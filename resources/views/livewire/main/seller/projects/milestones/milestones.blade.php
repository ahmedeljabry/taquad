<div class="w-full" x-data="window.FhAsclZJpDsCcbd">

    {{-- Loading --}}
    <x-forms.loading />
    
    {{-- Heading --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-12 mb-16">
        <div class="mx-auto max-w-7xl">
            <div class="lg:flex lg:items-center lg:justify-between">
    
                <div class="min-w-0 flex-1">
    
                    {{-- Section heading --}}
                    <h2 class="text-lg font-bold leading-7 text-zinc-700 dark:text-gray-50 sm:truncate sm:text-xl sm:tracking-tight">
                        @lang('messages.t_milestone_payments')
                    </h2>
    
                    {{-- Breadcrumbs --}}
                    <div class="mt-3 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6 rtl:space-x-reverse">
                        <ol class="inline-flex items-center mb-3 space-x-1 md:space-x-3 md:rtl:space-x-reverse sm:mb-0">

                            {{-- Main home --}}
                            <li>
                                <div class="flex items-center">
                                    <a href="{{ url('/') }}" class="text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-zinc-300 dark:hover:text-white">
                                        @lang('messages.t_home')
                                    </a>
                                </div>
                            </li>
            
                            {{-- My dashboard --}}
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg aria-hidden="true" class="w-4 h-4 text-gray-400 rtl:rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                    <a href="{{ url('seller/home') }}" class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-700 hover:text-primary-600 md:ltr:ml-2 md:rtl:mr-2 dark:text-zinc-300 dark:hover:text-white">
                                        @lang('messages.t_my_dashboard')
                                    </a>
                                </div>
                            </li>
            
                            {{-- Awarded projects --}}
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg aria-hidden="true" class="w-4 h-4 text-gray-400 rtl:rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                    <span class="mx-1 text-sm font-medium text-gray-400 md:mx-2 dark:text-zinc-400">
                                        @lang('messages.t_awarded_projects')
                                    </span>
                                </div>
                            </li>
            
                        </ol>
                    </div>
                    
                </div>
    
                {{-- Actions --}}
                <div class="mt-5 flex lg:mt-0 lg:ltr::ml-4 lg:rtl:mr-4">

                    {{-- View project --}}
                    <span class="block">
                        <a href="{{ url('project/' . $project->pid . '/' . $project->slug) }}" target="_blank" class="inline-flex items-center rounded-sm border border-gray-300 bg-white px-4 py-2 text-[13px] font-semibold text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:bg-zinc-800 dark:border-zinc-800 dark:text-zinc-100 dark:hover:bg-zinc-900 dark:focus:ring-offset-zinc-900 dark:focus:ring-zinc-900">
                            @lang('messages.t_view_project')
                        </a>
                    </span>

                    {{-- Request milestone --}}
                    @if (in_array($project->status, ['active', 'under_development']))
                        <span class="block sm:ltr:ml-3 sm:rtl:mr-3">
                            <button type="button" id="modal-request-milestone-button" class="inline-flex items-center rounded-sm border border-transparent bg-primary-600 px-4 py-2 text-[13px] font-semibold text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                                @lang('messages.t_request_milestone')
                            </button>
                        </span>
                    @endif

                    @if ($canRateClient)
                        <span class="block sm:ltr:ml-3 sm:rtl:mr-3">
                            <button type="button"
                                wire:click="openRatingModal"
                                class="inline-flex items-center rounded-sm border border-transparent bg-emerald-600 px-4 py-2 text-[13px] font-semibold text-white shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                                <i class="ph-duotone ph-star text-base ltr:mr-2 rtl:ml-2"></i>
                                @lang('messages.t_rate_client')
                            </button>
                        </span>
                    @elseif ($freelancerReview)
                        <span class="block sm:ltr:ml-3 sm:rtl:mr-3">
                            <span class="inline-flex items-center gap-1 rounded-full border border-slate-200 bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-200">
                                <i class="ph-duotone {{ $freelancerReview->is_skipped ? 'ph-arrow-bend-up-left' : 'ph-check-circle' }} text-sm"></i>
                                {{ $freelancerReview->is_skipped ? __('messages.t_rating_skipped_badge') : __('messages.t_rating_submitted_badge') }}
                            </span>
                        </span>
                    @endif
        
                </div>
    
            </div>
        </div>
    </div>

    {{-- Project details --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-12 mb-6">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-y-6 gap-x-5 h-full">

            {{-- Status --}}
            <div>
                <div class="flex flex-col h-full justify-center text-center space-y-3 bg-white dark:bg-zinc-800 dark:border-transparent py-4 px-2 border rounded-md">
                    <svg class="mx-auto h-6 w-6 mb-1 text-slate-500 dark:text-zinc-200" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <span class="font-light text-gray-500 text-xs uppercase dark:text-zinc-300 tracking-wider whitespace-nowrap">@lang('messages.t_status')</span>
                    <div class="text-sm font-semibold tracking-wide dark:text-white text-zinc-700">
                        @switch($project->status)

                            {{-- Active --}}
                            @case('active')
                                <span class="text-emerald-600">
                                    @lang('messages.t_active')
                                </span>
                                @break

                            {{-- Completed --}}
                            @case('completed')
                                <span class="text-green-600">
                                    @lang('messages.t_completed')
                                </span>
                                @break

                            {{-- Under development --}}
                            @case('under_development')
                                <span class="text-blue-600">
                                    @lang('messages.t_under_development')
                                </span>
                                @break

                            {{-- Pending final review --}}
                            @case('pending_final_review')
                                <span class="text-amber-600">
                                    @lang('messages.t_pending_final_review')
                                </span>
                                @break

                            {{-- Incomplete --}}
                            @case('incomplete')
                                <span class="text-red-600">
                                    @lang('messages.t_incomplete')
                                </span>
                                @break

                            {{-- Closed --}}
                            @case('closed')
                                <span class="text-slate-600 dark:text-slate-200">
                                    @lang('messages.t_closed')
                                </span>
                                @break

                            @default
                                
                        @endswitch
                    </div>
                </div>
            </div>

            {{-- Delivery date --}}
            <div>
                <div class="flex flex-col h-full justify-center text-center space-y-3 bg-white dark:bg-zinc-800 dark:border-transparent py-4 px-2 border rounded-md">
                    <svg class="mx-auto h-6 w-6 mb-1 text-slate-500 dark:text-zinc-200" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg>
                    <span class="font-light text-gray-500 text-xs uppercase dark:text-zinc-300 tracking-wider whitespace-nowrap">@lang('messages.t_delivery_time')</span>
                    <span class="text-sm font-bold dark:text-white text-slate-600">
                        @if ($expected_delivery_date)
                            {{ format_date($expected_delivery_date, config('carbon-formats.F_j_Y')) }}
                        @else
                            @lang('messages.t_n_a')
                        @endif    
                    </span>
                </div>
            </div>

            {{-- Amount In progress --}}
            <div>
                <div class="flex flex-col h-full justify-center text-center space-y-3 bg-white dark:bg-zinc-800 dark:border-transparent py-4 px-2 border rounded-md">
                    <svg class="mx-auto h-6 w-6 mb-1 text-slate-500 dark:text-zinc-200" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path></svg>
                    <span class="font-light text-gray-500 text-xs uppercase dark:text-zinc-300 tracking-wider whitespace-nowrap">@lang('messages.t_in_progress')</span>
                    <span class="text-sm font-bold dark:text-white text-zinc-700">{{ money($payments_in_progress, settings('currency')->code, true) }}</span>
                </div>
            </div>

            {{-- Paid amount --}}
            <div>
                <div class="flex flex-col h-full justify-center text-center space-y-3 bg-white dark:bg-zinc-800 dark:border-transparent py-4 px-2 border rounded-md">
                    <svg class="mx-auto h-6 w-6 mb-1 text-slate-500 dark:text-zinc-200" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="font-light text-gray-500 text-xs uppercase dark:text-zinc-300 tracking-wider whitespace-nowrap">@lang('messages.t_paid_amount')</span>
                    <span class="text-sm font-bold dark:text-white text-zinc-700">{{ money($paid_amount, settings('currency')->code, true) }}</span>
                </div>
            </div>

            {{-- Project budget --}}
            <div>
                <div class="flex flex-col h-full justify-center text-center space-y-3 bg-white dark:bg-zinc-800 dark:border-transparent py-4 px-2 border rounded-md">
                    <svg class="mx-auto h-6 w-6 mb-1 text-slate-500 dark:text-zinc-200" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v2a2 2 0 100 4v2a2 2 0 01-2 2H4a2 2 0 01-2-2v-2a2 2 0 100-4V6z"></path></svg>
                    <span class="font-light text-gray-500 text-xs uppercase dark:text-zinc-300 tracking-wider whitespace-nowrap">@lang('messages.t_project_budget')</span>
                    <span class="text-sm font-bold dark:text-white text-zinc-700">{{ money($project->awarded_bid->amount, settings('currency')->code, true) }}</span>
                </div>
            </div>

        </div>
    </div>

    @if ($pendingDecision)
        @php
            $decisionActionLabel = $pendingDecision->type === 'deliver'
                ? __('messages.t_project_request_type_deliver')
                : __('messages.t_project_request_type_cancel');
            $isOwnRequest = $pendingDecision->requested_by_role === 'freelancer';
        @endphp
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-12">
            <div class="mt-10 rounded-2xl border border-amber-200 bg-amber-50/70 p-6 shadow-sm dark:border-amber-400/40 dark:bg-amber-500/10">
                <div class="flex items-start gap-3">
                    <span class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-amber-500 text-white">
                        <i class="ph ph-hourglass-medium text-lg"></i>
                    </span>
                    <div class="space-y-3">
                        <h3 class="text-sm font-semibold text-amber-900 dark:text-amber-100">
                            {{ $isOwnRequest ? __('messages.t_request_waiting_client') : __('messages.t_project_pending_request_heading') }}
                        </h3>
                        <p class="text-sm leading-6 text-amber-900/80 dark:text-amber-100/80">
                            {{ $isOwnRequest
                                ? __('messages.t_request_waiting_client_body', ['action' => $decisionActionLabel])
                                : __('messages.t_project_pending_request_body', ['username' => optional($pendingDecision->requester)->username ?? __('messages.t_employer'), 'action' => $decisionActionLabel])
                            }}
                        </p>
                        @if ($pendingDecision->message)
                            <div class="rounded-xl bg-white/70 p-4 text-sm text-amber-900/90 shadow-sm dark:bg-amber-500/20 dark:text-amber-100">
                                {!! nl2br(e($pendingDecision->message)) !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (in_array($project->status, ['active', 'under_development', 'pending_final_review']) && ! $pendingDecision)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-12">
            <div class="mt-10 rounded-2xl border border-slate-200 bg-white/95 p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                            @lang('messages.t_request_actions_heading')
                        </h3>
                        <p class="mt-1 text-sm text-slate-500 dark:text-zinc-400">
                            @lang('messages.t_request_actions_subheading')
                        </p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <button wire:click="requestDelivery" type="button" class="inline-flex items-center rounded-lg bg-primary-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-zinc-900">
                            <i class="ph ph-rocket-launch text-base ltr:mr-2 rtl:ml-2"></i>
                            @lang('messages.t_project_request_type_deliver')
                        </button>
                        <button wire:click="requestCancellation" type="button" class="inline-flex items-center rounded-lg border border-rose-500 px-4 py-2 text-sm font-semibold text-rose-600 shadow-sm hover:bg-rose-50 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 focus:ring-offset-white dark:border-rose-400 dark:text-rose-200 dark:hover:bg-rose-500/10 dark:focus:ring-offset-zinc-900">
                            <i class="ph ph-warning text-base ltr:mr-2 rtl:ml-2"></i>
                            @lang('messages.t_project_request_type_cancel')
                        </button>
                    </div>
                </div>
                <div class="mt-4 grid gap-2">
                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500 dark:text-zinc-400">
                        @lang('messages.t_optional_note_label')
                    </label>
                    <textarea wire:model.defer="requestNote" rows="2" class="w-full resize-none rounded-lg border border-slate-200 bg-white p-3 text-sm text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/30 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-200" placeholder="@lang('messages.t_optional_note_placeholder')"></textarea>
                </div>
            </div>
        </div>
    @endif

    {{-- Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-12">
        {{-- Timeline --}}
        <div class="mt-8 space-y-10">
            @forelse ($timeline as $entry)
                @php
                    $milestone       = $entry['milestone'];
                    $meta            = $entry['meta'];
                    $excerpt         = \Illuminate\Support\Str::limit(strip_tags($milestone->description ?? ''), 200);
                @endphp

                <div class="relative ltr:pl-14 rtl:pr-14" wire:key="seller-timeline-root-{{ $milestone->uid }}">
                    @if (! $loop->last)
                        <span class="absolute top-12 bottom-0 ltr:left-6 rtl:right-6 w-px bg-slate-200 dark:bg-zinc-700"></span>
                    @endif

                    <span class="absolute top-1.5 flex h-11 w-11 items-center justify-center rounded-full text-white {{ $meta['badge_color'] }} ring-4 {{ $meta['ring_color'] }} shadow-sm dark:ring-1 dark:ring-zinc-700/70 ltr:left-4 rtl:right-4">
                        <i class="{{ $meta['icon'] }} text-lg"></i>
                    </span>

                    <div class="rounded-2xl border border-slate-200/80 bg-white px-6 py-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-800">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-[11px] font-semibold uppercase tracking-wide text-white {{ $meta['badge_color'] }}">
                                    {{ $meta['status_label'] }}
                                </span>

                                @if ($milestone->is_follow_up)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-primary-500/10 px-3 py-1 text-[11px] font-semibold uppercase tracking-wide text-primary-600 dark:text-primary-200">
                                        <i class="ph-duotone ph-repeat text-sm"></i>
                                        @lang('messages.t_follow_up_badge')
                                    </span>
                                @endif
                            </div>

                            <span class="text-xs font-medium uppercase tracking-wider text-slate-400 dark:text-zinc-500">
                                {{ format_date($milestone->created_at) }}
                            </span>
                        </div>

                        <p class="mt-4 text-sm leading-relaxed text-slate-600 dark:text-zinc-200">
                            {{ $excerpt ?: __('messages.t_no_data_to_show_now') }}
                            @if (strlen($milestone->description ?? '') > 200)
                                <button
                                    type="button"
                                    class="ml-2 text-xs font-semibold uppercase tracking-wide text-primary-600 hover:text-primary-500 dark:text-primary-200"
                                    x-on:click="description('{{ str_replace(["'", "\n", "\r", "\r\n"], " ", $milestone->description) }}')">
                                    @lang('messages.t_read_more')
                                </button>
                            @endif
                        </p>

                        <div class="mt-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-4 text-sm">
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400 dark:text-zinc-500">@lang('messages.t_amount')</p>
                                <p class="mt-1 font-semibold text-slate-800 dark:text-zinc-100">{{ money(convertToNumber($milestone->amount), settings('currency')->code, true) }}</p>
                            </div>
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400 dark:text-zinc-500">@lang('messages.t_milestone_freelancer_fee_name')</p>
                                <p class="mt-1 font-semibold text-slate-800 dark:text-zinc-100">{{ money(convertToNumber($milestone->freelancer_commission), settings('currency')->code, true) }}</p>
                            </div>
                            <div>
                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400 dark:text-zinc-500">@lang('messages.t_paid_to_you')</p>
                                <p class="mt-1 font-semibold text-slate-800 dark:text-zinc-100">{{ money(convertToNumber($milestone->amount) - convertToNumber($milestone->freelancer_commission), settings('currency')->code, true) }}</p>
                            </div>
                            <div class="lg:text-right rtl:lg:text-left">
                                <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400 dark:text-zinc-500">@lang('messages.t_id')</p>
                                <p class="mt-1 font-semibold text-slate-800 dark:text-zinc-100">{{ $milestone->uid }}</p>
                            </div>
                        </div>

                        @if ($entry['children']->isNotEmpty())
                            <div class="mt-7 space-y-6 border-l border-dashed border-slate-200/80 ltr:pl-8 rtl:pr-8 dark:border-zinc-600/70">
                                @foreach ($entry['children'] as $childEntry)
                                    @php
                                        $child        = $childEntry['milestone'];
                                        $childMeta    = $childEntry['meta'];
                                        $childExcerpt = \Illuminate\Support\Str::limit(strip_tags($child->description ?? ''), 180);
                                    @endphp

                                    <div class="relative ltr:pl-10 rtl:pr-10" wire:key="seller-timeline-child-{{ $child->uid }}">
                                        <span class="absolute top-1 flex h-8 w-8 items-center justify-center rounded-full text-white {{ $childMeta['badge_color'] }} ring-4 {{ $childMeta['ring_color'] }} shadow-sm dark:ring-1 dark:ring-zinc-700/70 ltr:-left-4 rtl:-right-4">
                                            <i class="{{ $childMeta['icon'] }} text-base"></i>
                                        </span>

                                        <div class="rounded-xl border border-slate-200/80 bg-slate-50 px-5 py-5 shadow-sm dark:border-zinc-700 dark:bg-zinc-900/60">
                                            <div class="flex flex-wrap items-center justify-between gap-3">
                                                <div class="flex items-center gap-2">
                                                    <span class="inline-flex items-center rounded-full px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-white {{ $childMeta['badge_color'] }}">
                                                        {{ $childMeta['status_label'] }}
                                                    </span>
                                                    <span class="inline-flex items-center gap-1 rounded-full bg-primary-500/10 px-2.5 py-1 text-[10px] font-semibold uppercase tracking-wide text-primary-600 dark:text-primary-200">
                                                        <i class="ph-duotone ph-repeat text-xs"></i>
                                                        @lang('messages.t_follow_up_badge')
                                                    </span>
                                                </div>

                                                <span class="text-[11px] font-medium uppercase tracking-wider text-slate-400 dark:text-zinc-500">
                                                    {{ format_date($child->created_at) }}
                                                </span>
                                            </div>

                                            <p class="mt-3 text-sm leading-relaxed text-slate-600 dark:text-zinc-200">
                                                {{ $childExcerpt ?: __('messages.t_no_data_to_show_now') }}
                                                @if (strlen($child->description ?? '') > 180)
                                                    <button
                                                        type="button"
                                                        class="ml-2 text-xs font-semibold uppercase tracking-wide text-primary-600 hover:text-primary-500 dark:text-primary-200"
                                                        x-on:click="description('{{ str_replace(["'", "\n", "\r", "\r\n"], " ", $child->description) }}')">
                                                        @lang('messages.t_read_more')
                                                    </button>
                                                @endif
                                            </p>

                                            <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-4 text-sm">
                                                <div>
                                                    <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400 dark:text-zinc-500">@lang('messages.t_amount')</p>
                                                    <p class="mt-1 font-semibold text-slate-800 dark:text-zinc-100">{{ money(convertToNumber($child->amount), settings('currency')->code, true) }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400 dark:text-zinc-500">@lang('messages.t_milestone_freelancer_fee_name')</p>
                                                    <p class="mt-1 font-semibold text-slate-800 dark:text-zinc-100">{{ money(convertToNumber($child->freelancer_commission), settings('currency')->code, true) }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400 dark:text-zinc-500">@lang('messages.t_paid_to_you')</p>
                                                    <p class="mt-1 font-semibold text-slate-800 dark:text-zinc-100">{{ money(convertToNumber($child->amount) - convertToNumber($child->freelancer_commission), settings('currency')->code, true) }}</p>
                                                </div>
                                                <div class="lg:text-right rtl:lg:text-left">
                                                    <p class="text-[11px] font-semibold uppercase tracking-wide text-slate-400 dark:text-zinc-500">@lang('messages.t_id')</p>
                                                    <p class="mt-1 font-semibold text-slate-800 dark:text-zinc-100">{{ $child->uid }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="rounded-2xl border border-dashed border-slate-200/80 bg-white px-6 py-16 text-center text-sm font-medium text-slate-400 shadow-sm dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                    @lang('messages.t_no_milestone_payments_created_yet')
                </div>
            @endforelse
        </div>

        <div class="hidden mt-8 overflow-x-auto overflow-y-hidden sm:mt-0 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 dark:scrollbar-thumb-zinc-800 dark:scrollbar-track-zinc-600">
            <table class="w-full text-left border-spacing-y-[10px] border-separate -mt-2">
                <thead class="">
                    <tr class="bg-slate-200 dark:bg-zinc-600">

                        {{-- Date --}}
                        <th class="font-bold tracking-wider text-gray-600 px-5 py-4.5 border-b-0 whitespace-nowrap text-xs uppercase dark:text-zinc-300 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md rtl:text-right">@lang('messages.t_date')</th>

                        {{-- Description --}}
                        <th class="font-bold tracking-wider text-gray-600 px-5 py-4.5 border-b-0 whitespace-nowrap text-xs uppercase dark:text-zinc-300 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md rtl:text-right">@lang('messages.t_description')</th>

                        {{-- Status --}}
                        <th class="font-bold tracking-wider text-gray-600 px-5 py-4.5 text-center border-b-0 whitespace-nowrap text-xs uppercase dark:text-zinc-300 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md">@lang('messages.t_status')</th>

                        {{-- Amount --}}
                        <th class="font-bold tracking-wider text-gray-600 px-5 py-4.5 text-center border-b-0 whitespace-nowrap text-xs uppercase dark:text-zinc-300 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md">@lang('messages.t_amount')</th>
                        
                        {{-- Paid to you --}}
                        <th class="font-bold tracking-wider text-gray-600 px-5 py-4.5 text-center border-b-0 whitespace-nowrap text-xs uppercase dark:text-zinc-300 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md">@lang('messages.t_paid_to_you')</th>
                        
                    </tr>
                </thead>
                <thead>
                    @forelse ($payments as $p)
                        <tr class="intro-x shadow-sm bg-white dark:bg-zinc-800 rounded-md h-16" wire:key="freelancer-dashboard-project-milestones-{{ $p->uid }}">

                            {{-- Date --}}
                            <td class="px-5 py-3 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md rtl:text-right">
                                <div class="text-gray-700 dark:text-gray-100 text-sm font-medium">
                                    {{ format_date($p->created_at) }}    
                                </div>
                            </td>

                            {{-- Description --}}
                            <td class="px-5 py-3 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md w-48 flex items-center rtl:text-right">
                                <div class="text-gray-700 dark:text-gray-100 text-sm font-medium truncate overflow-auto w-48 flex-none">
                                    {{ $p->description }} 
                                </div>
                                @if (strlen($p->description) > 30)
                                    <span x-on:click="description('{{ str_replace(["'", "\n", "\r", "\r\n"], " ", $p->description) }}')" class="cursor-pointer font-medium hover:text-slate-500 text-[11px] text-slate-400 tracking-wider whitespace-nowrap mt-0.5">@lang('messages.t_read_more')</span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td class="px-5 py-3 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md text-center">
                                @switch($p->status)

                                    {{-- Requested --}}
                                    @case('request')
                                        <span class="whitespace-nowrap inline-flex items-center px-2.5 py-1 rounded-sm text-xs font-medium bg-yellow-50 text-yellow-800 dark:bg-transparent dark:text-amber-400">
                                            {{ __('messages.t_requested') }}
                                        </span>
                                        @break
                                    
                                    {{-- Paid --}}
                                    @case('paid')
                                        <span class="whitespace-nowrap inline-flex items-center px-2.5 py-1 rounded-sm text-xs font-medium bg-green-50 text-green-800 dark:bg-transparent dark:text-green-400">
                                            {{ __('messages.t_paid') }}
                                        </span>
                                        @break

                                    {{-- Funded --}}
                                    @case('funded')
                                        <span class="whitespace-nowrap inline-flex items-center px-2.5 py-1 rounded-sm text-xs font-medium bg-purple-50 text-purple-800 dark:bg-transparent dark:text-purple-400">
                                            {{ __('messages.t_funded') }}
                                        </span>
                                        @break

                                    @default
                                        
                                @endswitch
                            </td>

                            {{-- Amount --}}
                            <td class="px-5 py-3 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md text-center">
                                <div class="text-gray-700 dark:text-gray-100 text-sm font-medium">
                                    {{ money(convertToNumber($p->amount), settings('currency')->code, true) }}
                                </div>
                            </td>

                            {{-- Paid to you --}}
                            <td class="px-5 py-3 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md text-center">
                                <div class="text-gray-700 dark:text-gray-100 text-sm font-medium">
                                    {{ money(convertToNumber($p->amount) - convertToNumber($p->freelancer_commission), settings('currency')->code, true) }}
                                </div>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="py-4.5 font-light text-sm text-gray-400 dark:text-zinc-200 text-center tracking-wide shadow-sm bg-white dark:bg-zinc-800 rounded-md">
                                @lang('messages.t_no_milestone_payments_created_yet')
                            </td>
                        </tr>
                    @endforelse
                </thead>
                @if ($payments->count())
                    <tfoot>
                        <tr class="bg-slate-200 dark:bg-zinc-600 intro-x rounded-md h-16">
                            <th colspan="3" class="text-center py-3 px-5 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md"></th>
                            <td class="text-center py-3 px-5 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md text-sm font-bold text-slate-600 dark:text-zinc-300">
                                {{ money( convertToNumber($paid_amount) + convertToNumber($payments_in_progress), settings('currency')->code, true ) }}
                            </td>
                            <td class="text-center py-3 px-5 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md text-sm font-bold text-slate-600 dark:text-zinc-300">
                                {{ money( (convertToNumber($paid_amount) + convertToNumber($payments_in_progress)) - ((convertToNumber(settings('projects')->commission_from_freelancer) / 100) * (convertToNumber($paid_amount) + convertToNumber($payments_in_progress))), settings('currency')->code, true ) }}
                            </td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>

    {{-- Pages --}}
    @if ($payments->hasPages())
        <div class="flex justify-center pt-12">
            {!! $payments->links('pagination::tailwind') !!}
        </div>
    @endif

    {{-- Request milestone modal --}}
    @if (in_array($project->status, ['active', 'under_development']))
        <x-forms.modal id="modal-request-milestone-container" target="modal-request-milestone-button" uid="modal_{{ uid() }}" placement="center-center" size="max-w-lg">
                
            {{-- Header --}}
            <x-slot name="title">{{ __('messages.t_request_milestone') }}</x-slot>
        
            {{-- Content --}}
            <x-slot name="content">
                <div class="grid grid-cols-12 gap-y-6 gap-x-4 py-2">

                    {{-- Amount --}}
                    <div class="col-span-12">
                        <x-forms.text-input
                            :label="__('messages.t_amount')"
                            placeholder="0.00"
                            model="amount"
                            svg_icon='<svg class="w-5 h-5" stroke="currentColor" fill="currentColor" stroke-width="0" version="1" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xmlns="http://www.w3.org/2000/svg"><path fill="#78909C" d="M40,41H8c-2.2,0-4-1.8-4-4l0-20.9c0-1.3,0.6-2.5,1.7-3.3L24,0l18.3,12.8c1.1,0.7,1.7,2,1.7,3.3V37 C44,39.2,42.2,41,40,41z"></path><rect x="14" y="1" fill="#AED581" width="20" height="31"></rect><g fill="#558B2F"><path d="M13,0v33h22V0H13z M33,31H15V2h18V31z"></path><path d="M34,3c0,1.7-0.3,3-2,3c-1.7,0-3-1.3-3-3s1.3-2,3-2C33.7,1,34,1.3,34,3z"></path><path d="M16,1c1.7,0,3,0.3,3,2s-1.3,3-3,3s-2-1.3-2-3S14.3,1,16,1z"></path><circle cx="24" cy="8" r="2"></circle><circle cx="24" cy="20" r="6"></circle></g><path fill="#CFD8DC" d="M40,41H8c-2.2,0-4-1.8-4-4l0-20l20,13l20-13v20C44,39.2,42.2,41,40,41z"></path></svg>' />
                    </div>

                    {{-- Description --}}
                    <div class="col-span-12">
                        <x-forms.textarea
                            :label="__('messages.t_description')"
                            :placeholder="__('messages.t_enter_milestone_payment_description')"
                            model="description"
                            :rows="6"
                            svg_icon='<svg class="w-5 h-5" stroke="currentColor" fill="currentColor" stroke-width="0" version="1" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xmlns="http://www.w3.org/2000/svg"><rect x="7" y="4" fill="#BBDEFB" width="34" height="40"></rect><g fill="#2196F3"><rect x="13" y="26" width="4" height="4"></rect><rect x="13" y="18" width="4" height="4"></rect><rect x="13" y="34" width="4" height="4"></rect><rect x="13" y="10" width="4" height="4"></rect><rect x="21" y="26" width="14" height="4"></rect><rect x="21" y="18" width="14" height="4"></rect><rect x="21" y="34" width="14" height="4"></rect><rect x="21" y="10" width="14" height="4"></rect></g></svg>' />
                    </div>
        
                </div>
            </x-slot>
        
            {{-- Footer --}}
            <x-slot name="footer">
                <x-forms.button action="confirmRequest" text="{{ __('messages.t_continue') }}" :block="0"  />
            </x-slot>
        
        </x-forms.modal>

        <x-forms.modal id="modal-project-feedback" target="modal-project-feedback-trigger" uid="modal_project_feedback" placement="center-center" size="max-w-xl">

            <x-slot name="title">
                <div class="space-y-1">
                    <h2 class="text-base font-bold tracking-wide text-slate-800 dark:text-zinc-100">
                        @lang('messages.t_rate_client_title', ['name' => $project->client?->fullname ?: $project->client?->username])
                    </h2>
                    <p class="text-sm text-slate-500 dark:text-zinc-300">@lang('messages.t_rate_client_subtitle')</p>
                </div>
            </x-slot>

            <x-slot name="content">
                <div class="space-y-6">
                    <div>
                        <p class="text-sm font-semibold text-slate-600 dark:text-zinc-200 mb-3">@lang('messages.t_select_rating_label')</p>
                        <div class="flex items-center justify-center gap-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <label class="cursor-pointer">
                                    <input type="radio" class="sr-only" name="sellerRatingScore" value="{{ $i }}" wire:model="ratingScore">
                                    <i class="ph-duotone ph-star text-3xl transition-colors duration-150 {{ $ratingScore >= $i ? 'text-emerald-400' : 'text-slate-300 dark:text-zinc-600' }}"></i>
                                </label>
                            @endfor
                        </div>
                        @error('ratingScore')
                            <p class="mt-3 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="seller-project-review-comment" class="block text-sm font-semibold text-slate-600 dark:text-zinc-200 mb-2">
                            @lang('messages.t_optional_feedback_label')
                        </label>
                        <textarea id="seller-project-review-comment" rows="4" wire:model.defer="ratingComment" class="block w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 shadow-sm transition focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-40 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100" placeholder="{{ __('messages.t_optional_feedback_placeholder') }}"></textarea>
                        <p class="mt-2 text-xs text-slate-400 dark:text-zinc-400">@lang('messages.t_optional_feedback_hint')</p>
                        @error('ratingComment')
                            <p class="mt-2 text-sm font-medium text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-3 sm:space-x-reverse w-full">
                    <button type="button"
                        wire:click="skipRating"
                        wire:loading.attr="disabled"
                        wire:target="skipRating,submitRating"
                        class="inline-flex justify-center items-center rounded border font-semibold focus:outline-none px-3 py-2 leading-5 text-xs tracking-wide border-slate-200 bg-white text-slate-600 shadow-sm hover:text-slate-800 hover:bg-slate-100 hover:border-slate-300 focus:ring focus:ring-slate-300 focus:ring-opacity-25 dark:border-zinc-600 dark:bg-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-600">
                        @lang('messages.t_skip_for_now')
                    </button>

                    <button type="button"
                        wire:click="submitRating"
                        wire:loading.attr="disabled"
                        wire:target="submitRating"
                        class="inline-flex justify-center items-center rounded border font-semibold focus:outline-none px-4 py-2 leading-5 text-xs tracking-wide border-transparent bg-emerald-600 text-white shadow-sm hover:bg-emerald-700 focus:ring focus:ring-emerald-500 focus:ring-opacity-25 disabled:opacity-60 disabled:cursor-not-allowed">
                        <div wire:loading wire:target="submitRating">
                            <svg role="status" class="inline w-4 h-4 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#059669"/>
                            </svg>
                        </div>
                        <span wire:loading.remove wire:target="submitRating">
                            @lang('messages.t_submit_ur_review')
                        </span>
                    </button>
                </div>
            </x-slot>

        </x-forms.modal>

        <x-forms.modal id="modal-confirm-request" target="modal-confirm-request-trigger" uid="modal_confirm_request_{{ uid() }}" placement="center-center" size="max-w-lg">

            <x-slot name="title">{{ __('messages.t_confirm_milestone_payment') }}</x-slot>

            <x-slot name="content">
                <div class='leading-relaxed'>
                    {{ __('messages.t_pls_review_ur_milestone_payment_details') }}
                </div>

                <div class='rounded border dark:border-secondary-600 my-8'>
                    <dl class='divide-y divide-gray-200 dark:divide-gray-600'>
                        <div class='grid grid-cols-3 gap-4 py-3 px-4'>
                            <dt class='text-sm font-medium whitespace-nowrap text-gray-500 dark:text-secondary-500 ltr:text-left rtl:text-right'>{{ __('messages.t_requested_amount') }}</dt>
                            <dd class='text-sm font-semibold text-zinc-900 dark:text-secondary-400 col-span-2 mt-0 ltr:text-right rtl:text-left'>
                                {{ money(data_get($confirmSummary, 'requested_amount', 0), settings('currency')->code, true) }}
                            </dd>
                        </div>
                        <div class='grid grid-cols-3 gap-4 py-3 px-4'>
                            <dt class='text-sm font-medium whitespace-nowrap text-gray-500 dark:text-secondary-500 ltr:text-left rtl:text-right'>{{ __('messages.t_milestone_freelancer_fee_name') }}</dt>
                            <dd class='text-sm font-semibold text-red-600 dark:text-secondary-400 col-span-2 mt-0 ltr:text-right rtl:text-left'>
                                - {{ money(data_get($confirmSummary, 'freelancer_commission', 0), settings('currency')->code, true) }}
                            </dd>
                        </div>
                        <div class='grid grid-cols-3 gap-4 py-3 px-4 bg-gray-100/60 dark:bg-secondary-700 rounded-b'>
                            <dt class='text-sm font-medium whitespace-nowrap text-gray-500 dark:text-secondary-400 ltr:text-left rtl:text-right'>{{ __('messages.t_u_will_get') }}</dt>
                            <dd class='text-sm font-semibold text-zinc-900 dark:text-secondary-400 col-span-2 mt-0 ltr:text-right rtl:text-left'>
                                {{ money(data_get($confirmSummary, 'requested_amount', 0) - data_get($confirmSummary, 'freelancer_commission', 0), settings('currency')->code, true) }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-3 sm:space-x-reverse w-full">
                    <button
                        type="button"
                        wire:click="cancelConfirmation"
                        wire:loading.attr="disabled"
                        wire:target="request"
                        class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:text-zinc-200 dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:ring-offset-zinc-800">
                        {{ __('messages.t_cancel') }}
                    </button>

                    <x-forms.button action="request" text="{{ __('messages.t_confirm') }}" :block="0" />
                </div>
            </x-slot>

        </x-forms.modal>
    @endif

    <x-forms.modal id="modal-read-description" target="modal-read-description-trigger" uid="modal_read_description" placement="center-center" size="max-w-2xl">

        <x-slot name="title">{{ __('messages.t_read_more') }}</x-slot>

        <x-slot name="content">
            <div id="modal-read-description-text" class="text-sm leading-relaxed text-slate-600 dark:text-zinc-200 whitespace-pre-wrap"></div>
        </x-slot>

        <x-slot name="footer">
            <button type="button" x-on:click="close" class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:text-zinc-200 dark:bg-zinc-700 dark:border-zinc-600 dark:hover:bg-zinc-600 dark:focus:ring-offset-zinc-800">
                {{ __('messages.t_close') }}
            </button>
        </x-slot>

    </x-forms.modal>

</div>

@push('scripts')
    <script>
        function FhAsclZJpDsCcbd() {
            return {

                // Read description
                description(text) {
                    const container = document.getElementById('modal-read-description-text');

                    if (container) {
                        container.textContent = text;
                    }

                    if (window.modal_read_description && window.modal_read_description.modal) {
                        window.modal_read_description.modal.show();
                    } else {
                        alert(text);
                    }
                }

            }
        }
        window.FhAsclZJpDsCcbd = FhAsclZJpDsCcbd();
    </script>
@endpush
