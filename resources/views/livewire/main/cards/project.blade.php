@php
    $summary = \Illuminate\Support\Str::limit(strip_tags(htmlspecialchars_decode($description)), 190);
    $isFixed = $budget_type === 'fixed';
@endphp

<article class="group relative overflow-hidden rounded-3xl border border-gray-200 bg-white/85 p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-white/10 dark:bg-white/5">
    <div aria-hidden class="absolute inset-0 bg-gradient-to-br from-primary-50 via-transparent to-transparent opacity-0 transition group-hover:opacity-100 dark:from-primary-500/10"></div>

    @if ($highlighted)
        <span class="absolute ltr:left-6 rtl:right-6 top-6 inline-flex items-center gap-1 rounded-full bg-primary-600/10 px-3 py-1 text-xs font-semibold text-primary-700 dark:text-primary-300">
            <i class="ph ph-sparkle text-sm"></i>
            مشروع مميز
        </span>
    @endif

    <div class="relative flex flex-col gap-6 lg:flex-row lg:items-start">
        <div class="flex-1 space-y-5">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div class="space-y-2">
                    <a href="{{ url('explore/projects', $category['slug']) }}" class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600 transition hover:bg-gray-200 dark:bg-white/10 dark:text-gray-300 dark:hover:bg-white/20">
                        <i class="ph ph-folders"></i>
                        {{ $category['title'] }}
                    </a>

                    <a href="{{ url('project/' . $pid . '/' . $slug) }}" class="block text-lg font-bold leading-snug text-gray-900 transition hover:text-primary-600 dark:text-white dark:hover:text-primary-300">
                        {{ $title }}
                    </a>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    @if ($urgent)
                        <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-600 animate-pulse dark:bg-red-500/10 dark:text-red-300">
                            <i class="ph ph-lightning"></i>
                            مشروع مستعجل
                        </span>
                    @endif

                    @if ($status === 'completed')
                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-600 dark:bg-green-500/10 dark:text-green-300">
                            <i class="ph ph-check-circle"></i>
                            {{ __('messages.t_project_completed') }}
                        </span>
                    @elseif ($status === 'active')
                        <span class="inline-flex items-center gap-1 rounded-full bg-primary-50 px-3 py-1 text-xs font-semibold text-primary-600 dark:bg-primary-500/10 dark:text-primary-300">
                            <i class="ph ph-clock"></i>
                            مشروع مفتوح للعروض
                        </span>
                    @endif

                    @if ($hasSubmittedBid)
                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-300">
                            <i class="ph ph-paper-plane-tilt"></i>
                            {{ __('messages.t_you_submitted_proposal') }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="flex flex-wrap gap-4 text-sm text-gray-500 dark:text-gray-300">
                <span class="inline-flex items-center gap-2">
                    <i class="ph ph-users-three text-base text-primary-500"></i>
                    {{ $total_bids }} {{ strtolower(__('messages.t_bids')) }}
                </span>
                <span class="inline-flex items-center gap-2">
                    <i class="ph ph-wallet text-base text-primary-500"></i>
                    {{ $isFixed ? __('messages.t_fixed_price') : __('messages.t_hourly_price') }}
                </span>
                <span class="inline-flex items-center gap-2">
                    <i class="ph ph-calendar-blank text-base text-primary-500"></i>
                    {{ $created_at }}
                </span>
            </div>

            <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                {{ $summary }}
            </p>

            @if ($skills->count())
                <div class="flex flex-wrap gap-2">
                    @foreach ($skills as $skill)
                        <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600 transition hover:bg-gray-200 dark:bg-white/10 dark:text-gray-200 dark:hover:bg-white/20">
                            <i class="ph ph-hash"></i>
                            {{ $skill->skill->name }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="flex w-full flex-col justify-between gap-4 rounded-3xl border border-gray-200 bg-white px-5 py-6 shadow-sm lg:w-64 dark:border-white/10 dark:bg-white/10">
            <div class="space-y-2 text-center">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-gray-400 dark:text-gray-300">الميزانية المقدّرة</p>
                <div class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ $budget_min }}
                    <span class="text-sm text-gray-400">–</span>
                    {{ $budget_max }}
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-300">
                    {{ $isFixed ? 'قيمة إجمالية للمشروع' : 'أجر بالساعة' }}
                </p>
            </div>

            <div class="flex flex-col gap-3">
                <a href="{{ url('project/' . $pid . '/' . $slug) }}" class="inline-flex items-center justify-center rounded-full bg-primary-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-primary-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary-500">
                    @if ($status === 'active')
                        {{ __('messages.t_bid_now') }}
                    @else
                        {{ __('messages.t_view_project') }}
                    @endif
                </a>
                <a href="{{ url('project/' . $pid . '/' . $slug) }}" class="inline-flex items-center justify-center gap-2 rounded-full border border-gray-200 px-5 py-2 text-xs font-semibold text-gray-600 transition hover:border-primary-400 hover:text-primary-600 dark:border-white/20 dark:text-gray-200 dark:hover:border-primary-400 dark:hover:text-primary-300">
                    <i class="ph ph-robot"></i>
                    اطلب ملخص المساعد الذكي
                </a>
            </div>
        </div>
    </div>
</article>
