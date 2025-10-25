<?php

namespace Database\Seeders;

use App\Models\ProjectCategory;
use App\Models\ProjectCategoryTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'تطوير الويب والتطبيقات',
                'seo'  => 'من بناء المواقع الاحترافية إلى تطبيقات الهاتف، نوفر حلول تطوير شاملة تدعم نمو نشاطك الرقمي.',
            ],
            [
                'name' => 'تحليل البيانات والذكاء الاصطناعي',
                'seo'  => 'نماذج تعلم الآلة، لوحات المعلومات، وتحليلات عميقة تساعدك على اتخاذ قرارات دقيقة أسرع.',
            ],
            [
                'name' => 'التسويق الرقمي والأداء الإعلاني',
                'seo'  => 'خبراء في تحسين محركات البحث، الحملات الإعلانية، واستراتيجيات المحتوى لزيادة الانتشار.',
            ],
            [
                'name' => 'التصميم الإبداعي والهوية البصرية',
                'seo'  => 'خدمات تصميم متكاملة تشمل الهوية البصرية، واجهات المستخدم، وتجارب المستخدم المميزة.',
            ],
            [
                'name' => 'إدارة المشاريع والاستشارات',
                'seo'  => 'خطط تنفيذ، إدارة فرق، ونماذج عمل مدروسة تقود مشروعك من الفكرة إلى الإطلاق.',
            ],
            [
                'name' => 'الترجمة وصناعة المحتوى',
                'seo'  => 'كتّاب ومترجمون محترفون يقدمون محتوى عربي وعالمي بجودة تحريرية عالية.',
            ],
            [
                'name' => 'الهندسة المعمارية والإنشاءات',
                'seo'  => 'مخططات هندسية، نمذجة ثلاثية الأبعاد، وإشراف على التنفيذ بمعايير عالمية.',
            ],
            [
                'name' => 'الدعم التقني وخدمات البنية السحابية',
                'seo'  => 'مهندسو بنية تحتية وسحابة لضمان جاهزية أنظمتك واستقرارها على مدار الساعة.',
            ],
        ];

        foreach ($categories as $category) {
            $slug = Str::slug($category['name'], '-');
            if (empty($slug)) {
                $slug = Str::uuid()->toString();
            }

            $record = ProjectCategory::updateOrCreate(
                ['slug' => $slug],
                [
                    'uid'             => ProjectCategory::where('slug', $slug)->value('uid') ?? uid(),
                    'name'            => $category['name'],
                    'seo_description' => $category['seo'],
                ]
            );

            ProjectCategoryTranslation::updateOrCreate(
                [
                    'projects_category_id' => $record->id,
                    'language_code'        => 'ar',
                ],
                [
                    'language_value' => $category['name'],
                ]
            );
        }
    }
}
