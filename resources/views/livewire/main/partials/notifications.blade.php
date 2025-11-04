@php
    $unreadTotal   = $notifications?->count() ?? 0;
    $markAllLabel  = __('messages.t_mark_all_as_read');
    $refreshLabel  = __('messages.t_refresh');

    if ($markAllLabel === 'messages.t_mark_all_as_read') {
        $markAllLabel = 'Mark all as read';
    }
    if ($refreshLabel === 'messages.t_refresh') {
        $refreshLabel = 'Refresh';
    }
@endphp

<div x-show="notifications_menu" style="display: none" class="fixed inset-0 z-[70] flex" x-ref="notifications_menu">

    {{-- Loading --}}
    <x-forms.loading />

    {{-- Backdrop --}}
    <div
        x-show="notifications_menu"
        style="display: none"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm dark:bg-black/60"
        @click="notifications_menu = false"
        aria-hidden="true"></div>

    {{-- Panel --}}
    <div
        x-show="notifications_menu"
        style="display: none"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="ltr:translate-x-full rtl:-translate-x-full opacity-0"
        x-transition:enter-end="ltr:translate-x-0 rtl:-translate-x-0 opacity-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="ltr:-translate-x-0 rtl:translate-x-0 opacity-100"
        x-transition:leave-end="ltr:translate-x-full rtl:-translate-x-full opacity-0"
        class="relative flex h-full w-full max-w-xl flex-col overflow-hidden">

        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -left-16 top-16 h-40 w-40 rounded-full bg-primary-500/10 blur-3xl"></div>
            <div class="absolute -right-24 bottom-10 h-64 w-64 rounded-full bg-sky-400/10 blur-3xl"></div>
        </div>

        <div class="relative flex h-full w-full flex-col overflow-hidden rounded-none bg-white/90 shadow-2xl backdrop-blur-xl dark:bg-zinc-900/95">
            <div class="relative overflow-hidden bg-gradient-to-br from-primary-500 via-primary-500/90 to-sky-500 text-white">
                <div class="absolute -top-10 -right-10 h-40 w-40 rounded-full bg-white/15 blur-2xl"></div>
                <div class="absolute -bottom-16 -left-12 h-48 w-48 rounded-full bg-white/10 blur-2xl"></div>
                <div class="relative px-6 py-7 sm:px-7">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-white/90">
                                <i class="ph-duotone ph-bell-ringing text-sm"></i>
                                {{ $unreadTotal }} @lang('messages.t_notifications')
                            </span>
                            <h3 class="mt-3 text-xl font-semibold text-white sm:text-2xl">
                                @lang('messages.t_notifications')
                            </h3>
                            <p class="mt-1 text-xs text-white/85">
                                {{ __('messages.t_you_have_unread_notifications', ['count' => $unreadTotal]) }}
                            </p>
                        </div>
                        <button
                            type="button"
                            class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-white/15 text-white transition hover:bg-white/25 focus:outline-none focus:ring-2 focus:ring-white/60"
                            @click="notifications_menu = false"
                            aria-label="@lang('messages.t_close')">
                            <i class="ph-duotone ph-x text-lg"></i>
                        </button>
                    </div>
                    <div class="mt-5 flex flex-wrap gap-3 text-xs font-semibold">
                        <button
                            type="button"
                            wire:click="refreshList"
                            wire:loading.attr="disabled"
                            wire:target="refreshList"
                            class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-2 text-white transition hover:bg-white/25 disabled:opacity-60">
                            <span wire:loading.remove wire:target="refreshList" class="inline-flex items-center gap-2">
                                <i class="ph-duotone ph-arrows-clockwise text-sm"></i>
                                {{ $refreshLabel }}
                            </span>
                            <span wire:loading wire:target="refreshList">
                                <svg class="h-4 w-4 animate-spin text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v3a5 5 0 00-5 5H4z"/>
                                </svg>
                            </span>
                        </button>
                        <button
                            type="button"
                            wire:click="markAllAsRead"
                            wire:loading.attr="disabled"
                            wire:target="markAllAsRead"
                            @class([
                                'inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-white transition hover:bg-white/20 disabled:opacity-60',
                                'opacity-40 pointer-events-none' => $unreadTotal === 0,
                            ])>
                            <span wire:loading.remove wire:target="markAllAsRead" class="inline-flex items-center gap-2">
                                <i class="ph-duotone ph-check-circle text-sm"></i>
                                {{ $markAllLabel }}
                            </span>
                            <span wire:loading wire:target="markAllAsRead">
                                <svg class="h-4 w-4 animate-spin text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v3a5 5 0 00-5 5H4z"/>
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="relative flex-1 overflow-y-auto px-6 py-6 sm:px-7 scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-transparent dark:scrollbar-thumb-zinc-700 dark:scrollbar-track-transparent">
                <div wire:loading.flex class="absolute inset-0 z-50 hidden items-center justify-center rounded-t-3xl bg-white/80 backdrop-blur-sm dark:bg-zinc-900/70">
                    <svg role="status" class="h-8 w-8 animate-spin text-primary-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#fff"/>
                    </svg>
                </div>

                <div class="space-y-5">
                    @forelse ($notifications as $n)
                        @php
                            $isFresh = $highlightedNotification === $n->uid;
                        @endphp
                        <article
                            wire:key="header-notifications-{{ $n->uid }}"
                            @class([
                                'relative overflow-hidden rounded-3xl border border-slate-200 bg-white/90 p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-lg dark:border-zinc-700 dark:bg-zinc-900/90',
                                'ring-2 ring-primary-500/70 shadow-primary-500/20' => $isFresh,
                            ])>
                            <div class="absolute inset-y-0 ltr:left-0 rtl:right-0 w-1 rounded-full bg-gradient-to-b from-primary-400/80 via-primary-500/60 to-sky-400/70"></div>
                            <div class="flex items-start gap-4">
                                <span class="relative inline-flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-primary-500/10 text-primary-600 dark:bg-primary-500/15 dark:text-primary-300">
                                    <i class="ph-duotone ph-bell-simple-ringing text-xl"></i>
                                    @if ($isFresh)
                                        <span class="absolute -top-1 -right-1 inline-flex h-3 w-3">
                                            <span class="absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75 animate-ping"></span>
                                            <span class="relative inline-flex h-3 w-3 rounded-full bg-amber-500"></span>
                                        </span>
                                    @endif
                                </span>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-2">
                                        @if ($isFresh)
                                            <span class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-2 py-0.5 text-[11px] font-semibold uppercase tracking-wider text-amber-600 dark:bg-amber-500/10 dark:text-amber-300">
                                                <i class="ph-duotone ph-sparkle text-xs"></i>
                                                @lang('messages.t_new')
                                            </span>
                                        @endif
                                    </div>
                                    <p class="mt-2 text-sm leading-relaxed text-slate-700 dark:text-zinc-100">
                                        @if ($n->params)
                                            {!! __('messages.' . $n->text, $n->params) !!}
                                        @else
                                            {!! __('messages.' . $n->text) !!}
                                        @endif
                                    </p>
                                    <div class="mt-4 flex flex-wrap items-center gap-3 text-xs text-slate-500 dark:text-zinc-400">
                                        <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-3 py-1 font-medium text-slate-600 dark:bg-zinc-800 dark:text-zinc-300">
                                            <i class="ph-duotone ph-clock text-sm"></i>
                                            {{ optional($n->created_at)->diffForHumans() }}
                                        </span>
                                        @if ($n->action)
                                            <a href="{{ $n->action }}" class="inline-flex items-center gap-1 rounded-full border border-primary-200/60 px-3 py-1 font-medium text-primary-600 transition hover:border-primary-300 hover:text-primary-700 dark:border-primary-500/30 dark:text-primary-300 dark:hover:border-primary-400 dark:hover:text-primary-200">
                                                <i class="ph-duotone ph-arrow-square-out text-sm"></i>
                                                {{ __('messages.t_view') }}
                                            </a>
                                        @endif
                                        <button
                                            type="button"
                                            wire:click="read('{{ $n->uid }}')"
                                            wire:loading.attr="disabled"
                                            wire:target="read('{{ $n->uid }}')"
                                            class="inline-flex items-center gap-1 rounded-full border border-slate-200 px-3 py-1 font-medium text-slate-600 transition hover:border-slate-300 hover:text-slate-800 disabled:opacity-60 dark:border-zinc-700 dark:text-zinc-300 dark:hover:border-zinc-600 dark:hover:text-zinc-100">
                                            <span wire:loading wire:target="read('{{ $n->uid }}')" class="inline-flex items-center gap-2">
                                                <svg class="h-3.5 w-3.5 animate-spin" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v2.5a5.5 5.5 0 00-5.5 5.5H4z"></path>
                                                </svg>
                                            </span>
                                            <span wire:loading.remove wire:target="read('{{ $n->uid }}')" class="inline-flex items-center gap-1">
                                                <i class="ph-duotone ph-check-circle text-sm"></i>
                                                {{ __('messages.t_mark_as_read') }}
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="flex flex-col items-center justify-center rounded-3xl border border-dashed border-slate-200 bg-slate-50/70 px-8 py-16 text-center dark:border-zinc-700 dark:bg-zinc-900/60">
                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-primary-500 shadow-sm dark:bg-zinc-800">
                                <i class="ph-duotone ph-bell-simple text-3xl"></i>
                            </div>
                            <p class="mt-6 text-sm font-semibold text-slate-600 dark:text-zinc-200">
                                @lang('messages.t_no_unread_notifications')
                            </p>
                            <p class="mt-2 text-xs text-slate-500 dark:text-zinc-400">
                                {{ __('messages.t_you_have_unread_notifications', ['count' => 0]) }}
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>
