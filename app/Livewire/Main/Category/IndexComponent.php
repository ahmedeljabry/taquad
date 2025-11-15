<?php

namespace App\Livewire\Main\Category;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\ProjectCategory;
use App\Models\Project;
use App\Models\User;
use App\Models\ProjectSkill;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class IndexComponent extends Component
{
    use SEOToolsTrait;

    #[Layout('components.layouts.main-app')]
    public function render()
    {
        $categories = cache()->remember('categories_directory_full', 3600, function () {
            return ProjectCategory::withCount('projects')
                ->orderBy('name')
                ->get();
        });

        $skillMap = cache()->remember('categories_directory_skill_preview', 3600, function () {
            return ProjectSkill::select('id', 'name', 'category_id')
                ->orderBy('category_id')
                ->orderBy('name')
                ->get()
                ->groupBy('category_id');
        });

        $stats = cache()->remember('categories_directory_stats', 1800, function () {
            return [
                'active_projects'  => Project::whereIn('status', ['active', 'pending'])->count(),
                'completed'        => Project::where('status', 'completed')->count(),
                'verified_experts' => User::where('account_type', 'seller')->whereIn('status', ['active', 'verified'])->count(),
            ];
        });

        $stats['categories'] = $categories->count();

        $featuredCategories = $categories->sortByDesc('projects_count')->take(3);

        $title       = 'دليل القطاعات والمهارات على منصة Taquad';
        $description = 'تعرّف على جميع القطاعات المتاحة، المهارات المرتبطة بها، وعدد المشاريع النشطة لكل مجال لتختار المكان الأنسب لعملك.';
        $ogImage     = src(settings('seo')->ogimage);

        $this->seo()->setTitle($title);
        $this->seo()->setDescription($description);
        $this->seo()->setCanonical(url()->current());
        $this->seo()->opengraph()->setTitle($title);
        $this->seo()->opengraph()->setDescription($description);
        $this->seo()->opengraph()->setUrl(url()->current());
        $this->seo()->opengraph()->addImage($ogImage);
        $this->seo()->twitter()->setTitle($title);
        $this->seo()->twitter()->setDescription($description);
        $this->seo()->twitter()->setUrl(url()->current());
        $this->seo()->twitter()->addImage($ogImage);

        return view('livewire.main.category.index', [
            'categories'         => $categories,
            'featuredCategories' => $featuredCategories,
            'stats'              => $stats,
            'skillMap'           => $skillMap,
        ]);
    }
}
