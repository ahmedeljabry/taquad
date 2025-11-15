<div class="bg-gradient-to-b from-white to-slate-50 dark:from-[#020817] dark:to-[#060b16]">
    <section class="relative overflow-hidden bg-gradient-to-br from-primary-50 via-white to-amber-50 dark:from-[#0c1530] dark:via-[#070c1c] dark:to-[#1b1227]">
        <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
            <div class="grid gap-12 lg:grid-cols-[1.15fr_0.85fr] lg:items-center">
                <div class="space-y-8 text-right" data-animate>
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/60 bg-white/80 px-5 py-1.5 text-xs font-semibold text-gray-700 shadow-sm backdrop-blur dark:border-white/10 dark:bg-white/5 dark:text-gray-200">
                        <i class="ph ph-folders text-primary-600 text-lg"></i>
                        دليل القطاعات
                    </span>
                    <h1 class="text-4xl font-black leading-snug text-slate-900 sm:text-5xl dark:text-white">
                        كل قطاع على المنصة معروض ببيانات واضحة تساعدك على اتخاذ القرار
                    </h1>
                    <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                        تصفح المجالات الأكثر نمواً، اطّلع على عدد المشاريع النشطة، واطّلع على المهارات المطلوبة قبل أن تطلق التالي.
                    </p>
                    <div class="flex flex-wrap justify-end gap-5">
                        <div class="rounded-3xl border border-white/70 bg-white/80 px-5 py-4 text-center shadow dark:border-white/10 dark:bg-white/5">
                            <p class="text-xs text-gray-500 dark:text-gray-300">مشاريع نشطة</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['active_projects']) }}</p>
                        </div>
                        <div class="rounded-3xl border border-white/70 bg-white/80 px-5 py-4 text-center shadow dark:border-white/10 dark:bg-white/5">
                            <p class="text-xs text-gray-500 dark:text-gray-300">مشاريع مكتملة</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['completed']) }}</p>
                        </div>
                        <div class="rounded-3xl border border-white/70 bg-white/80 px-5 py-4 text-center shadow dark:border-white/10 dark:bg-white/5">
                            <p class="text-xs text-gray-500 dark:text-gray-300">الخبراء المعتمدون</p>
                            <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ number_format($stats['verified_experts']) }}</p>
                        </div>
                    </div>
                </div>
                <div class="relative" data-animate data-animate-delay="0.1">
                    <div class="overflow-hidden rounded-[36px] border border-white/70 bg-white/90 p-8 shadow-2xl backdrop-blur dark:border-white/10 dark:bg-white/5">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">ما الذي ستحصل عليه؟</h2>
                        <div class="mt-6 space-y-6">
                            <div class="rounded-3xl border border-slate-100 bg-white/90 px-5 py-4 text-sm shadow-sm dark:border-white/5 dark:bg-white/10">
                                <p class="text-xs font-semibold text-primary-700 dark:text-primary-200">بيانات المشاريع</p>
                                <p class="mt-1 text-gray-600 dark:text-gray-200">عرض عدد المشاريع التي تمّت وإجمالي الطلب الحالي لكل قطاع.</p>
                            </div>
                            <div class="rounded-3xl border border-slate-100 bg-white/90 px-5 py-4 text-sm shadow-sm dark:border-white/5 dark:bg-white/10">
                                <p class="text-xs font-semibold text-primary-700 dark:text-primary-200">أهم المهارات</p>
                                <p class="mt-1 text-gray-600 dark:text-gray-200">قائمة بأهم المهارات التي يطلبها أصحاب المشاريع في هذا المجال.</p>
                            </div>
                            <div class="rounded-3xl border border-slate-100 bg-white/90 px-5 py-4 text-sm shadow-sm dark:border-white/5 dark:bg-white/10">
                                <p class="text-xs font-semibold text-primary-700 dark:text-primary-200">روابط سريعة</p>
                                <p class="mt-1 text-gray-600 dark:text-gray-200">انتقل إلى المشاريع المرتبطة أو ابدأ مشروعك مع خبراء المجال.</p>
                            </div>
                        </div>
                    </div>
                    <div class="pointer-events-none absolute -top-6 ltr:-left-10 rtl:-right-10 hidden h-32 w-32 rounded-full bg-primary-500/20 blur-3xl lg:block"></div>
                </div>
            </div>
        </div>
    </section>

    @if ($featuredCategories->isNotEmpty())
        <section class="py-20">
            <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
                <div class="mb-10 text-center" data-animate>
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/80 px-4 py-1 text-sm font-semibold text-primary-600 dark:bg-white/5 dark:text-primary-300">
                        قطاعات تشهد نمواً سريعاً
                    </span>
                    <h2 class="mt-4 text-3xl font-bold text-gray-900 sm:text-4xl dark:text-white">
                        ابدأ من أكثر المجالات نشاطاً
                    </h2>
                    <p class="mt-3 text-gray-600 dark:text-gray-300">المجالات التالية تضم أعلى طلبات خلال آخر ٣٠ يوماً.</p>
                </div>
                <div class="grid gap-6 md:grid-cols-3">
                    @foreach ($featuredCategories as $category)
                        <a href="{{ url('categories', $category->slug) }}"
                            class="group relative overflow-hidden rounded-3xl border border-white/40 bg-gray-900/90 p-6 text-white shadow-lg transition hover:-translate-y-1 hover:shadow-2xl dark:border-white/10"
                            data-animate data-animate-delay="{{ $loop->index * 0.08 }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                            <div class="relative flex h-48 flex-col justify-between">
                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-white/70">إجمالي المشاريع</p>
                                    <p class="mt-2 text-3xl font-black">{{ number_format($category->projects_count) }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-white/70">مجال</p>
                                    <h3 class="text-2xl font-semibold">{{ $category->name }}</h3>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="py-20">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col gap-4 text-right lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <span class="inline-flex items-center gap-2 rounded-full bg-primary-50 px-4 py-1 text-xs font-semibold text-primary-600 dark:bg-primary-500/10 dark:text-primary-300">
                        جميع القطاعات ({{ $stats['categories'] }})
                    </span>
                    <h2 class="mt-3 text-3xl font-bold text-gray-900 sm:text-4xl dark:text-white">استعرض المجال المناسب لك</h2>
                </div>
                <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-300 lg:max-w-2xl">
                    استخدم البطاقات التالية للتعرف على التخصصات الفرعية وروابط البدء السريع. نحدّث البيانات بشكل يومي كي تبقى الصورة واضحة.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                @foreach ($categories as $category)
                    @php
                        $skills = ($skillMap[$category->id] ?? collect())->take(5);
                    @endphp
                    <div class="group flex flex-col rounded-3xl border border-white/70 bg-white/90 p-6 shadow-lg backdrop-blur transition hover:-translate-y-1 hover:shadow-2xl dark:border-white/10 dark:bg-white/5" data-animate data-animate-delay="{{ ($loop->index % 4) * 0.05 }}">
                        <div class="flex flex-col gap-3 text-right lg:flex-row lg:items-start lg:justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-primary-600 dark:text-primary-300">قطاع</p>
                                <h3 class="mt-2 text-2xl font-semibold text-gray-900 dark:text-white">{{ $category->name }}</h3>
                            </div>
                            <span class="inline-flex items-center gap-1 rounded-full bg-primary-50 px-3 py-1 text-[11px] font-semibold text-primary-700 dark:bg-primary-500/15 dark:text-primary-200">
                                {{ number_format($category->projects_count) }} مشروع
                            </span>
                        </div>
                        <p class="mt-4 text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                            {{ $category->seo_description ?: 'مجال متكامل يدعم إطلاق المشاريع من مرحلة التخطيط حتى التسليم.' }}
                        </p>
                        @if ($skills->isNotEmpty())
                            <div class="mt-4 flex flex-wrap gap-2">
                                @foreach ($skills as $skill)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700 dark:bg-white/10 dark:text-white/80">
                                        <i class="ph ph-hash"></i>
                                        {{ $skill->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="{{ url('explore/projects', $category->slug) }}"
                                class="inline-flex items-center gap-2 rounded-2xl border border-primary-200 px-4 py-2 text-sm font-semibold text-primary-700 transition hover:bg-primary-50 dark:border-primary-500/40 dark:text-primary-200 dark:hover:bg-primary-500/10">
                                <i class="ph ph-arrow-line-up-right"></i>
                                تصفح المشاريع
                            </a>
                            <a href="{{ url('post/project') }}"
                                class="inline-flex items-center gap-2 rounded-2xl border border-white/60 bg-white/80 px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm transition hover:-translate-y-0.5 dark:border-white/10 dark:bg-white/10 dark:text-white">
                                <i class="ph ph-plus"></i>
                                أضف مشروعاً في هذا القطاع
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
