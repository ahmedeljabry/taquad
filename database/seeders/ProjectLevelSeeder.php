<?php

namespace Database\Seeders;

use App\Models\ProjectLevel;
use Illuminate\Database\Seeder;

class ProjectLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            [
                'slug'                    => 'freelancer_foundation',
                'account_type'            => 'seller',
                'label'                   => 'المستوى الأساسي',
                'badge_color'             => '#e2e8f0',
                'text_color'              => '#0f172a',
                'min_completed_projects'  => 0,
                'min_rating_count'        => 0,
                'min_rating'              => 0,
                'priority'                => 10,
            ],
            [
                'slug'                    => 'freelancer_rising',
                'account_type'            => 'seller',
                'label'                   => 'موهبة صاعدة',
                'badge_color'             => '#bae6fd',
                'text_color'              => '#0c4a6e',
                'min_completed_projects'  => 3,
                'min_rating_count'        => 3,
                'min_rating'              => 4.2,
                'priority'                => 20,
            ],
            [
                'slug'                    => 'freelancer_top_rated',
                'account_type'            => 'seller',
                'label'                   => 'الأعلى تقييماً',
                'badge_color'             => '#fde68a',
                'text_color'              => '#92400e',
                'min_completed_projects'  => 8,
                'min_rating_count'        => 6,
                'min_rating'              => 4.6,
                'priority'                => 30,
            ],
            [
                'slug'                    => 'freelancer_elite',
                'account_type'            => 'seller',
                'label'                   => 'شريك نخبة',
                'badge_color'             => '#fca5a5',
                'text_color'              => '#7f1d1d',
                'min_completed_projects'  => 15,
                'min_rating_count'        => 12,
                'min_rating'              => 4.85,
                'priority'                => 40,
            ],

            [
                'slug'                    => 'client_newcomer',
                'account_type'            => 'buyer',
                'label'                   => 'عميل جديد',
                'badge_color'             => '#e2e8f0',
                'text_color'              => '#111827',
                'min_completed_projects'  => 0,
                'min_rating_count'        => 0,
                'min_rating'              => 0,
                'priority'                => 10,
            ],
            [
                'slug'                    => 'client_preferred',
                'account_type'            => 'buyer',
                'label'                   => 'عميل مفضّل',
                'badge_color'             => '#bbf7d0',
                'text_color'              => '#065f46',
                'min_completed_projects'  => 3,
                'min_rating_count'        => 3,
                'min_rating'              => 4.2,
                'priority'                => 20,
            ],
            [
                'slug'                    => 'client_premium',
                'account_type'            => 'buyer',
                'label'                   => 'عميل مميّز',
                'badge_color'             => '#fcd34d',
                'text_color'              => '#7c2d12',
                'min_completed_projects'  => 8,
                'min_rating_count'        => 6,
                'min_rating'              => 4.6,
                'priority'                => 30,
            ],
            [
                'slug'                    => 'client_trust',
                'account_type'            => 'buyer',
                'label'                   => 'شريك موثوق',
                'badge_color'             => '#a5b4fc',
                'text_color'              => '#1e1b4b',
                'min_completed_projects'  => 15,
                'min_rating_count'        => 12,
                'min_rating'              => 4.8,
                'priority'                => 40,
            ],
        ];

        foreach ($levels as $level) {
            ProjectLevel::updateOrCreate(
                ['slug' => $level['slug']],
                $level
            );
        }
    }
}
