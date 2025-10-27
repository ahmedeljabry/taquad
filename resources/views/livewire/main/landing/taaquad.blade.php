<div class="relative w-full bg-slate-50 dark:bg-zinc-800" x-data="{ section: 'hero' }">
    {{-- Hero --}}
    <section id="hero" class="mx-auto flex max-w-7xl flex-col gap-12 px-4 py-20 sm:px-6 lg:flex-row lg:items-center lg:gap-16 lg:px-8">
        <div class="flex-1 space-y-6">
            <span class="inline-flex items-center rounded-full bg-primary-100 px-4 py-1.5 text-xs font-semibold tracking-[0.4em] text-primary-700 dark:bg-primary-500/15 dark:text-primary-200">
                {{ data_get($sections, 'hero.eyebrow') }}
            </span>
            <h1 class="text-3xl font-black leading-snug text-slate-900 sm:text-4xl lg:text-5xl dark:text-white">
                {{ data_get($sections, 'hero.title') }}
            </h1>
            <p class="max-w-2xl text-base leading-relaxed text-slate-600 dark:text-zinc-300">
                {{ data_get($sections, 'hero.subtitle') }}
            </p>
            <div class="mt-10 flex flex-wrap gap-4">
                <a href="#how" class="inline-flex items-center rounded-full bg-primary-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:ring-offset-slate-50 dark:focus:ring-offset-zinc-900">
                    اكتشف كيف تعمل تعاقد
                    <i class="ph-duotone ph-arrow-down-left ml-2 text-lg rtl:rotate-90"></i>
                </a>
                <a href="#cta" class="inline-flex items-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-primary-600 shadow-sm transition hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:ring-offset-slate-50 dark:bg-zinc-900 dark:text-primary-200 dark:hover:bg-zinc-800 dark:focus:ring-offset-zinc-900">
                    جرّب تعاقد مجاناً
                    <i class="ph-duotone ph-rocket-launch ml-2 text-lg"></i>
                </a>
            </div>
        </div>

        <div class="flex-1">
            <div class="grid gap-4 rounded-3xl bg-white p-8 shadow-xl dark:bg-zinc-900">
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    @foreach (data_get($sections, 'hero.stats', []) as $stat)
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-6 text-center dark:border-zinc-700 dark:bg-zinc-800/50">
                            <p class="text-2xl font-bold text-primary-600 dark:text-primary-300">{{ data_get($stat, 'value') }}</p>
                            <p class="mt-2 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-zinc-400">{{ data_get($stat, 'label') }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="rounded-2xl border border-dashed border-slate-200 p-6 text-sm leading-relaxed text-slate-500 dark:border-zinc-600 dark:text-zinc-300">
                    “منصة تعاقد تمنحك أفضل المواهب العربية في مكان واحد، من المصممين إلى المطورين، مع تجربة تعاقد سلسة ومدعومة بالأدوات.”
                </div>
            </div>
        </div>
    </section>

    {{-- Feature groups --}}
    <section id="features" class="border-t border-slate-200 bg-white py-20 dark:border-zinc-700 dark:bg-zinc-900">
        <div class="mx-auto max-w-7xl space-y-10 px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl space-y-3">
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">لماذا تعاقد خيارك الأول لإدارة فرق العمل الحر؟</h2>
                <p class="text-sm leading-relaxed text-slate-500 dark:text-zinc-400">
                    صممنا تعاقد لتجمع بين التكنولوجيا الذكية وعناصر الأمان والثقة، مما يسمح لك بالتركيز على نتائج مشروعك بدلاً من تفاصيل التوظيف المرهقة.
                </p>
            </div>
            <div class="grid gap-6 md:grid-cols-3">
                @foreach ($featureGroups as $group)
                    <div class="flex h-full flex-col justify-between rounded-3xl border border-slate-200 bg-slate-50 p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-zinc-700 dark:bg-zinc-800">
                        <div class="space-y-4">
                            <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary-100 text-primary-700 dark:bg-primary-500/15 dark:text-primary-300">
                                <i class="{{ data_get($group, 'icon') }} text-xl"></i>
                            </span>
                            <h3 class="text-xl font-semibold text-slate-900 dark:text-zinc-100">{{ data_get($group, 'title') }}</h3>
                            <ul class="space-y-2 text-sm leading-relaxed text-slate-500 dark:text-zinc-400">
                                @foreach (data_get($group, 'items', []) as $item)
                                    <li class="flex items-start gap-2">
                                        <i class="ph-duotone ph-check-circle text-lg text-primary-600 dark:text-primary-300"></i>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="mt-6 text-xs font-semibold uppercase tracking-wide text-primary-600 dark:text-primary-300">
                            موثوق لدى آلاف الشركات المحلية والإقليمية
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- How it works --}}
    <section id="how" class="bg-slate-50 py-20 dark:bg-zinc-800">
        <div class="mx-auto max-w-6xl space-y-12 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">ثلاث خطوات فقط للانطلاق مع تعاقد</h2>
                <p class="mt-3 text-sm text-slate-500 dark:text-zinc-400">سواء كنت فريق ناشئ أو مؤسسة، تساعدك تعاقد في اختصار رحلة التوظيف من أسابيع إلى ساعات.</p>
            </div>
            <div class="grid gap-6 md:grid-cols-3">
                @foreach (data_get($sections, 'how', []) as $index => $step)
                    <div class="relative rounded-3xl border border-slate-200 bg-white p-8 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                        <span class="absolute -top-4 left-6 flex h-10 w-10 items-center justify-center rounded-full bg-primary-600 text-sm font-bold text-white shadow-lg">{{ $index + 1 }}</span>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-zinc-100">{{ data_get($step, 'title') }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-slate-500 dark:text-zinc-400">
                            {{ data_get($step, 'description') }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    <section id="stories" class="border-y border-slate-200 bg-white py-20 dark:border-zinc-700 dark:bg-zinc-900">
        <div class="mx-auto max-w-6xl space-y-10 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">قصص نجاح من عملائنا</h2>
                <p class="mt-3 text-sm text-slate-500 dark:text-zinc-400">فرق ومنتجات وُلدت في تعاقد، وتوسعت لتقود قطاعاتها بثقة.</p>
            </div>
            <div class="grid gap-6 md:grid-cols-2">
                @foreach (data_get($sections, 'testimonials', []) as $testimonial)
                    <div class="flex h-full flex-col justify-between rounded-3xl border border-slate-200 bg-slate-50 p-8 shadow-sm dark:border-zinc-700 dark:bg-zinc-800">
                        <p class="text-base leading-relaxed text-slate-600 dark:text-zinc-300">“{{ data_get($testimonial, 'quote') }}”</p>
                        <div class="mt-6">
                            <p class="text-sm font-semibold text-slate-900 dark:text-zinc-100">{{ data_get($testimonial, 'name') }}</p>
                            <p class="text-xs text-slate-500 dark:text-zinc-400">{{ data_get($testimonial, 'role') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section id="cta" class="bg-gradient-to-br from-primary-600 via-primary-500 to-primary-700 py-20 text-white">
        <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-6 px-4 text-center sm:px-6 lg:flex-row lg:px-8 lg:text-left">
            <div class="space-y-4">
                <h2 class="text-3xl font-bold leading-snug">{{ data_get($cta, 'title') }}</h2>
                <p class="text-sm leading-relaxed text-white/80">{{ data_get($cta, 'subtitle') }}</p>
            </div>
            <div class="flex flex-wrap items-center justify-center gap-4 lg:justify-end">
                <a href="{{ data_get($cta, 'primary.href') }}" class="inline-flex items-center rounded-full bg-white px-6 py-3 text-sm font-semibold text-primary-600 transition hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 focus:ring-offset-primary-600">
                    {{ data_get($cta, 'primary.label') }}
                    <i class="ph-duotone ph-arrow-square-out ml-2 text-lg"></i>
                </a>
                <a href="{{ data_get($cta, 'secondary.href') }}" class="inline-flex items-center rounded-full border border-white/60 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white focus:ring-offset-primary-600">
                    {{ data_get($cta, 'secondary.label') }}
                </a>
            </div>
        </div>
    </section>
</div>

