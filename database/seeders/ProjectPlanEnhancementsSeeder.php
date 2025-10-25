<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectPlanEnhancementsSeeder extends Seeder
{
    /**
     * Seed enhanced project plans for proposal subscriptions.
     */
    public function run(): void
    {
        $plans = [
            [
                'slug' => 'proposal-lite',
                'title' => 'Freelancer Lite',
                'description' => '20 عرضاً شهرياً مع تنبيهات فورية للمشاريع المتوافقة وأولوية معتدلة في نتائج البحث.',
                'price' => '39',
                'days' => 30,
                'type' => 'proposal-lite',
                'badge_text_color' => '#2563eb',
                'badge_bg_color' => '#dbeafe',
                'is_active' => true,
            ],
            [
                'slug' => 'proposal-growth',
                'title' => 'Growth Pro',
                'description' => '60 عرضاً شهرياً مرفقة بتحليلات أداء متقدمة، إبراز دائم للتقديمات، ومساعد ذكاء اصطناعي لكتابة العروض.',
                'price' => '79',
                'days' => 30,
                'type' => 'proposal-growth',
                'badge_text_color' => '#047857',
                'badge_bg_color' => '#dcfce7',
                'is_active' => true,
            ],
            [
                'slug' => 'proposal-agency',
                'title' => 'Agency Suite',
                'description' => '120 عرضاً شهرياً للفرق، صلاحيات متعددة، وجدولة مدفوعات متقدمة لمتابعة العملاء بسهولة.',
                'price' => '149',
                'days' => 30,
                'type' => 'proposal-agency',
                'badge_text_color' => '#b45309',
                'badge_bg_color' => '#fef3c7',
                'is_active' => true,
            ],
        ];

        foreach ($plans as $plan) {
            DB::table('projects_plans')->updateOrInsert(
                ['slug' => $plan['slug']],
                [
                    'title' => $plan['title'],
                    'description' => $plan['description'],
                    'price' => $plan['price'],
                    'days' => $plan['days'],
                    'type' => $plan['type'],
                    'badge_text_color' => $plan['badge_text_color'],
                    'badge_bg_color' => $plan['badge_bg_color'],
                    'is_active' => $plan['is_active'],
                ]
            );
        }
    }
}
