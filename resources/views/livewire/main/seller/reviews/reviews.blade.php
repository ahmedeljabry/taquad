<div class="w-full">
    <x-forms.loading />

    <div class="max-w-7xl mx-auto space-y-12 px-4 sm:px-6 lg:px-8">

        <div class="rounded-3xl border border-slate-200 bg-white px-8 py-10 shadow-sm dark:border-zinc-700 dark:bg-zinc-800">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
                <div class="max-w-xl space-y-4">
                    <p class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400 dark:text-zinc-500">
                        @lang('messages.t_reviews')
                    </p>
                    <h1 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-zinc-100 sm:text-4xl">
                        @lang('messages.t_reviews_received_title')
                    </h1>
                    <p class="text-sm leading-relaxed text-slate-600 dark:text-zinc-400">
                        @lang('messages.t_reviews_received_subtitle')
                    </p>
                </div>

                <div class="grid w-full gap-6 sm:grid-cols-2 lg:w-auto">
                    <div class="rounded-2xl bg-primary-600 px-6 py-5 text-white shadow-md">
                        <div class="text-xs font-semibold uppercase tracking-[0.25em] text-white/70">
                            @lang('messages.t_average_rating')
                        </div>
                        <div class="mt-4 flex items-end gap-3">
                            <span class="text-4xl font-bold">{{ number_format($stats['avg'], 1) }}</span>
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-0.5">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="ph-duotone ph-star {{ $i <= round($stats['avg']) ? 'text-yellow-300' : 'text-white/40' }} text-lg"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="mt-2 text-xs font-medium text-white/80">
                            {{ trans_choice('messages.t_based_on_number_reviews', $stats['count'], ['number' => number_format($stats['count'])]) }}
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white px-6 py-5 shadow-sm dark:border-zinc-600 dark:bg-zinc-900">
                        <div class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-400 dark:text-zinc-500">
                            @lang('messages.t_rating_breakdown')
                        </div>
                        <div class="mt-4 space-y-2.5">
                            @foreach ($stats['breakdown'] as $score => $data)
                                <div class="flex items-center gap-3">
                                    <span class="flex items-center gap-1 text-xs font-semibold text-slate-500 dark:text-zinc-400">
                                        {{ $score }}
                                        <i class="ph-duotone ph-star text-[11px] text-yellow-400"></i>
                                    </span>
                                    <div class="h-2 flex-1 overflow-hidden rounded-full bg-slate-100 dark:bg-zinc-700">
                                        <span class="block h-full rounded-full bg-primary-500 transition-all" style="width: {{ $data['percent'] }}%"></span>
                                    </div>
                                    <span class="text-xs font-semibold text-slate-500 dark:text-zinc-400 w-10 text-right">
                                        {{ $data['count'] }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-3">
            @forelse ($reviews as $review)
                <article class="flex h-full flex-col justify-between rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-zinc-700 dark:bg-zinc-900" wire:key="seller-review-{{ $review->id }}">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="ph-duotone ph-star text-sm {{ $i <= (int) $review->score ? 'text-yellow-400' : 'text-slate-200 dark:text-zinc-600' }}"></i>
                                @endfor
                            </div>
                            <span class="text-xs font-semibold uppercase tracking-wide text-slate-400 dark:text-zinc-500">
                                {{ optional($review->submitted_at)->format('M d, Y') ?? $review->created_at->format('M d, Y') }}
                            </span>
                        </div>

                        @php
                            $portfolio = $review->project;
                            $portfolioOwner = optional($portfolio)->user;
                        @endphp
                        @if ($portfolio && $portfolioOwner && isset($portfolioOwner->username))
                            <div class="rounded-xl bg-slate-50 px-4 py-3 text-xs font-semibold text-slate-500 dark:bg-zinc-800 dark:text-zinc-300">
                                <span class="uppercase tracking-wide">@lang('messages.t_project')</span>
                                <a href="{{ url('profile/' . $portfolioOwner->username . '/portfolio/' . $portfolio->slug) }}" target="_blank" class="mt-1 block text-sm font-semibold text-slate-700 hover:text-primary-600 dark:text-zinc-100">
                                    {{ $portfolio->title }}
                                </a>
                            </div>
                        @elseif ($portfolio)
                            <div class="rounded-xl bg-slate-50 px-4 py-3 text-xs font-semibold text-slate-500 dark:bg-zinc-800 dark:text-zinc-300">
                                <span class="uppercase tracking-wide">@lang('messages.t_project')</span>
                                <p class="mt-1 block text-sm font-semibold text-slate-700 dark:text-zinc-100">
                                    {{ $portfolio->title }}
                                </p>
                            </div>
                        @endif

                        @if ($review->comment)
                            <p class="text-sm leading-relaxed text-slate-600 dark:text-zinc-300">
                                “{{ $review->comment }}”
                            </p>
                        @else
                            <p class="text-sm italic text-slate-400 dark:text-zinc-500">
                                @lang('messages.t_review_without_comment')
                            </p>
                        @endif
                    </div>

                    <div class="mt-6 flex items-center justify-between border-t border-dashed border-slate-200 pt-4 text-xs font-semibold uppercase tracking-wide text-slate-400 dark:border-zinc-700 dark:text-zinc-500">
                        <div class="flex items-center gap-3">
                            <div class="h-9 w-9 overflow-hidden rounded-full border border-slate-200 bg-slate-100 dark:border-zinc-700 dark:bg-zinc-700">
                                <img src="{{ src(optional($review->reviewer)->avatar) }}" alt="{{ optional($review->reviewer)->username ?? 'user' }}" class="h-full w-full object-cover">
                            </div>
                            <div class="flex flex-col text-slate-500 dark:text-zinc-300">
                                <span>@lang('messages.t_from')</span>
                                <span class="text-sm font-semibold text-slate-700 dark:text-zinc-100">
                                    {{ optional($review->reviewer)->username ?? __('messages.t_account_deleted') }}
                                </span>
                            </div>
                        </div>
                        <a href="{{ url('messages/new', optional($review->reviewer)->username ?? '') }}" class="inline-flex items-center gap-1 text-xs font-semibold text-primary-600 hover:text-primary-700 dark:text-primary-300">
                            <i class="ph-duotone ph-paper-plane-tilt text-sm"></i>
                            @lang('messages.t_contact')
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center dark:border-zinc-700 dark:bg-zinc-900">
                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-400 dark:bg-zinc-700 dark:text-zinc-300">
                        <i class="ph-duotone ph-seal-warning text-3xl"></i>
                    </div>
                    <h3 class="mt-6 text-xl font-semibold text-slate-700 dark:text-zinc-100">
                        @lang('messages.t_no_reviews_yet')
                    </h3>
                    <p class="mt-2 max-w-md text-sm leading-relaxed text-slate-500 dark:text-zinc-400">
                        @lang('messages.t_no_reviews_yet_subtitle')
                    </p>
                </div>
            @endforelse
        </div>

        @if ($reviews->hasPages())
            <div class="flex justify-center">
                {!! $reviews->links('pagination::tailwind') !!}
            </div>
        @endif
    </div>
</div>
