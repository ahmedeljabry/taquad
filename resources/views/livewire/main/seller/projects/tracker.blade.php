<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-12 mb-16">
    <x-forms.loading />

    <div class="space-y-10">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
            <div class="space-y-4">
                <nav class="flex items-center gap-2 text-xs font-medium text-gray-500 dark:text-zinc-400">
                    <a href="{{ url('/') }}" class="hover:text-primary-600 dark:hover:text-primary-300">
                        @lang('messages.t_home')
                    </a>
                    <span class="text-gray-300 dark:text-zinc-600">/</span>
                    <a href="{{ url('seller/projects') }}" class="hover:text-primary-600 dark:hover:text-primary-300">
                        @lang('messages.t_projects')
                    </a>
                    <span class="text-gray-300 dark:text-zinc-600">/</span>
                    <span class="text-primary-600 dark:text-primary-300">
                        @lang('messages.t_tracker_hourly_hub_title')
                    </span>
                </nav>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-zinc-50 sm:text-3xl">
                        {{ $project->title }}
                    </h1>
                    <p class="mt-2 text-sm text-gray-500 dark:text-zinc-400">
                        @lang('messages.t_tracker_hourly_hub_description', ['project' => $project->title])
                    </p>
                </div>
                <div class="inline-flex items-center gap-2 rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-primary-600 dark:bg-primary-500/20 dark:text-primary-200">
                    <i class="ph-duotone ph-timer text-base"></i>
                    @lang('messages.t_hourly_projects_notice')
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <a
                    href="{{ url('tracker/oauth') }}"
                    class="inline-flex items-center justify-center rounded-md border border-primary-500 bg-primary-600 px-5 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
                    <i class="ph-duotone ph-link-simple-bold ltr:mr-2 rtl:ml-2 text-base"></i>
                    @lang('messages.t_tracker_hourly_open_browser')
                </a>
                <button
                    wire:click="refreshStats"
                    type="button"
                    class="inline-flex items-center justify-center rounded-md border border-gray-300 px-5 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-700 dark:focus:ring-offset-zinc-900">
                    <i class="ph-duotone ph-arrow-clockwise ltr:mr-2 rtl:ml-2 text-base"></i>
                    @lang('messages.t_refresh')
                </button>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <section class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900 lg:col-span-2">
                <header class="flex items-center justify-between gap-4 border-b border-gray-200 pb-5 dark:border-zinc-700">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-zinc-100">
                            @lang('messages.t_tracker_hourly_contract_details')
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-zinc-400">
                            @lang('messages.t_tracker_hourly_contract_details_hint')
                        </p>
                    </div>
                </header>

                <dl class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl border border-gray-100 bg-gray-50 px-4 py-5 dark:border-zinc-700 dark:bg-zinc-800/60">
                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400">
                            @lang('messages.t_hourly_rate')
                        </dt>
                        <dd class="mt-2 text-xl font-semibold text-gray-900 dark:text-zinc-100">
                            {{ money($contract->hourly_rate, $contract->currency_code, true) }}
                        </dd>
                    </div>

                    <div class="rounded-2xl border border-gray-100 bg-gray-50 px-4 py-5 dark:border-zinc-700 dark:bg-zinc-800/60">
                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400">
                            @lang('messages.t_hourly_weekly_limit')
                        </dt>
                        <dd class="mt-2 text-xl font-semibold text-gray-900 dark:text-zinc-100">
                            {{ $contract->weekly_limit_hours !== null ? number_format((float) $contract->weekly_limit_hours, 1) . ' ' . __('messages.t_hours_per_week_suffix') : __('messages.t_not_set') }}
                        </dd>
                    </div>

                    <div class="rounded-2xl border border-gray-100 bg-gray-50 px-4 py-5 dark:border-zinc-700 dark:bg-zinc-800/60">
                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400">
                            @lang('messages.t_tracker_hourly_manual_time')
                        </dt>
                        <dd class="mt-2 text-base font-semibold">
                            <span class="{{ $contract->allow_manual_time ? 'text-emerald-600 dark:text-emerald-300' : 'text-gray-500 dark:text-zinc-400' }}">
                                {{ $contract->allow_manual_time ? __('messages.t_enabled') : __('messages.t_disabled') }}
                            </span>
                        </dd>
                    </div>

                    <div class="rounded-2xl border border-gray-100 bg-gray-50 px-4 py-5 dark:border-zinc-700 dark:bg-zinc-800/60">
                        <dt class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400">
                            @lang('messages.t_tracker_hourly_auto_low_activity')
                        </dt>
                        <dd class="mt-2 text-base font-semibold">
                            <span class="{{ $contract->auto_approve_low_activity ? 'text-emerald-600 dark:text-emerald-300' : 'text-gray-500 dark:text-zinc-400' }}">
                                {{ $contract->auto_approve_low_activity ? __('messages.t_enabled') : __('messages.t_disabled') }}
                            </span>
                        </dd>
                    </div>
                </dl>
            </section>

            <section class="rounded-3xl border border-indigo-200 bg-indigo-600/10 p-6 backdrop-blur dark:border-primary-500/40 dark:bg-primary-500/10">
                <h3 class="text-lg font-semibold text-primary-700 dark:text-primary-200">
                    @lang('messages.t_tracker_hourly_actions_heading')
                </h3>
                <p class="mt-2 text-sm text-primary-700/80 dark:text-primary-100/70 leading-relaxed">
                    @lang('messages.t_tracker_hourly_actions_body')
                </p>

        <ul class="mt-4 space-y-3 text-sm text-primary-800 dark:text-primary-100">
                    <li class="flex items-start gap-2">
                        <i class="ph-duotone ph-number-circle-one text-lg"></i>
                        <span>@lang('messages.t_tracker_hourly_action_download')</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="ph-duotone ph-number-circle-two text-lg"></i>
                        <span>@lang('messages.t_tracker_hourly_action_login')</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="ph-duotone ph-number-circle-three text-lg"></i>
                        <span>@lang('messages.t_tracker_hourly_action_start')</span>
                    </li>
                </ul>

                <p class="mt-6 rounded-2xl border border-primary-500/30 bg-white/40 px-4 py-3 text-xs text-primary-800 shadow-sm backdrop-blur-sm dark:border-primary-500/40 dark:bg-primary-500/10 dark:text-primary-100">
                    <i class="ph-duotone ph-info ltr:mr-2 rtl:ml-2"></i>
                    @lang('messages.t_tracker_hourly_sync_hint')
                </p>
            </section>
        </div>

        <section class="grid gap-6 lg:grid-cols-3">
            <div class="space-y-4 rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900 lg:col-span-2">
                <header class="flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900 dark:text-zinc-100">
                            @lang('messages.t_tracker_hourly_metrics_heading')
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-zinc-400">
                            @lang('messages.t_tracker_hourly_metrics_subtitle')
                        </p>
                    </div>
                </header>

                <div class="grid gap-4 md:grid-cols-3">
                    <div class="rounded-2xl border border-gray-200 bg-gradient-to-br from-blue-50 to-blue-100 px-5 py-6 shadow-sm dark:from-blue-500/10 dark:to-blue-500/5 dark:border-zinc-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-blue-600 dark:text-blue-400">
                                    @lang('messages.t_tracker_hourly_minutes_today')
                                </p>
                                <p class="mt-2 text-2xl font-bold text-blue-900 dark:text-blue-100">
                                    {{ $this->formatMinutes($metrics['today_minutes'] ?? 0) }}
                                </p>
                                @php
                                    $todayHours = ($metrics['today_minutes'] ?? 0) / 60;
                                    $todayEarnings = $todayHours * ($contract->hourly_rate ?? 0);
                                @endphp
                                @if($todayEarnings > 0)
                                    <p class="mt-1 text-xs font-medium text-blue-700 dark:text-blue-300">
                                        {{ money($todayEarnings, $contract->currency_code, true) }}
                                    </p>
                                @endif
                            </div>
                            <div class="rounded-xl bg-blue-200/50 p-3 dark:bg-blue-500/20">
                                <i class="ph-duotone ph-calendar text-2xl text-blue-600 dark:text-blue-300"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="rounded-2xl border border-gray-200 bg-gradient-to-br from-emerald-50 to-emerald-100 px-5 py-6 shadow-sm dark:from-emerald-500/10 dark:to-emerald-500/5 dark:border-zinc-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-emerald-600 dark:text-emerald-400">
                                    @lang('messages.t_tracker_hourly_minutes_week')
                                </p>
                                <p class="mt-2 text-2xl font-bold text-emerald-900 dark:text-emerald-100">
                                    {{ $this->formatMinutes($metrics['week_minutes'] ?? 0) }}
                                </p>
                                @php
                                    $weekHours = ($metrics['week_minutes'] ?? 0) / 60;
                                    $weekEarnings = $weekHours * ($contract->hourly_rate ?? 0);
                                    $weeklyLimit = $contract->weekly_limit_hours ?? null;
                                    $weekProgress = $weeklyLimit ? min(100, round(($weekHours / $weeklyLimit) * 100)) : null;
                                @endphp
                                @if($weekEarnings > 0)
                                    <p class="mt-1 text-xs font-medium text-emerald-700 dark:text-emerald-300">
                                        {{ money($weekEarnings, $contract->currency_code, true) }}
                                    </p>
                                @endif
                                @if($weekProgress !== null && $weeklyLimit)
                                    <div class="mt-2">
                                        <div class="h-1.5 w-full overflow-hidden rounded-full bg-emerald-200 dark:bg-emerald-900">
                                            <div 
                                                class="h-full rounded-full transition-all {{ $weekProgress >= 80 ? 'bg-amber-500' : ($weekProgress >= 100 ? 'bg-red-500' : 'bg-emerald-500') }}"
                                                style="width: {{ min(100, $weekProgress) }}%"
                                            ></div>
                                        </div>
                                        <p class="mt-1 text-[10px] text-emerald-600 dark:text-emerald-400">
                                            {{ $weekProgress }}% @lang('messages.t_tracker_of_weekly_limit', ['limit' => number_format($weeklyLimit, 1)])
                                        </p>
                                    </div>
                                @endif
                            </div>
                            <div class="rounded-xl bg-emerald-200/50 p-3 dark:bg-emerald-500/20">
                                <i class="ph-duotone ph-calendar-check text-2xl text-emerald-600 dark:text-emerald-300"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="rounded-2xl border border-gray-200 bg-gradient-to-br from-amber-50 to-amber-100 px-5 py-6 shadow-sm dark:from-amber-500/10 dark:to-amber-500/5 dark:border-zinc-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-amber-600 dark:text-amber-400">
                                    @lang('messages.t_tracker_pending_segments')
                                </p>
                                <p class="mt-2 text-2xl font-bold text-amber-900 dark:text-amber-100">
                                    {{ $metrics['pending_count'] ?? 0 }}
                                </p>
                                <p class="mt-1 text-xs text-amber-700 dark:text-amber-300">
                                    @lang('messages.t_tracker_awaiting_review')
                                </p>
                            </div>
                            <div class="rounded-xl bg-amber-200/50 p-3 dark:bg-amber-500/20">
                                <i class="ph-duotone ph-clock-countdown text-2xl text-amber-600 dark:text-amber-300"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-gray-50 px-4 py-5 dark:border-zinc-700 dark:bg-zinc-800">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400">
                        @lang('messages.t_tracker_hourly_last_synced')
                    </p>
                    <p class="mt-2 text-sm text-gray-700 dark:text-zinc-200">
                        @if(!empty($metrics['last_synced']))
                            {{ $metrics['last_synced']->diffForHumans() }}
                        @else
                            @lang('messages.t_tracker_hourly_last_synced_never')
                        @endif
                    </p>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <h4 class="text-base font-semibold text-gray-900 dark:text-zinc-100">
                            @lang('messages.t_tracker_hourly_recent_activity')
                        </h4>
                        <span class="text-xs text-gray-500 dark:text-zinc-400">
                            {{ count($recentEntries) }} @lang('messages.t_tracker_segments')
                        </span>
                    </div>
                    <div class="space-y-4">
                        @forelse ($recentEntries as $entry)
                            <div class="group rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition-all hover:border-primary-300 hover:shadow-md dark:border-zinc-700 dark:bg-zinc-800">
                                <!-- Header -->
                                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                                    <div class="flex-1 space-y-2">
                                        <div class="flex items-center gap-3">
                                            <div class="flex items-center gap-2">
                                                <i class="ph-duotone ph-clock text-lg text-gray-400 dark:text-zinc-500"></i>
                                                <p class="text-sm font-semibold text-gray-900 dark:text-zinc-100">
                                                    {{ optional($entry['started_at'])->timezone(config('app.timezone'))->translatedFormat('d M Y • h:i a') }}
                                                </p>
                                            </div>
                                            @if($entry['is_manual'] ?? false)
                                                <span class="rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-700 dark:bg-blue-500/20 dark:text-blue-200">
                                                    @lang('messages.t_tracker_manual_entry')
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="flex flex-wrap items-center gap-3 text-xs text-gray-600 dark:text-zinc-400">
                                            <span class="flex items-center gap-1.5">
                                                <i class="ph-duotone ph-timer text-sm"></i>
                                                {{ $this->formatMinutes($entry['duration']) }}
                                            </span>
                                            <span class="flex items-center gap-1.5">
                                                <i class="ph-duotone ph-gauge text-sm"></i>
                                                {{ __('messages.t_tracker_hourly_activity_score', ['score' => $entry['activity']]) }}
                                            </span>
                                            @if(isset($entry['ended_at']) && $entry['ended_at'])
                                                <span class="flex items-center gap-1.5">
                                                    <i class="ph-duotone ph-stop-circle text-sm"></i>
                                                    {{ optional($entry['ended_at'])->timezone(config('app.timezone'))->translatedFormat('h:i a') }}
                                                </span>
                                            @endif
                                        </div>

                                        @if(!empty($entry['memo']))
                                            <div class="mt-2 rounded-lg border border-gray-100 bg-gray-50 px-3 py-2 dark:border-zinc-700 dark:bg-zinc-900">
                                                <p class="text-xs font-semibold text-gray-600 dark:text-zinc-400 mb-1">
                                                    @lang('messages.t_tracker_memo')
                                                </p>
                                                <p class="text-sm text-gray-900 dark:text-zinc-100">
                                                    {{ $entry['memo'] }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex flex-col items-end gap-2">
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold {{ $entry['low_activity'] ? 'bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-200' : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-200' }}">
                                                <i class="ph-duotone {{ $entry['low_activity'] ? 'ph-warning-circle' : 'ph-check-circle' }} text-sm"></i>
                                                {{ $entry['low_activity'] ? __('messages.t_tracker_segment_low_activity') : __('messages.t_tracker_segment_good_activity') }}
                                            </span>
                                            <span class="inline-flex items-center gap-1.5 rounded-full border border-gray-200 px-3 py-1 text-xs font-medium text-gray-700 dark:border-zinc-700 dark:text-zinc-300">
                                                @lang('messages.t_tracker_status_' . $entry['status'])
                                            </span>
                                        </div>
                                        
                                        <!-- Activity Score Bar -->
                                        <div class="w-32">
                                            <div class="h-2 w-full overflow-hidden rounded-full bg-gray-200 dark:bg-zinc-700">
                                                <div 
                                                    class="h-full rounded-full transition-all {{ $entry['low_activity'] ? 'bg-amber-500' : 'bg-emerald-500' }}"
                                                    style="width: {{ min(100, $entry['activity']) }}%"
                                                ></div>
                                            </div>
                                            <p class="mt-1 text-xs text-gray-500 dark:text-zinc-400 text-right">
                                                {{ $entry['activity'] }}% @lang('messages.t_tracker_activity')
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Screenshots -->
                                @if(!empty($entry['snapshots']) && count($entry['snapshots']) > 0)
                                    <div class="mt-4 border-t border-gray-100 pt-4 dark:border-zinc-700">
                                        <div class="flex items-center justify-between mb-3">
                                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400">
                                                <i class="ph-duotone ph-camera ltr:mr-1.5 rtl:ml-1"></i>
                                                @lang('messages.t_tracker_entry_screenshots') ({{ count($entry['snapshots']) }})
                                            </p>
                                        </div>
                                        <div class="flex flex-wrap gap-3">
                                            @foreach ($entry['snapshots'] as $snapshot)
                                                <a 
                                                    href="{{ $snapshot['url'] }}" 
                                                    target="_blank" 
                                                    class="group/shot relative block overflow-hidden rounded-xl border-2 border-gray-200 bg-gray-100 shadow-sm transition-all hover:border-primary-400 hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900"
                                                >
                                                    <img 
                                                        src="{{ $snapshot['url'] }}" 
                                                        alt="@lang('messages.t_view_screenshot')" 
                                                        class="h-32 w-48 object-cover transition-transform duration-300 group-hover/shot:scale-105"
                                                        loading="lazy"
                                                    >
                                                    <div class="absolute inset-0 flex items-center justify-center bg-black/40 text-xs font-semibold text-white opacity-0 transition-opacity group-hover/shot:opacity-100">
                                                        <span class="flex items-center gap-1.5">
                                                            <i class="ph-duotone ph-magnifying-glass-plus text-base"></i>
                                                            @lang('messages.t_view_screenshot')
                                                        </span>
                                                    </div>
                                                    <div class="absolute bottom-1 right-1 rounded bg-black/60 px-1.5 py-0.5 text-[10px] text-white">
                                                        {{ optional($snapshot['captured_at'])->timezone(config('app.timezone'))->format('H:i') }}
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @elseif($entry['has_screenshot'] ?? false)
                                    <div class="mt-4 border-t border-gray-100 pt-4 dark:border-zinc-700">
                                        <p class="text-xs text-gray-500 dark:text-zinc-400">
                                            <i class="ph-duotone ph-image-slash ltr:mr-1 rtl:ml-1"></i>
                                            @lang('messages.t_tracker_screenshot_processing')
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 px-6 py-12 text-center dark:border-zinc-700 dark:bg-zinc-800">
                                <i class="ph-duotone ph-clock text-4xl text-gray-400 dark:text-zinc-600 mb-3"></i>
                                <p class="text-sm font-medium text-gray-600 dark:text-zinc-400">
                                    @lang('messages.t_tracker_hourly_no_segments')
                                </p>
                                <p class="mt-1 text-xs text-gray-500 dark:text-zinc-500">
                                    @lang('messages.t_tracker_hourly_no_segments_hint')
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                <h3 class="text-base font-semibold text-gray-900 dark:text-zinc-100">
                    @lang('messages.t_tracker_hourly_support_heading')
                </h3>
                <p class="mt-2 text-sm text-gray-500 dark:text-zinc-400 leading-relaxed">
                    @lang('messages.t_tracker_hourly_support_body')
                </p>
                <ul class="mt-4 space-y-2 text-sm text-gray-600 dark:text-zinc-300">
                    <li class="flex items-start gap-2">
                        <i class="ph-duotone ph-dot text-lg"></i>
                        <span>@lang('messages.t_tracker_hourly_support_tip_one')</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="ph-duotone ph-dot text-lg"></i>
                        <span>@lang('messages.t_tracker_hourly_support_tip_two')</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="ph-duotone ph-dot text-lg"></i>
                        <span>@lang('messages.t_tracker_hourly_support_tip_three')</span>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</div>
