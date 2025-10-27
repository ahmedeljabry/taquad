<?php

namespace App\Livewire\Main\Seller\Projects\Milestones;

use Carbon\Carbon;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use App\Models\ProjectMilestone;
use App\Models\ProjectReview;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use App\Notifications\User\Client\ProjectReviewReceived as ClientProjectReviewReceived;
use App\Notifications\User\Employer\FreelancerRequestedMilestone;
use App\Http\Validators\Main\Seller\Projects\Milestones\RequestValidator;
use App\Services\ProjectReputationService;
use Illuminate\Support\Facades\Validator;

class MilestonesComponent extends Component
{
    use WithPagination, SEOToolsTrait, LivewireAlert;

    public $project;
    public $paid_amount;
    public $payments_in_progress;
    public $expected_delivery_date;

    public $amount;
    public $description;

    public $confirmSummary = [];
    public bool $canRateClient = false;
    public bool $ratingModalOpen = false;
    public int $ratingScore = 5;
    public string $ratingComment = '';
    public bool $hasPaidMilestones = false;
    public ?ProjectReview $freelancerReview = null;


    /**
     * Initialize component
     *
     * @return mixed
     */
    public function mount($id)
    {
        // Get settings
        $settings = settings('projects');

        // Check if this section enabled
        if (!$settings->is_enabled) {

            // Redirect to home page
            return redirect('/');
        }

        // Get project
        $project = Project::where('uid', $id)
            ->where('awarded_freelancer_id', auth()->id())
            ->whereIn('status', ['active', 'completed', 'under_development', 'pending_final_review', 'incomplete', 'closed'])
            ->whereHas('awarded_bid', function ($query) {
                return $query->where('user_id', auth()->id())
                    ->where('is_freelancer_accepted', true)
                    ->where('status', 'active');
            })
            ->firstOrFail();

        // Set project
        $this->project              = $project;

        // Calculate paid amount
        $this->paid_amount          = $project->milestones->where('status', 'paid')->sum('amount');

        // Calculate payments in progress
        $this->payments_in_progress = $project->milestones->whereIn('status', ['funded', 'request'])->sum('amount');

        // Get awarded bid
        $awarded_bid                = $project->awarded_bid;

        // Set expected delivery date
        try {

            // Convert date
            $format_date                  = new Carbon($awarded_bid->freelancer_accepted_date, config('app.timezone'));

            // Set expected delivery time
            $this->expected_delivery_date = $format_date->addDays($awarded_bid->days);
        } catch (\Throwable $th) {

            // Something went wrong
            $this->expected_delivery_date = null;
        }

        $this->syncReviewState();
    }

    protected function syncReviewState(): void
    {
        $this->hasPaidMilestones = $this->project->milestones()
            ->where('status', 'paid')
            ->exists();

        $existingReview = ProjectReview::query()
            ->where('project_id', $this->project->id)
            ->where('reviewer_id', auth()->id())
            ->where('reviewer_role', 'freelancer')
            ->first();

        $this->freelancerReview = $existingReview;

        $this->canRateClient = in_array($this->project->status, ['completed', 'pending_final_review'], true)
            && $this->hasPaidMilestones
            && is_null($existingReview);
    }

    protected function milestoneStatusLabel(string $status): string
    {
        return match ($status) {
            'request' => __('messages.t_milestone_status_request'),
            'funded'  => __('messages.t_milestone_status_funded'),
            'paid'    => __('messages.t_milestone_status_paid'),
            'cancelled', 'canceled' => __('messages.t_milestone_status_cancelled'),
            default   => ucfirst($status),
        };
    }

    public function getTimelineProperty()
    {
        $milestones = $this->project
            ->milestones()
            ->with(['followUps' => function ($query) {
                $query->orderBy('created_at');
            }])
            ->orderBy('created_at')
            ->get();

        $roots = $milestones->whereNull('parent_milestone_id');

        $childrenGroups = $milestones
            ->whereNotNull('parent_milestone_id')
            ->groupBy('parent_milestone_id');

        return $roots->map(function (ProjectMilestone $milestone) use ($childrenGroups) {
            $children = $childrenGroups
                ->get($milestone->id, collect())
                ->map(function (ProjectMilestone $child) {
                    return [
                        'milestone' => $child,
                        'meta'      => $this->timelineMeta($child),
                    ];
                });

            return [
                'milestone' => $milestone,
                'children'  => $children,
                'meta'      => $this->timelineMeta($milestone),
            ];
        });
    }

    protected function timelineMeta(ProjectMilestone $milestone): array
    {
        $status = $milestone->status;

        $styles = [
            'request'   => ['color' => 'bg-amber-500', 'ring' => 'ring-amber-200/60', 'icon' => 'ph-duotone ph-hourglass'],
            'funded'    => ['color' => 'bg-sky-500', 'ring' => 'ring-sky-200/60', 'icon' => 'ph-duotone ph-bank'],
            'paid'      => ['color' => 'bg-emerald-500', 'ring' => 'ring-emerald-200/60', 'icon' => 'ph-duotone ph-check-circle'],
            'cancelled' => ['color' => 'bg-rose-500', 'ring' => 'ring-rose-200/60', 'icon' => 'ph-duotone ph-x-circle'],
            'canceled'  => ['color' => 'bg-rose-500', 'ring' => 'ring-rose-200/60', 'icon' => 'ph-duotone ph-x-circle'],
        ];

        $style = $styles[$status] ?? ['color' => 'bg-slate-400', 'ring' => 'ring-slate-200/60', 'icon' => 'ph-duotone ph-circle'];

        return [
            'status_label' => $this->milestoneStatusLabel($status),
            'badge_color'  => $style['color'],
            'ring_color'   => $style['ring'],
            'icon'         => $style['icon'],
        ];
    }

    public function openRatingModal(): void
    {
        if (!$this->canRateClient) {
            return;
        }

        $this->ratingScore = 5;
        $this->ratingComment = '';
        $this->resetValidation(['ratingScore', 'ratingComment']);
        $this->ratingModalOpen = true;
        $modalId = 'modal-project-feedback';
        $this->dispatch('open-modal', $modalId);
        $this->dispatch('modal:open', id: $modalId);
    }

    public function closeRatingModal(): void
    {
        $this->ratingModalOpen = false;
        $this->resetValidation(['ratingScore', 'ratingComment']);
        $modalId = 'modal-project-feedback';
        $this->dispatch('close-modal', $modalId);
        $this->dispatch('modal:close', id: $modalId);
    }

    public function submitRating(): void
    {
        if (!$this->canRateClient) {
            return;
        }

        Validator::make(
            [
                'ratingScore'   => $this->ratingScore,
                'ratingComment' => $this->ratingComment,
            ],
            [
                'ratingScore'   => ['required', 'integer', 'min:1', 'max:5'],
                'ratingComment' => ['nullable', 'string', 'max:600'],
            ],
            [
                'ratingScore.required' => __('messages.t_project_rating_required'),
                'ratingScore.integer'  => __('messages.t_project_rating_required'),
                'ratingScore.min'      => __('messages.t_project_rating_required'),
                'ratingScore.max'      => __('messages.t_project_rating_required'),
                'ratingComment.max'    => __('messages.t_validator_max', ['max' => 600]),
            ]
        )->validate();

        $review = ProjectReview::updateOrCreate(
            [
                'project_id'    => $this->project->id,
                'reviewer_id'   => auth()->id(),
                'reviewer_role' => 'freelancer',
            ],
            [
                'uid'          => ProjectReview::where('project_id', $this->project->id)
                    ->where('reviewer_id', auth()->id())
                    ->where('reviewer_role', 'freelancer')
                    ->value('uid') ?? uid(),
                'reviewee_id'  => $this->project->user_id,
                'score'        => $this->ratingScore,
                'comment'      => $this->ratingComment ? clean($this->ratingComment) : null,
                'is_skipped'   => false,
                'submitted_at' => now(),
            ]
        );

        if ($review->reviewee) {
            ProjectReputationService::refreshFor($review->reviewee);

            notification([
                'text'    => 't_notification_project_review_client',
                'action'  => url('account/projects/milestones', $this->project->uid),
                'user_id' => $review->reviewee_id,
                'params'  => [
                    'username' => auth()->user()->username,
                    'project'  => $this->project->title,
                    'rating'   => $this->ratingScore ? number_format((float) $this->ratingScore, 1) : null,
                ],
            ]);

            $review->reviewee->notify(new ClientProjectReviewReceived($this->project, $review, auth()->user()));
        }

        $this->resetValidation(['ratingScore', 'ratingComment']);
        $this->closeRatingModal();
        $this->syncReviewState();

        $this->alert(
            'success',
            __('messages.t_success'),
            [
                'text'     => __('messages.t_project_review_saved'),
                'toast'    => true,
                'position' => 'top-end',
            ]
        );
    }

    public function skipRating(): void
    {
        if (!$this->canRateClient) {
            return;
        }

        $review = ProjectReview::updateOrCreate(
            [
                'project_id'    => $this->project->id,
                'reviewer_id'   => auth()->id(),
                'reviewer_role' => 'freelancer',
            ],
            [
                'uid'          => ProjectReview::where('project_id', $this->project->id)
                    ->where('reviewer_id', auth()->id())
                    ->where('reviewer_role', 'freelancer')
                    ->value('uid') ?? uid(),
                'reviewee_id'  => $this->project->user_id,
                'score'        => null,
                'comment'      => null,
                'is_skipped'   => true,
                'submitted_at' => now(),
            ]
        );

        if ($review->reviewee) {
            ProjectReputationService::refreshFor($review->reviewee);
        }

        $this->resetValidation(['ratingScore', 'ratingComment']);
        $this->closeRatingModal();
        $this->syncReviewState();

        $this->alert(
            'info',
            __('messages.t_noted'),
            [
                'text'     => __('messages.t_project_review_skipped'),
                'toast'    => true,
                'position' => 'top-end',
            ]
        );
    }


    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    #[Layout('components.layouts.seller-app')]
    public function render()
    {
        // SEO
        $separator   = settings('general')->separator;
        $title       = __('messages.t_milestone_payments') . " $separator " . settings('general')->title;
        $description = settings('seo')->description;
        $ogimage     = src(settings('seo')->ogimage);

        $this->seo()->setTitle($title);
        $this->seo()->setDescription($description);
        $this->seo()->setCanonical(url()->current());
        $this->seo()->opengraph()->setTitle($title);
        $this->seo()->opengraph()->setDescription($description);
        $this->seo()->opengraph()->setUrl(url()->current());
        $this->seo()->opengraph()->setType('website');
        $this->seo()->opengraph()->addImage($ogimage);
        $this->seo()->twitter()->setImage($ogimage);
        $this->seo()->twitter()->setUrl(url()->current());
        $this->seo()->twitter()->setSite("@" . settings('seo')->twitter_username);
        $this->seo()->twitter()->addValue('card', 'summary_large_image');
        $this->seo()->metatags()->addMeta('fb:page_id', settings('seo')->facebook_page_id, 'property');
        $this->seo()->metatags()->addMeta('fb:app_id', settings('seo')->facebook_app_id, 'property');
        $this->seo()->metatags()->addMeta('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1', 'name');
        $this->seo()->jsonLd()->setTitle($title);
        $this->seo()->jsonLd()->setDescription($description);
        $this->seo()->jsonLd()->setUrl(url()->current());
        $this->seo()->jsonLd()->setType('WebSite');

        return view('livewire.main.seller.projects.milestones.milestones', [
            'payments' => $this->payments,
            'timeline' => $this->timeline,
        ]);
    }


    /**
     * Get milestone payments
     *
     * @return object
     */
    public function getPaymentsProperty()
    {
        return ProjectMilestone::where('project_id', $this->project->id)
            ->latest()
            ->paginate(42);
    }


    /**
     * Request a milestone payment
     *
     * @return void
     */
    public function confirmRequest()
    {
        try {

            // Project must be active or under development
            if (!in_array($this->project->status, ['active', 'under_development'])) {
                return;
            }

            // Validate form
            RequestValidator::validate($this);

            // Get bid mount
            $bid_amount   = $this->project->awarded_bid->amount;

            // Count total milestones paymanets amount
            $total_amount = ProjectMilestone::where('project_id', $this->project->id)->sum('amount');

            // You must not ask more money than the project budget you agreed with employer
            if (convertToNumber($this->amount) + convertToNumber($total_amount) > convertToNumber($bid_amount)) {

                // Error
                $this->alert('error', __('messages.t_error'), [
                    'text'     => __('messages.t_u_exceeded_amount_agreed_with_employer_milestone'),
                    'toast'    => true,
                    'position' => 'top-end',
                ]);

                return;
            }

            // Get projects settings
            $settings = settings('projects');

            // Check commission type
            if ($settings->commission_type === 'fixed') {

                // Set freelancer commission
                $freelancer_commission = convertToNumber($settings->commission_from_freelancer);
            } else {

                // Calculate commission
                $freelancer_commission = (convertToNumber($settings->commission_from_freelancer) / 100) * convertToNumber($this->amount);
            }

            // Close form modal and prepare confirmation state
            $this->dispatch('close-modal', 'modal-request-milestone-container');

            $this->confirmSummary = [
                'requested_amount'      => convertToNumber($this->amount),
                'freelancer_commission' => convertToNumber($freelancer_commission),
            ];

            $this->dispatch('open-modal', 'modal-confirm-request');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Validation error
            $this->alert(
                'error',
                __('messages.t_error'),
                livewire_alert_params($e->getMessage(), 'error')
            );

            throw $e;
        } catch (\Throwable $th) {
            // Error
            $this->alert(
                'error',
                __('messages.t_error'),
                livewire_alert_params($th->getMessage(), 'error')
            );
        }
    }


    /**
     * Allow freelancer to review data again before confirming
     *
     * @return void
     */
    public function cancelConfirmation(): void
    {
        $this->dispatch('close-modal', 'modal-confirm-request');
        $this->dispatch('open-modal', 'modal-request-milestone-container');
        $this->confirmSummary = [];
    }

    /**
     * Now let's handle this milestone payment request
     *
     * @return void
     */
    public function request()
    {
        try {

            // Project must be active or under development
            if (!in_array($this->project->status, ['active', 'under_development'])) {
                return;
            }

            // Validate form
            RequestValidator::validate($this);

            // Get bid mount
            $bid_amount   = $this->project->awarded_bid->amount;

            // Count total milestones paymanets amount
            $total_amount = ProjectMilestone::where('project_id', $this->project->id)->sum('amount');

            // You must not ask more money than the project budget you agreed with employer
            if (convertToNumber($this->amount) + convertToNumber($total_amount) > convertToNumber($bid_amount)) {

                // Error
                $this->alert('error', __('messages.t_error'), [
                    'text'     => __('messages.t_u_exceeded_amount_agreed_with_employer_milestone'),
                    'toast'    => true,
                    'position' => 'top-end',
                ]);

                return;
            }

            // Get projects settings
            $settings = settings('projects');

            // Check commission type
            if ($settings->commission_type === 'fixed') {

                // Set freelancer commission
                $freelancer_commission = convertToNumber($settings->commission_from_freelancer);

                // Set employer commission
                $employer_commission   = convertToNumber($settings->commission_from_publisher);
            } else {

                // Calculate commission
                $freelancer_commission = (convertToNumber($settings->commission_from_freelancer) / 100) * convertToNumber($this->amount);

                // Set employer commission
                $employer_commission   = (convertToNumber($settings->commission_from_publisher) / 100) * convertToNumber($this->amount);
            }

            // Create a milestone request
            $milestone                        = new ProjectMilestone();
            $milestone->uid                   = uid();
            $milestone->project_id            = $this->project->id;
            $milestone->created_by            = 'freelancer';
            $milestone->freelancer_id         = auth()->id();
            $milestone->employer_id           = $this->project->user_id;
            $milestone->amount                = convertToNumber($this->amount);
            $milestone->employer_commission   = $employer_commission;
            $milestone->freelancer_commission = $freelancer_commission;
            $milestone->description           = clean($this->description);
            $milestone->status                = 'request';
            $milestone->save();

            // Get new total amount requested or paid for this project
            $total_amount                     = ProjectMilestone::where('project_id', $this->project->id)->sum('amount');

            // Mark project as pending final review
            if ($total_amount == $bid_amount) {

                // Update status
                $this->project->status = "pending_final_review";
                $this->project->save();

                // Refresh project
                $this->project->refresh();
            }

            // Send a notification to the employer
            $this->project->client->notify(new FreelancerRequestedMilestone($milestone->load('project')));

            // Sen notification via web app
            notification([
                'text'    => 't_subject_employer_freelancer_requested_a_milestone',
                'action'  => url('account/projects/milestones', $this->project->uid),
                'user_id' => $this->project->user_id
            ]);

            $this->dispatch('close-modal', 'modal-confirm-request');
            $this->confirmSummary = [];

            // Refresh the page
            return redirect('seller/projects/milestones/' . $this->project->uid);
        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->alert(
                'error',
                __('messages.t_error'),
                livewire_alert_params(__('messages.t_toast_form_validation_error'), 'error')
            );

            throw $e;
        } catch (\Throwable $th) {

            // Error
            $this->alert(
                'error',
                __('messages.t_error'),
                livewire_alert_params($th->getMessage(), 'error')
            );
        }
    }


    /**
     * Close confirmation modal
     * We have to reset this values
     * In case he wants to make another request
     *
     * @return void
     */
    public function cancel()
    {
        $this->reset(['amount', 'description']);
    }
}
