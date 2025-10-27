<?php

declare(strict_types=1);

namespace App\Livewire\Main\Seller\Home;

use App\Models\Project;
use Livewire\Component;
use App\Models\ProjectBid;
use App\Models\CustomOffer;
use Livewire\Attributes\Layout;
use App\Models\ProjectMilestone;
use Illuminate\Support\Facades\DB;
use App\Models\ChMessage as Message;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Carbon\Carbon;

class HomeComponent extends Component
{
    use SEOToolsTrait;

    public $earnings       = 0;
    public $total_reach    = 0;
    public $awarded_projects = 0;
    public $pending_orders = 0;
    public $latest_messages = [];
    public $latest_awarded_projects;
    public $monthly_proposals_limit = 0;
    public $monthly_proposals_used = 0;
    public $monthly_proposals_remaining = 0;
    public $monthly_proposals_reset_at = null;

    public function mount(): void
    {
        try {
            auth()->user()->loadMissing('freelancerProjectLevel');
            $userId = auth()->id();

            $earningsFromProjectsTotal = ProjectMilestone::where('freelancer_id', $userId)
                ->where('status', 'paid')
                ->sum('amount');

            $earningsFromProjectsCommission = ProjectMilestone::where('freelancer_id', $userId)
                ->where('status', 'paid')
                ->sum('freelancer_commission');

            $earningsFromOffersBudget = CustomOffer::where('freelancer_id', $userId)
                ->where('payment_status', 'released')
                ->sum('budget_amount');

            $earningsFromOffersFee = CustomOffer::where('freelancer_id', $userId)
                ->where('payment_status', 'released')
                ->sum('budget_freelancer_fee');

            $this->earnings = max(0, ($earningsFromProjectsTotal - $earningsFromProjectsCommission) + ($earningsFromOffersBudget - $earningsFromOffersFee));

            $this->pending_orders = ProjectMilestone::where('freelancer_id', $userId)
                ->whereIn('status', ['request', 'funded'])
                ->count();

            $this->total_reach = ProjectBid::where('user_id', $userId)->count();

            $this->awarded_projects = ProjectBid::where('user_id', $userId)
                ->where('is_awarded', true)
                ->where('is_freelancer_accepted', true)
                ->count();

            $currentMonthProposals = ProjectBid::where('user_id', $userId)
                ->whereBetween('created_at', [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth(),
                ])
                ->count();

            $limit = (int) (settings('general')->free_plan_monthly_proposals ?? 0);
            $this->monthly_proposals_limit     = $limit;
            $this->monthly_proposals_used      = $currentMonthProposals;
            $this->monthly_proposals_remaining = $limit > 0 ? max($limit - $currentMonthProposals, 0) : null;
            $this->monthly_proposals_reset_at  = Carbon::now()->startOfMonth()->addMonth();

            $contacts = Message::join('users', function ($join): void {
                    $join->on('ch_messages.from_id', '=', 'users.id')
                        ->orOn('ch_messages.to_id', '=', 'users.id');
                })
                ->where(function ($query) use ($userId): void {
                    $query->where('ch_messages.from_id', $userId)
                        ->orWhere('ch_messages.to_id', $userId);
                })
                ->with('avatar')
                ->where('users.id', '!=', $userId)
                ->select('users.*', DB::raw('MAX(ch_messages.created_at) as max_created_at'))
                ->orderBy('max_created_at', 'desc')
                ->groupBy('users.id')
                ->take(6)
                ->get();

            foreach ($contacts as $contact) {
                $latestMessage = Message::where('from_id', $contact->id)
                    ->where('to_id', $userId)
                    ->where('seen', false)
                    ->latest()
                    ->first();

                if ($latestMessage) {
                    $this->latest_messages[] = [
                        'uid'      => strtolower($contact->uid),
                        'username' => $contact->username,
                        'avatar'   => src($contact->avatar),
                        'message'  => [
                            'body'       => $latestMessage->body,
                            'attachment' => (bool) $latestMessage->attachment,
                        ],
                    ];
                }
            }

            if (settings('projects')->is_enabled) {
                $this->latest_awarded_projects = Project::whereHas('bids', function ($query) use ($userId) {
                        return $query->where('user_id', $userId)
                            ->whereIsAwarded(true)
                            ->whereStatus('active')
                            ->latest('updated_at');
                    })
                    ->where('awarded_freelancer_id', $userId)
                    ->whereIn('status', ['active', 'completed', 'under_development', 'pending_final_review', 'incomplete', 'closed'])
                    ->take(8)
                    ->get();
            } else {
                $this->latest_awarded_projects = null;
            }
        } catch (\Throwable $throwable) {
            report($throwable);
        }
    }

    #[Layout('components.layouts.seller-app')]
    public function render()
    {
        $separator   = settings('general')->separator;
        $title       = __('messages.t_seller_dashboard') . " $separator " . settings('general')->title;
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
        $this->seo()->twitter()->setSite('@' . settings('seo')->twitter_username);
        $this->seo()->twitter()->addValue('card', 'summary_large_image');
        $this->seo()->metatags()->addMeta('fb:page_id', settings('seo')->facebook_page_id, 'property');
        $this->seo()->metatags()->addMeta('fb:app_id', settings('seo')->facebook_app_id, 'property');
        $this->seo()->metatags()->addMeta('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1', 'name');
        $this->seo()->jsonLd()->setTitle($title);
        $this->seo()->jsonLd()->setDescription($description);
        $this->seo()->jsonLd()->setUrl(url()->current());
        $this->seo()->jsonLd()->setType('WebSite');

        return view('livewire.main.seller.home.home');
    }
}
