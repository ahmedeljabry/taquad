<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-[7rem] py-12 lg:pt-16 lg:pb-24">
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
                    <div class="rounded-2xl border border-gray-100 bg-gray-50 px-4 py-5 dark:border-zinc-700 dark:bg-zinc-800">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400">
                            @lang('messages.t_tracker_hourly_minutes_today')
                        </p>
                        <p class="mt-2 text-xl font-semibold text-gray-900 dark:text-zinc-100">
                            {{ $this->formatMinutes($metrics['today_minutes'] ?? 0) }}
                        </p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-gray-50 px-4 py-5 dark:border-zinc-700 dark:bg-zinc-800">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400">
                            @lang('messages.t_tracker_hourly_minutes_week')
                        </p>
                        <p class="mt-2 text-xl font-semibold text-gray-900 dark:text-zinc-100">
                            {{ $this->formatMinutes($metrics['week_minutes'] ?? 0) }}
                        </p>
                    </div>
                    <div class="rounded-2xl border border-gray-100 bg-gray-50 px-4 py-5 dark:border-zinc-700 dark:bg-zinc-800">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400">
                            @lang('messages.t_tracker_pending_segments')
                        </p>
                        <p class="mt-2 text-xl font-semibold text-gray-900 dark:text-zinc-100">
                            {{ $metrics['pending_count'] ?? 0 }}
                        </p>
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
                    </div>
                    <div class="space-y-3">
                        @forelse ($recentEntries as $entry)
                            <div class="rounded-2xl border border-gray-100 bg-white px-4 py-4 shadow-sm transition hover:border-primary-200 dark:border-zinc-700 dark:bg-zinc-800">
                                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-zinc-100">
                                            {{ optional($entry['started_at'])->timezone(config('app.timezone'))->translatedFormat('d M Y • h:i a') }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-zinc-400">
                                            {{ $this->formatMinutes($entry['duration']) }} — {{ __('messages.t_tracker_hourly_activity_score', ['score' => $entry['activity']]) }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $entry['low_activity'] ? 'bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-200' : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-200' }}">
                                            {{ $entry['low_activity'] ? __('messages.t_tracker_segment_low_activity') : __('messages.t_tracker_segment_good_activity') }}
                                        </span>
                                        <span class="rounded-full border border-gray-200 px-3 py-1 text-xs text-gray-600 dark:border-zinc-700 dark:text-zinc-300">
                                            @lang('messages.t_tracker_status_' . $entry['status'])
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-2xl border border-dashed border-gray-200 bg-white px-4 py-6 text-center text-sm text-gray-500 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-400">
                                @lang('messages.t_tracker_hourly_no_segments')
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
