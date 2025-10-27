<?php

namespace App\Livewire\Main\Profile;

use App\Models\User;
use Livewire\Component;
use WireUi\Traits\Actions;
use Livewire\WithPagination;
use App\Models\UserPortfolio;
use App\Models\UserPortfolioLike;
use App\Models\UserPortfolioVisit;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class ProjectComponent extends Component
{
    use WithPagination, SEOToolsTrait, Actions, LivewireAlert;

    public $project;
    public bool $liked = false;
    public bool $canLike = false;
    public int $likesCount = 0;
    public int $viewsCount = 0;


    /**
     * Initialize component
     *
     * @param string $username
     * @param string $slug
     * @return void
     */
    public function mount($username, $slug)
    {
        // Get user
        $user    = User::where('username', $username)->whereIn('status', ['verified', 'active'])->firstOrFail();

        // Get project
        $project = UserPortfolio::where('user_id', $user->id)
            ->where('slug', $slug)
            ->with(['gallery', 'user'])
            ->firstOrFail();

        // Check if portfolio is pending approval
        if ($project->status === 'pending') {

            // Admin has right to see it
            if (auth('admin')->check()) {

                // Set project
                $this->project = $project;
            } else if (auth()->check() && auth()->id() === $project->user_id) {

                // Project owner has right to see it, even its status is pending
                $this->project = $project;
            } else {

                // Go back user's profile
                return redirect('profile/' . $user->username);
            }
        } else {

            // Set project
            $this->project = $project;
        }

        $this->initialiseEngagementState();
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

        return view('livewire.main.profile.project');
    }

    protected function initialiseEngagementState(): void
    {
        $this->likesCount = (int) $this->project->likes_count;
        $this->viewsCount = (int) $this->project->views_count;

        $this->canLike = auth()->check() && auth()->id() !== $this->project->user_id;

        if ($this->canLike) {
            $this->liked = $this->project->likes()->where('user_id', auth()->id())->exists();
        }

        $this->recordVisit();
    }

    protected function recordVisit(): void
    {
        if (auth()->check() && auth()->id() === $this->project->user_id) {
            return;
        }

        $hashSource = auth()->check()
            ? 'user:' . auth()->id()
            : 'guest:' . hash('sha256', (string) request()->ip() . '|' . (string) request()->userAgent());

        $visitorHash = substr($hashSource, 0, 64);

        $visit = UserPortfolioVisit::firstOrCreate(
            [
                'portfolio_id' => $this->project->id,
                'visitor_hash' => $visitorHash,
            ],
            [
                'user_id' => auth()->id(),
            ]
        );

        if ($visit->wasRecentlyCreated) {
            $this->project->increment('views_count');
            $this->project->refresh();
        }

        $this->viewsCount = (int) $this->project->views_count;
    }

    public function toggleLove(): void
    {
        if (!auth()->check()) {
            $this->notification([
                'title'       => __('messages.t_login_required'),
                'description' => __('messages.t_login_to_love_project'),
                'icon'        => 'warning',
            ]);

            return;
        }

        if (auth()->id() === $this->project->user_id) {
            $this->notification([
                'title'       => __('messages.t_action_not_allowed'),
                'description' => __('messages.t_cannot_love_own_project'),
                'icon'        => 'warning',
            ]);

            return;
        }

        DB::transaction(function () {
            $like = UserPortfolioLike::where('portfolio_id', $this->project->id)
                ->where('user_id', auth()->id())
                ->first();

            if ($like) {
                $like->delete();
                $this->project->decrement('likes_count');
                $this->liked = false;
            } else {
                UserPortfolioLike::create([
                    'portfolio_id' => $this->project->id,
                    'user_id'      => auth()->id(),
                ]);
                $this->project->increment('likes_count');
                $this->liked = true;
            }

            $this->project->refresh();
            $this->likesCount = (int) $this->project->likes_count;
        });
    }
}
