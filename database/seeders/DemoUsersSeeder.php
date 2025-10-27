<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Level;
use App\Models\ProjectLevel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = Country::query()->pluck('id')->all();
        $levels    = Level::query()->pluck('id')->all();
        $freelancerLevels = ProjectLevel::forAccountType('seller')->pluck('id', 'slug')->toArray();
        $clientLevels     = ProjectLevel::forAccountType('buyer')->pluck('id', 'slug')->toArray();
        $defaultClientLevel = $clientLevels['client_newcomer'] ?? null;

        $profiles = [
            ['fullname' => 'أحمد السالم', 'username' => 'ahmad-salem', 'email' => 'ahmad.salem@example.com', 'headline' => 'قائد التحول الرقمي في الشركات المتوسطة'],
            ['fullname' => 'ريم السويدي', 'username' => 'reem-al-suwaidi', 'email' => 'reem.suwaidi@example.com', 'headline' => 'مديرة منتجات رقمية متخصصة في SaaS'],
            ['fullname' => 'سارة الخطيب', 'username' => 'sara-khatib', 'email' => 'sara.khatib@example.com', 'headline' => 'استشارية تجارب المستخدم عالية النمو'],
            ['fullname' => 'مازن العمري', 'username' => 'mazen-omari', 'email' => 'mazen.omari@example.com', 'headline' => 'مسؤول تطوير أعمال في قطاع الصحة'],
            ['fullname' => 'ليان الحارثي', 'username' => 'layan-harthy', 'email' => 'layan.harthy@example.com', 'headline' => 'مديرة مشاريع ابتكارية في التعليم'],
            ['fullname' => 'فهد القحطاني', 'username' => 'fahad-alqahtani', 'email' => 'fahad.qahtani@example.com', 'headline' => 'مؤسس حلول لوجستية رقمية'],
            ['fullname' => 'نورة الرشيد', 'username' => 'noura-alrashid', 'email' => 'noura.rashid@example.com', 'headline' => 'مديرة تسويق أداء في شركات التجارة الإلكترونية'],
            ['fullname' => 'عبدالله السبيعي', 'username' => 'abdullah-alsubaie', 'email' => 'abdullah.subaie@example.com', 'headline' => 'قائد فرق التطوير في قطاع التمويل'],
            ['fullname' => 'هناء الفارس', 'username' => 'hana-alfaris', 'email' => 'hana.faris@example.com', 'headline' => 'استشارية ابتكار وتجربة عميل'],
            ['fullname' => 'خالد السعد', 'username' => 'khaled-alsaad', 'email' => 'khaled.saad@example.com', 'headline' => 'مدير التحول الرقمي في قطاع التجزئة'],
            ['fullname' => 'ميساء المدني', 'username' => 'maysa-almadani', 'email' => 'maysa.madani@example.com', 'headline' => 'مديرة عمليات تقنية في الشركات الناشئة'],
            ['fullname' => 'طارق الهاجري', 'username' => 'tariq-alhajri', 'email' => 'tariq.hajri@example.com', 'headline' => 'قائد مبادرات الذكاء الاصطناعي المؤسسية'],
        ];

        $bioFragments = [
            'أركز على بناء المنتجات الرقمية التي تحل مشكلات حقيقية وتستند إلى بيانات واضحة.',
            'أمتلك خبرة عميقة في تحليل احتياجات أصحاب المصلحة وترجمتها إلى خارطة طريق تنفيذية.',
            'أؤمن بالشراكات طويلة الأمد والعمل بشفافية مع الفرق الفنية لضمان نجاح الإطلاق.',
            'أقود عمليات التغيير عبر وضع آليات متابعة دقيقة ومؤشرات أداء قابلة للقياس.',
            'أحب العمل مع فرق متعددة التخصصات وتوفير بيئة إبداعية تضمن جودة المخرجات.',
        ];

        foreach ($profiles as $index => $profile) {
            $email    = $profile['email'];
            $username = Str::slug($profile['username'], '_');

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'uid'              => uid(),
                    'username'         => $this->uniqueUsername($username),
                    'fullname'         => $profile['fullname'],
                    'headline'         => $profile['headline'],
                    'description'      => $this->composeBio($bioFragments),
                    'account_type'     => 'buyer',
                    'status'           => 'active',
                    'email_verified_at'=> now(),
                    'password'         => Hash::make('Password123!'),
                    'country_id'       => $this->randomValue($countries),
                    'level_id'         => $this->randomValue($levels),
                    'client_project_level_id' => $defaultClientLevel,
                ]
            );

            if ($defaultClientLevel && !$user->client_project_level_id) {
                $user->client_project_level_id = $defaultClientLevel;
                $user->save();
            }
        }

        $sellerProfiles = [
            [
                'fullname'   => 'ليث الزهراني',
                'username'   => 'laith-zahrani',
                'email'      => 'laith.zahrani@example.com',
                'headline'   => 'مصمم منتجات رقمية يقود التجارب العربية',
                'level_slug' => 'freelancer_top_rated',
                'rating_avg' => 4.9,
                'rating_count' => 22,
            ],
            [
                'fullname'   => 'أروى الناصر',
                'username'   => 'arwa-nasser',
                'email'      => 'arwa.nasser@example.com',
                'headline'   => 'مديرة مشاريع تقنية في الشركات الناشئة',
                'level_slug' => 'freelancer_elite',
                'rating_avg' => 4.95,
                'rating_count' => 30,
            ],
            [
                'fullname'   => 'رامي البوعينين',
                'username'   => 'rami-buainain',
                'email'      => 'rami.buainain@example.com',
                'headline'   => 'مهندس برمجيات سحابي لخدمات الأعمال',
                'level_slug' => 'freelancer_rising',
                'rating_avg' => 4.6,
                'rating_count' => 12,
            ],
        ];

        foreach ($sellerProfiles as $profile) {
            $email          = $profile['email'];
            $username       = Str::slug($profile['username'], '_');
            $ratingCount    = (int) $profile['rating_count'];
            $ratingAverage  = (float) $profile['rating_avg'];
            $ratingSum      = $ratingCount > 0 ? (int) round($ratingAverage * $ratingCount) : 0;

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'uid'                         => uid(),
                    'username'                    => $this->uniqueUsername($username),
                    'fullname'                    => $profile['fullname'],
                    'headline'                    => $profile['headline'],
                    'description'                 => $this->composeBio($bioFragments),
                    'account_type'                => 'seller',
                    'status'                      => 'active',
                    'email_verified_at'           => now(),
                    'password'                    => Hash::make('Password123!'),
                    'country_id'                  => $this->randomValue($countries),
                    'level_id'                    => $this->randomValue($levels),
                    'client_project_level_id'     => $defaultClientLevel,
                    'freelancer_project_level_id' => $freelancerLevels[$profile['level_slug']] ?? null,
                    'project_rating_count'        => $ratingCount,
                    'project_rating_sum'          => $ratingSum,
                    'project_rating_avg'          => $ratingCount > 0 ? round($ratingAverage, 2) : 0,
                    'last_project_review_at'      => $ratingCount > 0 ? now()->subDays(random_int(5, 45)) : null,
                ]
            );

            if (!$user->freelancer_project_level_id && isset($freelancerLevels[$profile['level_slug']])) {
                $user->freelancer_project_level_id = $freelancerLevels[$profile['level_slug']];
                $user->save();
            }

            if ($defaultClientLevel && !$user->client_project_level_id) {
                $user->client_project_level_id = $defaultClientLevel;
                $user->save();
            }
        }
    }

    /**
     * Generate a unique username.
     */
    protected function uniqueUsername(string $base): string
    {
        $baseName = $base !== '' ? $base : 'client_' . Str::lower(Str::random(6));
        $username = $baseName;
        $attempt  = 1;

        while (User::where('username', $username)->exists()) {
            $username = $baseName . '_' . $attempt;
            $attempt++;
        }

        return $username;
    }

    /**
     * Compose an Arabic bio snippet.
     */
    protected function composeBio(array $fragments): string
    {
        shuffle($fragments);

        return implode("\n\n", array_slice($fragments, 0, 2));
    }

    /**
     * Fetch a random value from array or null.
     */
    protected function randomValue(array $values): ?int
    {
        if (empty($values)) {
            return null;
        }

        return $values[array_rand($values)];
    }
}
