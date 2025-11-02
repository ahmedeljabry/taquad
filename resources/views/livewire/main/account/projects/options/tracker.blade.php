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

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                        <thead class="bg-gray-50 dark:bg-zinc-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">@lang('messages.t_time_range')</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">@lang('messages.t_minutes')</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">@lang('messages.t_activity')</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">@lang('messages.t_status')</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">@lang('messages.t_actions')</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                            @forelse ($entries as $entry)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-zinc-100">
                                        <div class="flex flex-col">
                                            <span>{{ $entry->started_at->timezone(config('app.timezone'))->format('Y-m-d H:i') }}</span>
                                            <span class="text-xs text-gray-400 dark:text-zinc-500">
                                                {{ $entry->ended_at->timezone(config('app.timezone'))->format('Y-m-d H:i') }}
                                            </span>
                                            @if ($entry->snapshots->isNotEmpty())
                                                @php
                                                    $snapshot = $entry->snapshots->first();
                                                @endphp
                                                <a href="{{ \Storage::disk($snapshot->disk)->url($snapshot->image_path) }}" target="_blank" class="mt-1 text-xs text-primary-600 hover:underline">
                                                    @lang('messages.t_view_screenshot')
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-zinc-100">
                                        {{ number_format($entry->duration_minutes) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold
                                            {{ $entry->activity_score >= 60 ? 'bg-emerald-100 text-emerald-700' :
                                                ($entry->activity_score >= 30 ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700') }}">
                                            {{ $entry->activity_score }}%
                                        </span>
                                        @if ($entry->low_activity)
                                            <span class="ml-2 text-xs text-rose-500">@lang('messages.t_low_activity_flag')</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @php
                                            $statusClasses = match($entry->client_status->value) {
                                                'approved' => 'bg-emerald-100 text-emerald-700',
                                                'rejected' => 'bg-rose-100 text-rose-700',
                                                default    => 'bg-amber-100 text-amber-700',
                                            };
                                        @endphp
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $statusClasses }}">
                                            @lang("messages.t_status_{$entry->client_status->value}")
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex flex-col sm:flex-row gap-2">
                                            @if ($entry->client_status === \App\Enums\TimeEntryClientStatus::Pending)
                                                <button wire:click="approveEntry({{ $entry->id }})" type="button" class="inline-flex items-center px-3 py-1.5 border border-emerald-500 text-emerald-600 text-xs font-semibold rounded hover:bg-emerald-50 dark:hover:bg-emerald-500/10">
                                                    <i class="ph-duotone ph-check-circle text-base ltr:mr-1 rtl:ml-1"></i>
                                                    @lang('messages.t_approve')
                                                </button>
                                                <button wire:click="startReject({{ $entry->id }})" type="button" class="inline-flex items-center px-3 py-1.5 border border-rose-500 text-rose-600 text-xs font-semibold rounded hover:bg-rose-50 dark:hover:bg-rose-500/10">
                                                    <i class="ph-duotone ph-x-circle text-base ltr:mr-1 rtl:ml-1"></i>
                                                    @lang('messages.t_reject')
                                                </button>
                                            @else
                                                <span class="text-xs text-gray-400 dark:text-zinc-500">
                                                    {{ $entry->client_reviewed_at?->timezone(config('app.timezone'))->format('Y-m-d H:i') }}
                                                </span>
                                            @endif
                                        </div>
                                        @if ($rejectEntryId === $entry->id)
                                            <div class="mt-3 space-y-2">
                                                <textarea wire:model.defer="rejectNotes" rows="3" class="w-full border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 text-sm rounded" placeholder="@lang('messages.t_add_rejection_note_placeholder')"></textarea>
                                                @error('rejectNotes')
                                                    <p class="text-xs text-rose-500">{{ $message }}</p>
                                                @enderror
                                                <div class="flex gap-2">
                                                    <button wire:click="rejectEntry" type="button" class="inline-flex items-center px-3 py-1.5 bg-rose-600 text-white text-xs font-semibold rounded hover:bg-rose-700">
                                                        @lang('messages.t_submit_decision')
                                                    </button>
                                                    <button wire:click="cancelReject" type="button" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-gray-600 text-xs font-semibold rounded hover:bg-gray-50">
                                                        @lang('messages.t_cancel')
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($entry->client_notes)
                                            <p class="mt-2 text-xs text-gray-500 dark:text-zinc-400">
                                                <span class="font-semibold">@lang('messages.t_client_note'):</span>
                                                {{ $entry->client_notes }}
                                            </p>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-zinc-400">
                                        @lang('messages.t_no_tracked_sessions_yet')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
