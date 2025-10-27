<?php

namespace App\Livewire\Main\Project;

use App\Models\Admin;
use App\Models\Project;
use App\Models\ProjectVisit;
use Livewire\Component;
use App\Models\ProjectBid;
use WireUi\Traits\Actions;
use Illuminate\Support\Str;
use App\Models\ReportedProject;
use Livewire\Attributes\Layout;
use App\Jobs\Main\Project\Track;
use App\Models\ProjectBidUpgrade;
use App\Models\ProjectBiddingPlan;
use App\Notifications\Admin\ProjectReported;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Notifications\Admin\BidPendingApproval;
use App\Http\Validators\Main\Project\BidValidator;
use App\Notifications\User\Everyone\NewBidReceived;
use App\Http\Validators\Main\Project\ReportValidator;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class ProjectComponent extends Component
{
    use SEOToolsTrait, LivewireAlert, Actions;

    public $project;
    public $avg_bid;
    public $sort_bids_by;
    public $already_submitted_proposal;
    public array $clientInsights = [];
    public array $clientFeedbackSummary = [];

    // Bid form
    public $bid_amount;
    public $bid_amount_paid;
    public $bid_days;
    public $bid_description;
    public $bid_sponsored;
    public $bid_sealed;
    public $bid_highlight;
    public $bid_current_step = 1;
    public string $bid_plan_type = 'fixed';
    public array $bid_milestones = [];

    // Report form
    public $report_reason;
    public $report_description;


    /**
     * Init component
     *
     * @return void
     */
    public function mount($pid, $slug)
    {
        // Get projects settings
        $settings = settings('projects');

        // Check if this section enabled
        if (!$settings->is_enabled) {
            return redirect('/');
        }

        // Get project
        $project = Project::where('pid', $pid)
            ->where('slug', $slug)
            ->with(['client.country', 'client.billing'])
            ->withCount(['bids' => function ($query) {
                return $query->where('status', 'active');
            }])
            ->firstOrFail();

        // Check if admin authenticated
        if (auth('admin')->check()) {

            // Set project
            $this->project = $project;
        } else if (auth()->check() && $project->user_id === auth()->id()) {

            // Set project
            $this->project = $project;
        } else {

            // So, no one authenticated (admin or user)
            // We have to check the status of this project first
            if (in_array($project->status, ['pending_approval', 'pending_payment', 'hidden', 'rejected'])) {

                // Not found
                return abort(404);
            }

            // Set the project
            $this->project = $project;
        }

        // Track this visit
        Track::dispatch([
            'project_id' => $project->id,
            'ip'         => request()->ip(),
            'ua'         => request()->server('HTTP_USER_AGENT')
        ]);

        // Calculate avg bid
        $this->avg_bid();

        // Check if user already submitted a proposal for this project
        $this->checkIfAlreadySubmittedBid();

        if (empty($this->bid_milestones)) {
            $this->bid_milestones = [
                ['title' => '', 'amount' => '', 'due_in' => '']
            ];
        }

        $this->clientInsights = $this->prepareClientInsights();
        $this->clientFeedbackSummary = $this->prepareClientFeedbackSummary();
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
        $title       = $this->project->title . " $separator " . settings('general')->title;
        $description = $this->project->description;
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

        $this->clientInsights = $this->prepareClientInsights();
        $this->clientFeedbackSummary = $this->prepareClientFeedbackSummary();

        return view('livewire.main.project.project', [
            'plans'                  => $this->plans,
            'bids'                   => $this->bids,
            'clientInsights'         => $this->clientInsights,
            'bestBids'               => $this->bestBids,
            'clientFeedbackSummary'  => $this->clientFeedbackSummary,
        ]);
    }


    /**
     * Get bidding plans
     *
     * @return mixed
     */
    public function getPlansProperty()
    {
        // Check if promoting bids allowed
        if (settings('projects')->is_premium_bidding) {

            // Don't get sponsored plan, if already has a sponsored bid
            // Because only one sponsored bid is allowed
            if ($this->hasSponsoredBid()) {

                // Get plans without sponsored
                return ProjectBiddingPlan::whereIsActive(true)->where('plan_type', '!=', 'sponsored')->get();
            }

            // Return all plans, no sponsored bid yet
            return ProjectBiddingPlan::whereIsActive(true)->get();
        } else {
            return null;
        }
    }


    /**
     * Get bids on this project
     *
     * @return object
     */
    public function getBidsProperty()
    {
        // Check if has a sort by
        if (in_array($this->sort_bids_by, ['newest', 'oldest', 'fastest', 'cheapest'])) {

            // Check sort by
            switch ($this->sort_bids_by) {

                // Newest
                case 'newest':
                    return ProjectBid::whereProjectId($this->project->id)
                        ->whereIsSponsored(false)
                        ->whereStatus('active')
                        ->latest()
                        ->get();
                    break;

                // Oldest
                case 'oldest':
                    return ProjectBid::whereProjectId($this->project->id)
                        ->whereIsSponsored(false)
                        ->whereStatus('active')
                        ->oldest()
                        ->get();
                    break;

                // Fastest
                case 'fastest':
                    return ProjectBid::whereProjectId($this->project->id)
                        ->whereIsSponsored(false)
                        ->whereStatus('active')
                        ->orderBy('days', 'asc')
                        ->get();
                    break;

                // Cheapest
                case 'cheapest':
                    return ProjectBid::whereProjectId($this->project->id)
                        ->whereIsSponsored(false)
                        ->whereStatus('active')
                        ->orderBy('amount', 'asc')
                        ->get();
                    break;
            }
        }

        // No sort by
        return ProjectBid::whereProjectId($this->project->id)->whereIsSponsored(false)->whereStatus('active')->get();
    }

    public function getBestBidsProperty(): Collection
    {
        $bids = $this->project->bids()
            ->where('status', 'active')
            ->with('user')
            ->get();

        if ($bids->isEmpty()) {
            return collect();
        }

        $minAmount = $bids->min(function (ProjectBid $bid) {
            return max(0.01, (float) convertToNumber($bid->amount));
        }) ?: 0.01;

        $minDays = $bids->filter(fn(ProjectBid $bid) => $bid->days > 0)->min('days') ?? 1;

        return $bids->map(function (ProjectBid $bid) use ($minAmount, $minDays) {
            $amount = max(0.01, (float) convertToNumber($bid->amount));
            $days   = max(1, (int) $bid->days);
            $rating = ($bid->user && method_exists($bid->user, 'rating')) ? (float) $bid->user->rating() : 0;
            $detailLength = $bid->message ? strlen(strip_tags($bid->message)) : 0;

            $amountScore = min(1, $minAmount / $amount);
            $speedScore  = $minDays ? min(1, $minDays / $days) : 0.5;
            $ratingScore = min(1, $rating / 5);
            $detailScore = min(1, $detailLength / 600);

            $score = round(
                ($ratingScore * 0.5) +
                    ($amountScore * 0.3) +
                    ($speedScore * 0.15) +
                    ($detailScore * 0.05),
                4
            );

            return [
                'bid'    => $bid,
                'score'  => $score,
                'rating' => $rating,
            ];
        })
            ->sortByDesc('score')
            ->take(2)
            ->values();
    }


    /**
     * Filter bids
     *
     * @param string $by
     * @return void
     */
    public function filter($by)
    {
        // Check sort by
        if (in_array($by, ['newest', 'oldest', 'fastest', 'cheapest'])) {

            // Set sort by
            $this->sort_bids_by = $by;
        }
    }


    /**
     * Calculate avg bid
     *
     * @return void
     */
    private function avg_bid()
    {
        // Get tota bids
        $bids_counter = $this->project->bids()->count();

        // Get total amount of bids
        $bids_amount  = $this->project->bids->sum('amount');

        // Check if it has any bids
        if ($bids_counter !== 0) {

            // Set avg bid
            $this->avg_bid = number_format((float)($bids_amount / $bids_counter), 2, '.', '');
        } else {

            // No bids yet
            $this->avg_bid = 0;
        }
    }


    /**
     * Get client hidden username
     *
     * @return string
     */
    public function clientUsername()
    {
        // Get client username
        $username = $this->project->client->username;

        // Get username lenght
        $length   = strlen($username);

        // Set visible characters
        $visible  = (int) round($length / 4);

        // Count hidden characters
        $hidden   = $length - ($visible * 2);

        // Return hidden username
        return substr($username, 0, $visible) . str_repeat('*', $hidden) . substr($username, ($visible * -1), $visible);
    }

    protected function prepareClientInsights(): array
    {
        $client = $this->project?->client;

        if (!$client) {
            return [
                'has_payment_method' => false,
                'last_activity'      => null,
                'projects_count'     => 0,
                'orders_count'       => 0,
            ];
        }

        $hasPaymentMethod = $client->relationLoaded('billing')
            ? (bool) $client->billing
            : $client->billing()->exists();

        $projectsCount = Project::where('user_id', $client->id)->count();

        $lastSeenVisit = ProjectVisit::where('project_id', $this->project->id)
            ->latest(ProjectVisit::UPDATED_AT)
            ->value(ProjectVisit::UPDATED_AT);

        $lastActivity = $client->last_activity ?? $lastSeenVisit ?? $client->updated_at ?? $client->created_at;

        return [
            'has_payment_method' => $hasPaymentMethod,
            'last_activity'      => $lastActivity,
            'projects_count'     => $projectsCount,
            'orders_count'       => null,
        ];
    }

    protected function prepareClientFeedbackSummary(): array
    {
        $client = $this->project?->client;

        if (!$client) {
            return [
                'average'    => 0,
                'total'      => 0,
                'categories' => [],
            ];
        }

        $average = method_exists($client, 'rating') ? max(0, (float) $client->rating()) : 0.0;
        $totalReviews = method_exists($client, 'reviews') ? $client->reviews()->count() : 0;

        $categories = [
            [
                'label' => 'وضوح المتطلبات',
                'score' => min(5, round($average, 1)),
            ],
            [
                'label' => 'سرعة الاستجابة',
                'score' => min(5, round($average * 0.95, 1)),
            ],
            [
                'label' => 'التعاون أثناء التنفيذ',
                'score' => min(5, round($average * 0.9, 1)),
            ],
        ];

        if ($totalReviews === 0) {
            $categories = [];
        }

        return [
            'average'    => round($average, 1),
            'total'      => $totalReviews,
            'categories' => $categories,
        ];
    }

    public function updatedBidPlanType($value): void
    {
        $this->bid_plan_type = $value === 'milestone' ? 'milestone' : 'fixed';

        if ($this->bid_plan_type === 'fixed') {
            $this->bid_milestones = [
                ['title' => '', 'amount' => '', 'due_in' => '']
            ];
        } elseif (empty($this->bid_milestones)) {
            $this->bid_milestones = [
                ['title' => '', 'amount' => '', 'due_in' => '']
            ];
        }
    }

    public function addBidMilestone(): void
    {
        if (count($this->bid_milestones) >= 6) {
            return;
        }

        $this->bid_milestones[] = ['title' => '', 'amount' => '', 'due_in' => ''];
    }

    public function removeBidMilestone(int $index): void
    {
        if (!isset($this->bid_milestones[$index])) {
            return;
        }

        unset($this->bid_milestones[$index]);
        $this->bid_milestones = array_values($this->bid_milestones);

        if (empty($this->bid_milestones)) {
            $this->bid_milestones = [
                ['title' => '', 'amount' => '', 'due_in' => '']
            ];
        }
    }

    protected function prepareMilestonePlanForStorage(): array
    {
        if ($this->bid_plan_type !== 'milestone') {
            return [];
        }

        $plan = collect($this->bid_milestones ?? [])
            ->map(function ($item) {
                return [
                    'title'  => trim($item['title'] ?? ''),
                    'amount' => (float) convertToNumber($item['amount'] ?? 0),
                    'due_in' => trim($item['due_in'] ?? ''),
                ];
            })
            ->filter(function ($item) {
                return $item['title'] !== '' || $item['amount'] > 0 || $item['due_in'] !== '';
            })
            ->values();

        if ($plan->isEmpty()) {
            return [];
        }

        $bidAmount = (float) convertToNumber($this->bid_amount ?? 0);
        $currentTotal = round($plan->sum('amount'), 2);

        if ($bidAmount > 0 && $currentTotal < $bidAmount && $plan->isNotEmpty()) {
            $difference = round($bidAmount - $currentTotal, 2);

            if ($difference > 0) {
                $lastMilestone         = $plan->pop();
                $lastMilestone['amount'] = round($lastMilestone['amount'] + $difference, 2);
                $plan->push($lastMilestone);
            }
        }

        return $plan->map(function ($item, $index) {
            return [
                'order'  => $index + 1,
                'title'  => $item['title'],
                'amount' => round($item['amount'], 2),
                'due_in' => $item['due_in'],
            ];
        })->toArray();
    }

    protected function compileBidDescription(array $normalizedPlan = []): string
    {
        $description = (string) $this->bid_description;

        $plan = !empty($normalizedPlan) ? $normalizedPlan : $this->prepareMilestonePlanForStorage();

        if (!empty($plan)) {
            $lines = collect($plan)->values()->map(function ($item, $index) {
                $position    = $item['order'] ?? ($index + 1);
                $title       = $item['title'] !== '' ? $item['title'] : __('messages.t_not_available');
                $amountValue = $item['amount'] > 0 ? money($item['amount'], settings('currency')->code, true) : __('messages.t_not_available');
                $due         = $item['due_in'] !== '' ? $item['due_in'] : __('messages.t_not_available');

                return max(1, $position) . '. ' . $title . ' — ' . $amountValue . ' • تسليم خلال: ' . $due;
            })->implode("\n");

            $description = trim($description . "\n\n--- خطة الدفعات ---\n" . $lines);
        }

        return \Illuminate\Support\Str::limit($description, 3500, '');
    }

    public function rateClient(?float $rating = null): void
    {
        if (!auth()->check()) {
            $this->notification([
                'title'       => __('messages.t_error'),
                'description' => __('messages.t_pls_login_or_register_report_project'),
                'icon'        => 'error',
            ]);
            return;
        }

        $message = $rating
            ? 'تم حفظ تقييمك للعميل بنجاح.'
            : 'تم تخطي التقييم ويمكنك العودة لاحقاً.';

        $this->notification([
            'title'       => __('messages.t_success'),
            'description' => $message,
            'icon'        => 'success'
        ]);
    }


    /**
     * Go back to previous step in bid form
     *
     * @return void
     */
    public function back()
    {
        // Check if on second step
        if ($this->bid_current_step === 2) {
            $this->bid_current_step = 1;
        }
    }


    /**
     * Go to next step to bid
     *
     * @return mixed
     */
    public function next()
    {
        try {

            // We have to check if user authenticated
            if (!auth()->check()) {

                // Go to login
                return redirect('auth/login');
            }

            // Only freelancers can send bids
            if (auth()->user()->account_type !== 'seller') {

                // Error
                $this->notification([
                    'title'       => __('messages.t_error'),
                    'description' => __('messages.t_toast_something_went_wrong'),
                    'icon'        => 'error'
                ]);

                return;
            }

            // Now, this project must be active to send bids
            if ($this->project->status !== 'active') {

                // Error
                $this->notification([
                    'title'       => __('messages.t_error'),
                    'description' => __('messages.t_project_not_active_to_send_proposals'),
                    'icon'        => 'error'
                ]);

                return;
            }

            // So project is active, but employer not allow to send bids to himself
            if (auth()->id() == $this->project->user_id) {

                // Error
                $this->notification([
                    'title'       => __('messages.t_error'),
                    'description' => __('messages.t_u_cant_submit_bids_to_urself'),
                    'icon'        => 'error'
                ]);

                return;
            }

            // Enforce free plan monthly proposals limit
            $usage = $this->monthlyProposalUsage();
            if ($usage['limit'] > 0 && $usage['used'] >= $usage['limit']) {

                $resetDate = Carbon::now()->startOfMonth()->addMonth();

                $this->notification([
                    'title'       => __('messages.t_free_plan_limit_reached_title'),
                    'description' => __('messages.t_free_plan_limit_reached_body', [
                        'count' => $usage['limit'],
                        'date'  => format_date($resetDate->toDateTimeString(), config('carbon-formats.F_d,_Y')),
                    ]),
                    'icon'        => 'warning'
                ]);

                return;
            }

            // After that we have to check if this user already submitted a bid to this project
            if (ProjectBid::whereProjectId($this->project->id)->whereUserId(auth()->id())->first()) {

                // Error
                $this->notification([
                    'title'       => __('messages.t_error'),
                    'description' => __('messages.t_u_already_submitted_a_bid_to_this_project'),
                    'icon'        => 'error'
                ]);

                return;
            }

            // Require portfolio presence before bidding
            $portfolioCount = auth()->user()->projects()
                ->where('status', 'active')
                ->count();

            if ($portfolioCount < 2) {
                $this->notification([
                    'title'       => __('messages.t_attention_needed'),
                    'description' => __('messages.t_bid_requires_portfolio', ['count' => 2]),
                    'icon'        => 'warning',
                ]);

                return redirect('seller/portfolio/create');
            }

            // Check if first step
            if ($this->bid_current_step === 1) {

                // Validate form
                BidValidator::validate($this);

                // Bid amount must be between project's budget
                if (convertToNumber($this->bid_amount) < convertToNumber($this->project->budget_min) || convertToNumber($this->bid_amount) > convertToNumber($this->project->budget_max)) {

                    // Error
                    $this->notification([
                        'title'       => __('messages.t_error'),
                        'description' => __('messages.t_pls_insert_bid_value_between_budget'),
                        'icon'        => 'error'
                    ]);

                    return;
                }

                // Form is valid, we have to check if promoting bids allowed
                if (settings('projects')->is_premium_bidding) {

                    // Go to next setp
                    $this->bid_current_step = 2;

                    return;
                } else {

                    // Create new bid
                    $response = $this->bid();

                    // Reset bidding form
                    $this->reset([
                        'bid_amount',
                        'bid_amount_paid',
                        'bid_days',
                        'bid_description',
                        'bid_sponsored',
                        'bid_sealed',
                        'bid_highlight',
                        'bid_current_step',
                        'bid_plan_type',
                        'bid_milestones'
                    ]);
                    $this->bid_current_step = 1;
                    $this->bid_plan_type    = 'fixed';
                    $this->bid_milestones   = [
                        ['title' => '', 'amount' => '', 'due_in' => '']
                    ];

                    // Close modal
                    $this->dispatch('close-modal', 'modal-bid-container');

                    // Return response depends on bid's status
                    if (isset($response['status'])) {

                        // Check status
                        switch ($response['status']) {

                            // Active
                            case 'active':

                                $this->notification([
                                    'title'       => __('messages.t_success'),
                                    'description' => __('messages.t_ur_bid_has_been_posted'),
                                    'icon'        => 'success'
                                ]);

                                break;

                            // Pending approval
                            case 'pending_approval':

                                $this->notification([
                                    'title'       => __('messages.t_success'),
                                    'description' => __('messages.t_ur_bid_has_been_posted_pending_approval'),
                                    'icon'        => 'success'
                                ]);

                                break;

                            // Pending payment
                            case 'pending_payment':

                                $this->notification([
                                    'title'       => __('messages.t_success'),
                                    'description' => __('messages.t_ur_bid_has_been_posted_pending_payment'),
                                    'icon'        => 'success'
                                ]);

                                break;

                            default:
                                # code...
                                break;
                        }
                    }
                }
            }

            // Check second step
            if ($this->bid_current_step === 2) {

                $response = $this->bid();

                // Reset bidding form
                $this->reset([
                    'bid_amount',
                    'bid_amount_paid',
                    'bid_days',
                    'bid_description',
                    'bid_sponsored',
                    'bid_sealed',
                    'bid_highlight',
                    'bid_current_step',
                    'bid_plan_type',
                    'bid_milestones'
                ]);
                $this->bid_current_step = 1;
                $this->bid_plan_type    = 'fixed';
                $this->bid_milestones   = [
                    ['title' => '', 'amount' => '', 'due_in' => '']
                ];

                // Close modal
                $this->dispatch('close-modal', 'modal-bid-container');

                // Return response depends on bid's status
                if (isset($response['status'])) {

                    // Check status
                    switch ($response['status']) {

                        // Active
                        case 'active':

                            $this->notification([
                                'title'       => __('messages.t_success'),
                                'description' => __('messages.t_ur_bid_has_been_posted'),
                                'icon'        => 'success'
                            ]);

                            break;

                        // Pending approval
                        case 'pending_approval':

                            $this->notification([
                                'title'       => __('messages.t_success'),
                                'description' => __('messages.t_ur_bid_has_been_posted_pending_approval'),
                                'icon'        => 'success'
                            ]);

                            break;

                        // Pending payment
                        case 'pending_payment':

                            $this->notification([
                                'title'       => __('messages.t_success'),
                                'description' => __('messages.t_ur_bid_has_been_posted_pending_payment'),
                                'icon'        => 'success'
                            ]);

                            break;

                        // Error
                        case 'error':

                            $this->notification([
                                'title'       => __('messages.t_error'),
                                'description' => $response['message'],
                                'icon'        => 'error'
                            ]);

                            break;

                        default:
                            # code...
                            break;
                    }
                }

                // If pending payment, redirect to payment url
                if (isset($response['redirect'])) {

                    // Go to payment url
                    return redirect('seller/projects/bids/checkout/' . $response['redirect']);
                }
            }
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
     * Create new bid
     *
     * @return void
     */
    private function bid()
    {
        try {

            // Get settings
            $settings        = settings('projects');
            $normalizedPlan  = [];

            if ($this->bid_plan_type === 'milestone') {
                $normalizedPlan = $this->prepareMilestonePlanForStorage();

                if (empty($normalizedPlan)) {
                    $this->notification([
                        'title'       => __('messages.t_error'),
                        'description' => __('messages.t_bid_milestones_required'),
                        'icon'        => 'error'
                    ]);

                    return [
                        'success' => false,
                        'status'  => 'error',
                        'message' => __('messages.t_bid_milestones_required'),
                    ];
                }

                $planTotal      = round(collect($normalizedPlan)->sum(fn($item) => (float) $item['amount']), 2);
                $bidAmountValue = round((float) convertToNumber($this->bid_amount ?? 0), 2);

                if ($planTotal <= 0) {
                    $this->notification([
                        'title'       => __('messages.t_error'),
                        'description' => __('messages.t_bid_milestones_required'),
                        'icon'        => 'error'
                    ]);

                    return [
                        'success' => false,
                        'status'  => 'error',
                        'message' => __('messages.t_bid_milestones_required'),
                    ];
                }

                if ($bidAmountValue > 0 && $planTotal > $bidAmountValue) {
                    $this->notification([
                        'title'       => __('messages.t_error'),
                        'description' => __('messages.t_u_exceeded_amount_agreed_with_employer_milestone'),
                        'icon'        => 'error'
                    ]);

                    return [
                        'success' => false,
                        'status'  => 'error',
                        'message' => __('messages.t_u_exceeded_amount_agreed_with_employer_milestone'),
                    ];
                }
            }

            // Check if promoting bids enabled
            if ($settings->is_premium_bidding) {

                // Check if user selected sealed upgrade
                if ($this->bid_sealed) {

                    // Get sealed upgrade
                    $upgrade_sealed = ProjectBiddingPlan::whereUid($this->bid_sealed)->wherePlanType('sealed')->first();
                } else {

                    // Not selected
                    $upgrade_sealed = null;
                }

                // Check if user selected sponsored upgrade
                if ($this->bid_sponsored && !$this->hasSponsoredBid()) {

                    // Get sponsored upgrade
                    $upgrade_sponsored = ProjectBiddingPlan::whereUid($this->bid_sponsored)->wherePlanType('sponsored')->first();
                } else {

                    // Not selected
                    $upgrade_sponsored = null;
                }

                // Check if user selected highlight upgrade
                if ($this->bid_highlight) {

                    // Get highlight upgrade
                    $upgrade_highlight = ProjectBiddingPlan::whereUid($this->bid_highlight)->wherePlanType('highlight')->first();
                } else {

                    // Not selected
                    $upgrade_highlight = null;
                }
            } else {

                // Not enabled, so not upgrades
                $upgrade_sponsored = null;
                $upgrade_sealed    = null;
                $upgrade_highlight = null;
            }

            // Get status of this bid
            if ($settings->is_premium_bidding && ($upgrade_sponsored || $upgrade_sealed || $upgrade_highlight)) {

                // Pending payment
                $status = 'pending_payment';
            } else if (!$settings->auto_approve_bids) {

                // Pending approval
                $status = 'pending_approval';
            } else {

                // Active
                $status = 'active';
            }

            // Create a new bid
            $bid               = new ProjectBid();
            $bid->uid          = strtolower(uid());
            $bid->project_id   = $this->project->id;
            $bid->user_id      = auth()->id();
            $bid->amount       = $this->bid_amount;
            $bid->days         = $this->bid_days;
            $bid->message      = clean($this->compileBidDescription($normalizedPlan));
            $bid->is_sponsored = $upgrade_sponsored ? true : false;
            $bid->is_sealed    = $upgrade_sealed ? true : false;
            $bid->is_highlight = $upgrade_highlight ? true : false;
            $bid->status       = $status;
            $bid->milestone_plan = !empty($normalizedPlan) ? $normalizedPlan : null;
            $bid->save();

            // If pending payment, we have to create a payment link
            if ($status === 'pending_payment') {

                // Set empty amount variable
                $amount = 0;

                // Let's check if there is sealed upgrade selected
                if ($upgrade_sealed) {
                    $amount += convertToNumber($upgrade_sealed->price);
                }

                // Let's check if there is sponsored upgrade selected
                if ($upgrade_sponsored) {
                    $amount += convertToNumber($upgrade_sponsored->price);
                }

                // Let's check if there is highlight upgrade selected
                if ($upgrade_highlight) {
                    $amount += convertToNumber($upgrade_highlight->price);
                }

                // Generate payment id
                $payment_id      = Str::uuid()->toString();

                // Set payment
                $payment         = new ProjectBidUpgrade();
                $payment->bid_id = $bid->id;
                $payment->uid    = $payment_id;
                $payment->amount = $amount;
                $payment->save();

                // Set response
                $response = [
                    'success'  => true,
                    'status'   => $status,
                    'redirect' => $payment->uid
                ];
            } else {

                // Set response
                $response = [
                    'success'  => true,
                    'status'   => $status
                ];
            }

            // Send notification to employer
            if ($status === 'active') {

                // Via web app
                notification([
                    'text'    => 't_u_received_new_bid_on_ur_project',
                    'action'  => url('project/' . $this->project->pid . '/' . $this->project->slug),
                    'user_id' => $this->project->user_id
                ]);

                // Send a notification via email to the employer
                $this->project->client->notify(new NewBidReceived($bid, $this->project));
            }


            // Send notification to admin if bid pending approval
            if ($bid->status === 'pending_approval') {

                // Send notification
                Admin::first()->notify(new BidPendingApproval($bid));
            }

            // Return the response
            return $response;
        } catch (\Throwable $th) {

            // Error
            return [
                'success' => false,
                'status'  => 'error',
                'message' => $th->getLine()
            ];
        }
    }


    /**
     * Check if this project has a sponsored bid
     *
     * @return boolean
     */
    private function hasSponsoredBid()
    {
        // Get any sponsored active bid
        $bid = ProjectBid::whereProjectId($this->project->id)->whereIsSponsored(true)->whereStatus('active')->first();

        // Return
        return $bid ? $bid : false;
    }


    /**
     * Report this project
     *
     * @return mixed
     */
    public function report()
    {
        try {

            // First user must be authenticated to report this project
            if (!auth()->check()) {

                // Error
                $this->notification([
                    'title'       => __('messages.t_error'),
                    'description' => __('messages.t_pls_login_or_register_report_project'),
                    'icon'        => 'error'
                ]);

                return;
            }

            // So user is online, but we can't let him report his own project
            // In frontend we don't allow that, but we have to be sure in backend as well
            if (auth()->id() == $this->project->client->id) {

                // Error
                $this->notification([
                    'title'       => __('messages.t_error'),
                    'description' => __('messages.t_u_cannot_report_ur_own_projects'),
                    'icon'        => 'error'
                ]);

                return;
            }

            // User is able to report this project, but what if he already did that
            $already_reported = ReportedProject::whereUserId(auth()->id())
                ->whereProjectId($this->project->id)
                ->whereIsSeen(false)
                ->first();

            // Let's check that
            if ($already_reported) {

                // Error
                $this->notification([
                    'title'       => __('messages.t_error'),
                    'description' => __('messages.t_u_already_reported_this_project'),
                    'icon'        => 'error'
                ]);

                return;
            }

            // Validate form
            ReportValidator::validate($this);

            // Create new report
            $report              = new ReportedProject();
            $report->uid         = uid();
            $report->project_id  = $this->project->id;
            $report->user_id     = auth()->id();
            $report->reason      = $this->report_reason;
            $report->description = clean($this->report_description);
            $report->save();

            // Let's reset the report form
            $this->reset(['report_reason', 'report_description']);

            // Now let's send a notification to admin
            Admin::first()->notify(new ProjectReported($this->project, $report));

            // Close the modal
            $this->dispatch('close-modal', 'modal-report-project-container');

            // Success
            $this->notification([
                'title'       => __('messages.t_tnx_for_the_feedback'),
                'description' => __('messages.t_we_have_received_bid_report_success'),
                'icon'        => 'success'
            ]);
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
     * Check if user already submitted a proposal for this bid
     *
     * @return boolean
     */
    private function checkIfAlreadySubmittedBid()
    {
        try {

            // Check if user online
            if (auth()->check()) {

                // Get proposal
                $proposal                         = ProjectBid::where('project_id', $this->project->id)
                    ->where('user_id', auth()->id())
                    ->first();

                // Return value
                $this->already_submitted_proposal = $proposal ? true : false;
            } else {

                // Not online
                $this->already_submitted_proposal = false;
            }
        } catch (\Throwable $th) {

            // Error
            $this->already_submitted_proposal = false;
        }
    }


    /**
     * Get monthly proposals usage for authenticated freelancer
     *
     * @return array{used:int,limit:int}
     */
    private function monthlyProposalUsage(): array
    {
        try {

            $limit = (int) (settings('general')->free_plan_monthly_proposals ?? 0);

            if (!auth()->check()) {
                return ['used' => 0, 'limit' => $limit];
            }

            if ($limit <= 0) {
                return ['used' => 0, 'limit' => 0];
            }

            $used = ProjectBid::where('user_id', auth()->id())
                ->whereBetween('created_at', [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth(),
                ])
                ->count();

            return ['used' => $used, 'limit' => $limit];
        } catch (\Throwable $th) {
            return ['used' => 0, 'limit' => 0];
        }
    }
}
