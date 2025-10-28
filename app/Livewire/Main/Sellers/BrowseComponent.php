<?php

namespace App\Livewire\Main\Sellers;

use App\DataTransferObjects\FreelancerFiltersData;
use App\Enums\FreelancerSortOption;
use App\Models\Country;
use App\Models\ProjectLevel;
use App\Models\UserSkill;
use App\Services\FreelancerDirectoryService;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class BrowseComponent extends Component
{
    use SEOToolsTrait, WithPagination;

    protected string $paginationTheme = 'tailwind';

    protected FreelancerDirectoryService $directory;

    #[Url(history: true)]
    public string $search = '';

    #[Url(as: 'skills', history: true)]
    public string $skillsParameter = '';

    #[Url(history: true)]
    public ?int $country = null;

    #[Url(history: true)]
    public ?int $level = null;

    #[Url(history: true)]
    public ?int $rating = null;

    #[Url(history: true)]
    public string $sort = '';

    #[Url(history: true)]
    public bool $online = false;

    public array $selectedSkills = [];

    public int $perPage = 12;
    public bool $customOffersEnabled = false;

    public function boot(FreelancerDirectoryService $directory): void
    {
        $this->directory = $directory;
    }

    public function mount(): void
    {
        $this->selectedSkills = $this->skillsParameter === ''
            ? []
            : collect(explode(',', $this->skillsParameter))
                ->filter()
                ->unique()
                ->values()
                ->all();

        if ($this->sort === '') {
            $this->sort = FreelancerSortOption::default()->value;
        }

        $this->customOffersEnabled = (bool) settings('publish')->enable_custom_offers;
    }

    public function updatedSearch(): void
    {
        $this->search = clean($this->search);
        $this->resetPage();
    }

    public function updatedCountry(): void
    {
        $this->resetPage();
    }

    public function updatedLevel(): void
    {
        $this->resetPage();
    }

    public function updatedRating(): void
    {
        $this->resetPage();
    }

    public function updatedOnline(): void
    {
        $this->resetPage();
    }

    public function updatedSelectedSkills(): void
    {
        $this->selectedSkills = collect($this->selectedSkills)
            ->filter()
            ->unique()
            ->values()
            ->all();

        $this->skillsParameter = implode(',', $this->selectedSkills);
        $this->resetPage();
    }

    public function applySort(string $option): void
    {
        if (FreelancerSortOption::tryFrom($option)) {
            $this->sort = $option;
            $this->resetPage();
        }
    }

    public function removeSkill(string $slug): void
    {
        $this->selectedSkills = collect($this->selectedSkills)
            ->reject(fn ($item) => $item === $slug)
            ->values()
            ->all();

        $this->skillsParameter = implode(',', $this->selectedSkills);
        $this->resetPage();
    }

    public function toggleSkill(string $slug): void
    {
        if (in_array($slug, $this->selectedSkills)) {
            $this->removeSkill($slug);

            return;
        }

        $this->selectedSkills[] = $slug;
        $this->selectedSkills = collect($this->selectedSkills)->unique()->values()->all();
        $this->skillsParameter = implode(',', $this->selectedSkills);
        $this->resetPage();
    }

    public function clearFilters(): void
    {
        $this->reset([
            'search',
            'selectedSkills',
            'skillsParameter',
            'country',
            'level',
            'rating',
            'online',
        ]);

        $this->sort = FreelancerSortOption::default()->value;
        $this->resetPage();
    }

    #[Layout('components.layouts.main-app')]
    public function render()
    {
        $filters = FreelancerFiltersData::from([
            'search'  => $this->search,
            'skills'  => implode(',', $this->selectedSkills),
            'country' => $this->country,
            'level'   => $this->level,
            'rating'  => $this->rating,
            'online'  => $this->online,
            'sort'    => $this->sort,
        ]);

        $freelancers = $this->directory->paginate($filters, $this->perPage);

        $this->prepareSeo();

        return view('livewire.main.sellers.browse', [
            'freelancers'    => $freelancers,
            'levels'         => $this->levels(),
            'countries'      => $this->countries(),
            'trendingSkills' => $this->trendingSkills(),
            'sortOptions'    => FreelancerSortOption::options(),
            'customOffersEnabled' => $this->customOffersEnabled,
        ]);
    }

    protected function prepareSeo(): void
    {
        $separator   = settings('general')->separator;
        $title       = __('messages.t_freelancers_directory_title') . " $separator " . settings('general')->title;
        $description = __('messages.t_freelancers_directory_description') ?: settings('seo')->description;
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
        $this->seo()->metatags()->addMeta(
            'robots',
            'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
            'name'
        );
        $this->seo()->jsonLd()->setTitle($title);
        $this->seo()->jsonLd()->setDescription($description);
        $this->seo()->jsonLd()->setUrl(url()->current());
        $this->seo()->jsonLd()->setType('CollectionPage');
    }

    protected function levels(): Collection
    {
        return Cache::remember(
            'freelancers_directory_levels',
            now()->addHours(6),
            fn () => ProjectLevel::forAccountType('seller')
                ->orderBy('priority')
                ->get(['id', 'label', 'badge_color', 'text_color'])
        );
    }

    protected function countries(): Collection
    {
        return Cache::remember(
            'freelancers_directory_countries',
            now()->addHours(6),
            fn () => Country::query()
                ->whereIn('id', function ($sub) {
                    $sub->select('country_id')
                        ->from('users')
                        ->whereNotNull('country_id')
                        ->where('account_type', 'seller')
                        ->whereIn('status', ['active', 'verified'])
                        ->groupBy('country_id');
                })
                ->orderBy('name')
                ->get(['id', 'name', 'code'])
        );
    }

    protected function trendingSkills(): Collection
    {
        return Cache::remember(
            'freelancers_directory_skills',
            now()->addHours(3),
            fn () => UserSkill::query()
                ->selectRaw('slug, name, COUNT(*) as total')
                ->whereIn('user_id', function ($sub) {
                    $sub->select('id')
                        ->from('users')
                        ->where('account_type', 'seller')
                        ->whereIn('status', ['active', 'verified']);
                })
                ->groupBy('slug', 'name')
                ->orderByDesc('total')
                ->limit(40)
                ->get()
        );
    }
}
