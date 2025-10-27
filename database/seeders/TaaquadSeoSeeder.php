<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaaquadSeoSeeder extends Seeder
{
    /**
     * Seed a comprehensive SEO baseline for Ta'aquad marketplace.
     */
    public function run(): void
    {
        $keywords = [
            'Ta\'aqad marketplace',
            'تعاقد منصة العمل الحر',
            'arab freelance marketplace',
            'hire arabic freelancers',
            'استقطاب المستقلين العرب',
            'MENA freelance platform',
            'منصة للوظائف عن بعد',
            'best freelance websites middle east',
            'مشاريع تصميم واجهات المستخدم',
            'UI UX designers MENA',
            'full stack developers remote',
            'خبراء التسويق الرقمي',
            'خدمات كتابة المحتوى الاحترافية',
            'إدارة المشاريع الرقمية',
            'outsourcing agency arabic',
            'build remote arabic teams',
            'منصة تعاقد للمستقلين',
            'taaqad gig economy',
            'taaqad jobs',
            'taaqad freelancers',
            'سوق مستقلين عربي',
            'taaqad remote talents',
            'إسناد المشاريع التقنية',
            'taaqad product designers',
            'taaqad growth marketers',
            'taaqad software engineers',
            'taaqad content creators',
            'taaqad video editors',
            'taaqad seo experts',
            'taaqad translation services',
            'taaqad branding specialists',
            'taaqad digital transformation',
        ];

        DB::table('settings_general')->updateOrInsert(
            ['id' => 1],
            [
                'title'                => 'Ta\'aqad • تعاقد',
                'subtitle'             => 'منصة العمل الحر العربية التي تربطك بأفضل الخبرات الرقمية',
                'separator'            => '•',
                'header_announce_text' => 'انطلق مع تعاقد لبناء فريقك خلال دقائق واستلم أفضل النتائج',
                'header_announce_link' => '/taaquad',
                'default_language'     => 'ar',
            ]
        );

        DB::table('settings_seo')->updateOrInsert(
            ['id' => 1],
            [
                'description'      => 'تعاقد Ta\'aqad هو منصة العمل الحر الرائدة في الوطن العربي لربط الشركات وروّاد الأعمال بالمستقلين المحترفين في التصميم، التطوير، التسويق وصناعة المحتوى. أنشئ فريقاً عن بعد، أدِر مشاريعك بمرونة، واحصل على نتائج استثنائية بسرعة وثقة.',
                'keywords'         => implode(', ', $keywords),
                'facebook_page_id' => 'taaquad.marketplace',
                'facebook_app_id'  => 'taaquadMarketplaceApp',
                'twitter_username' => 'taaquadHQ',
                'ogimage_id'       => DB::table('settings_seo')->where('id', 1)->value('ogimage_id'),
                'is_sitemap'       => true,
            ]
        );
    }
}

