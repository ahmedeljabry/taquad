@php
    $project = $this->project;
    $title = $project['title'] ?? '';
    $description = $project['description'] ?? '';
    $salaryType = $project['salary_type'] ?? 'fixed';
    $requiresNda = $project['requires_nda'] ?? false;
    $ndaScope = $project['nda_scope'] ?? null;
    $ndaTerm = $project['nda_term_months'] ?? null;
    $currencyCode = $project['currency_code'] ?? settings('currency')->code;
    $currencySymbol = $project['currency_symbol'] ?? settings('currency')->symbol;

    $formatMoney = static function ($value) use ($currencyCode) {
        if ($value === null || $value === '' || !is_numeric($value)) {
            return null;
        }

        return money((float) $value, $currencyCode, true);
    };

    $minPrice = $formatMoney($project['min_price'] ?? null);
    $maxPrice = $formatMoney($project['max_price'] ?? null);

    if ($salaryType === 'hourly') {
        $budgetLabel = $minPrice ? $minPrice . ' /ساعة' : 'أدخل سعر الساعة';
    } elseif ($minPrice && $maxPrice) {
        $budgetLabel = "{$minPrice} - {$maxPrice}";
    } elseif ($minPrice) {
        $budgetLabel = "{$minPrice}";
    } elseif ($maxPrice) {
        $budgetLabel = "{$maxPrice}";
    } else {
        $budgetLabel = 'حدد الميزانية المتوقعة';
    }

    $skills = $this->skills;
    $plans = $this->plans;
    $questions = $project['questions'] ?? [];
    $milestones = $project['milestones'] ?? [];
    $attachments = $project['attachments'] ?? [];

    $categoryName = $category?->name ?? 'اختر فئة المشروع';
@endphp

<div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 mt-[6rem] mb-20 space-y-12">
    <section
        class="relative overflow-hidden rounded-3xl border border-slate-200 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 px-6 py-10 text-white shadow-xl dark:border-slate-700">
        <div class="absolute inset-0 opacity-20"
            style="background-image: radial-gradient(circle at 5% 15%, rgba(255,255,255,0.7) 0%, transparent 35%), radial-gradient(circle at 95% 0%, rgba(255,255,255,0.4) 0%, transparent 35%);">
        </div>
        <div class="relative grid gap-10 lg:grid-cols-[minmax(0,1.6fr)_minmax(320px,1fr)] lg:items-center">
            <div class="space-y-6">
                <div
                    class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-1 text-[12px] font-semibold uppercase tracking-[0.3em]">
                    <i class="ph ph-eye"></i>
                    معاينة مشروع
                </div>
                <div class="space-y-3">
                    <h1 class="text-3xl font-bold sm:text-4xl">{{ $title ?: 'أضف عنواناً جذاباً يعكس هدف المشروع' }}
                    </h1>
                    <p class="text-sm text-white/70 leading-7">
                        {{ $project['description_preview'] ?? 'سيظهر ملخص وصف مشروعك هنا. استخدمه لجذب أنظار أفضل الخبراء وإيضاح الهدف النهائي.' }}
                    </p>
                </div>
                <div class="flex flex-wrap gap-3 text-[12px] font-semibold uppercase tracking-[0.2em] text-white/70">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1">
                        <i class="ph ph-folders"></i>
                        {{ $categoryName }}
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1">
                        <i class="ph ph-coins"></i>
                        {{ $budgetLabel }}
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1">
                        <i class="ph ph-path"></i>
                        {{ $salaryType === 'hourly' ? 'أجر بالساعة' : 'ميزانية ثابتة' }}
                    </span>
                    @if ($requiresNda)
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1">
                            <i class="ph ph-shield-check"></i>
                            اتفاقية عدم إفصاح
                        </span>
                    @endif
                </div>
                <div class="grid gap-3 sm:grid-cols-3">
                    <div class="rounded-2xl bg-white/10 p-4 shadow-sm">
                        <p class="text-xs text-white/50 uppercase tracking-[0.2em]">الميزانية</p>
                        <p class="mt-1 text-lg font-semibold">{{ $budgetLabel }}</p>
                    </div>
                    <div class="rounded-2xl bg-white/10 p-4 shadow-sm">
                        <p class="text-xs text-white/50 uppercase tracking-[0.2em]">حالة النشر</p>
                        <p class="mt-1 text-lg font-semibold">مسودة قبل الإطلاق</p>
                    </div>
                    <div class="rounded-2xl bg-white/10 p-4 shadow-sm">
                        <p class="text-xs text-white/50 uppercase tracking-[0.2em]">آخر تحديث</p>
                        <p class="mt-1 text-lg font-semibold">
                            {{ isset($project['updated_at']) ? format_date($project['updated_at'], 'd F Y') : now()->format('d-m-Y') }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <a href="{{ url('post/project') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-6 py-2.5 text-sm font-semibold text-slate-900 shadow-md shadow-black/10 transition hover:-translate-y-0.5">
                        <i class="ph ph-arrow-bend-up-left"></i>
                        العودة إلى التحرير
                    </a>
                    <span class="text-xs text-white/60">
                        يتم تحديث هذه المعاينة عند كل حفظ مؤقت أو تعديل.
                    </span>
                </div>
            </div>

            <aside
                class="space-y-4 rounded-3xl bg-white/10 p-6 shadow-xl backdrop-blur dark:bg-white/10/5 lg:space-y-5">
                <h2 class="text-sm font-semibold uppercase tracking-[0.3em] text-white/70">تفاصيل سريعة</h2>
                <ul class="space-y-3 text-sm text-white/80">
                    <li class="flex items-center justify-between gap-2">
                        <span class="font-medium">فئة المشروع</span>
                        <span class="text-white/70">{{ $categoryName }}</span>
                    </li>
                    <li class="flex items-center justify-between gap-2">
                        <span class="font-medium">نوع الدفع</span>
                        <span
                            class="text-white/70">{{ $salaryType === 'hourly' ? 'أجر بالساعة' : 'ميزانية ثابتة' }}</span>
                    </li>
                    <li class="flex items-center justify-between gap-2">
                        <span class="font-medium">اتفاقية السرية</span>
                        <span class="text-white/70">{{ $requiresNda ? 'مطلوبة' : 'غير مطلوبة' }}</span>
                    </li>
                    @if ($requiresNda && filled($ndaScope))
                        <li class="space-y-1">
                            <span class="font-medium">نطاق السرية</span>
                            <p class="text-[13px] leading-6 text-white/70">{{ $ndaScope }}</p>
                            @if ($ndaTerm)
                                <p class="text-[12px] text-white/50">مدة الالتزام: {{ $ndaTerm }} شهر</p>
                            @endif
                        </li>
                    @endif
                </ul>
                <div>
                    <h3 class="text-xs font-semibold uppercase tracking-[0.3em] text-white/70 mb-3">المهارات المطلوبة
                    </h3>
                    <div class="flex flex-wrap gap-2">
                        @forelse ($skills as $skill)
                            <span
                                class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-[12px] font-semibold text-white">
                                <i class="ph ph-lightning"></i>
                                {{ $skill }}
                            </span>
                        @empty
                            <span class="text-[12px] text-white/60">لم يتم إضافة مهارات بعد.</span>
                        @endforelse
                    </div>
                </div>
                @if (!empty($plans))
                    <div class="space-y-3">
                        <h3 class="text-xs font-semibold uppercase tracking-[0.3em] text-white/70 mb-1">خيارات الترويج</h3>
                        @foreach ($plans as $plan)
                            <div class="rounded-2xl border border-white/15 bg-white/5 px-4 py-3 text-[13px]">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="font-semibold text-white">{{ $plan['title'] }}</span>
                                    <span class="text-white/70">{{ $formatMoney($plan['price']) ?? $plan['price'] }}
                                        {{ $currencySymbol }}</span>
                                </div>
                                @if (!empty($plan['description']))
                                    <p class="mt-2 text-white/60 leading-6">{{ $plan['description'] }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </aside>
        </div>
    </section>

    <section class="grid gap-8 lg:grid-cols-[minmax(0,1.6fr)_minmax(320px,1fr)]">
        <div class="space-y-8">
            <article
                class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-900/5 dark:border-zinc-700 dark:bg-zinc-900">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">وصف المشروع</h2>
                <div class="mt-4 text-sm leading-7 text-slate-600 dark:text-zinc-300">
                    @if ($description)
                        {!! nl2br(e($description)) !!}
                    @else
                        <p>سيظهر الوصف التفصيلي هنا. اشرح النتائج المتوقعة، الجمهور المستهدف، والمعلومات الأساسية التي
                            يحتاجها المستقل.</p>
                    @endif
                </div>
            </article>

            <div class="grid gap-6 lg:grid-cols-2">
                <div
                    class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-900/5 dark:border-zinc-700 dark:bg-zinc-900">
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">أسئلة للمستقل</h3>
                    <ul class="mt-4 space-y-3 text-sm text-slate-600 dark:text-zinc-300">
                        @forelse ($questions as $question)
                            <li class="rounded-2xl bg-slate-100 px-4 py-3 dark:bg-zinc-800">
                                <div class="flex items-start justify-between gap-3">
                                    <p class="leading-6">{{ $question['text'] }}</p>
                                    @if (!empty($question['is_required']))
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-rose-50 px-2 py-0.5 text-[11px] font-semibold text-rose-600 dark:bg-rose-500/10 dark:text-rose-300">
                                            <i class="ph ph-asterisk"></i> إلزامي
                                        </span>
                                    @endif
                                </div>
                            </li>
                        @empty
                            <li class="text-[13px] text-slate-500 dark:text-zinc-400">لم يتم إضافة أسئلة للمستقلين بعد.</li>
                        @endforelse
                    </ul>
                </div>

                <div
                    class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-900/5 dark:border-zinc-700 dark:bg-zinc-900">
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">الدفعات المقترحة</h3>
                    @if (!empty($milestones))
                        <ul class="mt-4 space-y-3">
                            @foreach ($milestones as $index => $milestone)
                                <li
                                    class="flex items-center justify-between gap-3 rounded-2xl bg-slate-100 px-4 py-3 text-sm text-slate-600 dark:bg-zinc-800 dark:text-zinc-200">
                                    <div class="flex items-center gap-3">
                                        <span
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-primary-500/10 text-primary-600 dark:text-primary-300">{{ $index + 1 }}</span>
                                        <span>{{ $milestone['title'] ?: 'معلم بدون اسم' }}</span>
                                    </div>
                                    @if (!empty($milestone['amount']))
                                        <span
                                            class="font-semibold text-primary-600 dark:text-primary-300">{{ $formatMoney($milestone['amount']) ?? $milestone['amount'] }}
                                            {{ $currencySymbol }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mt-4 text-[13px] text-slate-500 dark:text-zinc-400">أضف مراحل المشروع لتحديد الدفعات أو
                            النتائج الجزئية.</p>
                    @endif
                </div>
            </div>

            <div
                class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-900/5 dark:border-zinc-700 dark:bg-zinc-900">
                <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">مرفقات</h3>
                @if (!empty($attachments))
                    <ul class="mt-4 grid gap-3 sm:grid-cols-2">
                        @foreach ($attachments as $name)
                            <li
                                class="flex items-center gap-3 rounded-2xl bg-slate-100 px-4 py-3 text-sm text-slate-600 dark:bg-zinc-800 dark:text-zinc-200">
                                <i class="ph ph-paperclip text-primary-500"></i>
                                <span class="truncate" title="{{ $name }}">{{ $name }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="mt-4 text-[13px] text-slate-500 dark:text-zinc-400">لم يتم رفع ملفات حتى الآن. يمكنك إضافة
                        ملفات الدعم (عروض تقديمية، مخططات، دراسات) من صفحة التحرير.</p>
                @endif
            </div>
        </div>

        <aside class="space-y-6">
            <div
                class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-900/5 dark:border-zinc-700 dark:bg-zinc-900">
                <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">التسعير والدفعات</h3>
                <ul class="mt-3 space-y-2 text-sm text-slate-600 dark:text-zinc-300">
                    <li class="flex items-center justify-between gap-2">
                        <span>الميزانية الكلية</span>
                        <span>{{ $budgetLabel }}</span>
                    </li>
                    <li class="flex items-center justify-between gap-2">
                        <span>نوع العقد</span>
                        <span>{{ $salaryType === 'hourly' ? 'أجر بالساعة' : 'مبلغ ثابت' }}</span>
                    </li>
                    <li class="flex items-center justify-between gap-2">
                        <span>خيارات الترويج</span>
                        <span>{{ !empty($plans) ? count($plans) . ' باقة' : 'لم يتم اختيار باقات' }}</span>
                    </li>
                </ul>
                @if (!empty($plans))
                    <div class="mt-4 space-y-2 text-[13px] text-slate-500 dark:text-zinc-400">
                        @foreach ($plans as $plan)
                            <p>• {{ $plan['title'] }} — {{ $formatMoney($plan['price']) ?? $plan['price'] }}
                                {{ $currencySymbol }}</p>
                        @endforeach
                    </div>
                @endif
            </div>

            <div
                class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-900/5 dark:border-zinc-700 dark:bg-zinc-900">
                <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">التوجيهات للمستقلين</h3>
                <p class="mt-3 text-sm leading-6 text-slate-600 dark:text-zinc-300">
                    تأكد من توضيح شروط العمل والموارد المتاحة للمستقلين. كلما كانت التفاصيل أكثر دقة، زادت جودة العروض
                    التي ستحصل عليها.
                </p>
                <ul class="mt-3 space-y-2 text-[13px] text-slate-500 dark:text-zinc-400">
                    <li>• حدد مخرجات واضحة لكل مرحلة.</li>
                    <li>• استعرض نماذج العمل السابقة للمستقلين.</li>
                    <li>• شارك جدولاً زمنياً واقعيًا مع نقاط مراجعة.</li>
                </ul>
            </div>
        </aside>
    </section>
</div>