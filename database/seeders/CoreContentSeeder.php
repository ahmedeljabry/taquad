<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleSeo;
use App\Models\ArticleTranslation;
use App\Models\FileManager;
use App\Models\Page;
use App\Models\PageTranslation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CoreContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locale = config('app.locale', 'ar');
        $fallbackLocale = config('app.fallback_locale', 'en');

        DB::transaction(function () use ($locale, $fallbackLocale) {
            $this->seedPages($locale, $fallbackLocale);
            $this->seedArticles($locale, $fallbackLocale);
        });
    }

    /**
     * Seed static pages (privacy, terms, about, etc.).
     */
    protected function seedPages(string $primaryLocale, string $fallbackLocale): void
    {
        $pages = [
            [
                'title'       => 'سياسة الخصوصية',
                'slug'        => 'privacy-policy',
                'column'      => 'legal',
                'seo_summary' => 'تعرف على كيفية حماية بياناتك داخل منصة تعاقد، وما هي الأذونات المطلوبة لضمان تجربة آمنة.',
                'sections'    => [
                    [
                        'heading' => 'مقدمة عن حماية الخصوصية',
                        'body'    => 'نلتزم بحماية بيانات مستخدمينا من خلال ضوابط تقنية وإجرائية صارمة. توضح هذه الصفحة نوعية المعلومات التي نجمعها وكيفية استخدامها.',
                    ],
                    [
                        'heading' => 'المعلومات التي يتم جمعها',
                        'body'    => 'يتم جمع بيانات الهوية الأساسية، وملفات تعريف المشاريع، وسجلات الدفع المؤمنة. لا نقوم ببيع بياناتك أو مشاركتها إلا ضمن المتطلبات القانونية.',
                    ],
                    [
                        'heading' => 'إدارة تفضيلات الخصوصية',
                        'body'    => 'يمكنك تحديث تفضيلات الخصوصية من خلال إعدادات الحساب في أي وقت، كما يمكنك طلب إزالة بياناتك وفق الضوابط النظامية.',
                    ],
                ],
            ],
            [
                'title'       => 'الشروط والأحكام',
                'slug'        => 'terms-of-service',
                'column'      => 'legal',
                'seo_summary' => 'اطلع على الإرشادات القانونية لاستخدام منصة تعاقد، وحقوق ومسؤوليات كل من العملاء والمستقلين.',
                'sections'    => [
                    [
                        'heading' => 'تعريفات عامة',
                        'body'    => 'يشير مصطلح "المنصة" إلى تعاقد، و"المستخدم" إلى أي عميل أو مستقل يقوم بالتسجيل واستخدام الخدمات.',
                    ],
                    [
                        'heading' => 'مسؤوليات العملاء',
                        'body'    => 'يتحمل العميل مسؤولية دقة المعلومات، واحترام الشروط المالية المتفق عليها، وتوفير التقييمات العادلة بعد اكتمال العمل.',
                    ],
                    [
                        'heading' => 'حقوق المستقلين',
                        'body'    => 'يحق للمستقلين استلام دفعاتهم في حال الالتزام بالتسليم المعتمد، كما يمكنهم الاعتراض خلال فترة الضمان في حال حدوث نزاع.',
                    ],
                ],
            ],
            [
                'title'       => 'عن منصة تعاقد',
                'slug'        => 'about-us',
                'column'      => 'company',
                'seo_summary' => 'منصة عربية تجمع أفضل الخبراء المستقلين مع الشركات الناشئة والمؤسسات لتسريع تنفيذ المشاريع الرقمية.',
                'sections'    => [
                    [
                        'heading' => 'رسالتنا',
                        'body'    => 'نساعد رواد الأعمال على بناء فرق عمل مرنة، والوصول إلى خبرات متخصصة، مع ضمان جودة التنفيذ وسرعة التعاقد.',
                    ],
                    [
                        'heading' => 'قيمنا',
                        'body'    => 'الثقة، والشفافية، والاحترافية. نسعى لتقديم تجربة سلسة تدعم نمو الأعمال في المنطقة العربية.',
                    ],
                    [
                        'heading' => 'منصة مدعومة بالذكاء الاصطناعي',
                        'body'    => 'نطبق حلول تحليل البيانات والذكاء الاصطناعي لمطابقة المشاريع مع الخبراء، وتقديم توصيات تعمل على تحسين نجاح التنفيذ.',
                    ],
                ],
            ],
            [
                'title'       => 'مركز الأمان',
                'slug'        => 'trust-and-safety',
                'column'      => 'support',
                'seo_summary' => 'إرشادات الأمان، وآليات حل النزاعات، ونصائح لحماية الحساب والميزانية أثناء استخدام منصة تعاقد.',
                'sections'    => [
                    [
                        'heading' => 'حماية الحسابات',
                        'body'    => 'تفعل المنصة المصادقة الثنائية، وتراقب محاولات تسجيل الدخول المشبوهة، وتوفر أدوات لاستعادة الحساب بسهولة.',
                    ],
                    [
                        'heading' => 'آلية حل النزاعات',
                        'body'    => 'تستطيع فتح بلاغ رسمي خلال فترة الضمان، وسيتم التواصل مع الطرفين للوصول إلى حل عادل يحفظ حقوق الجميع.',
                    ],
                    [
                        'heading' => 'نصائح للعقود',
                        'body'    => 'حدد مراحل واضحة مع مخرجات قابلة للقياس، وشارك الملاحظات مبكراً لتفادي إعادة العمل أو تأخير التسليم.',
                    ],
                ],
            ],
        ];

        foreach ($pages as $page) {
            $slug = Str::slug($page['slug']);

            $bodyHtml = collect($page['sections'])->map(function ($section) {
                return '<h2>'.$section['heading'].'</h2><p>'.$section['body'].'</p>';
            })->implode('');

            $pageModel = Page::updateOrCreate(
                ['slug' => $slug],
                [
                    'uid'      => Page::where('slug', $slug)->value('uid') ?? uid(),
                    'title'    => $page['title'],
                    'content'  => $bodyHtml,
                    'is_link'  => false,
                    'link'     => null,
                    'column'   => $page['column'],
                ]
            );

            PageTranslation::updateOrCreate(
                [
                    'page_id' => $pageModel->id,
                    'locale'  => $primaryLocale,
                ],
                [
                    'title'   => $page['title'],
                    'content' => $bodyHtml,
                ]
            );

            if ($fallbackLocale !== $primaryLocale) {
                PageTranslation::updateOrCreate(
                    [
                        'page_id' => $pageModel->id,
                        'locale'  => $fallbackLocale,
                    ],
                    [
                        'title'   => Str::of($page['title'])->transliterate(),
                        'content' => Str::of(strip_tags($bodyHtml))->transliterate(),
                    ]
                );
            }
        }
    }

    /**
     * Seed long-form knowledge articles.
     */
    protected function seedArticles(string $primaryLocale, string $fallbackLocale): void
    {
        $articles = [
            [
                'title'  => 'دليل إطلاق مشروع تقني بنجاح في 30 يوماً',
                'tags'   => ['إدارة المشاريع', 'تطوير المنتجات', 'خطط التنفيذ'],
                'sections' => [
                    [
                        'heading' => 'اليوم 1-5: صياغة الرؤية وتحديد المخرجات',
                        'body'    => 'ابدأ بجلسة عصف ذهني تحدد القيمة المقدمة، الفئة المستهدفة، والمؤشرات الرئيسية للنجاح. قم بتحويل الرؤية إلى متطلبات فنية قابلة للقياس.',
                    ],
                    [
                        'heading' => 'اليوم 6-15: تشكيل الفريق ووضع خارطة الطريق',
                        'body'    => 'حدد المهارات المطلوبة، أنشئ لوحة مهام باستخدام Kanban أو Scrum، وحدد نقاط التسليم الأسبوعية مع المراجعة المستمرة للمخاطر.',
                    ],
                    [
                        'heading' => 'اليوم 16-25: التطوير السريع واختبارات الجودة',
                        'body'    => 'اعتمد مبدأ البناء السريع (Rapid Prototyping)، تأكد من توثيق القرارات، وخصص وقتاً كافياً للاختبارات الوظيفية وتجربة المستخدم.',
                    ],
                    [
                        'heading' => 'اليوم 26-30: الإطلاق والتحسين المستمر',
                        'body'    => 'أطلق نسخة بيتا محدودة، اجمع الملاحظات من المستخدمين، ثم ضع خطة تحسين تعتمد على البيانات وتحافظ على استدامة الفريق.',
                    ],
                ],
                'seo' => [
                    'title'       => 'دليل شامل لإطلاق المشاريع التقنية بسرعة',
                    'description' => 'خطوات عملية لإنجاز مشروعك التقني خلال 30 يوماً، مع نصائح لتشكيل الفريق، مراقبة الجودة، وضمان نجاح الإطلاق.',
                ],
                'image' => [
                    'file_name'  => 'launch-roadmap.jpg',
                    'file_url'   => 'https://images.unsplash.com/photo-1522252234503-e356532cafd5?auto=format&fit=crop&w=1200&q=80',
                    'mime'       => 'image/jpeg',
                    'size'       => '420 KB',
                    'extension'  => 'jpg',
                ],
                'reading_time' => 8,
            ],
            [
                'title'  => 'استراتيجية بناء فريق مستقلين عالي الأداء',
                'tags'   => ['فرق العمل', 'مستقلون', 'موارد بشرية'],
                'sections' => [
                    [
                        'heading' => 'اختيار المهارات المناسبة للمهمة',
                        'body'    => 'ابدأ بتحليل الفجوات داخل فريقك الأساسي، وحدد المهارات التخصصية المطلوبة. استخدم تقييمات تقنية وسلوكية لاختيار المستقلين.',
                    ],
                    [
                        'heading' => 'تصميم رحلة عمل واضحة',
                        'body'    => 'اضبط قنوات التواصل، وأدر جلسة تعريفية للتأكد من وضوح الأهداف والمعايير. استخدم أدوات إدارة المعرفة لتوثيق القرارات.',
                    ],
                    [
                        'heading' => 'مؤشرات الأداء والتحفيز',
                        'body'    => 'حدد مؤشرات قياس الأداء (KPIs) مثل الالتزام بالمواعيد وجودة التسليم، وشارك المستقلين باستمرار بالتقدم والخطط المستقبلية.',
                    ],
                    [
                        'heading' => 'التطوير والاستمرارية',
                        'body'    => 'اعتمد سياسة تقييم دوري، وقدّم فرص تطوير للمستقلين المميزين. بناء العلاقات طويلة الأمد يقلل تكاليف الاستقطاب المستقبلية.',
                    ],
                ],
                'seo' => [
                    'title'       => 'كيف تبني فريقاً من المستقلين المحترفين',
                    'description' => 'تعلم كيفية اختيار المستقلين، وإدارة مهامهم، وبناء ثقافة عمل مشتركة تحفز الأداء العالي وتضمن جودة النتائج.',
                ],
                'image' => [
                    'file_name'  => 'remote-team.jpg',
                    'file_url'   => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1200&q=80',
                    'mime'       => 'image/jpeg',
                    'size'       => '510 KB',
                    'extension'  => 'jpg',
                ],
                'reading_time' => 7,
            ],
            [
                'title'  => 'خارطة طريق لتحسين ظهورك في نتائج البحث',
                'tags'   => ['SEO', 'محتوى', 'تسويق رقمي'],
                'sections' => [
                    [
                        'heading' => 'إنشاء محتوى متعمق ومفيد',
                        'body'    => 'اكتب مقالات تتناول أسئلة جمهورك بعمق، وادعمها ببيانات وإحصاءات. المحتوى الشامل يحصل على ترتيب أعلى ويزيد زمن الجلسة.',
                    ],
                    [
                        'heading' => 'تحسين عناصر الصفحة الأساسية',
                        'body'    => 'استخدم عناوين فرعية غنية بالكلمات المفتاحية، واحرص على سرعة تحميل الصفحات وتجربة المستخدم على الأجهزة المحمولة.',
                    ],
                    [
                        'heading' => 'بناء روابط موثوقة',
                        'body'    => 'تواصل مع مواقع ذات مصداقية في مجالك، وقدّم محتوى يمكنهم الاستشهاد به. الروابط الخارجية ترفع من موثوقيتك وظهورك.',
                    ],
                    [
                        'heading' => 'قياس التحسينات وتكرار العملية',
                        'body'    => 'راقب المقاييس مثل معدل النقر CTR ومتوسط موضع الظهور، ثم كرر التحسينات بناءً على البيانات الفعلية.',
                    ],
                ],
                'seo' => [
                    'title'       => 'تحسين محركات البحث للمشاريع الناشئة',
                    'description' => 'خطة متكاملة لتحسين ترتيب موقعك في نتائج البحث، من المحتوى إلى الروابط الخلفية وتجربة المستخدم.',
                ],
                'image' => [
                    'file_name'  => 'seo-growth.jpg',
                    'file_url'   => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1200&q=80',
                    'mime'       => 'image/jpeg',
                    'size'       => '465 KB',
                    'extension'  => 'jpg',
                ],
                'reading_time' => 6,
            ],
            [
                'title'  => 'دليل إعداد عقود العمل الحر بلغة قانونية واضحة',
                'tags'   => ['قانون', 'عقود', 'حماية'],
                'sections' => [
                    [
                        'heading' => 'تعريف نطاق العمل والمخرجات',
                        'body'    => 'ابدأ كل عقد بفقرة واضحة تحدد نطاق المشروع والمخرجات المطلوبة والمعايير المقبولة للتسليم.',
                    ],
                    [
                        'heading' => 'جداول الدفعات وضمان الحق المالي',
                        'body'    => 'قسّم الدفعات على مراحل مرتبطة بمخرجات واضحة، وحدد فترة مراجعة قبل إطلاق الدفعة النهائية.',
                    ],
                    [
                        'heading' => 'حقوق الملكية الفكرية والسرية',
                        'body'    => 'صرّح صراحةً بمن يمتلك العمل النهائي وكيفية التعامل مع المواد السرية والبيانات الحساسة.',
                    ],
                    [
                        'heading' => 'بنود حل النزاعات',
                        'body'    => 'أدرج بنداً يحدد طريقة حل النزاعات، مثل التحكيم أو الوساطة، والجهة المختصة في حال التصعيد القانوني.',
                    ],
                ],
                'seo' => [
                    'title'       => 'صياغة عقود العمل الحر باحترافية',
                    'description' => 'تعرف على العناصر الأساسية لعقود العمل الحر التي تحمي حقوق العميل والمستقل وتضمن تنفيذ الأعمال بجودة عالية.',
                ],
                'image' => [
                    'file_name'  => 'legal-contract.jpg',
                    'file_url'   => 'https://images.unsplash.com/photo-1580894897200-8e80b2700c26?auto=format&fit=crop&w=1200&q=80',
                    'mime'       => 'image/jpeg',
                    'size'       => '398 KB',
                    'extension'  => 'jpg',
                ],
                'reading_time' => 5,
            ],
        ];

        $uploaderId = User::query()->oldest('id')->value('id') ?? 1;

        foreach ($articles as $article) {
            $slug = Str::slug($article['title']);
            if (Article::where('slug', $slug)->exists()) {
                $slug .= '-'.Str::random(4);
            }

            $file = $this->storeOrRetrieveImage($article['image'], $uploaderId);

            $contentHtml = collect($article['sections'])->map(function (array $section) {
                return '<h2>'.$section['heading'].'</h2><p>'.$section['body'].'</p>';
            })->implode('');

            $articleModel = Article::updateOrCreate(
                ['slug' => $slug],
                [
                    'uid'          => Article::where('slug', $slug)->value('uid') ?? uid(),
                    'title'        => $article['title'],
                    'content'      => $contentHtml,
                    'reading_time' => Arr::get($article, 'reading_time', 6),
                    'image_id'     => $file->id,
                ]
            );

            ArticleSeo::updateOrCreate(
                ['article_id' => $articleModel->id],
                [
                    'title'       => $article['seo']['title'],
                    'description' => $article['seo']['description'],
                ]
            );

            ArticleTranslation::updateOrCreate(
                [
                    'article_id' => $articleModel->id,
                    'locale'     => $primaryLocale,
                ],
                [
                    'title'   => $article['title'],
                    'content' => $contentHtml,
                ]
            );

            if ($fallbackLocale !== $primaryLocale) {
                ArticleTranslation::updateOrCreate(
                    [
                        'article_id' => $articleModel->id,
                        'locale'     => $fallbackLocale,
                    ],
                    [
                        'title'   => Str::of($article['title'])->transliterate(),
                        'content' => Str::of(strip_tags($contentHtml))->transliterate(),
                    ]
                );
            }
        }
    }

    /**
     * Create or reuse a file manager record for article hero images.
     */
    protected function storeOrRetrieveImage(array $image, int $uploaderId): FileManager
    {
        $existing = FileManager::where('file_url', $image['file_url'])->first();
        if ($existing) {
            return $existing;
        }

        $file = FileManager::create([
            'uid'            => uid(24),
            'file_folder'    => 'seed/articles',
            'file_size'      => $image['size'],
            'file_mimetype'  => $image['mime'],
            'file_extension' => $image['extension'],
            'uploader_type'  => User::class,
            'uploader_id'    => $uploaderId,
        ]);

        $file->file_name = $image['file_name'];
        $file->file_url  = $image['file_url'];
        $file->storage_driver = 'remote';
        $file->save();

        return $file;
    }
}
