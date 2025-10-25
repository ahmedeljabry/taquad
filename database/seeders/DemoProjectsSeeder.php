<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectRequiredSkill;
use App\Models\ProjectSkill;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DemoProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $existingCount = Project::query()->count();
        $target        = 60;

        if ($existingCount >= $target) {
            return;
        }

        // Ensure we have at least a base set of clients.
        if (User::query()->where('account_type', 'buyer')->count() < 8) {
            $this->call(DemoUsersSeeder::class);
        }

        $clients     = User::query()->where('account_type', 'buyer')->get();
        $categories  = ProjectCategory::with('skills')->get();
        $allSkills   = ProjectSkill::query()->get();

        if ($clients->isEmpty() || $categories->isEmpty() || $allSkills->isEmpty()) {
            return;
        }

        $focusAreas = [
            'منصة تعليم إلكتروني',
            'نظام حجز طبي',
            'حل لإدارة المخزون',
            'بوابة تمويل جماعي',
            'منصة محتوى تفاعلي',
            'تطبيق توصيل محلي',
            'لوحة ذكاء أعمال',
            'نظام إدارة عيادات',
            'منصة استشارات عن بعد',
            'منظومة تتبع لوجستي',
            'منصة تجارب عملاء',
            'مركز دعم ذاتي',
        ];

        $audiences = [
            'المنشآت الصغيرة والمتوسطة',
            'شركات التقنية الناشئة',
            'الجامعات ومراكز التدريب',
            'المنشآت الصحية المتخصصة',
            'سلاسل التوريد الإقليمية',
            'فرق التسويق المركزي',
            'فرق خدمة العملاء',
            'المؤسسات غير الربحية',
        ];

        $valueAngles = [
            'تسريع إطلاق الخدمات الرقمية',
            'رفع مستوى الكفاءة التشغيلية',
            'تحسين رحلة المستخدم من أول تفاعل',
            'تخفيض التكاليف التشغيلية المتكررة',
            'توفير لوحة تحكم لحظية لاتخاذ القرار',
            'زيادة معدل التحويل والاحتفاظ بالعملاء',
            'تطوير خدمات تعتمد على البيانات الفعلية',
            'تحسين تجربة ما بعد البيع والدعم الفني',
        ];

        $techStacks = [
            'Laravel و Vue.js مع Tailwind CSS',
            'Laravel و Livewire مع بنية API نظيفة',
            'Laravel و React مع Next.js للواجهات',
            'Laravel و Inertia مع تصميم متجاوب',
            'Laravel مع Flutter لتطبيقات الهاتف',
            'Laravel و Nuxt لدعم تجربة متعددة اللغات',
        ];

        $dataPractices = [
            'بناء قاعدة بيانات موحدة مع تقارير لحظية',
            'تكامل مع مصادر البيانات الحالية وإزالة التكرار',
            'تصميم نماذج بيانات قابلة للتوسع خلال ١٢ شهرًا',
            'ضبط صلاحيات المستخدمين ومتابعة الأنشطة اليومية',
            'ربط المنصة مع أدوات التسويق والأتمتة الحالية',
        ];

        $successMetrics = [
            'قياس معدل التفاعل الأسبوعي ونمو المستخدمين النشطين',
            'رفع معدل التحويل بنسبة ٣٠٪ خلال الربع الأول بعد الإطلاق',
            'تقليل زمن تنفيذ العملية الأساسية إلى أقل من دقيقتين',
            'تحقيق درجة رضا مستخدمين تتجاوز ٤.٥ من ٥ خلال أول ثلاثة أشهر',
            'تفعيل لوحة تحكم لفرق القيادة تعرض مؤشرات الأداء الأساسية لحظيًا',
        ];

        $budgetOptions = [
            ['type' => 'fixed', 'min' => 1200, 'max' => 2600],
            ['type' => 'fixed', 'min' => 1800, 'max' => 3200],
            ['type' => 'fixed', 'min' => 2500, 'max' => 4200],
            ['type' => 'hourly', 'min' => 70, 'max' => 110],
            ['type' => 'hourly', 'min' => 90, 'max' => 140],
        ];

        $durationOptions = [
            ['days' => 21, 'label' => 'ثلاثة أسابيع'],
            ['days' => 30, 'label' => 'شهر كامل مع تسليم مرحلي'],
            ['days' => 45, 'label' => 'ستة أسابيع مع اجتماعات أسبوعية'],
            ['days' => 60, 'label' => 'ثمانية أسابيع تشمل الاختبارات'],
            ['days' => 75, 'label' => 'عشرة أسابيع مع إطلاق تدريجي'],
            ['days' => 90, 'label' => 'ثلاثة أشهر تشمل التحسين والتدريب'],
        ];

        $now = Carbon::now();

        $projectsToCreate = $target - $existingCount;

        for ($i = 0; $i < $projectsToCreate; $i++) {
            $client    = $clients->random();
            $category  = $categories->random();
            $focus     = Arr::random($focusAreas);
            $audience  = Arr::random($audiences);
            $angle     = Arr::random($valueAngles);
            $tech      = Arr::random($techStacks);
            $practice  = Arr::random($dataPractices);
            $success   = Arr::random($successMetrics);
            $budget    = Arr::random($budgetOptions);
            $duration  = Arr::random($durationOptions);

            $title = "{$focus} لدعم {$audience}";
            $slug  = $this->uniqueSlug($title);
            $pid   = $this->uniquePid();

            $description = implode("\n\n", [
                "نبحث عن فريق محترف لتطوير {$focus} يخدم {$audience} ويضمن {$angle}. نريد منتجًا مرنًا يدعم اللغة العربية بالكامل ويستوعب توسعًا سريعًا في الأشهر القادمة.",
                "يشمل نطاق العمل تحليل تجربة المستخدم الحالية، إعداد قصة مستخدم تفصيلية، ثم بناء الواجهة والخلفية باستخدام {$tech}. من المهم {$practice} مع الالتزام بمعايير أمان عالية وإمكانية التكامل مع أنظمة داخلية مستقبلًا.",
                "يجب تسليم العمل خلال {$duration['label']}، مع اجتماعات مراجعة أسبوعية وتوثيق واضح لكل مرحلة. سيتم قياس النجاح عبر {$success}. نفضّل فريقًا يمتلك خبرة مثبتة في المشاريع المماثلة ويعمل بأسلوب تشاركي واضح.",
            ]);

            $requiresNda = (bool) random_int(0, 1);

            DB::transaction(function () use (
                $client,
                $category,
                $slug,
                $pid,
                $title,
                $description,
                $budget,
                $duration,
                $requiresNda,
                $now,
                $allSkills
            ) {
                $project = Project::create([
                    'uid'             => uid(),
                    'pid'             => $pid,
                    'user_id'         => $client->id,
                    'title'           => $title,
                    'slug'            => $slug,
                    'description'     => $description,
                    'category_id'     => $category->id,
                    'budget_min'      => $budget['min'],
                    'budget_max'      => $budget['max'],
                    'budget_type'     => $budget['type'],
                    'duration'        => $duration['days'],
                    'status'          => 'active',
                    'is_featured'     => (bool) random_int(0, 1),
                    'is_urgent'       => (bool) random_int(0, 1),
                    'is_highlighted'  => (bool) random_int(0, 1),
                    'is_alert'        => false,
                    'requires_nda'    => $requiresNda,
                    'expiry_date'     => $now->copy()->addDays(45),
                ]);

                $skillsPool = $category->skills->isNotEmpty()
                    ? $category->skills
                    : $allSkills;

                $skillsCount    = max(1, $skillsPool->count());
                $takeUpperBound = min(6, $skillsCount);
                $takeLowerBound = min(3, $takeUpperBound);

                $skillsToAttach = $skillsPool
                    ->shuffle()
                    ->take(random_int($takeLowerBound, $takeUpperBound));

                $records = $skillsToAttach->map(fn ($skill) => [
                    'project_id' => $project->id,
                    'skill_id'   => $skill->id,
                ])->toArray();

                if (! empty($records)) {
                    ProjectRequiredSkill::insert($records);
                }
            });
        }
    }

    /**
     * Generate a unique project slug.
     */
    protected function uniqueSlug(string $title): string
    {
        $base    = Str::slug($title, '-');
        $base    = $base !== '' ? $base : 'project-' . Str::lower(Str::random(6));
        $slug    = $base;
        $attempt = 1;

        while (Project::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $attempt;
            $attempt++;
        }

        return Str::limit($slug, 160, '');
    }

    /**
     * Generate a unique project pid.
     */
    protected function uniquePid(): string
    {
        do {
            $pid = strtoupper(Str::random(6));
        } while (Project::where('pid', $pid)->exists());

        return $pid;
    }
}
