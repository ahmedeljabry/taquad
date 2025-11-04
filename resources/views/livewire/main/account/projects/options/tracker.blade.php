<div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 mt-[7rem] py-12 lg:pt-16 lg:pb-24">
    <x-forms.loading />

    <div class="lg:grid lg:grid-cols-12">
        <aside class="lg:col-span-3 py-6 hidden lg:block bg-white shadow-sm border border-gray-200 rounded-lg dark:bg-zinc-800 dark:border-transparent" wire:ignore>
            <x-main.account.sidebar />
        </aside>

        <div class="lg:col-span-9 lg:ltr:ml-8 lg:rtl:mr-8">
            <div class="w-full mb-16">
                <div class="mx-auto max-w-7xl">
                    <div class="lg:flex lg:items-center lg:justify-between">
                        <div class="min-w-0 flex-1">
                            <div class="mb-3 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6 rtl:space-x-reverse">
                                <ol class="inline-flex items-center mb-3 space-x-1 md:space-x-3 md:rtl:space-x-reverse sm:mb-0">
                                    <li>
                                        <div class="flex items-center">
                                            <a href="{{ url('/') }}" class="text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-zinc-300 dark:hover:text-white">
                                                @lang('messages.t_home')
                                            </a>
                                        </div>
                                    </li>
                                    <li aria-current="page">
                                        <div class="flex items-center">
                                            <svg aria-hidden="true" class="w-4 h-4 text-gray-400 rtl:rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                                            <span class="mx-1 text-sm font-medium text-gray-400 md:mx-2 dark:text-zinc-400">
                                                @lang('messages.t_tracker_activity_review')
                                            </span>
                                        </div>
                                    </li>
                                </ol>
                            </div>

                            <h2 class="text-lg font-bold leading-7 text-zinc-700 dark:text-gray-50 sm:truncate sm:text-xl sm:tracking-tight">
                                {{ $project->title }}
                            </h2>
                            <p class="leading-relaxed text-gray-400 mt-1 text-sm">
                                @lang('messages.t_tracker_activity_review_subtitle', ['project' => $project->title])
                            </p>
                        </div>
                        <div class="mt-5 flex flex-col sm:flex-row gap-3 lg:mt-0 lg:ltr:ml-4 lg:rtl:mr-4">
                            <a href="{{ url('project/' . $project->pid . '/' . $project->slug) }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-500 rounded-sm shadow-sm text-[13px] font-medium text-gray-700 dark:text-zinc-200 bg-white dark:bg-zinc-600 hover:bg-gray-50 dark:hover:bg-zinc-500 focus:outline-none focus:ring-primary-600">
                                <i class="ph-duotone ph-arrow-square-out text-lg ltr:mr-2 rtl:ml-2 text-gray-500 dark:text-zinc-200"></i>
                                {{ __('messages.t_view_project') }}
                            </a>
                            <button wire:click="refreshEntries" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-500 rounded-sm shadow-sm text-[13px] font-medium text-gray-700 dark:text-zinc-200 bg-white dark:bg-zinc-600 hover:bg-gray-50 dark:hover:bg-zinc-500 focus:outline-none focus:ring-primary-600">
                                <i class="ph-duotone ph-arrow-clockwise text-lg ltr:mr-2 rtl:ml-2 text-gray-500 dark:text-zinc-200"></i>
                                @lang('messages.t_refresh')
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-10 flex flex-wrap gap-3">
                <a href="{{ url('account/projects/options/milestones/' . $project->uid) }}"
                   class="inline-flex items-center px-3 py-2 rounded border text-xs font-semibold transition
                        {{ request()->is('account/projects/options/milestones*')
                            ? 'border-primary-500 bg-primary-50 text-primary-600 dark:border-primary-400 dark:bg-primary-500/20 dark:text-primary-200'
                            : 'border-gray-200 bg-white text-gray-600 hover:border-primary-200 hover:text-primary-600 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300' }}">
                    <i class="ph-duotone ph-flag text-base ltr:mr-1 rtl:ml-1"></i>
                    @lang('messages.t_milestone_payments')
                </a>
                <a href="{{ url('account/projects/options/tracker/' . $project->uid) }}"
                   class="inline-flex items-center px-3 py-2 rounded border text-xs font-semibold transition
                        {{ request()->is('account/projects/options/tracker*')
                            ? 'border-primary-500 bg-primary-50 text-primary-600 dark:border-primary-400 dark:bg-primary-500/20 dark:text-primary-200'
                            : 'border-gray-200 bg-white text-gray-600 hover:border-primary-200 hover:text-primary-600 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300' }}">
                    <i class="ph-duotone ph-monitor-play text-base ltr:mr-1 rtl:ml-1"></i>
                    @lang('messages.t_tracker_activity_review')
                </a>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-10">
                <div class="rounded-lg border border-gray-200 bg-white dark:bg-zinc-900 dark:border-zinc-700 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400">@lang('messages.t_total_minutes_tracked')</p>
                    <p class="mt-2 text-2xl font-semibold text-gray-800 dark:text-zinc-100">{{ number_format($summary['total_minutes'] ?? 0) }} @lang('messages.t_minutes')</p>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white dark:bg-zinc-900 dark:border-zinc-700 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400">@lang('messages.t_tracker_pending_segments')</p>
                    <p class="mt-2 text-2xl font-semibold text-amber-600">{{ number_format($summary['pending'] ?? 0) }}</p>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white dark:bg-zinc-900 dark:border-zinc-700 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400">@lang('messages.t_tracker_approved_segments')</p>
                    <p class="mt-2 text-2xl font-semibold text-emerald-600">{{ number_format($summary['approved'] ?? 0) }}</p>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white dark:bg-zinc-900 dark:border-zinc-700 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400">@lang('messages.t_tracker_rejected_segments')</p>
                    <p class="mt-2 text-2xl font-semibold text-rose-600">{{ number_format($summary['rejected'] ?? 0) }}</p>
                </div>
            </div>

            <section class="flex flex-wrap gap-3 mb-8">
                @foreach ([
                    'pending'  => __('messages.t_pending'),
                    'approved' => __('messages.t_approved'),
                    'rejected' => __('messages.t_rejected'),
                    'all'      => __('messages.t_all'),
                ] as $value => $label)
                    <button
                        type="button"
                        wire:click="$set('statusFilter', '{{ $value }}')"
                        class="inline-flex items-center px-3 py-2 border rounded text-xs font-semibold transition
                            {{ $statusFilter === $value
                                ? 'border-primary-500 bg-primary-50 text-primary-600 dark:border-primary-400 dark:bg-primary-500/20 dark:text-primary-200'
                                : 'border-gray-200 bg-white text-gray-600 hover:border-primary-200 hover:text-primary-600 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300' }}"
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </section>

            <section class="bg-white dark:bg-zinc-800 shadow-sm border border-gray-200 dark:border-zinc-700 rounded-lg overflow-hidden" wire:poll.60s="refreshEntries">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-zinc-700 flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 dark:text-zinc-100">
                            @lang('messages.t_tracked_sessions')
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-zinc-400">
                            @lang('messages.t_tracked_sessions_subtitle', [
                                'name' => optional($freelancer)->fullname
                                    ?? optional($freelancer)->username
                                    ?? optional($freelancer)->name
                            ])
                        </p>
                    </div>
                </div>

                <div class="px-4 pb-6 sm:px-6">
                    <div class="space-y-4">
                            @forelse ($entries->take(5) as $entry)
                            <article wire:key="tracked-entry-{{ $entry->id }}" class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                                <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                                    <div class="space-y-3">
                                        <div class="flex flex-wrap items-center gap-2 text-sm font-semibold text-gray-800 dark:text-zinc-100">
                                            <span>{{ $entry->started_at->timezone(config('app.timezone'))->format('Y-m-d H:i') }}</span>
                                            <span class="text-gray-400 dark:text-zinc-500">•</span>
                                            <span>{{ $entry->ended_at->timezone(config('app.timezone'))->format('Y-m-d H:i') }}</span>
                                        </div>
                                        <div class="flex flex-wrap items-center gap-3 text-xs text-gray-500 dark:text-zinc-400">
                                            <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-2 py-0.5 font-medium text-gray-700 dark:bg-zinc-800 dark:text-zinc-200">
                                                <i class="ph-duotone ph-hourglass text-sm"></i>
                                                {{ number_format($entry->duration_minutes) }} @lang('messages.t_minutes')
                                            </span>
                                            <span class="inline-flex items-center gap-1 rounded-full px-2 py-0.5 text-xs font-semibold
                                                {{ $entry->activity_score >= 60 ? 'bg-emerald-100 text-emerald-700' :
                                                    ($entry->activity_score >= 30 ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700') }}">
                                                <i class="ph-duotone ph-pulse text-sm"></i>
                                                {{ $entry->activity_score }}%
                                            </span>
                                            @if ($entry->low_activity)
                                                <span class="text-xs font-semibold text-rose-500">@lang('messages.t_low_activity_flag')</span>
                                            @endif
                                        </div>
                                        <div class="space-y-1">
                                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400">
                                                @lang('messages.t_tracker_entry_memo_label')
                                            </p>
                                            @php
                                                $memoPreview = \Illuminate\Support\Str::limit(strip_tags($entry->memo ?? ''), 160);
                                            @endphp
                                            @if ($memoPreview)
                                                <p class="text-sm text-gray-700 dark:text-zinc-100">{{ $memoPreview }}</p>
                                            @else
                                                <p class="text-sm text-gray-400 dark:text-zinc-500">@lang('messages.t_tracker_entry_no_memo')</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-start gap-2 md:items-end">
                                        @php
                                            $statusClasses = match($entry->client_status->value) {
                                                'approved' => 'bg-emerald-100 text-emerald-700',
                                                'rejected' => 'bg-rose-100 text-rose-700',
                                                default    => 'bg-amber-100 text-amber-700',
                                            };
                                        @endphp
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $statusClasses }}">
                                            @lang("messages.t_status_{$entry->client_status->value}")
                                        </span>
                                        @if ($entry->client_status !== \App\Enums\TimeEntryClientStatus::Pending)
                                            <span class="text-xs text-gray-400 dark:text-zinc-500">
                                                {{ $entry->client_reviewed_at?->timezone(config('app.timezone'))->format('Y-m-d H:i') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if ($entry->snapshots->isNotEmpty())
                                    <div class="mt-4">
                                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400">
                                            @lang('messages.t_tracker_entry_screenshots')
                                        </p>
                                        <div class="mt-2 flex flex-wrap gap-3">
                                            @foreach ($entry->snapshots as $snapshot)
                                                @php
                                                    $shotUrl = \Storage::disk($snapshot->disk)->url($snapshot->image_path);
                                                @endphp
                                                <a href="{{ $shotUrl }}" target="_blank" class="group relative block overflow-hidden rounded-xl border border-gray-200 bg-gray-50 shadow-sm transition hover:border-primary-300 dark:border-zinc-700 dark:bg-zinc-800">
                                                    <img src="{{ $shotUrl }}" alt="@lang('messages.t_view_screenshot')" class="h-28 w-36 object-cover transition duration-200 group-hover:scale-105">
                                                    <span class="absolute inset-0 flex items-center justify-center bg-black/20 text-xs font-semibold text-white opacity-0 transition group-hover:opacity-100">
                                                        @lang('messages.t_view_screenshot')
                                                    </span>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <p class="mt-4 text-xs text-gray-400 dark:text-zinc-500">
                                        @lang('messages.t_tracker_entry_no_screenshots')
                                    </p>
                                @endif

                                <div class="mt-5 space-y-4">
                                    <div class="flex flex-wrap gap-2">
                                        @if ($entry->client_status === \App\Enums\TimeEntryClientStatus::Pending)
                                            <button wire:click="approveEntry({{ $entry->id }})" type="button" class="inline-flex w-full items-center justify-center gap-2 rounded-lg border border-emerald-500 px-4 py-2 text-xs font-semibold text-emerald-600 transition hover:bg-emerald-50 dark:hover:bg-emerald-500/10 sm:w-auto">
                                                <i class="ph-duotone ph-check-circle text-base"></i>
                                                @lang('messages.t_approve')
                                            </button>
                                            <button wire:click="startReject({{ $entry->id }})" type="button" class="inline-flex w-full items-center justify-center gap-2 rounded-lg border border-rose-500 px-4 py-2 text-xs font-semibold text-rose-600 transition hover:bg-rose-50 dark:hover:bg-rose-500/10 sm:w-auto">
                                                <i class="ph-duotone ph-x-circle text-base"></i>
                                                @lang('messages.t_reject')
                                            </button>
                                        @endif
                                    </div>

                                    @if ($rejectEntryId === $entry->id)
                                        <div class="space-y-3 rounded-xl border border-rose-200 bg-rose-50/60 p-4 dark:border-rose-500/30 dark:bg-rose-500/5">
                                            <textarea wire:model.defer="rejectNotes" rows="3" class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-rose-500 focus:ring-rose-500 dark:border-zinc-700 dark:bg-zinc-900" placeholder="@lang('messages.t_add_rejection_note_placeholder')"></textarea>
                                            @error('rejectNotes')
                                                <p class="text-xs font-semibold text-rose-500">{{ $message }}</p>
                                            @enderror
                                            <div class="flex flex-wrap gap-2">
                                                <button wire:click="rejectEntry" type="button" class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-rose-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-rose-700 sm:w-auto">
                                                    <i class="ph-duotone ph-paper-plane-tilt text-sm"></i>
                                                    @lang('messages.t_submit_decision')
                                                </button>
                                                <button wire:click="cancelReject" type="button" class="inline-flex w-full items-center justify-center gap-2 rounded-lg border border-gray-300 px-4 py-2 text-xs font-semibold text-gray-600 transition hover:bg-gray-50 dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-700 sm:w-auto">
                                                    <i class="ph-duotone ph-arrow-counter-clockwise text-sm"></i>
                                                    @lang('messages.t_cancel')
                                                </button>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($entry->client_notes)
                                        <p class="text-xs text-gray-500 dark:text-zinc-400">
                                            <span class="font-semibold">@lang('messages.t_client_note'):</span>
                                            {{ $entry->client_notes }}
                                        </p>
                                    @endif
                                </div>
                            </article>
                        @empty
                            <div class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 px-6 py-12 text-center text-sm text-gray-500 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-400">
                                @lang('messages.t_no_tracked_sessions_yet')
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
