<?php

namespace App\Livewire\Main\Account\Projects\Options;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\ProjectMilestone;
use App\Models\ProjectReview;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use App\Services\ProjectReputationService;
use App\Notifications\User\Freelancer\EmployerFundedMilestone;
use App\Notifications\User\Freelancer\EmployerReleasedMilestone;
use App\Notifications\User\Freelancer\ProjectReviewReceived as FreelancerProjectReviewReceived;
use App\Http\Validators\Main\Account\Projects\Employer\MilestoneValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MilestonesComponent extends Component
{
    use SEOToolsTrait, LivewireAlert;

    public $project;
    public $paid_amount;
    public $payments_in_progress;
    public $expected_delivery_date;

    public $milestone_amount;
    public $milestone_description;
    public ?array $confirmDialog = null;
    public ?array $milestoneDetails = null;
    public ?int $followUpSourceId = null;
    public bool $canRateFreelancer = false;
    public bool $ratingModalOpen = false;
    public int $ratingScore = 5;
    public string $ratingComment = '';
    public bool $hasPaidMilestones = false;
    public ?ProjectReview $clientReview = null;

    protected function showConfirmDialog(array $options): void
    {
        $this->confirmDialog = [
            'title'         => $options['title'] ?? '',
            'description'   => $options['description'] ?? '',
            'icon'          => $this->resolveDialogIcon($options['icon'] ?? null),
            'icon_wrapper'  => $options['iconBackground'] ?? 'bg-slate-100 rounded-full p-3',
            'icon_classes'  => $options['iconColor'] ?? 'text-slate-500',
            'confirm_label' => data_get($options, 'accept.label', __('messages.t_confirm')),
            'confirm_method'=> data_get($options, 'accept.method'),
            'confirm_params'=> data_get($options, 'accept.params'),
            'confirm_class' => $this->resolveConfirmButtonClasses(data_get($options, 'accept.color')),
            'cancel_label'  => data_get($options, 'reject.label', __('messages.t_cancel')),
            'show_cancel'   => filled(data_get($options, 'reject.label', __('messages.t_cancel'))),
        ];

        $this->dispatch('open-modal', 'modal-milestone-confirm');
    }

    public function submitConfirmDialog()
    {
        if (!$this->confirmDialog) {
            return;
        }

        $method = $this->confirmDialog['confirm_method'] ?? null;
        $params = $this->confirmDialog['confirm_params'] ?? null;

        $this->dispatch('close-modal', 'modal-milestone-confirm');
        $this->confirmDialog = null;

        if (!$method || !method_exists($this, $method)) {
            return;
        }

        if (is_array($params)) {
            return $this->{$method}(...$params);
        }

        if (!is_null($params)) {
            return $this->{$method}($params);
        }

        return $this->{$method}();
    }

    public function cancelConfirmDialog(): void
    {
        $this->dispatch('close-modal', 'modal-milestone-confirm');
        $this->confirmDialog = null;
    }

    public function closeDetailsModal(): void
    {
        $this->dispatch('close-modal', 'modal-milestone-details');
        $this->milestoneDetails = null;
    }

    protected function resolveDialogIcon(?string $icon): ?string
    {
        if (!$icon) {
            return null;
        }

        return [
            'document-text' => 'ph-duotone ph-textbox',
            'exclamation'   => 'ph-duotone ph-warning',
            'shield-check'  => 'ph-duotone ph-shield-check',
        ][$icon] ?? 'ph-duotone ph-info';
    }

    protected function resolveConfirmButtonClasses(?string $color): string
    {
        $base = 'inline-flex justify-center items-center rounded border font-semibold focus:outline-none px-3 py-2 leading-5 text-xs tracking-wide text-white focus:ring focus:ring-opacity-25 disabled:opacity-60 disabled:cursor-not-allowed';

        return match ($color) {
            'negative' => $base . ' border-transparent bg-red-600 hover:bg-red-700 focus:ring-red-500',
            'warning'  => $base . ' border-transparent bg-amber-500 hover:bg-amber-600 focus:ring-amber-500',
            default    => $base . ' border-transparent bg-primary-600 hover:bg-primary-700 focus:ring-primary-500',
        };
    }

    protected function formatMoney($value): string
    {
        return money(convertToNumber($value), settings('currency')->code, true)->format();
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

    protected function syncReviewState(): void
    {
        $this->hasPaidMilestones = $this->project->milestones()
            ->where('status', 'paid')
            ->exists();

        $existingReview = ProjectReview::query()
            ->where('project_id', $this->project->id)
            ->where('reviewer_id', auth()->id())
            ->where('reviewer_role', 'client')
            ->first();

        $this->clientReview = $existingReview;

        $this->canRateFreelancer = in_array($this->project->status, ['completed', 'pending_final_review'], true)
            && $this->hasPaidMilestones
            && is_null($existingReview);
    }

    protected function resetMilestoneForm(): void
    {
        $this->reset(['milestone_amount', 'milestone_description']);
        $this->followUpSourceId = null;
    }

    public function prepareStandardMilestone(): void
    {
        $this->resetMilestoneForm();
        $modalId = 'modal-create-milestone-container-' . $this->project->uid;
        $this->dispatch('open-modal', $modalId);
        $this->dispatch('modal:open', id: $modalId);
    }

    protected function validateFollowUpSelection(): ?ProjectMilestone
    {
        if (is_null($this->followUpSourceId)) {
            return null;
        }

        return ProjectMilestone::query()
            ->where('project_id', $this->project->id)
            ->where('id', $this->followUpSourceId)
            ->where('status', 'paid')
            ->first();
    }

    public function openFollowUp(string $uid): void
    {
        $milestone = ProjectMilestone::where('project_id', $this->project->id)
            ->where('uid', $uid)
            ->firstOrFail();

        if ($milestone->status !== 'paid') {
            $this->alert(
                'error',
                __('messages.t_error'),
                [
                    'text'     => __('messages.t_follow_up_milestone_only_after_payment'),
                    'toast'    => true,
                    'position' => 'top-end',
                ]
            );

            return;
        }

        $this->followUpSourceId = $milestone->id;
        $preview = Str::limit(strip_tags($milestone->description ?? __('messages.t_milestone')), 80);
        $this->milestone_description = __('messages.t_follow_up_milestone_default', ['label' => $preview]);
        $this->milestone_amount = '';

        $modalId = 'modal-create-milestone-container-' . $this->project->uid;
        $this->dispatch('open-modal', $modalId);
        $this->dispatch('modal:open', id: $modalId);
    }

    public function openRatingModal(): void
    {
        if (!$this->canRateFreelancer) {
            return;
        }

        $this->ratingScore = 5;
        $this->ratingComment = '';
        $this->resetValidation(['ratingScore', 'ratingComment']);
        $this->ratingModalOpen = true;
        $modalId = 'modal-project-review';
        $this->dispatch('open-modal', $modalId);
        $this->dispatch('modal:open', id: $modalId);
    }

    public function closeRatingModal(): void
    {
        $this->ratingModalOpen = false;
        $this->resetValidation(['ratingScore', 'ratingComment']);
        $modalId = 'modal-project-review';
        $this->dispatch('close-modal', $modalId);
        $this->dispatch('modal:close', id: $modalId);
    }

    public function submitRating(): void
    {
        if (!$this->canRateFreelancer) {
            return;
        }

        Validator::make(
            [
                'ratingScore'    => $this->ratingScore,
                'ratingComment'  => $this->ratingComment,
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
                'reviewer_role' => 'client',
            ],
            [
                'uid'          => ProjectReview::where('project_id', $this->project->id)
                    ->where('reviewer_id', auth()->id())
                    ->where('reviewer_role', 'client')
                    ->value('uid') ?? uid(),
                'reviewee_id'  => $this->project->awarded_freelancer_id,
                'score'        => $this->ratingScore,
                'comment'      => $this->ratingComment ? clean($this->ratingComment) : null,
                'is_skipped'   => false,
                'submitted_at' => now(),
            ]
        );

        if ($review->reviewee) {
            ProjectReputationService::refreshFor($review->reviewee);

            notification([
                'text'    => 't_notification_project_review_freelancer',
                'action'  => url('seller/projects/milestones', $this->project->uid),
                'user_id' => $review->reviewee_id,
                'params'  => [
                    'username' => auth()->user()->username,
                    'project'  => $this->project->title,
                    'rating'   => $this->ratingScore ? number_format((float) $this->ratingScore, 1) : null,
                ],
            ]);

            $review->reviewee->notify(new FreelancerProjectReviewReceived($this->project, $review, auth()->user()));
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
        if (!$this->canRateFreelancer) {
            return;
        }

        $review = ProjectReview::updateOrCreate(
            [
                'project_id'    => $this->project->id,
                'reviewer_id'   => auth()->id(),
                'reviewer_role' => 'client',
            ],
            [
                'uid'          => ProjectReview::where('project_id', $this->project->id)
                    ->where('reviewer_id', auth()->id())
                    ->where('reviewer_role', 'client')
                    ->value('uid') ?? uid(),
                'reviewee_id'  => $this->project->awarded_freelancer_id,
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
     * Init component
     *
     * @param string $id
     * @return void
     */
    public function mount($id)
    {
        // Get project
        $project                    = Project::where('uid', $id)
            ->whereHas('awarded_bid', function ($query) {
                return $query->where('is_freelancer_accepted', true);
            })
            ->where('user_id', auth()->id())
            ->with('awarded_bid')
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


    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    #[Layout('components.layouts.main-app')]
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

        return view('livewire.main.account.projects.options.milestones', [
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

        $statuses = [
            'request'   => ['color' => 'bg-amber-500', 'ring' => 'ring-amber-200/60', 'icon' => 'ph-duotone ph-hourglass'],
            'funded'    => ['color' => 'bg-sky-500', 'ring' => 'ring-sky-200/60', 'icon' => 'ph-duotone ph-bank'],
            'paid'      => ['color' => 'bg-emerald-500', 'ring' => 'ring-emerald-200/60', 'icon' => 'ph-duotone ph-check-circle'],
            'cancelled' => ['color' => 'bg-rose-500', 'ring' => 'ring-rose-200/60', 'icon' => 'ph-duotone ph-x-circle'],
            'canceled'  => ['color' => 'bg-rose-500', 'ring' => 'ring-rose-200/60', 'icon' => 'ph-duotone ph-x-circle'],
        ];

        $style = $statuses[$status] ?? ['color' => 'bg-slate-400', 'ring' => 'ring-slate-200/60', 'icon' => 'ph-duotone ph-circle'];

        return [
            'status_label' => $this->milestoneStatusLabel($status),
            'badge_color'  => $style['color'],
            'ring_color'   => $style['ring'],
            'icon'         => $style['icon'],
        ];
    }


    /**
     * Milestone payment
     *
     * @param string $id
     * @return void
     */
    public function details($id)
    {
        try {
            $payment = ProjectMilestone::where('project_id', $this->project->id)
                ->where('uid', $id)
                ->firstOrFail();

            $totalEmployer = convertToNumber($payment->amount) + convertToNumber($payment->employer_commission);

            $this->milestoneDetails = [
                'title'        => __('messages.t_milestone_payment_details'),
                'uid'          => $payment->uid,
                'status_key'   => $payment->status,
                'status'       => $this->milestoneStatusLabel($payment->status),
                'amount'       => $this->formatMoney($payment->amount),
                'employer_fee' => $this->formatMoney($payment->employer_commission),
                'freelancer_fee' => $this->formatMoney($payment->freelancer_commission),
                'total'        => $this->formatMoney($totalEmployer),
                'created_at'   => optional(optional($payment->created_at)->timezone(config('app.timezone')))->format('Y-m-d H:i'),
                'updated_at'   => optional(optional($payment->updated_at)->timezone(config('app.timezone')))->format('Y-m-d H:i'),
                'description'  => clean(nl2br($payment->description ?? '')),
            ];

            $this->dispatch('open-modal', 'modal-milestone-details');
        } catch (\Throwable $th) {
            $this->alert(
                'error',
                __('messages.t_error'),
                livewire_alert_params(__('messages.t_toast_something_went_wrong'), 'error')
            );
        }
    }


    /**
     * Create a milestone payment
     *
     * @return mixed
     */
    public function confirmCreate()
    {
        try {

            // Validate form
            MilestoneValidator::validate($this);

            $isFollowUp = !is_null($this->followUpSourceId);

            // Project must be active unless creating a follow-up after completion
            if (
                !in_array($this->project->status, ['active', 'under_development', 'pending_final_review'])
                && !($isFollowUp && $this->project->status === 'completed')
            ) {

                // Error
                $this->alert(
                    'error',
                    __('messages.t_error'),
                    [
                        'text'     => __('messages.t_u_cannot_create_milestones_for_this_project'),
                        'toast'    => true,
                        'position' => 'top-end',
                    ]
                );

                return;
            }

            $parentMilestone = null;
            if ($isFollowUp) {
                $parentMilestone = $this->validateFollowUpSelection();

                if (!$parentMilestone) {
                    $this->alert(
                        'error',
                        __('messages.t_error'),
                        [
                            'text'     => __('messages.t_follow_up_milestone_only_after_payment'),
                            'toast'    => true,
                            'position' => 'top-end',
                        ]
                    );

                    $this->resetMilestoneForm();
                    $this->dispatch('close-modal', 'modal-create-milestone-container-' . $this->project->uid);

                    return;
                }
            }

            // Check if employer has this money
            if (convertToNumber($this->milestone_amount) > convertToNumber(auth()->user()->balance_available)) {

                // Employer does not have money to create a milestone
                $this->showConfirmDialog([
                    'title'          => '<h1 class="text-base font-bold tracking-wide -mt-1 mb-2">' . __('messages.t_insufficient_funds_in_your_account') . '</h1>',
                    'description'    => __('messages.t_employer_u_dont_have_milestone_amount'),
                    'icon'           => "exclamation",
                    'iconColor'      => "text-red-600 dark:text-secondary-400 p-1",
                    'iconBackground' => "bg-red-50 rounded-full p-3 dark:bg-secondary-700",
                    'accept'         => [
                        'label'  => __('messages.t_deposit'),
                        'method' => 'deposit',
                        'color'  => 'negative'
                    ],
                    'reject' => [
                        'label'  => __('messages.t_cancel')
                    ],
                ]);

                // Reset form
                $this->resetMilestoneForm();

                // Close modal
                $this->dispatch('close-modal', 'modal-create-milestone-container-' . $this->project->uid);

                return;
            }

            // Set amount to paid to freelancer
            $milestone_amount = convertToNumber($this->milestone_amount);

            // Get projects settings
            $settings         = settings('projects');

            // Check commission type
            if ($settings->commission_type === 'fixed') {

                // Set employer commission
                $employer_commission   = convertToNumber($settings->commission_from_publisher);
                $freelancer_commission = convertToNumber($settings->commission_from_freelancer);
            } else {

                // Calculate commission
                $employer_commission   = (convertToNumber($settings->commission_from_publisher) / 100) * $milestone_amount;
                $freelancer_commission = (convertToNumber($settings->commission_from_freelancer) / 100) * $milestone_amount;
            }

            // Show confirmation dialog
            $this->showConfirmDialog([
                'title'          => '<h1 class="text-base font-bold tracking-wide">' . __('messages.t_confirm_milestone_payment') . '</h1>',
                'description'    => "<div class='leading-relaxed'>" . __('messages.t_pls_review_ur_milestone_payment_details') . "<br></div>
                <div class='rounded border dark:border-secondary-600 my-8'>
                <dl class='divide-y divide-gray-200 dark:divide-gray-600'>
                    <div class='grid grid-cols-3 gap-4 py-3 px-4'>
                        <dt class='text-sm font-medium whitespace-nowrap text-gray-500 dark:text-secondary-500 ltr:text-left rtl:text-right'>" . __('messages.t_the_amount_to_be_paid_to_freelancer') . "</dt>
                        <dd class='text-sm font-semibold text-zinc-900 dark:text-secondary-400 col-span-2 mt-0 ltr:text-right rtl:text-left'>" . money($milestone_amount, settings('currency')->code, true) . "</dd>
                    </div>
                    <div class='grid grid-cols-3 gap-4 py-3 px-4'>
                        <dt class='text-sm font-medium whitespace-nowrap text-gray-500 dark:text-secondary-500 ltr:text-left rtl:text-right'>" . __('messages.t_milestone_employer_fee_name') . "</dt>
                        <dd class='text-sm font-semibold text-green-600 dark:text-secondary-400 col-span-2 mt-0 ltr:text-right rtl:text-left'>+ " . money(convertToNumber($employer_commission), settings('currency')->code, true) . "</dd>
                    </div>
                    <div class='grid grid-cols-3 gap-4 py-3 px-4'>
                        <dt class='text-sm font-medium whitespace-nowrap text-gray-500 dark:text-secondary-500 ltr:text-left rtl:text-right'>" . __('messages.t_milestone_freelancer_fee_name') . "</dt>
                        <dd class='text-sm font-semibold text-red-500 dark:text-secondary-400 col-span-2 mt-0 ltr:text-right rtl:text-left'>- " . money(convertToNumber($freelancer_commission), settings('currency')->code, true) . "</dd>
                    </div>
                    <div class='grid grid-cols-3 gap-4 py-3 px-4 bg-gray-100/60 dark:bg-secondary-700 rounded-b'>
                        <dt class='text-sm font-medium whitespace-nowrap text-gray-500 dark:text-secondary-400 ltr:text-left rtl:text-right'>" . __('messages.t_total') . "</dt>
                        <dd class='text-sm font-semibold text-zinc-900 dark:text-secondary-400 col-span-2 mt-0 ltr:text-right rtl:text-left'>" . money($milestone_amount + convertToNumber($employer_commission), settings('currency')->code, true) . "</dd>
                    </div>
                </dl>
                </div>
                ",
                'icon'           => "shield-check",
                'iconColor'      => "text-slate-500 dark:text-secondary-400 p-1",
                'iconBackground' => "bg-slate-100 rounded-full p-3 dark:bg-secondary-700",
                'accept'         => [
                    'label'  => __('messages.t_confirm'),
                    'method' => 'create',
                    'color'  => 'secondary'
                ],
                'reject' => [
                    'label'  => __('messages.t_cancel')
                ],
            ]);

            // Close modal
            $this->dispatch('close-modal', 'modal-create-milestone-container-' . $this->project->uid);
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
     * Create a milestone payment
     *
     * @return mixed
     */
    public function create()
    {
        try {

            // Validate form
            MilestoneValidator::validate($this);

            $isFollowUp = !is_null($this->followUpSourceId);

            // Project must be active unless creating a follow-up after completion
            if (
                !in_array($this->project->status, ['active', 'under_development', 'pending_final_review']) &&
                !($isFollowUp && $this->project->status === 'completed')
            ) {

                // Error
            $this->alert(
                'error',
                __('messages.t_error'),
                [
                    'text'     => __('messages.t_u_cannot_create_milestones_for_this_project'),
                    'toast'    => true,
                    'position' => 'top-end',
                ]
            );

                return;
            }

            $parentMilestone = null;
            if ($isFollowUp) {
                $parentMilestone = $this->validateFollowUpSelection();

                if (!$parentMilestone) {
                    $this->alert(
                        'error',
                        __('messages.t_error'),
                        [
                            'text'     => __('messages.t_follow_up_milestone_only_after_payment'),
                            'toast'    => true,
                            'position' => 'top-end',
                        ]
                    );

                    $this->resetMilestoneForm();
                    $this->dispatch('close-modal', 'modal-create-milestone-container-' . $this->project->uid);

                    return;
                }
            }

            // Check if employer has this money
            if (convertToNumber($this->milestone_amount) > convertToNumber(auth()->user()->balance_available)) {

                // Employer does not have money to create a milestone
                $this->showConfirmDialog([
                    'title'          => '<h1 class="text-base font-bold tracking-wide -mt-1 mb-2">' . __('messages.t_insufficient_funds_in_your_account') . '</h1>',
                    'description'    => __('messages.t_employer_u_dont_have_milestone_amount'),
                    'icon'           => "exclamation",
                    'iconColor'      => "text-red-600 dark:text-secondary-400 p-1",
                    'iconBackground' => "bg-red-50 rounded-full p-3 dark:bg-secondary-700",
                    'accept'         => [
                        'label'  => __('messages.t_deposit'),
                        'method' => 'deposit',
                        'color'  => 'negative'
                    ],
                    'reject' => [
                        'label'  => __('messages.t_cancel')
                    ],
                ]);

                // Reset form
                $this->resetMilestoneForm();

                // Close modal
                $this->dispatch('close-modal', 'modal-create-milestone-container-' . $this->project->uid);

                return;
            }

            // Set amount to paid to freelancer
            $milestone_amount = convertToNumber($this->milestone_amount);

            // Get projects settings
            $settings         = settings('projects');

            // Check commission type
            if ($settings->commission_type === 'fixed') {

                // Set employer commission
                $employer_commission   = convertToNumber($settings->commission_from_publisher);

                // Set freelancer commission
                $freelancer_commission = convertToNumber($settings->commission_from_freelancer);
            } else {

                // Calculate commission
                $employer_commission   = (convertToNumber($settings->commission_from_publisher) / 100) * $milestone_amount;

                // Set freelancer commission
                $freelancer_commission = (convertToNumber($settings->commission_from_freelancer) / 100) * $milestone_amount;
            }

            // Set total amount to be taken from the employer
            $total_amount_from_employer       = convertToNumber($this->milestone_amount) + convertToNumber($employer_commission);

            // Create new milestone
            $milestone                        = new ProjectMilestone();
            $milestone->uid                   = uid();
            $milestone->project_id            = $this->project->id;
            $milestone->created_by            = 'employer';
            $milestone->employer_id           = auth()->id();
            $milestone->freelancer_id         = $this->project->awarded_freelancer_id;
            $milestone->amount                = $this->milestone_amount;
            $milestone->employer_commission   = $employer_commission;
            $milestone->freelancer_commission = $freelancer_commission;
            $milestone->description           = clean($this->milestone_description);
            $milestone->status                = 'funded';
            $milestone->is_follow_up          = $isFollowUp;
            $milestone->parent_milestone_id   = $parentMilestone?->id;
            $milestone->save();

            // Let's update user available balance
            User::where('id', auth()->id())->update([
                'balance_available' => convertToNumber(auth()->user()->balance_available) - $total_amount_from_employer
            ]);

            // Send a notification to the freelancer
            $this->project->awarded_bid->user->notify(new EmployerFundedMilestone($milestone));

            // Calculate pending funds
            $this->calculatePendingFunds();
            $this->calculatePaidFunds();

            // Mark project as pending final reviews
            if (!$isFollowUp && $this->payments_in_progress >= convertToNumber($this->project->awarded_bid->amount)) {

                // Update project
                $this->project->status = 'pending_final_review';
                $this->project->save();
            } elseif ($isFollowUp && $this->project->status === 'completed') {
                $this->project->status = 'under_development';
                $this->project->save();
            }

            // Reset form
            $this->resetMilestoneForm();

            // Close modal
            $this->dispatch('close-modal', 'modal-create-milestone-container-' . $this->project->uid);

            // Refresh project
            $this->project->refresh();
            $this->syncReviewState();

            // Success
            $this->alert(
                'success',
                __('messages.t_success'),
                [
                    'text'     => __('messages.t_milestone_created_success'),
                    'toast'    => true,
                    'position' => 'top-end',
                ]
            );
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
     * Confirm depositing amount
     *
     * @param string $id
     * @return void
     */
    public function confirmPay($id)
    {
        try {

            // Get milestone payment
            $payment = ProjectMilestone::where('project_id', $this->project->id)
                ->where('status', 'request')
                ->where('uid', $id)
                ->firstOrFail();

            // Check if user has the amount to paid
            if ((convertToNumber($payment->amount) + convertToNumber($payment->employer_commission)) > convertToNumber(auth()->user()->balance_available)) {

                // Employer does not have money to create a milestone
                $this->showConfirmDialog([
                    'title'          => '<h1 class="text-base font-bold tracking-wide -mt-1 mb-2">' . __('messages.t_insufficient_funds_in_your_account') . '</h1>',
                    'description'    => __('messages.t_employer_u_dont_have_milestone_amount'),
                    'icon'           => "exclamation",
                    'iconColor'      => "text-red-600 dark:text-secondary-400 p-1",
                    'iconBackground' => "bg-red-50 rounded-full p-3 dark:bg-secondary-700",
                    'accept'         => [
                        'label'  => __('messages.t_deposit'),
                        'method' => 'deposit',
                        'color'  => 'negative'
                    ],
                    'reject' => [
                        'label'  => __('messages.t_cancel')
                    ],
                ]);

                return;
            }

            // Confirm dialog
            $this->showConfirmDialog([
                'title'          => '<h1 class="text-base font-bold tracking-wide">' . __('messages.t_deposit_funds') . '</h1>',
                'description'    => __('messages.t_u_will_be_depositing_this_amount_employer_milestone'),
                'icon'           => "shield-check",
                'iconColor'      => "text-slate-500 dark:text-secondary-400 p-1",
                'iconBackground' => "bg-slate-100 rounded-full p-3 dark:bg-secondary-700",
                'accept'         => [
                    'label'  => __('messages.t_confirm'),
                    'method' => 'pay',
                    'params' => $payment->uid,
                    'color'  => 'secondary'
                ],
                'reject' => [
                    'label'  => __('messages.t_cancel')
                ],
            ]);
        } catch (\Throwable $th) {

            // Error
            $this->alert(
                'error',
                __('messages.t_error'),
                livewire_alert_params(__('messages.t_toast_something_went_wrong'), 'error')
            );
        }
    }


    /**
     * Deposit this amount
     *
     * @param string $id
     * @return void
     */
    public function pay($id)
    {
        try {

            // Get milestone payment
            $payment         = ProjectMilestone::where('project_id', $this->project->id)
                ->where('status', 'request')
                ->where('uid', $id)
                ->firstOrFail();

            // Check if user has the amount to paid
            if ((convertToNumber($payment->amount) + convertToNumber($payment->employer_commission)) > convertToNumber(auth()->user()->balance_available)) {

                // Employer does not have money to create a milestone
                $this->showConfirmDialog([
                    'title'          => '<h1 class="text-base font-bold tracking-wide -mt-1 mb-2">' . __('messages.t_insufficient_funds_in_your_account') . '</h1>',
                    'description'    => __('messages.t_employer_u_dont_have_milestone_amount'),
                    'icon'           => "exclamation",
                    'iconColor'      => "text-red-600 dark:text-secondary-400 p-1",
                    'iconBackground' => "bg-red-50 rounded-full p-3 dark:bg-secondary-700",
                    'accept'         => [
                        'label'  => __('messages.t_deposit'),
                        'method' => 'deposit',
                        'color'  => 'negative'
                    ],
                    'reject' => [
                        'label'  => __('messages.t_cancel')
                    ],
                ]);

                return;
            }

            // Update milestone status
            $payment->status = 'funded';
            $payment->save();

            // Let's update user's amount
            auth()->user()->update([
                'balance_available' => convertToNumber(auth()->user()->balance_available) - (convertToNumber($payment->amount) + convertToNumber($payment->employer_commission))
            ]);

            // Calculate pending funds
            $this->calculatePendingFunds();
            $this->calculatePaidFunds();

            // Mark project as pending final reviews
            if ($this->payments_in_progress >= convertToNumber($this->project->awarded_bid->amount)) {

                // Update project
                $this->project->status = 'pending_final_review';
                $this->project->save();
            }

            // Send notification to the freelancer
            notification([
                'text'    => 't_username_has_deposited_amount_in_project',
                'action'  => url('seller/projects/milestones', $this->project->uid),
                'user_id' => $this->project->awarded_freelancer_id,
                'params'  => [
                    'username' => $this->project->client->username,
                    'amount'   => money(convertToNumber($payment->amount), settings('currency')->code, true)->format()
                ]
            ]);

            // Send notification by email
            $this->project->awarded_bid->user->notify(new EmployerFundedMilestone($payment));

            // Refresh project
            $this->project->refresh();
            $this->syncReviewState();

            // Success
            $this->alert(
                'success',
                __('messages.t_success'),
                livewire_alert_params(__('messages.t_toast_operation_success'))
            );
        } catch (\Throwable $th) {

            // Error
            $this->alert(
                'error',
                __('messages.t_error'),
                livewire_alert_params(__('messages.t_toast_something_went_wrong'), 'error')
            );
        }
    }


    /**
     * Confirm releasing amount
     *
     * @param string $id
     * @return void
     */
    public function confirmRelease($id)
    {
        try {

            // Get milestone payment
            $payment = ProjectMilestone::where('project_id', $this->project->id)
                ->where('status', 'funded')
                ->where('uid', $id)
                ->firstOrFail();

            // Confirm dialog
            $this->showConfirmDialog([
                'title'          => '<h1 class="text-base font-bold tracking-wide">' . __('messages.t_confirm_release_of_payment_for_username', ['username' => $this->project->awarded_bid->user->username]) . '</h1>',
                'description'    => __('messages.t_pls_ensure_that_u_are_satisfied_with_work_freelancer', ['username' => $this->project->awarded_bid->user->username]),
                'icon'           => "shield-check",
                'iconColor'      => "text-amber-600 dark:text-secondary-400 p-1",
                'iconBackground' => "bg-amber-100 rounded-full p-3 dark:bg-secondary-700",
                'accept'         => [
                    'label'  => __('messages.t_confirm'),
                    'method' => 'release',
                    'params' => $payment->uid,
                    'color'  => 'warning'
                ],
                'reject' => [
                    'label'  => __('messages.t_cancel')
                ],
            ]);
        } catch (\Throwable $th) {

            // Error
            $this->alert(
                'error',
                __('messages.t_error'),
                livewire_alert_params(__('messages.t_toast_something_went_wrong'), 'error')
            );
        }
    }


    /**
     * Release milestone payment
     *
     * @param int $id
     * @return mixed
     */
    public function release($id)
    {
        try {

            // Get milestone payment
            $milestone         = ProjectMilestone::where('project_id', $this->project->id)
                ->where('status', 'funded')
                ->where('uid', $id)
                ->firstOrFail();

            // Set freelancer
            $freelancer        = $milestone->project->awarded_bid->user;

            // Set amount to give to freelancer
            $amount            = convertToNumber($milestone->amount) - convertToNumber($milestone->freelancer_commission);

            // Release this payment
            $milestone->status = 'paid';
            $milestone->save();

            // Let's give freelancer his money
            User::where('id', $freelancer->id)
                ->update([
                    'balance_available' => convertToNumber($freelancer->balance_available) + convertToNumber($amount)
                ]);

            // Calculate paid amount
            $this->calculatePaidFunds();
            $this->calculatePendingFunds();

            // Mark project as completed if employer paid everything
            if ($this->paid_amount >= $milestone->project->awarded_bid->amount) {

                // Update project
                $this->project->status = 'completed';
                $this->project->save();
            }

            // Send notification to freelancer via email
            $freelancer->notify(new EmployerReleasedMilestone($milestone));

            // Send notification in web app
            notification([
                'text'    => 't_username_has_released_amount_in_project',
                'action'  => url('seller/projects/milestones', $this->project->uid),
                'user_id' => $freelancer->id,
                'params'  => [
                    'username' => $this->project->client->username,
                    'amount'   => money($amount, settings('currency')->code, true)->format()
                ]
            ]);

            // Refresh project
            $this->project->refresh();
            $this->syncReviewState();

            // Success
            $this->alert(
                'success',
                __('messages.t_success'),
                [
                    'text'     => __('messages.t_milestone_payment_released_success'),
                    'toast'    => true,
                    'position' => 'top-end',
                ]
            );
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
     * Go to deposit page
     *
     * @return void
     */
    public function deposit()
    {
        // Go to deposit page
        return redirect('account/deposit');
    }


    /**
     * Calculate paid funds
     *
     * @return void
     */
    private function calculatePaidFunds()
    {
        // Calculate amount
        $amount            = ProjectMilestone::where('project_id', $this->project->id)
            ->whereIn('status', ['paid'])
            ->sum('amount');

        // Set value value
        $this->paid_amount = convertToNumber($amount);
    }


    /**
     * Calculate pending funds
     *
     * @return void
     */
    private function calculatePendingFunds()
    {
        // Calculate amount
        $amount                     = ProjectMilestone::where('project_id', $this->project->id)
            ->whereIn('status', ['request', 'funded'])
            ->sum('amount');

        // Set value
        $this->payments_in_progress = convertToNumber($amount);
    }
}
