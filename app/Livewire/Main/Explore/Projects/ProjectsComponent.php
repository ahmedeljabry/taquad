<?php
namespace App\Livewire\Main\Explore\Projects;

use Livewire\Component;
use WireUi\Traits\Actions;
use App\Enums\ProjectStatus;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\{ Layout , Url };
use App\Models\{ Project , ProjectCategory };
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class ProjectsComponent extends Component
{
    use SEOToolsTrait, LivewireAlert, Actions;

    public $q;

    #[Url(as: 'category', history: true)]
    public string $category = '';
    public array $cats = [];
    protected $queryString = ['q'];

    /**
     * Intialize component
     *
     * @return void
     */
    public function mount()
    {
        // Clean query
        $this->q = clean($this->q);
        $this->cats = $this->category === '' ? [] : explode(',', $this->category);

        // Check if this section enabled
        if (!settings('projects')->is_enabled) {
            return redirect('/');
        }

    }

    /**
     * Update query string when search query changes
     *
     * @return void
     */
    public function updatedCats(): void
    {
        $this->category = implode(',', $this->cats);
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
        $title       = __('messages.t_explore_projects') . " $separator " . settings('general')->title;
        $description = settings('seo')->description;
        $ogimage     = src( settings('seo')->ogimage );

        $this->seo()->setTitle( $title );
        $this->seo()->setDescription( $description );
        $this->seo()->setCanonical( url()->current() );
        $this->seo()->opengraph()->setTitle( $title );
        $this->seo()->opengraph()->setDescription( $description );
        $this->seo()->opengraph()->setUrl( url()->current() );
        $this->seo()->opengraph()->setType('website');
        $this->seo()->opengraph()->addImage( $ogimage );
        $this->seo()->twitter()->setImage( $ogimage );
        $this->seo()->twitter()->setUrl( url()->current() );
        $this->seo()->twitter()->setSite( "@" . settings('seo')->twitter_username );
        $this->seo()->twitter()->addValue('card', 'summary_large_image');
        $this->seo()->metatags()->addMeta('fb:page_id', settings('seo')->facebook_page_id, 'property');
        $this->seo()->metatags()->addMeta('fb:app_id', settings('seo')->facebook_app_id, 'property');
        $this->seo()->metatags()->addMeta('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1', 'name');
        $this->seo()->jsonLd()->setTitle( $title );
        $this->seo()->jsonLd()->setDescription( $description );
        $this->seo()->jsonLd()->setUrl( url()->current() );
        $this->seo()->jsonLd()->setType('WebSite');

        return view('livewire.main.explore.projects.projects', [
            'categories' => $this->categories,
            'projects'   => $this->projects
        ]);
    }


    /**
     * Get projects
     *
     * @return object
     */
    public function getProjectsProperty()
    {
        // Return projects
        return Project::query()
                        ->whereIn('status' , [ProjectStatus::Active, ProjectStatus::Completed])
                        ->when($this->q, function ($query) {
                            return $query->where(function($query) {
                                return $query->where('title', 'LIKE', '%'.$this->q.'%')
                                             ->orWhere('description', 'LIKE', '%'.$this->q.'%');
                            });
                        })
                        ->when($this->cats, function ($query) {
                            return $query->whereHas('category', function($q) {
                                return $q->whereIn('slug', $this->cats);
                            });
                        })
                        ->latest()
                        ->cursorPaginate(15);
    }

    /**
     * Get all projects categories
     *
     * @return object
     */
    public function getCategoriesProperty()
    {
        return Cache::remember('explore_project_categories' , 60 * 60 , function () {
            return ProjectCategory::latest()
                                ->select('id', 'name', 'slug', 'thumbnail_id')
                                ->with([
                                    'thumbnail' => function($query) {
                                        return $query->select('id', 'uid', 'file_folder', 'file_extension');
                                    },
                                    'translation'
                                ])
                                ->get();
        });
    }

}
