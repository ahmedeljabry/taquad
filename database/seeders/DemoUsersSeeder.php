<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Level;
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

            User::firstOrCreate(
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
                ]
            );
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
