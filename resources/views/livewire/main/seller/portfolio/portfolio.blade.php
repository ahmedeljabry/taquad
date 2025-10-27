<div class="w-full">

    <div class="max-w-7xl mx-auto space-y-12 px-4 sm:px-6 lg:px-8">




        {{-- Overview --}}
        <div class="flex flex-col gap-6 lg:flex-row lg:items-start">
            @if (!$projects->count() >= 2)
                <div class="rounded-3xl border border-transparent bg-gradient-to-br from-primary-600 via-primary-500 to-primary-700 px-8 py-10 text-white shadow-xl dark:from-primary-500 dark:via-primary-600 dark:to-primary-700">
                    <div class="flex flex-wrap items-start justify-between gap-6">
                        <div class="max-w-2xl">
                            <p class="text-xs font-semibold uppercase tracking-[0.35em] text-white/70">
                                @lang('messages.t_portfolio')
                            </p>
                            <h1 class="mt-4 text-3xl font-bold tracking-tight sm:text-4xl">
                                @lang('messages.t_portfolio_progress_title')
                            </h1>
                            <p class="mt-3 text-sm leading-relaxed text-white/80">
                                {{ __('messages.t_portfolio_progress_subtitle', ['count' => $metrics['required_min']]) }}
                            </p>
                        </div>

                        @if ($metrics['pending'] > 0)
                            <p class="mt-2 inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-[11px] font-semibold uppercase tracking-wide text-white/80">
                                <i class="ph-duotone ph-hourglass-medium text-base"></i>
                                {{ __('messages.t_portfolio_pending_badge', ['count' => number_format($metrics['pending'])]) }}
                            </p>
                        @endif

                        <a href="{{ url('seller/portfolio/create') }}"
                        class="inline-flex items-center justify-center rounded-full bg-white/15 px-5 py-2 text-sm font-semibold tracking-wide text-white transition hover:bg-white/25 focus:outline-none focus:ring-2 focus:ring-white/40">
                            <i class="ph-duotone ph-plus-circle mr-2 text-base"></i>
                            @lang('messages.t_add_new_work')
                        </a>
                    </div>

                    @php
                        $progressPercent = (int) round($metrics['progress'] * 100);
                    @endphp

                    <div class="mt-8 space-y-3">
                        <div class="flex items-center justify-between text-xs font-semibold uppercase tracking-wide text-white/70">
                            <span>{{ $progressPercent }}% @lang('messages.t_completed')</span>

                            @if ($metrics['requirement_met'])
                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-500/20 px-3 py-1 text-[11px] font-semibold uppercase tracking-wide text-emerald-100">
                                    <i class="ph-duotone ph-check-circle text-base"></i>
                                    @lang('messages.t_portfolio_progress_completed_badge')
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 rounded-full bg-amber-500/20 px-3 py-1 text-[11px] font-semibold uppercase tracking-wide text-amber-100">
                                    <i class="ph-duotone ph-rocket-launch text-base"></i>
                                    {{ __('messages.t_portfolio_progress_missing_badge', ['count' => $metrics['remaining_needed']]) }}
                                </span>
                            @endif
                        </div>

                        <div class="h-3 w-full overflow-hidden rounded-full bg-white/20">
                            <div class="h-full rounded-full bg-white transition-all duration-500 ease-out" style="width: {{ max($metrics['progress'] > 0 ? 6 : 0, $progressPercent) }}%"></div>
                        </div>
                    </div>
                </div>
            @endif
            {{-- Metrics --}}
            @php
                $metricCards = [
                    [
                        'label' => __('messages.t_portfolio_metric_total'),
                        'value' => number_format($metrics['total']),
                        'icon'  => 'ph-duotone ph-folders',
                        'bg'    => 'bg-slate-900 text-white',
                    ],
                    [
                        'label' => __('messages.t_portfolio_metric_active'),
                        'value' => number_format($metrics['active']),
                        'icon'  => 'ph-duotone ph-rocket-launch',
                        'bg'    => 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-400',
                    ],
                    [
                        'label' => __('messages.t_portfolio_metric_views'),
                        'value' => number_format($metrics['views']),
                        'icon'  => 'ph-duotone ph-eye',
                        'bg'    => 'bg-blue-500/15 text-blue-600 dark:text-blue-400',
                    ],
                    [
                        'label' => __('messages.t_portfolio_metric_likes'),
                        'value' => number_format($metrics['likes']),
                        'icon'  => 'ph-duotone ph-heart',
                        'bg'    => 'bg-rose-500/15 text-rose-600 dark:text-rose-400',
                    ],
                ];
            @endphp

            <div class="grid w-full gap-4 sm:grid-cols-2 lg:w-96">
                @foreach ($metricCards as $metric)
                    <div class="flex flex-col justify-between rounded-2xl border border-slate-200 bg-white px-6 py-5 shadow-sm transition hover:border-primary-200 hover:shadow-md dark:border-zinc-700 dark:bg-zinc-800">
                        <div class="flex items-center justify-between">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl {{ $metric['bg'] }} text-lg">
                                <i class="{{ $metric['icon'] }}"></i>
                            </div>
                            <span class="text-2xl font-bold text-slate-900 dark:text-white">{{ $metric['value'] }}</span>
                        </div>
                        <p class="mt-5 text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-zinc-400">
                            {{ $metric['label'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Collection --}}
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.4em] text-slate-400 dark:text-zinc-500">
                        @lang('messages.t_portfolio')
                    </p>
                    <h2 class="mt-2 text-lg font-semibold text-slate-800 dark:text-zinc-100">
                        @lang('messages.t_portfolio_showcase')
                    </h2>
                </div>
                <a href="{{ url('/') }}" class="hidden items-center text-sm font-semibold tracking-wide text-primary-600 hover:text-primary-700 dark:text-primary-300 lg:inline-flex">
                    <i class="ph-duotone ph-storefront mr-2 text-base"></i>
                    @lang('messages.t_switch_to_buying')
                </a>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">

                {{-- Add new --}}
                <a href="{{ url('seller/portfolio/create') }}" class="group relative flex h-[20rem] flex-col justify-between overflow-hidden rounded-3xl border border-dashed border-slate-300 bg-slate-50 p-8 text-slate-500 transition hover:border-primary-200 hover:bg-primary-50 dark:border-zinc-600 dark:bg-zinc-900">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white text-primary-600 shadow-sm transition group-hover:bg-primary-600 group-hover:text-white dark:bg-zinc-800 dark:text-primary-300">
                        <i class="ph-duotone ph-folder-plus text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-slate-700 transition group-hover:text-primary-700 dark:text-zinc-100 dark:group-hover:text-primary-200">
                            @lang('messages.t_add_portfolio_item')
                        </h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-500 dark:text-zinc-400">
                            @lang('messages.t_add_portfolio_item_hint')
                        </p>
                    </div>
                </a>

                @forelse ($projects as $project)
                    @php
                        $statusStyles = [
                            'active'   => ['bg' => 'bg-emerald-500/90', 'text' => 'text-white', 'icon' => 'ph-duotone ph-check-circle'],
                            'pending'  => ['bg' => 'bg-amber-500/95',   'text' => 'text-white', 'icon' => 'ph-duotone ph-hourglass'],
                            'rejected' => ['bg' => 'bg-rose-500/95',    'text' => 'text-white', 'icon' => 'ph-duotone ph-x-circle'],
                        ];
                        $style = $statusStyles[$project->status] ?? ['bg' => 'bg-slate-500/90', 'text' => 'text-white', 'icon' => 'ph-duotone ph-circle'];
                    @endphp

                    <article class="group relative flex h-[20rem] flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-zinc-700 dark:bg-zinc-900" wire:key="freelancer-portfolio-{{ $project->uid }}">
                        <div class="absolute inset-0">
                            <img src="{{ src($project->thumbnail) }}" alt="{{ $project->title }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-[1.04]" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/45 to-black/5 transition duration-500 group-hover:from-black/85 group-hover:via-black/55"></div>
                        </div>

                        <div class="relative z-10 flex flex-1 flex-col justify-between p-6">
                            <div class="flex items-start justify-between">
                                <p class="text-xs font-semibold uppercase tracking-wide text-white/80">
                                    {{ format_date($project->created_at) }}
                                </p>
                                <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-[11px] font-semibold uppercase tracking-wide {{ $style['bg'] }} {{ $style['text'] }}">
                                    <i class="{{ $style['icon'] }} text-sm"></i>
                                    @lang('messages.t_' . $project->status)
                                </span>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <a href="{{ url('profile/' . $project->user->username . '/portfolio/' . $project->slug) }}"
                                       target="_blank"
                                       class="block text-lg font-semibold text-white transition hover:text-primary-200">
                                        {{ $project->title }}
                                    </a>

                                    @if ($project->project_link)
                                        <a href="{{ $project->project_link }}" target="_blank" class="mt-2 inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wide text-white/70 hover:text-white transition">
                                            <i class="ph-duotone ph-link-simple text-sm"></i>
                                            @lang('messages.t_view_project')
                                        </a>
                                    @endif
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ url('profile/' . $project->user->username . '/portfolio/' . $project->slug) }}" target="_blank"
                                           class="inline-flex h-9 items-center gap-2 rounded-full bg-white/15 px-4 text-xs font-semibold uppercase tracking-wide text-white transition hover:bg-white/25">
                                            <i class="ph-duotone ph-eye text-sm"></i>
                                            @lang('messages.t_view')
                                        </a>
                                        <a href="{{ url('seller/portfolio/edit', $project->uid) }}"
                                           class="inline-flex h-9 items-center gap-2 rounded-full bg-white/15 px-4 text-xs font-semibold uppercase tracking-wide text-white transition hover:bg-white/25">
                                            <i class="ph-duotone ph-pencil text-sm"></i>
                                            @lang('messages.t_edit')
                                        </a>
                                    </div>

                                    <button type="button"
                                            wire:click="delete('{{ $project->uid }}')"
                                            wire:loading.attr="disabled"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-white/15 text-white transition hover:bg-rose-500/90">
                                        <span wire:loading wire:target="delete('{{ $project->uid }}')" class="animate-spin">
                                            <svg class="h-4 w-4" stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v2m0 12v2m8-8h-2M6 12H4m13.657-6.343l-1.414 1.414M7.757 16.243l-1.414 1.414m0-12.728l1.414 1.414m9.9 9.9l1.414 1.414"/>
                                            </svg>
                                        </span>
                                        <span wire:loading.remove wire:target="delete('{{ $project->uid }}')">
                                            <i class="ph-duotone ph-trash text-lg"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full flex flex-col items-center justify-center rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center dark:border-zinc-700 dark:bg-zinc-900">
                        <div class="flex h-16 w-16 items-center justify-center rounded-full bg-primary-500/10 text-primary-600 dark:text-primary-300">
                            <i class="ph-duotone ph-images text-3xl"></i>
                        </div>
                        <h3 class="mt-6 text-xl font-semibold text-slate-700 dark:text-zinc-100">
                            @lang('messages.t_portfolio_empty_title')
                        </h3>
                        <p class="mt-2 max-w-md text-sm leading-relaxed text-slate-500 dark:text-zinc-400">
                            @lang('messages.t_portfolio_empty_subtitle')
                        </p>
                        <a href="{{ url('seller/portfolio/create') }}"
                           class="mt-6 inline-flex items-center justify-center rounded-full bg-primary-600 px-6 py-2 text-sm font-semibold tracking-wide text-white shadow-sm transition hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-900">
                            <i class="ph-duotone ph-plus-circle mr-2 text-base"></i>
                            @lang('messages.t_add_new_work')
                        </a>
                    </div>
                @endforelse
            </div>

            @if ($projects->hasPages())
                <div class="flex justify-center pt-4">
                    {!! $projects->links('pagination::tailwind') !!}
                </div>
            @endif
        </div>
    </div>

</div>
