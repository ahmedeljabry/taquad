<?php

namespace App\Livewire\Main\Post;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\WithFileUploads;
use Illuminate\Database\Eloquent\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Http\Validators\Main\Post\ProjectValidator;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use App\Models\{ProjectPlan, ProjectSkill, Project, ProjectCategory, ProjectRequiredSkill, ProjectSubscription};
use App\Models\{ProjectBriefAttachment, ProjectBriefQuestion};
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class ProjectComponent extends Component
{
    use SEOToolsTrait, LivewireAlert, WithFileUploads;

    public $title;
    public $description;
    public $category;
    public $salary_type;
    public $min_price;
    public $max_price;
    public $currency_symbol;
    public $required_skills = [];
    public $selected_plans  = [];
    public $skills          = [];
    public string $skillSearch = '';
    public array $skillRecommendations = [];
    public array $selectedSkillLabels = [];
    public $attachments     = [];
    public $questions       = [];
    public $milestones      = [];
    public bool $requires_nda = false;
    public ?string $nda_scope = null;
    public ?int $nda_term_months = 12;

    public array $templateLibrary   = [];
    public array $playbooks         = [];
    public array $assistantShortcuts = [];
    public array $descriptionSuggestions = [];
    public ?string $selectedTemplate = null;
    public array $templateConversation = [];
    public array $templateMatches = [];
    public string $templateMessage = '';

    protected bool $hasShownHourlyNotice = false;

    #[Locked]
    public $promoting_total = 0;
    public int $step = 0;


    public function nextStep()
    {
        $this->validate($this->rulesFor($this->step));
        $this->step++;
    }

    public function prevStep()
    {
        $this->step = max(0, $this->step - 1);
    }

    public function resetWizard(): void
    {
        $this->clearWizardState();
        $this->resetValidation();
        $this->syncSelectedSkillLabels();
        $this->dispatch('project-form-reset');
    }

    public function updatedSalaryType($value): void
    {
        if ($value !== 'fixed') {
            $this->salary_type = 'fixed';
            $this->showHourlyNotice();
        }
    }

    protected function clearWizardState(): void
    {
        $this->title               = null;
        $this->description         = null;
        $this->category            = null;
        $this->salary_type         = 'fixed';
        $this->min_price           = null;
        $this->max_price           = null;
        $this->required_skills     = [];
        $this->selected_plans      = [];
        $this->selectedSkillLabels = [];
        $this->skillRecommendations = [];
        $this->attachments         = [];
        $this->questions           = [];
        $this->milestones          = [];
        $this->requires_nda        = false;
        $this->nda_scope           = null;
        $this->nda_term_months     = 12;
        $this->selectedTemplate    = null;
        $this->templateMessage     = '';
        $this->promoting_total     = 0;
        $this->skills              = [];
        $this->step                = 0;
        $this->hasShownHourlyNotice = false;

        $initialTemplates = array_values($this->templateLibrary);
        $this->templateMatches = array_map(
            fn($template) => $this->simplifyTemplateCard($template),
            array_slice($initialTemplates, 0, 6)
        );

        $this->templateConversation = [
            [
                'role'      => 'assistant',
                'content'   => 'مرحباً! أنا مساعد القوالب الذكي. اخبرني عن مشروعك أو اختر قالباً جاهزاً من القائمة، وسأملأ الحقول الأساسية تلقائياً.',
                'timestamp' => now()->toIso8601String(),
            ],
        ];
    }

    protected function showHourlyNotice(): void
    {
        if ($this->hasShownHourlyNotice) {
            return;
        }

        $this->hasShownHourlyNotice = true;

        $this->alert('info', __('messages.t_attention_needed'), [
            'text'     => __('messages.t_hourly_projects_coming_soon'),
            'toast'    => true,
            'position' => 'top-end',
        ]);
    }


    private function rulesFor(int $step): array
    {
        return match ($step) {
            0 => [
                'title'       => 'required|string|max:120',
                'description' => 'required|string|min:30',
                'category'    => 'required|exists:projects_categories,id',
            ],
            1 => [
                'required_skills' => 'array|min:1',
            ],
            2 => [
                'salary_type'      => 'required|in:fixed',
                'min_price'        => 'required|numeric|min:0',
                'max_price'        => 'required|numeric|gt:min_price',
                'requires_nda'     => 'boolean',
                'nda_scope'        => 'nullable|string|max:500',
                'nda_term_months'  => 'nullable|integer|min:1|max:60',
            ],
            default => [],
        };
    }
    /**
     * Intialize component
     *
     * @return void
     */
    public function mount()
    {
        // Check first if projects enabled
        if (!settings('projects')->is_enabled) {

            // Go home
            return redirect('/');
        }

        // Check who can post project
        if (settings('projects')->who_can_post !== 'both' && settings('projects')->who_can_post !== auth()->user()->account_type) {

            // Go home
            return redirect('/');
        }

        // Get currency settings
        $currency              = settings('currency');

        // Get currency symbol
        $this->currency_symbol = config('money.currencies.' . mb_strtoupper($currency->code))['symbol'];

        $assistantConfig           = config('project-assistant');
        $this->templateLibrary     = $this->buildTemplateLibrary($assistantConfig['templates'] ?? []);
        $this->playbooks           = [];
        $this->assistantShortcuts  = [];
        $this->descriptionSuggestions = $assistantConfig['description_suggestions'] ?? $this->defaultDescriptionSuggestions();

        $initialTemplates = array_values($this->templateLibrary);
        $this->templateMatches = array_map(
            fn($template) => $this->simplifyTemplateCard($template),
            array_slice($initialTemplates, 0, 6)
        );

        $this->templateConversation[] = [
            'role'      => 'assistant',
            'content'   => 'مرحباً! أنا مساعد القوالب الذكي. اخبرني عن مشروعك أو اختر قالباً جاهزاً من القائمة، وسأملأ الحقول الأساسية تلقائياً.',
            'timestamp' => now()->toIso8601String(),
        ];

        if ($this->category) {
            $this->loadSkills((int) $this->category);
        }

        $this->syncSelectedSkillLabels();
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
        $title       = __('messages.t_post_project') . " $separator " . settings('general')->title;
        $description = settings('seo')->description;
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
        $this->seo()->twitter()->setSite("@" . settings('seo')->twitter_username);
        $this->seo()->twitter()->addValue('card', 'summary_large_image');
        $this->seo()->metatags()->addMeta('fb:page_id', settings('seo')->facebook_page_id, 'property');
        $this->seo()->metatags()->addMeta('fb:app_id', settings('seo')->facebook_app_id, 'property');
        $this->seo()->metatags()->addMeta('robots', 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1', 'name');
        $this->seo()->jsonLd()->setTitle($title);
        $this->seo()->jsonLd()->setDescription($description);
        $this->seo()->jsonLd()->setUrl(url()->current());
        $this->seo()->jsonLd()->setType('WebSite');

        return view('livewire.main.post.project', [
            'categories'            => $this->categories,
            'plans'                 => $this->plans,
            'selectedSkills'        => $this->selectedSkillLabels,
            'skillRecommendations'  => $this->skillRecommendations,
            'templateConversation'  => $this->templateConversation,
            'templateMatches'       => $this->templateMatches,
            'templateBlueprints'    => array_values($this->templateLibrary),
            'assistantShortcuts'    => $this->assistantShortcuts,
            'descriptionSuggestions' => $this->descriptionSuggestions,
            'review'                => $this->reviewData,
        ]);
    }


    /**
     * Get projects categories
     *
     * @return object
     */
    public function getCategoriesProperty()
    {
        return ProjectCategory::select('id', 'name')->latest()->get();
    }


    /**
     * Get plans
     *
     * @return Collection
     */
    public function getPlansProperty(): Collection
    {
        return cache()->remember('post_project_plans_active', 600, function () {
            return ProjectPlan::orderBy('title', 'asc')
                ->where('is_active', true)
                ->select(
                    'title',
                    'id',
                    'description',
                    'price',
                    'days',
                    'type',
                    'badge_text_color as text_color',
                    'badge_bg_color as bg_color'
                )
                ->get();
        });
    }


    public function getSelectedTemplateDataProperty(): ?array
    {
        if (!$this->selectedTemplate) {
            return null;
        }

        return $this->templateLibrary[$this->selectedTemplate] ?? null;
    }


    protected function defaultDescriptionSuggestions(): array
    {
        return [
            'صف المشكلة الحالية والنتيجة المطلوبة خلال 3 أسابيع مع أي أدوات مفضلة.',
            'اذكر الجمهور المستهدف، متطلبات الأداء، وأي قيود تقنية يجب احترامها.',
            'حدد مراحل التنفيذ المتوقعة، نقاط الفحص، ومؤشرات النجاح لكل مرحلة.',
            'وضح الملفات أو مستودعات الكود التي سيتعامل معها المستقل وأي صلاحيات لازمة.',
            'اشرح كيف سيتم قياس جودة العمل وما هي معايير القبول النهائي للتسليم.',
            'بيّن ما إذا كنت تحتاج إلى خطة صيانة أو دعم بعد الإطلاق ومدة هذا الدعم.',
            'حدد أعضاء الفريق الحاليين، طريقة التواصل المفضلة، وجدولة الاجتماعات الأسبوعية.',
            'شارك أمثلة لمشاريع أو منتجات مشابهة تود الاقتداء بها من ناحية تجربة المستخدم.',
        ];
    }

    protected function buildTemplateLibrary(array $templates): array
    {
        $collection = collect($templates)
            ->map(function ($template, $index) {
                $id = $template['id'] ?? 'template-seed-' . ($index + 1);
                $template['id'] = $id;
                $template['headline'] = $template['headline'] ?? ($template['name'] ?? ('قالب مشروع ' . ($index + 1)));

                return $template;
            });

        if ($collection->isEmpty()) {
            $collection = collect($this->defaultTemplateSeed());
        }

        $seedIndex = 1;

        while ($collection->count() < 100) {
            foreach ($this->defaultTemplateSeed() as $seed) {
                if ($collection->count() >= 100) {
                    break;
                }
                $collection->push($this->expandTemplateSeed($seed, ++$seedIndex));
            }
        }

        return $collection
            ->mapWithKeys(function ($template) {
                $id = $template['id'] ?? Str::uuid()->toString();
                $template['id'] = $id;
                $template['headline'] = $template['headline'] ?? ($template['name'] ?? 'قالب مشروع متقدم');

                return [$id => $template];
            })
            ->toArray();
    }

    protected function defaultTemplateSeed(): array
    {
        return [
            [
                'id'            => 'tpl-ai-product',
                'name'          => 'منصة ذكاء اصطناعي لتحليل البيانات',
                'headline'      => 'منصة ذكاء اصطناعي لتحليل بيانات العملاء',
                'category_hint' => 'تحليل البيانات والذكاء الاصطناعي',
                'skill_hints'   => ['Python', 'Machine Learning', 'Power BI'],
                'salary_type'   => 'fixed',
                'budget'        => ['min' => 6000, 'max' => 9500],
                'brief'         => "نحتاج إلى بناء منصة ذكاء اصطناعي تسحب بيانات رضا العملاء من مصادر متعددة، وتحولها إلى لوحة تحكم تفاعلية مع توصيات فورية.",
                'deliverables'  => [
                    'لوحة بيانات رئيسية تعرض مؤشرات الرضا والتوجهات الزمنية.',
                    'نموذج تعلم آلي يتوقع معدل التخلي خلال الأشهر القادمة.',
                    'تكامل تلقائي مع مصادر البيانات (CRM، جداول Google، ملفات CSV).',
                ],
                'milestones'    => [
                    'إعداد مصادر البيانات والنماذج الأولية.',
                    'تدريب نموذج التنبؤ والتحقق منه.',
                    'بناء لوحة القيادة النهائية وإطلاق النسخة التجريبية.',
                ],
                'questions'     => [
                    'ما هي مصادر البيانات الحالية التي يجب دعمها؟',
                    'هل لديكم أمثلة على تقارير أو لوحات سابقة تعجبكم؟',
                    'ما هو معيار النجاح الرقمي المتوقع للمشروع؟',
                ],
            ],
            [
                'id'            => 'tpl-mobile-ecommerce',
                'name'          => 'تطبيق تجارة إلكترونية متعدد البائعين',
                'headline'      => 'تطبيق تجارة إلكترونية مع لوحة تحكم للبائعين',
                'category_hint' => 'تطوير الويب والتطبيقات',
                'skill_hints'   => ['Flutter', 'Laravel', 'Stripe'],
                'salary_type'   => 'fixed',
                'budget'        => ['min' => 8000, 'max' => 12000],
                'brief'         => "نريد تطبيقاً للهاتف يتيح لبائعين مختلفين إضافة منتجاتهم، تتبع الطلبات، وإدارة الشحن بطريقة مشابهة لأمازون المصغر.",
                'deliverables'  => [
                    'تطبيق iOS/Android للمستهلكين مع نظام سلة مشتريات متطور.',
                    'لوحة تحكم ويب للبائعين لإدارة المخزون والعروض.',
                    'تكامل مع بوابات الدفع (Stripe، Tap) وخدمات الشحن المحلي.',
                ],
                'milestones'    => [
                    'تصميم تجربة المستخدم والشاشات الرئيسية.',
                    'تطوير واجهة برمجة التطبيقات والمنصة الأساسية.',
                    'اختبارات الجودة وإطلاق الإصدار الأولي على المتاجر.',
                ],
                'questions'     => [
                    'ما هي الأسواق الجغرافية التي تستهدفونها في المرحلة الأولى؟',
                    'هل هناك نظام ولاء أو نقاط ترغبون في إضافته؟',
                    'ما هي بوابات الدفع المفضلة لديكم؟',
                ],
            ],
            [
                'id'            => 'tpl-brand-identity',
                'name'          => 'حزمة هوية بصرية لشركة ناشئة',
                'headline'      => 'هوية بصرية مبتكرة لشركة تقنية ناشئة',
                'category_hint' => 'التصميم الإبداعي والهوية البصرية',
                'skill_hints'   => ['Branding', 'Figma', 'Guidelines'],
                'salary_type'   => 'fixed',
                'budget'        => ['min' => 2500, 'max' => 4000],
                'brief'         => "نبحث عن مصمم يبني هوية مرنة لمنتج SaaS جديد، تشمل الشعار، الألوان، نمط الصور، ونظام أيقونات بسيط.",
                'deliverables'  => [
                    'شعار رئيسي وثانوي مع دليل استخدام واضح.',
                    'نظام ألوان وخطوط وعناصر UI قابلة لإعادة الاستخدام.',
                    'مجموعة نماذج جاهزة (عروض تقديمية، بطاقات، منشورات سوشال).',
                ],
                'milestones'    => [
                    'بحث بصري ولوحات المزاج.',
                    'مفهومان مبدئيان مع تعديلات محدودة.',
                    'الدليل الكامل وتسليم الملفات المفتوحة.',
                ],
                'questions'     => [
                    'اذكروا 3 علامات تجارية تتمنون الاقتباس منها ولماذا.',
                    'ما القيم الأساسية التي يجب أن تعكسها الهوية؟',
                    'هل هناك قيود على الألوان أو الخطوط بسبب الشريك التقني؟',
                ],
            ],
            [
                'id'            => 'tpl-marketing-funnel',
                'name'          => 'إطلاق حملة تسويق رقمية شاملة',
                'headline'      => 'حملة تسويق رقمية متعددة القنوات لإطلاق منتج',
                'category_hint' => 'التسويق الرقمي والأداء الإعلاني',
                'skill_hints'   => ['SEO', 'Google Ads', 'Email Automation'],
                'salary_type'   => 'fixed',
                'budget'        => ['min' => 3500, 'max' => 5200],
                'brief'         => "نحتاج إلى خبير تسويق يضع خطة كاملة لإطلاق منتج SaaS خلال 6 أسابيع، تشمل الإعلانات المدفوعة، البريد الإلكتروني، والمحتوى.",
                'deliverables'  => [
                    'خطة قمع تسويقي من 3 مراحل مع مؤشرات أداء.',
                    'استراتيجية محتوى أسبوعية ومدونات محسّنة لمحركات البحث.',
                    'إعداد حملات إعلانية (Google, LinkedIn) وتقارير أسبوعية.',
                ],
                'milestones'    => [
                    'خطة الإطلاق وتحليل الجمهور.',
                    'تنفيذ الحملات الأولى وضبط الأداء.',
                    'تقرير نهائي مع توصيات الاستمرار.',
                ],
                'questions'     => [
                    'ما المقاييس الأهم بالنسبة لكم (التجارب، التسجيلات، التحويلات)؟',
                    'ما هي الميزانية الإعلانية لكل منصة؟',
                    'هل لديكم فريق داخلي يدعم إنشاء المحتوى؟',
                ],
            ],
            [
                'id'            => 'tpl-enterprise-migration',
                'name'          => 'ترحيل بنية تحتية إلى السحابة',
                'headline'      => 'ترحيل خدمات مؤسسة إلى AWS بطريقة آمنة',
                'category_hint' => 'الدعم التقني وخدمات البنية السحابية',
                'skill_hints'   => ['AWS', 'Terraform', 'DevSecOps'],
                'salary_type'   => 'fixed',
                'budget'        => ['min' => 7000, 'max' => 11000],
                'brief'         => "نرغب في ترحيل ثلاث خدمات داخلية من خوادم محلية إلى AWS مع الحفاظ على الامتثال الأمني وتطبيق بنية IaC.",
                'deliverables'  => [
                    'تصميم مرجعي للبنية المستهدفة مع سياسات الأمان.',
                    'قوالب Terraform تغطي VPC، الشبكات، قواعد البيانات، والحوامل.',
                    'خطة انتقال مع اختبارات تحميل وتقرير مخاطر.',
                ],
                'milestones'    => [
                    'تقييم الوضع الحالي وتوثيق نطاق العمل.',
                    'إعداد البنية وإجراء اختبارات الأمان.',
                    'ترحيل نهائي وتدريب فريق العمليات.',
                ],
                'questions'     => [
                    'ما هي أنظمة المراقبة والتنبيهات الحالية؟',
                    'هل هناك متطلبات امتثال (ISO, SOC2) يجب مراعاتها؟',
                    'ما هو الجدول الزمني المتاح للتوقف أثناء الترحيل؟',
                ],
            ],
            [
                'id'            => 'tpl-consulting-roadmap',
                'name'          => 'خطة تحول رقمي لشركة خدمات',
                'headline'      => 'خارطة طريق للتحول الرقمي خلال 12 شهراً',
                'category_hint' => 'إدارة المشاريع والاستشارات',
                'skill_hints'   => ['Consulting', 'Roadmapping', 'Change Management'],
                'salary_type'   => 'fixed',
                'budget'        => ['min' => 5000, 'max' => 7800],
                'brief'         => "شركة خدمات متوسطة الحجم تريد خطة تحول رقمي تشمل عمليات المبيعات، إدارة المشاريع الداخلية، والتقارير المالية.",
                'deliverables'  => [
                    'تحليل فجوات يشمل العمليات الحالية، التكنولوجيا، والكوادر.',
                    'خارطة طريق مرحلية مع مبادرات سريعة ومشاريع طويلة الأمد.',
                    'تقدير ميزانية، موارد، وحوكمة للتنفيذ.',
                ],
                'milestones'    => [
                    'تشخيص الوضع وتحليل أصحاب المصلحة.',
                    'صياغة الرؤية والمبادرات ذات الأولوية العالية.',
                    'عرض تنفيذي مع خطة التنفيذ والمتابعة.',
                ],
                'questions'     => [
                    'ما أهم ثلاثة تحديات تواجهكم اليوم في التسليم؟',
                    'هل هناك منصات تقنية يجب الحفاظ عليها؟',
                    'ما هو مستوى الاستعداد الداخلي للتغيير؟',
                ],
            ],
        ];
    }

    protected function expandTemplateSeed(array $seed, int $index): array
    {
        $clone = $seed;
        $suffix = ' #' . $index;
        $clone['id'] = ($seed['id'] ?? 'template') . '-' . $index;
        $clone['name'] = ($seed['name'] ?? 'قالب مشروع') . $suffix;
        $clone['headline'] = ($seed['headline'] ?? $clone['name']) . ' ' . $index;

        if (isset($clone['budget']['min'])) {
            $clone['budget']['min'] = (int) round($clone['budget']['min'] * (1 + ($index % 5) * 0.05));
        }

        if (isset($clone['budget']['max'])) {
            $clone['budget']['max'] = (int) round($clone['budget']['max'] * (1 + ($index % 7) * 0.04));
        }

        return $clone;
    }

    protected function simplifyTemplateCard(array $template): array
    {
        return [
            'id'        => $template['id'],
            'name'      => $template['name'] ?? $template['headline'] ?? 'قالب مشروع',
            'headline'  => $template['headline'] ?? $template['name'] ?? '',
            'category'  => $template['category_hint'] ?? null,
            'summary'   => $this->summarizeTemplate($template),
            'tags'      => array_values($template['skill_hints'] ?? []),
        ];
    }

    protected function summarizeTemplate(array $template): string
    {
        $parts = [];

        if (!empty($template['brief'])) {
            $parts[] = Str::limit($template['brief'], 140);
        }

        if (!empty($template['deliverables'])) {
            $parts[] = 'المخرجات: ' . implode('، ', array_slice($template['deliverables'], 0, 2));
        }

        if (!empty($template['budget']['min']) && !empty($template['budget']['max'])) {
            $parts[] = 'الميزانية المتوقعة: ' . number_format($template['budget']['min']) . ' - ' . number_format($template['budget']['max']) . ' ' . settings('currency')->code;
        }

        return implode(' • ', array_filter($parts));
    }

    protected function pushTemplateMessage(string $role, string $content): void
    {
        $this->templateConversation[] = [
            'role'      => $role,
            'content'   => $content,
            'timestamp' => now()->toIso8601String(),
        ];

        if (count($this->templateConversation) > 12) {
            $this->templateConversation = array_slice($this->templateConversation, -12);
        }
    }

    protected function matchTemplates(string $prompt): array
    {
        $keywords = $this->extractKeywords($prompt);
        $templates = array_values($this->templateLibrary);

        if (empty($templates)) {
            return [];
        }

        foreach ($templates as &$template) {
            $score = 0;

            foreach ($keywords as $keyword) {
                $keyword = Str::lower($keyword);

                if (Str::contains(Str::lower($template['name'] ?? ''), $keyword)) {
                    $score += 4;
                }

                if (!empty($template['skill_hints'])) {
                    foreach ($template['skill_hints'] as $hint) {
                        if (Str::contains(Str::lower($hint), $keyword)) {
                            $score += 3;
                        }
                    }
                }

                if (!empty($template['category_hint']) && Str::contains(Str::lower($template['category_hint']), $keyword)) {
                    $score += 2;
                }

                if (!empty($template['brief']) && Str::contains(Str::lower($template['brief']), $keyword)) {
                    $score += 1;
                }
            }

            if ($score === 0 && !empty($keywords)) {
                $score = 1;
            }

            $template['_score'] = $score;
        }

        usort($templates, fn($a, $b) => ($b['_score'] ?? 0) <=> ($a['_score'] ?? 0));

        $top = array_slice($templates, 0, 5);

        return array_map(function ($template) {
            unset($template['_score']);
            return $template;
        }, $top);
    }

    protected function buildAssistantReply(array $templates): string
    {
        if (empty($templates)) {
            return 'لم أجد قالباً مطابقاً تماماً، شاركني تفاصيل إضافية أو استعرض جميع القوالب المتاحة لاختيار الأنسب.';
        }

        $lines = collect($templates)
            ->take(3)
            ->map(fn($template, $index) => ($index + 1) . '. ' . ($template['name'] ?? $template['headline']))
            ->implode("\n");

        return "أرشح لك هذه القوالب:\n{$lines}\nاختر القالب المناسب لأملأ الحقول الأساسية فوراً.";
    }

    public function sendTemplatePrompt(): void
    {
        $message = trim($this->templateMessage);

        if ($message === '') {
            return;
        }

        $this->pushTemplateMessage('user', $message);
        $this->templateMessage = '';

        $matches = $this->matchTemplates($message);
        $this->templateMatches = array_map(fn($template) => $this->simplifyTemplateCard($template), $matches);

        $assistantReply = $this->buildAssistantReply($matches);
        $this->pushTemplateMessage('assistant', $assistantReply);
    }

    public function getReviewDataProperty(): array
    {
        $category = null;

        if ($this->category) {
            $category = ProjectCategory::select('id', 'name', 'slug')->find($this->category);
        }

        $currency      = settings('currency');
        $minFormatted  = $this->min_price !== null ? money($this->min_price, $currency->code, true) : null;
        $maxFormatted  = $this->max_price !== null ? money($this->max_price, $currency->code, true) : null;
        $budgetLabel   = null;

        if ($this->salary_type === 'hourly') {
            $budgetLabel = ($minFormatted ?: '—') . ' / ساعة';
        } elseif ($minFormatted && $maxFormatted) {
            $budgetLabel = $minFormatted . ' - ' . $maxFormatted;
        } elseif ($minFormatted) {
            $budgetLabel = $minFormatted;
        } elseif ($maxFormatted) {
            $budgetLabel = $maxFormatted;
        } else {
            $budgetLabel = null;
        }

        $attachments = collect($this->attachments ?? [])
            ->map(function ($file) {
                if (is_string($file)) {
                    return $file;
                }

                if (is_array($file) && isset($file['name'])) {
                    return $file['name'];
                }

                if (is_object($file) && method_exists($file, 'getClientOriginalName')) {
                    return $file->getClientOriginalName();
                }

                return null;
            })
            ->filter()
            ->values()
            ->all();

        $milestones = collect($this->milestones ?? [])
            ->filter(fn($milestone) => filled($milestone['title'] ?? null))
            ->map(fn($milestone) => [
                'title'  => $milestone['title'],
                'amount' => $milestone['amount'] ?? null,
            ])
            ->values()
            ->all();

        $questions = collect($this->questions ?? [])
            ->filter(fn($question) => filled($question['text'] ?? null))
            ->map(fn($question) => [
                'text'        => $question['text'],
                'is_required' => (bool) ($question['is_required'] ?? false),
            ])
            ->values()
            ->all();

        $selectedPlans = collect($this->plans ?? [])
            ->whereIn('id', $this->selected_plans ?? [])
            ->map(function ($plan) use ($currency) {
                return [
                    'title'       => $plan->title,
                    'description' => $plan->description,
                    'price'       => money($plan->price, $currency->code, true),
                    'days'        => $plan->days,
                    'type'        => $plan->type,
                ];
            })
            ->values()
            ->all();

        return [
            'title'           => trim((string) $this->title),
            'category'        => $category?->name,
            'category_slug'   => $category?->slug,
            'salary_type'     => $this->salary_type,
            'budget_label'    => $budgetLabel,
            'budget_min'      => $minFormatted,
            'budget_max'      => $maxFormatted,
            'requires_nda'    => (bool) $this->requires_nda,
            'nda_scope'       => $this->nda_scope,
            'nda_term'        => $this->nda_term_months,
            'description'     => (string) $this->description,
            'description_preview' => Str::limit(strip_tags((string) $this->description), 220),
            'skills'          => $this->selectedSkillLabels,
            'questions'       => $questions,
            'milestones'      => $milestones,
            'attachments'     => $attachments,
            'plans'           => $selectedPlans,
            'plans_total'     => $this->promoting_total,
        ];
    }

    protected function loadSkills(?int $categoryId = null): void
    {
        if (!$categoryId) {
            $this->skills = [];
            return;
        }

        $query = ProjectSkill::query()
            ->select('id', 'uid', 'name')
            ->where('category_id', $categoryId);

        $search = trim($this->skillSearch ?? '');
        if ($search !== '') {
            $keywords = $this->extractKeywords($search);
            if (!empty($keywords)) {
                $query->where(function ($inner) use ($keywords) {
                    foreach ($keywords as $token) {
                        $inner->orWhere('name', 'LIKE', '%' . $token . '%')
                            ->orWhere('slug', 'LIKE', '%' . $token . '%');
                    }
                });
            }
        }

        $this->skills = $query
            ->orderBy('name')
            ->limit(200)
            ->get()
            ->map(fn(ProjectSkill $skill) => [
                'id'   => $skill->id,
                'uid'  => $skill->uid,
                'name' => $skill->name,
            ])
            ->toArray();
    }

    protected function extractKeywords(string $text): array
    {
        $normalized = Str::of($text)
            ->replaceMatches('/[^\p{L}\p{N}\s]+/u', ' ')
            ->lower()
            ->toString();

        $ascii = Str::lower(Str::ascii($text));

        $tokens = array_filter(array_unique(array_merge(
            preg_split('/\s+/u', $normalized, -1, PREG_SPLIT_NO_EMPTY) ?: [],
            preg_split('/\s+/u', $ascii, -1, PREG_SPLIT_NO_EMPTY) ?: []
        )), fn($token) => mb_strlen($token) >= 2);

        return array_values(array_slice($tokens, 0, 8));
    }

    protected function syncSelectedSkillLabels(): void
    {
        if (!is_array($this->required_skills) || empty($this->required_skills)) {
            $this->selectedSkillLabels = [];
            return;
        }

        $this->selectedSkillLabels = ProjectSkill::query()
            ->select('id', 'uid', 'name')
            ->whereIn('id', $this->required_skills)
            ->orderBy('name')
            ->limit(60)
            ->get()
            ->map(fn(ProjectSkill $skill) => [
                'id'   => $skill->id,
                'uid'  => $skill->uid,
                'name' => $skill->name,
            ])
            ->toArray();
    }

    public function updatedSkillSearch($value): void
    {
        $this->skillSearch = trim((string) $value);
        $this->loadSkills((int) ($this->category ?: 0));
    }

    public function clearSkillSearch(): void
    {
        $this->skillSearch = '';
        $this->loadSkills((int) ($this->category ?: 0));
    }

    public function generateSkillRecommendations(): void
    {
        $categoryId = (int) ($this->category ?: 0);

        if (!$categoryId) {
            $this->alert(
                'warning',
                __('messages.t_warning'),
                livewire_alert_params(__('messages.t_skills_select_category_first_alert'), 'warning')
            );
            return;
        }

        $text = trim(
            Str::of($this->title . ' ' . strip_tags((string) ($this->description ?? '')))
                ->squish()
                ->toString()
        );

        $keywords = $this->extractKeywords($text);

        $query = ProjectSkill::query()
            ->select('id', 'uid', 'name')
            ->where('category_id', $categoryId);

        if (!empty($keywords)) {
            $query->where(function ($inner) use ($keywords) {
                foreach ($keywords as $token) {
                    $inner->orWhere('name', 'LIKE', '%' . $token . '%')
                        ->orWhere('slug', 'LIKE', '%' . $token . '%');
                }
            });
        }

        $results = $query
            ->orderBy('name')
            ->limit(12)
            ->get()
            ->map(fn(ProjectSkill $skill) => [
                'id'   => $skill->id,
                'uid'  => $skill->uid,
                'name' => $skill->name,
            ])
            ->toArray();

        if (empty($results)) {
            $results = ProjectSkill::query()
                ->select('id', 'uid', 'name')
                ->where('category_id', $categoryId)
                ->orderBy('name')
                ->limit(12)
                ->get()
                ->map(fn(ProjectSkill $skill) => [
                    'id'   => $skill->id,
                    'uid'  => $skill->uid,
                    'name' => $skill->name,
                ])
                ->toArray();
        }

        $this->skillRecommendations = $results;
    }

    public function applySkillRecommendation(string $uid): void
    {
        $categoryId = (int) ($this->category ?: 0);

        if (!$categoryId) {
            return;
        }

        $skill = ProjectSkill::query()
            ->select('id', 'uid')
            ->where('uid', $uid)
            ->where('category_id', $categoryId)
            ->first();

        if (!$skill) {
            return;
        }

        if (!in_array($skill->id, $this->required_skills)) {
            $this->addSkill($uid);
        }
    }

    public function applyAllSkillRecommendations(): void
    {
        if (empty($this->skillRecommendations)) {
            $this->generateSkillRecommendations();
        }

        foreach ($this->skillRecommendations as $skill) {
            if (!isset($skill['uid'])) {
                continue;
            }
            $this->applySkillRecommendation($skill['uid']);
        }
    }


    /**
     * Set ProjectSkills
     *
     * @param int $id
     * @return void
     */
    public function updatedCategory($id): void
    {
        $categoryId = (int) $id;

        $this->skillSearch = '';
        $this->skillRecommendations = [];
        $this->required_skills = [];
        $this->selectedSkillLabels = [];

        $this->loadSkills($categoryId);
        $this->syncSelectedSkillLabels();
    }

    public function applyTemplate(string $templateId): void
    {
        $template = $this->templateLibrary[$templateId] ?? null;

        if (!$template) {
            return;
        }

        $this->selectedTemplate = $templateId;

        $this->templateMatches = array_map(
            fn($candidate) => $this->simplifyTemplateCard($candidate),
            $this->matchTemplates($template['name'] ?? ($template['headline'] ?? $templateId))
        );

        if (!empty($template['headline'])) {
            $this->title = $template['headline'];
        } elseif (!empty($template['name'])) {
            $this->title = $template['name'];
        }

        $this->description = $this->buildTemplateDescription($template);

        if (!empty($template['salary_type'])) {
            if ($template['salary_type'] === 'hourly') {
                $this->salary_type = 'fixed';
                $this->showHourlyNotice();
            } else {
                $this->salary_type = $template['salary_type'];
            }
        }

        if (!empty($template['budget']['min'])) {
            $this->min_price = $template['budget']['min'];
        }

        if (!empty($template['budget']['max'])) {
            $this->max_price = $template['budget']['max'];
        }

        $categoryId = $this->resolveTemplateCategoryId($template);

        if ($categoryId) {
            $this->category = $categoryId;
            $this->updatedCategory($categoryId);
        }

        $this->applyTemplateSkills($template, $categoryId);

        if (!empty($template['questions']) && is_array($template['questions'])) {
            $this->questions = collect($template['questions'])
                ->take(8)
                ->map(fn($text) => [
                    'text'        => $text,
                    'is_required' => false,
                ])
                ->toArray();
        }

        if (!empty($template['milestones']) && is_array($template['milestones'])) {
            $this->milestones = collect($template['milestones'])
                ->take(8)
                ->map(function ($item) {
                    if (is_array($item)) {
                        $title  = $item['title'] ?? ($item['label'] ?? '');
                        $amount = $item['amount'] ?? '';
                    } else {
                        $title  = (string) $item;
                        $amount = '';
                    }

                    return [
                        'title'  => trim((string) $title),
                        'amount' => trim((string) $amount),
                    ];
                })
                ->filter(fn($milestone) => $milestone['title'] !== '' || $milestone['amount'] !== '')
                ->values()
                ->toArray();
        } else {
            $this->milestones = [];
        }

        $this->step = 0;
        $this->dispatch('project-template-applied', $templateId);
        $this->pushTemplateMessage('assistant', 'تم تحميل قالب "' . ($template['name'] ?? $template['headline'] ?? 'مخصص') . '" وتم تحديث الحقول الرئيسية.');
    }

    public function clearTemplate(): void
    {
        $this->selectedTemplate = null;
        $this->milestones       = [];
        $this->dispatch('project-template-cleared');
        $this->pushTemplateMessage('assistant', 'تمت إعادة ضبط الحقول. يمكنك اختيار قالب جديد أو متابعة التحرير يدوياً.');
    }

    protected function resolveTemplateCategoryId(array $template): ?int
    {
        $hint = $template['category_hint'] ?? null;

        if (empty($hint)) {
            return null;
        }

        $category = ProjectCategory::query()
            ->where('name', 'LIKE', '%' . $hint . '%')
            ->orWhere('slug', 'LIKE', '%' . Str::slug($hint, '-') . '%')
            ->first();

        return $category?->id;
    }

    protected function applyTemplateSkills(array $template, ?int $categoryId): void
    {
        if (!$categoryId || empty($template['skill_hints']) || !is_array($template['skill_hints'])) {
            return;
        }

        $hints = array_filter($template['skill_hints']);

        if (empty($hints)) {
            return;
        }

        $query = ProjectSkill::query()
            ->where('category_id', $categoryId)
            ->where(function ($query) use ($hints) {
                foreach ($hints as $hint) {
                    $query->orWhere('name', 'LIKE', '%' . $hint . '%')
                        ->orWhere('slug', 'LIKE', '%' . Str::slug($hint, '-') . '%');
                }
            });

        $maxSkills = (int) settings('projects')->max_skills ?: 5;

        $this->required_skills = $query->limit($maxSkills)->pluck('id')->toArray();
        $this->syncSelectedSkillLabels();
    }

    protected function buildTemplateDescription(array $template): string
    {
        $sections = [];

        if (!empty($template['brief'])) {
            $sections[] = trim($template['brief']);
        }

        if (!empty($template['deliverables'])) {
            $sections[] = '';
            $sections[] = 'المخرجات المتوقعة:';
            foreach ($template['deliverables'] as $deliverable) {
                $sections[] = '- ' . $deliverable;
            }
        }

        if (!empty($template['milestones'])) {
            $sections[] = '';
            $sections[] = 'الجدول الزمني المقترح:';
            foreach ($template['milestones'] as $milestone) {
                $sections[] = '- ' . $milestone;
            }
        }

        return trim(implode(PHP_EOL, array_filter($sections, fn($line) => $line !== null)));
    }

    /**
     * Select new skill
     *
     * @param string $id
     * @return void
     */
    public function addSkill($id): void
    {
        try {

            // Check maximum skills allowed
            if (count($this->required_skills) >= (int)settings('projects')->max_skills) {

                // Maw allowed skills reached
                $this->alert(
                    'error',
                    __('messages.t_error'),
                    livewire_alert_params(__('messages.t_max_allowed_skills_reached'), 'error')
                );

                return;
            }

            // Get the skill
            $skill = ProjectSkill::where('uid', $id)
                ->where('category_id', $this->category)
                ->first();

            // Check if skill exists
            if (!$skill) {

                // Error
                $this->alert(
                    'error',
                    __('messages.t_error'),
                    livewire_alert_params(__('messages.t_selected_skill_unavailable'), 'error')
                );

                return;
            }

            // Let's check if skill already selected
            if (in_array($skill->id, $this->required_skills)) {

                // Already exists, remove it
                if (($key = array_search($skill->id, $this->required_skills)) !== false) {
                    unset($this->required_skills[$key]);
                }
            } else {

                // Add it to list of selected skills
                array_push($this->required_skills, $skill->id);
            }

            // Refresh array
            $this->required_skills = array_values($this->required_skills);
            $this->syncSelectedSkillLabels();
        } catch (\Throwable $th) {

            // Something went wrong
            $this->alert(
                'error',
                __('messages.t_error'),
                livewire_alert_params(__('messages.t_toast_something_went_wrong'), 'error')
            );
        }
    }


    /**
     * Select a plan
     *
     * @param string $id
     * @return void
     */
    public function addPlan($id): void
    {
        try {

            // Get the plan
            $plan = ProjectPlan::where('id', $id)->first();

            // Check if skill exists
            if (!$plan) {

                // Error
                $this->alert(
                    'error',
                    __('messages.t_error'),
                    livewire_alert_params(__('messages.t_selected_plan_unavailable'), 'error')
                );

                return;
            }

            // Let's check if plan already selected
            if (in_array($plan->id, $this->selected_plans)) {

                // Already exists, remove it
                if (($key = array_search($plan->id, $this->selected_plans)) !== false) {

                    // Remove it
                    unset($this->selected_plans[$key]);

                    // Update total price
                    $this->promoting_total = convertToNumber($this->promoting_total) - convertToNumber($plan->price);
                }
            } else {

                // Add it to list of selected plans
                array_push($this->selected_plans, $plan->id);

                // Update total price
                $this->promoting_total = convertToNumber($this->promoting_total) + convertToNumber($plan->price);
            }

            // Refresh array
            $this->selected_plans = array_values($this->selected_plans);
        } catch (\Throwable $th) {

            // Something went wrong
            $this->alert(
                'error',
                __('messages.t_error'),
                livewire_alert_params(__('messages.t_toast_something_went_wrong'), 'error')
            );
        }
    }


    /**
     * Create new project
     *
     */
    public function create()
    {
        try {

            // Get projects settings
            $settings = settings('projects');

            // Get user
            $user     = auth()->user();

            // First let's check if projects section is enabled
            if (!$settings->is_enabled) {

                // Redirect home
                return redirect('/');
            }

            // Check if current user allowed to post projects
            if ($settings->who_can_post !== 'both' && $settings->who_can_post !== $user->account_type) {

                // Redirect home
                return redirect('/');
            }

            // Check if only premium posting allowed
            if (!$settings->is_free_posting && (!is_array($this->selected_plans) || count($this->selected_plans) === 0)) {

                // Error
                $this->alert(
                    'error',
                    __('messages.t_error'),
                    livewire_alert_params(__('messages.t_toast_select_plan_to_post_project'), 'error')
                );

                return;
            }

            // Max price must be greater than min price
            if (convertToNumber($this->min_price) >= convertToNumber($this->max_price)) {

                // Error
                $this->alert(
                    'error',
                    __('messages.t_error'),
                    livewire_alert_params(__('messages.t_max_project_price_must_be_greater'), 'error')
                );

                return;
            }

            // Check if user didn't select salary type
            if ($this->salary_type !== 'fixed') {
                $this->salary_type = 'fixed';
                $this->showHourlyNotice();
            }

            // Validate form
            ProjectValidator::validate($this);

            $requiresNda       = (bool) $this->requires_nda;
            $ndaTermMonths     = $requiresNda ? max(1, (int) ($this->nda_term_months ?? 12)) : null;
            $ndaScopeSanitized = $requiresNda ? clean((string) ($this->nda_scope ?? '')) : null;

            if ($ndaScopeSanitized !== null) {
                $this->nda_scope = $ndaScopeSanitized;
            }


            // Get skills
            $skills                  = $this->required_skills;

            // Get title
            $title                   = clean($this->title);

            // Generate project id
            $uid                     = uid();

            // Generate a project id
            $pid                     = mt_rand(100000, 999999);

            // Generate project slug
            $normalizedTitle         = trim(Str::ascii($this->title ?? ''));
            $slug                    = substr(generate_slug($normalizedTitle), 0, 160);
            if (empty($slug)) {
                $slug = Str::slug($normalizedTitle);
            }
            if (empty($slug)) {
                $slug = 'project-' . Str::lower(uid(8));
            }

            // Get project status
            $status                  = $this->status($settings);

            // Get premium options
            $premium                 = $this->premium($settings);

            // Create new project
            $project                   = new Project();
            $project->user_id          = $user->id;
            $project->uid              = $uid;
            $project->pid              = $pid;
            $project->title            = $title;
            $project->description      = clean($this->description);
            $project->slug             = $slug;
            $project->category_id      = $this->category;
            $project->budget_min       = $this->min_price;
            $project->budget_max       = $this->max_price;
            $project->budget_type      = $this->salary_type;
            $project->is_featured      = $premium['is_featured'];
            $project->is_urgent        = $premium['is_urgent'];
            $project->is_highlighted   = $premium['is_highlighted'];
            $project->is_alert         = $premium['is_alert'];

            $hasNdaColumns = Schema::hasColumns('projects', ['requires_nda', 'nda_scope', 'nda_term_months', 'nda_path']);

            if ($hasNdaColumns) {
                $project->requires_nda    = $requiresNda;
                $project->nda_scope       = $requiresNda ? $ndaScopeSanitized : null;
                $project->nda_term_months = $requiresNda ? $ndaTermMonths : null;
            }

            $project->status           = $status;
            $project->save();

            // Create a subscription if user selected premium posting
            if ($settings->is_premium_posting && is_array($this->selected_plans) && count($this->selected_plans)) {

                // Save subscription
                $subscription             = new ProjectSubscription();
                $subscription->uid        = Str::uuid()->toString();
                $subscription->project_id = $project->id;
                $subscription->total      = $premium['total'];
                $subscription->save();
            } else {

                // No subscription
                $subscription = false;
            }

            // Loop through skills
            foreach ($skills as $key => $s) {

                // Save skill
                $skill             = new ProjectRequiredSkill();
                $skill->project_id = $project->id;
                $skill->skill_id   = $s;
                $skill->save();
            }

            // Save discovery questions (max 8)
            if (is_array($this->questions) && count($this->questions)) {
                $position = 1;
                foreach ($this->questions as $question) {
                    if ($position > 8) {
                        break;
                    }

                    $text = isset($question['text']) ? trim((string) $question['text']) : '';
                    if ($text === '') {
                        continue;
                    }

                    ProjectBriefQuestion::create([
                        'uid'         => Str::uuid()->toString(),
                        'project_id'  => $project->id,
                        'question'    => $text,
                        'is_required' => (bool) ($question['is_required'] ?? false),
                        'position'    => $position,
                    ]);

                    $position++;
                }
            }

            // Save brief attachments (max 5, 25MB)
            if (is_array($this->attachments) && count($this->attachments)) {
                $allowedExtensions = ['pdf', 'doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx', 'zip', 'rar', '7z', 'png', 'jpg', 'jpeg', 'webp', 'gif', 'mp3', 'wav', 'ogg', 'webm', 'mp4', 'm4a'];
                $saved = 0;

                foreach ($this->attachments as $file) {
                    if ($saved >= 5) {
                        break;
                    }

                    if (!$file || !method_exists($file, 'getClientOriginalName')) {
                        continue;
                    }

                    $size = $file->getSize();
                    if ($size > 25 * 1024 * 1024) {
                        continue;
                    }

                    $ext = strtolower($file->getClientOriginalExtension());
                    if (!in_array($ext, $allowedExtensions, true)) {
                        continue;
                    }

                    $storedName = Str::uuid()->toString() . '.' . $ext;
                    $disk       = 'public';
                    $directory  = 'projects/briefs/' . $project->uid;
                    $path       = $file->storeAs($directory, $storedName, $disk);

                    ProjectBriefAttachment::create([
                        'uid'           => Str::uuid()->toString(),
                        'project_id'    => $project->id,
                        'original_name' => $file->getClientOriginalName(),
                        'stored_name'   => $storedName,
                        'disk'          => $disk,
                        'path'          => $path,
                        'size'          => $size,
                        'mime_type'     => $file->getMimeType(),
                    ]);

                    $saved++;
                }
            }

            if ($requiresNda && $hasNdaColumns) {
                $ndaPath = $this->generateNdaDocument($project, $ndaScopeSanitized ?? '', $ndaTermMonths ?? 12);

                if ($ndaPath) {
                    $project->nda_path = $ndaPath;
                    $project->save();
                }
            }

            // Check if payment required, redirect to payment link
            if ($subscription) {

                // Flash a success message
                $this->alert(
                    'success',
                    __('messages.t_success'),
                    livewire_alert_params(__('messages.t_ur_project_created_and_pending_payment'))
                );

                // Redirect
                return redirect('/account/projects/checkout/' . $subscription->uid);
            }

            // Flash a message
            $this->alert(
                'success',
                __('messages.t_success'),
                livewire_alert_params($status === 'pending_approval' ? __('messages.t_ur_project_created_and_pending_approval') : __('messages.t_ur_project_created_success'))
            );

            // Redirect
            return redirect('/account/projects');
        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->alert(
                'error',
                __('messages.t_error'),
                livewire_alert_params($e->getMessage(), 'error')
            );

            throw $e;
        } catch (\Throwable $th) {

            // Error
            $this->alert(
                'error',
                __('messages.t_error'),
                livewire_alert_params($e->getMessage(), 'error')
            );
        }
    }


    /**
     * Get project status
     *
     * @param object $settings
     * @return string
     */
    private function status($settings)
    {
        // Get selected plans
        $selected_plans = $this->selected_plans;

        // Check if has plans
        if (is_array($selected_plans) && count($selected_plans)) {

            // Pending payment
            return 'pending_payment';
        } else {

            // Check if auto approval enabled
            if ($settings->auto_approve_projects) {

                // Active
                return 'active';
            }

            // Pending approval
            return 'pending_approval';
        }
    }


    /**
     * Get premium options
     *
     * @param object $settings
     * @return array
     */
    private function premium($settings)
    {
        // Check if premium posting enabled
        if ($settings->is_premium_posting) {

            // Get selected plans
            $selected_plans = $this->selected_plans;

            // Check if has any plan
            if (is_array($selected_plans) && count($selected_plans)) {

                // Get plans
                $plans = ProjectPlan::whereIn('id', $selected_plans)->whereIsActive(true)->get();

                // Check if these plans exist
                if ($plans->count()) {

                    // Convert plans to array
                    $plans_to_array = $plans->toArray();

                    // Check if featured plan select
                    if (array_search('featured', array_column($plans_to_array, 'type')) !== false) {
                        $featured = $plans_to_array[array_search('featured', array_column($plans_to_array, 'type'))];
                    } else {
                        $featured = false;
                    }

                    // Check if urgent plan select
                    if (array_search('urgent', array_column($plans_to_array, 'type')) !== false) {
                        $urgent = $plans_to_array[array_search('urgent', array_column($plans_to_array, 'type'))];
                    } else {
                        $urgent = false;
                    }

                    // Check if highlighted plan select
                    if (array_search('highlight', array_column($plans_to_array, 'type')) !== false) {
                        $highlighted = $plans_to_array[array_search('highlight', array_column($plans_to_array, 'type'))];
                    } else {
                        $highlighted = false;
                    }

                    // Check if alert plan select
                    if (array_search('alert', array_column($plans_to_array, 'type')) !== false) {
                        $alert = $plans_to_array[array_search('alert', array_column($plans_to_array, 'type'))];
                    } else {
                        $alert = false;
                    }

                    // Calculate total price
                    $total = array_sum(array_column($plans_to_array, 'price'));

                    // Return premium options
                    return [
                        'is_featured'    => $featured ? true : false,
                        'is_urgent'      => $urgent ? true : false,
                        'is_highlighted' => $highlighted ? true : false,
                        'is_alert'       => $alert ? true : false,
                        'total'          => $total
                    ];
                } else {

                    // No plan found
                    return [
                        'is_featured'    => false,
                        'is_urgent'      => false,
                        'is_highlighted' => false,
                        'is_alert'       => false,
                        'total'          => 0
                    ];
                }
            } else {

                // No plan selected
                return [
                    'is_featured'    => false,
                    'is_urgent'      => false,
                    'is_highlighted' => false,
                    'is_alert'       => false,
                    'total'          => 0
                ];
            }
        } else {

            // Premium posting not enabled
            return [
                'is_featured'    => false,
                'is_urgent'      => false,
                'is_highlighted' => false,
                'is_alert'       => false,
                'total'          => 0
            ];
        }
    }


    public function addQuestion(): void
    {
        if (!is_array($this->questions)) {
            $this->questions = [];
        }

        if (count($this->questions) >= 8) {
            return;
        }

        $this->questions[] = [
            'text'        => '',
            'is_required' => false,
        ];
    }

    public function removeQuestion(int $index): void
    {
        if (!isset($this->questions[$index])) {
            return;
        }

        unset($this->questions[$index]);
        $this->questions = array_values($this->questions);
    }

    public function removeAttachment(int $index): void
    {
        if (!isset($this->attachments[$index])) {
            return;
        }

        unset($this->attachments[$index]);
        $this->attachments = array_values($this->attachments);
    }

    protected function generateNdaDocument(Project $project, string $scope, int $termMonths): ?string
    {
        try {
            $client           = auth()->user();
            $effective        = now();
            $effectiveDate    = $effective->format('Y-m-d');
            $expirationDate   = (clone $effective)->addMonths($termMonths)->format('Y-m-d');
            $cleanScope       = $scope !== '' ? $scope : 'كافة التفاصيل التقنية والمالية والوثائق المرفقة الخاصة بالمشروع.';

            $content = <<<NDA
اتفاقية عدم الإفصاح (NDA)
=========================

التاريخ: {$effectiveDate}

الطرف الأول (العميل): {($client->fullname ?? $client->username)}
الطرف الثاني (المستقل): _______________________________

رقم المشروع: {$project->pid}
عنوان المشروع: {$project->title}

1. نطاق السرية
   يتعهد الطرفان بالحفاظ على سرية المعلومات التالية وعدم مشاركتها مع أي طرف ثالث دون إذن خطي مسبق:
   - {$cleanScope}

2. فترة الاتفاقية
   يبدأ سريان هذه الاتفاقية من تاريخ {$effectiveDate} وتنتهي في {$expirationDate}، مع استمرار الالتزام بالسرية لما بعد انتهاء المدة المحددة.

3. الاستثناءات
   لا تشمل هذه الاتفاقية المعلومات التي تصبح معروفة للعامة دون خرق من أي طرف، أو التي كان الطرف المتلقي على علم بها مسبقاً، أو التي يتم طلبها بموجب الأنظمة والقوانين.

4. التزامات الطرف الثاني
   يلتزم الطرف الثاني بإعادة أو إتلاف كافة المواد السرية بناءً على طلب الطرف الأول، وعدم نسخ أو استخدام المعلومات إلا لغرض تنفيذ المشروع.

5. أحكام عامة
   يخضع هذا الاتفاق للأنظمة المعمول بها، وأي نزاع ينشأ يُحال إلى الجهة القضائية المختصة في مقر إقامة الطرف الأول، ما لم يتفق الطرفان على خلاف ذلك.

توقيع الطرف الأول (العميل): _______________________________

توقيع الطرف الثاني (المستقل): _______________________________
NDA;

            $path = 'projects/nda/' . $project->uid . '-' . Str::uuid()->toString() . '.md';
            Storage::disk('local')->put($path, $content);

            return $path;
        } catch (\Throwable $th) {
            report($th);
            return null;
        }
    }
}
