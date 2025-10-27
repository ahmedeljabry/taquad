<?php

namespace App\Livewire\Main\Seller\Reviews;

use App\Models\ProjectReview;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class ReviewsComponent extends Component
{
    use WithPagination, SEOToolsTrait, LivewireAlert, Actions;

    protected $paginationTheme = 'tailwind';

    #[Layout('components.layouts.seller-app')]
    public function render()
    {
        $user = Auth::user();

        $separator   = settings('general')->separator;
        $title       = __('messages.t_reviews') . " $separator " . settings('general')->title;
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

        return view('livewire.main.seller.reviews.reviews', [
            'reviews' => $this->reviews($user->id),
            'stats'   => $this->stats($user),
        ]);
    }

    protected function reviews(int $userId)
    {
        return ProjectReview::query()
            ->with(['reviewer', 'project'])
            ->where('reviewee_id', $userId)
            ->where('reviewer_role', 'client')
            ->where(function ($query) {
                $query->where('is_skipped', false)
                    ->orWhereNull('is_skipped');
            })
            ->orderByDesc('submitted_at')
            ->orderByDesc('created_at')
            ->paginate(9);
    }

    protected function stats($user): array
    {
        $breakdown = $this->ratingBreakdown($user->id);

        return [
            'avg'        => round((float) $user->project_rating_avg, 2),
            'count'      => (int) $user->project_rating_count,
            'likes'      => (int) $user->project_rating_sum,
            'breakdown'  => $breakdown,
        ];
    }

    protected function ratingBreakdown(int $userId): array
    {
        $rows = ProjectReview::query()
            ->selectRaw('score, COUNT(*) as aggregate')
            ->where('reviewee_id', $userId)
            ->where('reviewer_role', 'client')
            ->where('is_skipped', false)
            ->whereNotNull('score')
            ->groupBy('score')
            ->pluck('aggregate', 'score')
            ->toArray();

        $max = array_sum($rows) ?: 1;

        $breakdown = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = (int) ($rows[$i] ?? 0);
            $breakdown[$i] = [
                'count'     => $count,
                'percent'   => $max ? round(($count / $max) * 100) : 0,
            ];
        }

        return $breakdown;
    }
}

