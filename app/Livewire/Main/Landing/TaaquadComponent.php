<?php

namespace App\Livewire\Main\Landing;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class TaaquadComponent extends Component
{
    use SEOToolsTrait;

    #[Layout('components.layouts.main-app')]
    public function render()
    {
        $this->prepareSeo();

        return view('livewire.main.landing.taaquad', [
            'sections'      => $this->sections(),
            'featureGroups' => $this->featureGroups(),
            'cta'           => $this->cta(),
        ]);
    }

    protected function prepareSeo(): void
    {
        $title       = 'Ta\'aqad • منصة تعاقد للعمل الحر | استقطب نخبة المستقلين العرب';
        $description = 'تعاقد Ta\'aqad هو سوق عربي موثوق للعمل الحر يساعد الشركات الناشئة والمؤسسات على بناء فرق عن بعد خلال دقائق. اكتشف نخبة المستقلين العرب في التصميم، البرمجة، التسويق وصناعة المحتوى.';
        $url         = url('/taaquad');
        $image       = src(settings('seo')->ogimage ?? null);

        $this->seo()->setTitle($title);
        $this->seo()->setDescription($description);
        $this->seo()->setCanonical($url);
        $this->seo()->opengraph()->setTitle($title);
        $this->seo()->opengraph()->setDescription($description);
        $this->seo()->opengraph()->setUrl($url);
        $this->seo()->opengraph()->setType('website');
        if ($image) {
            $this->seo()->opengraph()->addImage($image);
            $this->seo()->twitter()->setImage($image);
        }
        $this->seo()->twitter()->setUrl($url);
        $this->seo()->twitter()->setSite('@taaquadHQ');
        $this->seo()->twitter()->addValue('card', 'summary_large_image');
        $this->seo()->jsonLd()->setTitle($title);
        $this->seo()->jsonLd()->setDescription($description);
        $this->seo()->jsonLd()->setUrl($url);
        $this->seo()->jsonLd()->setType('WebPage');
    }

    protected function sections(): array
    {
        return [
            'hero' => [
                'eyebrow'  => 'تعاقد • Ta\'aqad',
                'title'    => 'منصة عربية موثوقة للعمل الحر تبني لك فريق الأحلام عن بعد',
                'subtitle' => 'ابحث عن مصممين، مطورين، كتاب محتوى، خبراء تسويق وغيرهم خلال دقائق. نساعدك على إطلاق منتجاتك وسرعة تنفيذ مشاريعك بثقة كاملة.',
                'stats'    => [
                    ['value' => '25K+', 'label' => 'مستقل عربي موثوق'],
                    ['value' => '4.9/5', 'label' => 'تقييم متوسط للمشاريع'],
                    ['value' => '48 ساعة', 'label' => 'للحصول على أول فريق جاهز'],
                ],
            ],
            'how'  => [
                [
                    'title'       => 'عرّف احتياجك',
                    'description' => 'قم بإضافة وصف واضح لمشروعك، الميزانية، والمهارات المطلوبة ليقوم نظامنا الذكي باقتراح أفضل الملفات المناسبة.',
                ],
                [
                    'title'       => 'اختر المواهب',
                    'description' => 'استعرض الملفات، الأعمال السابقة، والتقييمات. تواصل مباشرة مع المستقلين وحدد تفاصيل التعاون خلال محادثة واحدة.',
                ],
                [
                    'title'       => 'أطلق مشروعك بثقة',
                    'description' => 'استخدم أدوات تعاقد لإدارة المهام، المتابعة، والدفع الآمن. استلم عملك مُراجعًا ومطابقًا لمعاييرك.',
                ],
            ],
            'testimonials' => [
                [
                    'quote'  => 'تعاقد اختصر علينا عملية اختيار فريق متكامل للتصميم والتطوير خلال ثلاثة أيام فقط، والجودة فاقت التوقعات.',
                    'name'   => 'ليان السبيعي',
                    'role'   => 'قائدة المنتج في منصة تعليمية سعودية',
                ],
                [
                    'quote'  => 'جمعت خلال أسبوع فريق تسويق رقمي عربي فهم ثقافة السوق المحلي وحقق نمواً ملحوظاً في أول حملة.',
                    'name'   => 'حسام مراد',
                    'role'   => 'مؤسس متجر إلكتروني للمنتجات اليدوية',
                ],
            ],
        ];
    }

    protected function featureGroups(): array
    {
        return [
            [
                'icon'  => 'ph-duotone ph-lightning',
                'title' => 'نظام مطابق للمشاريع الذكية',
                'items' => [
                    'خوارزمية توصية تعتمد على المهارات والخبرة واللغة.',
                    'فلترة دقيقة حسب معدل الإنجاز، متوسط التقييم، وتوافر الوقت.',
                    'قوائم مختارة بعناية للمشاريع العاجلة والموسمية.',
                ],
            ],
            [
                'icon'  => 'ph-duotone ph-shield-check',
                'title' => 'أمان مالي وتعاقد واضح',
                'items' => [
                    'حسابات ضمان وتحويلات سريعة عند اكتمال العمل.',
                    'عقود رقمية بمرونة العمل بالساعات أو المراحل.',
                    'مراجعة جودة مسبقة وتقييمات شفافة لكل مستقل.',
                ],
            ],
            [
                'icon'  => 'ph-duotone ph-users-four',
                'title' => 'مجتمع خبرات عربية متنوعة',
                'items' => [
                    'فرق جاهزة لإطلاق المنتجات الرقمية والهوية البصرية.',
                    'خبرات في التسويق، المحتوى، الموشن، والبرمجة السحابية.',
                    'جلسات إرشاد، دورات، ومحتوى متخصص لبناء فرق ناجحة.',
                ],
            ],
        ];
    }

    protected function cta(): array
    {
        return [
            'title'       => 'ابدأ رحلتك مع تعاقد اليوم',
            'subtitle'    => 'انضم لأكثر من 4,000 شركة وكيان ناشئ يستخدمون تعاقد لتوسيع فرقهم بسرعة ومرونة.',
            'primary'     => [
                'href'  => url('register'),
                'label' => 'إنشاء حساب شركة',
            ],
            'secondary'   => [
                'href'  => url('start_selling'),
                'label' => 'انضم كمستقل',
            ],
        ];
    }
}
