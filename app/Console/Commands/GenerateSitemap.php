<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Project;
use Spatie\Sitemap\Sitemap;
use App\Models\ProjectCategory;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a sitemap';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (settings('seo')->is_sitemap) {

            // Get projects (only)
            $projects            = Project::latest()->get();

            // Get projects categories
            $projects_categories = ProjectCategory::latest()->select('slug')->get();

            // Get blog articles
            $articles            = Article::latest()->select('slug')->get();

            // Create sitemap (projects-only)
            Sitemap::create()
                    ->add($projects)
                    ->add($projects_categories)
                    ->add($articles)
                    ->writeToFile(base_path('sitemap.xml'));
        }
    }
}
