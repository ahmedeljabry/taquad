<div class="container" x-data="window.WbHObCwPcNqueuQ" x-init="init()">
    <div class="app rounded-md shadow-sm border border-gray-100 dark:border-zinc-700">

        {{-- Section header --}}
        <div class="header py-3 px-5">
                
            {{-- Section title --}}
            <div class="">
                <span class="text-sm font-semibold tracking-wide text-gray-700 dark:text-gray-100">{{ __('messages.t_messages') }}</span>
            </div>

            {{-- My Profile --}}
            <div class="user-settings rtl:!mr-auto rtl:!ml-[unset]">
                
                {{-- Account settings --}}
                <div class="settings">
                    <a href="{{ url('account/settings') }}" target="_blank" data-tooltip-target="tooltip-account-settings">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3" />
                            <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z" />
                        </svg>
                        <div id="tooltip-account-settings" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-xs font-medium text-white bg-gray-900 rounded-sm shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            {{ __('messages.t_account_settings') }}
                        </div>
                    </a>
                </div>

                {{-- View my profile --}}
                <img class="user-profile object-cover rtl:!ml-0 rtl:!mr-4 lazy" src="{{ placeholder_img() }}" data-src="{{ src(auth()->user()->avatar) }}" alt="{{ auth()->user()->username }}">

            </div>

        </div>

        {{-- Section content --}}
        <div class="wrapper !grid md:!flex">

            {{-- Conversations --}}
            <div class="conversation-area rtl:!border-r-0 rtl:border-l border-gray-200 dark:border-zinc-700">

                @foreach ($conversations as $c)
                    <{{ $c->uid !== $conversation->uid ? 'a' : 'div' }} href="{{ $c->uid !== $conversation->uid ? url('messages', $c->uid) : '' }}" class="msg {{ $c->sender->isOnline() ? 'online' : 'offline' }} {{ $c->uid === $conversation->uid ? 'active' : '' }}" wire:key="conversation-id-{{ $c->uid }}">
                        <img class="msg-profile object-cover rtl:!mr-0 rtl:!ml-4 lazy" src="{{ placeholder_img() }}" data-src="{{ src($c->sender->avatar) }}" alt="{{ $c->sender->username }}" />
                        <div class="msg-detail">
                            <div class="msg-username flex items-center gap-2">
                                <span class="msg-status"></span>
                                <span class="font-semibold">{{ $c->sender->username }}</span>
                                @if ($c->unreadMessages()->count() > 0)
                                    <div class="flex items-center justify-center w-5 h-5 pt-[1px] bg-primary-600 text-[11px] font-medium text-white ltr:ml-2 rtl:mr-2 rounded-full">
                                        {{ $c->unreadMessages()->count() }}
                                    </div>
                                @endif
                            </div>
                            <div class="msg-content">

                                @php
                                    $latest = $c->messages()->latest()->first();
                                @endphp

                                @if ($latest)
                                    <span class="msg-message">{{ $latest->message }}</span>
                                    <span class="msg-date rtl:!ml-0 rtl:!mr-1">{{ format_date($latest->created_at) }}</span>
                                @else
                                @endif

                            </div>
                        </div>
                    </{{ $c->uid !== $conversation->uid ? 'a' : 'div' }}>
                @endforeach
                
                <div class="overlay"></div>
            </div>

            {{-- Conversation messages --}}
            <div class="chat-area" id="chat-area">
                <div class="chat-area-header">
                    <div class="flex flex-col gap-3 rounded-2xl bg-white/80 px-5 py-4 shadow-sm dark:bg-zinc-800/80 dark:shadow-none">
                        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                            <div class="flex items-center gap-3">
                                <img class="h-12 w-12 rounded-full object-cover shadow-sm lazy"
                                    src="{{ placeholder_img() }}" data-src="{{ src($conversation->sender->avatar) }}"
                                    alt="{{ $conversation->sender->username }}">
                                <div>
                                    <p class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
                                        {{ $conversation->sender->username }}
                                    </p>
                                    <p class="text-[12px] text-slate-500 dark:text-zinc-400">
                                        {{ $conversation->sender->isOnline() ? 'متصل الآن' : 'آخر ظهور: ' . format_date($conversation->sender->updated_at, config('carbon-formats.M_j,_H_:_i')) }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center gap-2">
                                <a href="{{ url('profile', $conversation->sender->username) }}" target="_blank"
                                    class="inline-flex items-center gap-2 rounded-full border border-primary-100 px-3.5 py-1.5 text-[12px] font-semibold text-primary-600 transition hover:border-primary-300 hover:text-primary-700 dark:border-primary-400/20 dark:text-primary-200 dark:hover:border-primary-400/40">
                                    <i class="ph ph-user-circle text-sm"></i>
                                    <span>@lang('messages.t_view_profile')</span>
                                </a>
                                <a href="{{ url('profile/' . $conversation->sender->username . '/projects') }}" target="_blank"
                                    class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-3.5 py-1.5 text-[12px] font-semibold text-slate-600 transition hover:border-primary-200 hover:text-primary-600 dark:border-zinc-600 dark:text-zinc-300">
                                    <i class="ph ph-briefcase text-sm"></i>
                                    <span>مشاريعه</span>
                                </a>
                            </div>
                        </div>
                        <div class="grid gap-3 text-[12px] text-slate-500 dark:text-zinc-400 md:grid-cols-3">
                                <div class="flex items-center gap-2">
                                    <i class="ph ph-shield-check text-base text-emerald-500"></i>
                                    <span>{{ __('messages.t_member_since') }} {{ format_date($conversation->sender->created_at, config('carbon-formats.F_j,_Y')) }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="ph ph-map-pin text-base text-primary-500"></i>
                                <span>{{ $conversation->sender->country?->name ?? 'دولي' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="ph ph-target text-base text-indigo-500"></i>
                                <span>{{ $conversation->sender->headline ?? 'جاهز للتعاون' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-area-main">

                    @if (count($messages))

                        {{-- Pages --}}
                        @if ($messages->hasPages())
                            <div class="flex justify-center py-6">
                                {!! $messages->links('pagination::tailwind') !!}
                            </div>
                        @endif

                        {{-- Messages --}}
                        @foreach ($messages->reverse() as $msg)
                            <div class="chat-msg {{ $msg->message_from == auth()->id() ? 'owner' : 'rtl:flex-row-reverse' }}" wire:key="conversation-message-{{ $msg->uid }}">
                                <div class="chat-msg-profile">
                                    <img class="chat-msg-img object-cover lazy" src="{{ placeholder_img() }}" data-src="{{ src($msg->sender->avatar) }}" alt="{{ $msg->sender->username }}" />
                                    <div class="chat-msg-date">{{ format_date($msg->created_at, config('carbon-formats.F_j,_Y_h_:_i_A')) }}</div>
                                </div>
                                <div class="chat-msg-content">
                                    @if ($msg->type === 'voice' && $msg->attachment_path)
                                        <div class="chat-msg-voice">
                                            <audio controls preload="none" src="{{ \Illuminate\Support\Facades\Storage::disk($msg->attachment_disk ?? 'public')->url($msg->attachment_path) }}"></audio>
                                            @if ($msg->attachment_duration)
                                                <span class="chat-msg-voice__duration">{{ gmdate('i:s', $msg->attachment_duration) }}</span>
                                            @endif
                                        </div>

                                        @if (!empty($msg->message))
                                            <div class="chat-msg-text chat-msg-text--caption">
                                                {{ $msg->message }}
                                            </div>
                                        @endif
                                    @else
                                        <div class="chat-msg-text">
                                            {{ $msg->message }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    @else

                        {{-- No messages yet --}}
                        <div class="py-14 px-6 text-center text-sm sm:px-14">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            <p class="mt-4 font-semibold text-gray-900 dark:text-gray-200">{{ __('messages.t_no_messages_yet') }}</p>
                            <p class="mt-2 text-gray-500 dark:text-gray-400">{{ __('messages.t_no_messages_yet_subtitle') }}</p>
                        </div>

                    @endif
                    
                </div>

                <div class="chat-area-footer dark:bg-zinc-700 dark:border-zinc-700">

                    {{-- Active conversation --}}
                    @if ($conversation->status === 'active')
                        <div class="chat-controls" data-conversation-controls data-component-id="{{ $this->conversation->id }}">
                            <button type="button" class="chat-control-btn chat-control-btn--voice" data-voice-record aria-label="{{ __('messages.t_record_voice_note') }}">
                                <i class="ph ph-microphone"></i>
                            </button>
                            <div class="chat-recording-indicator" data-voice-indicator hidden>
                                <span class="chat-recording-indicator__dot"></span>
                                <span data-voice-timer>00:00</span>
                                <button type="button" class="chat-control-btn chat-control-btn--stop" data-voice-stop aria-label="{{ __('messages.t_stop_recording') }}">
                                    <i class="ph ph-square"></i>
                                </button>
                            </div>
                            <input class="chat-input focus:ring-2 focus:ring-primary-600 dark:bg-zinc-600 dark:text-gray-400" type="text" placeholder="{{ __('messages.t_type_ur_message_here') }}" wire:model.defer="message" wire:keydown.enter="send" />
                            <div class="chat-send">
                                <div wire:loading wire:target="send" class="chat-send__loader">
                                    <div class="w-10 h-10 flex items-center justify-center rounded-md bg-primary-600 text-white">
                                        <svg role="status" class="inline w-6 h-6 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                        </svg>
                                    </div>
                                </div>
                                <div wire:loading.remove wire:target="send" wire:click="send" class="chat-send__button cursor-pointer">
                                    <div class="w-10 h-10 items-center justify-center rounded-md bg-primary-600 text-white ltr:flex rtl:hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                    </div>
                                    <div class="w-10 h-10 items-center justify-center rounded-md bg-primary-600 text-white ltr:hidden rtl:flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-[11px] text-slate-400 dark:text-zinc-500">
                            اضغط على زر الميكروفون للتسجيل، أو استخدم Shift + Enter لبدء سطر جديد.
                        </p>
                        <div class="chat-voice-preview" data-voice-preview hidden>
                            <audio controls preload="none" data-voice-audio></audio>
                            <div class="chat-voice-preview__meta">
                                <span class="chat-voice-preview__duration" data-voice-preview-duration>00:00</span>
                                <div class="chat-voice-preview__actions">
                                    <button type="button" class="chat-btn-secondary" data-voice-discard>
                                        <i class="ph ph-trash"></i>
                                        <span>{{ __('messages.t_discard') }}</span>
                                    </button>
                                    <button type="button" class="chat-btn-primary" data-voice-upload>
                                        <i class="ph ph-paper-plane-right"></i>
                                        <span>{{ __('messages.t_send_voice_note') }}</span>
                                    </button>
                                </div>
                            </div>
                            <p class="chat-voice-feedback" data-voice-feedback></p>
                        </div>

                    @elseif ($conversation->status === 'blocked')
                        <div class="flex items-center justify-center w-full m-auto py-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="text-xs font-medium text-gray-400">{{ __('messages.t_u_cant_reply_this_conversation') }}</span>
                        </div>
                    @endif

                    
                </div>
            </div>

            {{-- User details --}}
            <div class="detail-area dark:border-zinc-700" wire:key="conversation-user-details">
                <div class="detail-area-header">
                    <div class="msg-profile group" wire:ignore>
                        <img class="inline-block h-14 w-14 rounded-full object-cover lazy" src="{{ placeholder_img() }}" data-src="{{ src($conversation->sender->avatar) }}" alt="">
                    </div>
                    <div class="detail-title flex items-center dark:text-gray-200" wire:ignore>
                        {{ $conversation->sender->username }}
                        @if ($conversation->sender->status === 'verified')
                            <img data-tooltip-target="tooltip-account-verified-{{ $conversation->id }}" class="ltr:ml-0.5 rtl:mr-0.5 h-4 w-4 -mt-0.5" src="{{ url('public/img/auth/verified-badge.svg') }}" alt="{{ __('messages.t_account_verified') }}">
                            <div id="tooltip-account-verified-{{ $conversation->id }}" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-xs font-medium text-white bg-gray-900 rounded-sm shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                {{ __('messages.t_account_verified') }}
                            </div>
                        @endif
                    </div>
                    <div class="detail-subtitle" wire:ignore>{{ __('messages.t_conversation_started_on_date', ['date' => format_date($conversation->created_at, config('carbon-formats.F_j,_Y'))]) }}</div>
                    <div class="detail-buttons m-auto">
                        <div class="flex flex-col {{ $conversation->status === 'blocked' ? 'justify-center' : 'justify-between' }} space-y-3 sm:flex-row sm:space-y-0 sm:space-x-2 sm:rtl:space-x-reverse px-4">

                            {{-- View profile --}}
                            <a href="{{ url('profile', $conversation->sender->username) }}" target="_blank" class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="ltr:-ml-1 ltr:mr-2 rtl:-mr-1 rtl:ml-2 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span class="whitespace-nowrap font-semibold">{{ __('messages.t_view_profile') }}</span>
                            </a>

                            {{-- Block conversation --}}
                            @if ($conversation->status !== 'blocked')
                                <button type="button" x-on:click='confirm("{{ __('messages.t_are_u_sure_block_conversation_user') }}") ? $wire.block : "" ' wire:loading.attr="disabled" wire:target="block" class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">

                                    {{-- Loading indicator --}}
                                    <div wire:loading wire:target="block">
                                        <div class="flex items-center justify-center">
                                            <svg role="status" class="ltr:-ml-1 ltr:mr-2 rtl:-mr-1 rtl:ml-2 h-5 w-5 text-red-700 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#fffafa"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                            </svg>
                                            <span>{{ __('messages.t_working_dots') }}</span>
                                        </div>
                                    </div>

                                    {{-- Ban icon --}}
                                    <div wire:loading.remove wire:target="block">
                                        <div class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="ltr:-ml-1 ltr:mr-2 rtl:-mr-1 rtl:ml-2 h-5 w-5 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                            <span class="whitespace-nowrap font-semibold">{{ __('messages.t_block_user') }}</span>
                                        </div>
                                    </div>

                                </button>
                            @else
                                <button type="button" x-on:click='confirm("{{ __('messages.t_are_u_sure_unblock_conversation_user') }}") ? $wire.unblock : "" ' wire:loading.attr="disabled" wire:target="unblock" class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">

                                    {{-- Loading indicator --}}
                                    <div wire:loading wire:target="unblock">
                                        <div class="flex items-center justify-center">
                                            <svg role="status" class="ltr:-ml-1 ltr:mr-2 rtl:-mr-1 rtl:ml-2 h-5 w-5 text-red-700 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#fffafa"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                                            </svg>
                                            <span>{{ __('messages.t_working_dots') }}</span>
                                        </div>
                                    </div>

                                    {{-- Ban icon --}}
                                    <div wire:loading.remove wire:target="unblock">
                                        <div class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="ltr:-ml-1 ltr:mr-2 rtl:-mr-1 rtl:ml-2 h-5 w-5 text-red-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/></svg>
                                            <span class="whitespace-nowrap font-semibold">{{ __('messages.t_unblock_user') }}</span>
                                        </div>
                                    </div>

                                </button> 
                            @endif
                          </div>
                    </div>
                </div>
                <div class="detail-changes" wire:ignore>

                    {{-- Fullname --}}
                    @if ($conversation->sender->fullname)
                        <div class="detail-change flex items-center justify-between">
                            <span class="text-xs text-gray-400 dark:text-gray-400">{{ __('messages.t_fullname') }}</span>
                            <span class="text-xs text-gray-800 dark:text-gray-200">{{ $conversation->sender->fullname }}</span>
                        </div>
                    @endif

                    {{-- Country --}}
                    @if ($conversation->sender->country)
                        <div class="detail-change flex items-center justify-between">
                            <span class="text-xs text-gray-400 dark:text-gray-400">{{ __('messages.t_country') }}</span>
                            <div class="text-xs text-gray-800 dark:text-gray-200 flex items-center">
                                <img src="{{ placeholder_img() }}" data-src="{{ countryFlag($conversation->sender->country?->code) }}" alt="{{ $conversation->sender->country?->name }}" class="lazy h-4 w-4 ltr:mr-2 rtl:ml-2 object-cover">  
                                <span>{{ $conversation->sender->country?->name }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- Level --}}
                    @if ($conversation->sender->level)
                        <div class="detail-change flex items-center justify-between">
                            <span class="text-xs text-gray-400 dark:text-gray-400">{{ __('messages.t_level') }}</span>
                            <span class="text-xs" style="color: {{ $conversation->sender->level->level_color }}">{{ $conversation->sender->level->title }}</span>
                        </div>
                    @endif

                    {{-- Joined date --}}
                    <div class="detail-change flex items-center justify-between">
                        <span class="text-xs text-gray-400 dark:text-gray-400">{{ __('messages.t_member_since') }}</span>
                        <span class="text-xs text-gray-800 dark:text-gray-200">{{ format_date($conversation->sender->created_at, config('carbon-formats.F_j,_Y')) }}</span>
                    </div>

                </div>

                @if ($conversation->sender->projects()->count())
                    <div class="detail-photos">
                        <div class="detail-photo-title">
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-image">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                <circle cx="8.5" cy="8.5" r="1.5" />
                                <path d="M21 15l-5-5L5 21" />
                            </svg>
                            {{ __('messages.t_portfolio') }}
                        </div>
                        <div class="detail-photo-grid grid grid-cols-4 md:gap-x-6 gap-y-6 mb-6">
                            @foreach ($conversation->sender->projects()->limit(16)->get() as $project)
                                @if ($project->status === 'active')
                                    <a href="{{ url('projects', $project->slug) }}" target="_blank">
                                        <img src="{{ placeholder_img() }}" data-src="{{ src($project->thumbnail) }}" alt="{{ $project->title }}" class="lazy w-12 h-12 rounded-md object-cover shadow-sm">
                                    </a>
                                @endif
                            @endforeach
                        </div>
                        <a href="{{ url('profile/' . $conversation->sender->username . '/portfolio') }}" target="_blank" class="view-more">{{ __('messages.t_view_more') }}</a>
                    </div>
                @endif
                
            </div>
        </div>
        
    </div>
</div>

@push('scripts')

    {{-- AlpineJs --}}
    <script>
        function WbHObCwPcNqueuQ() {
            return {

                init() {
                    var _this = this;

                    // Listen when livewire event received
                    document.addEventListener("DOMContentLoaded", () => {

                        _this.scrollDown();

                        Livewire.hook('message.processed', (message, component) => {
                            _this.scrollDown();
                        })
                    });

                },

                scrollDown() {
                    var target = document.getElementById("chat-area");
                    target.scrollTop = target.scrollHeight;
                }

            }
        }
        window.WbHObCwPcNqueuQ = WbHObCwPcNqueuQ();

        document.addEventListener('DOMContentLoaded', initVoiceRecorder);

        function initVoiceRecorder() {
            const controls = document.querySelector('[data-conversation-controls]');
            if (!controls || !window.Livewire) {
                return;
            }

            const componentId = controls.getAttribute('data-component-id');
            if (!componentId) {
                return;
            }

            const recordButton = controls.querySelector('[data-voice-record]');
            const stopButton = controls.querySelector('[data-voice-stop]');
            const indicator = controls.querySelector('[data-voice-indicator]');
            const timerLabel = controls.querySelector('[data-voice-timer]');
            const preview = document.querySelector('[data-voice-preview]');
            const audioEl = preview ? preview.querySelector('[data-voice-audio]') : null;
            const durationLabel = preview ? preview.querySelector('[data-voice-preview-duration]') : null;
            const discardButton = preview ? preview.querySelector('[data-voice-discard]') : null;
            const uploadButton = preview ? preview.querySelector('[data-voice-upload]') : null;
            const feedback = preview ? preview.querySelector('[data-voice-feedback]') : null;

            if (!recordButton || !stopButton || !preview || !audioEl || !uploadButton) {
                return;
            }

            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                recordButton.classList.add('is-disabled');
                recordButton.setAttribute('disabled', 'disabled');
                if (feedback) {
                    feedback.textContent = @json(__('messages.t_voice_not_supported'));
                    feedback.classList.add('is-error');
                }
                return;
            }

            let mediaRecorder = null;
            let recordedChunks = [];
            let recordingTimer = null;
            let recordingStartedAt = null;
            let recordedBlob = null;
            let recordedDuration = 0;

            recordButton.addEventListener('click', async () => {
                if (mediaRecorder && mediaRecorder.state === 'recording') {
                    return;
                }

                try {
                    if (!mediaRecorder) {
                        const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                        mediaRecorder = new MediaRecorder(stream);
                        mediaRecorder.ondataavailable = (event) => {
                            if (event.data && event.data.size > 0) {
                                recordedChunks.push(event.data);
                            }
                        };
                        mediaRecorder.onstop = handleStop;
                    }

                    recordedChunks = [];
                    recordedBlob = null;
                    recordedDuration = 0;
                    startTimer();
                    mediaRecorder.start();
                    toggleRecordingState(true);
                } catch (error) {
                    showFeedback(@json(__('messages.t_voice_permission_denied')), true);
                }
            });

            stopButton.addEventListener('click', () => {
                if (mediaRecorder && mediaRecorder.state === 'recording') {
                    mediaRecorder.stop();
                }
            });

            if (discardButton) {
                discardButton.addEventListener('click', () => {
                    resetPreview();
                });
            }

            if (uploadButton) {
                uploadButton.addEventListener('click', () => {
                    if (!recordedBlob) {
                        showFeedback(@json(__('messages.t_voice_no_recording')), true);
                        return;
                    }

                    uploadButton.classList.add('is-loading');
                    uploadButton.disabled = true;
                    showFeedback(@json(__('messages.t_voice_uploading')), false);

                    window.Livewire.find(componentId).upload('voiceDraft', recordedBlob, (filename) => {
                        window.Livewire.find(componentId).call('sendVoiceMessage', filename, recordedDuration);
                        resetPreview();
                        uploadButton.classList.remove('is-loading');
                        uploadButton.disabled = false;
                    }, () => {
                        showFeedback(@json(__('messages.t_voice_upload_failed')), true);
                        uploadButton.classList.remove('is-loading');
                        uploadButton.disabled = false;
                    });
                });
            }

            window.addEventListener('conversation-voice-sent', () => {
                showFeedback(@json(__('messages.t_send_voice_note_success')), false);
            });

            function handleStop() {
                stopTimer();
                toggleRecordingState(false);

                if (!recordedChunks.length) {
                    return;
                }

                recordedBlob = new Blob(recordedChunks, { type: mediaRecorder.mimeType || 'audio/webm' });

                if (audioEl) {
                    if (audioEl.dataset.objectUrl) {
                        URL.revokeObjectURL(audioEl.dataset.objectUrl);
                    }
                    const objectUrl = URL.createObjectURL(recordedBlob);
                    audioEl.src = objectUrl;
                    audioEl.dataset.objectUrl = objectUrl;
                }

                if (durationLabel) {
                    durationLabel.textContent = formatDuration(recordedDuration);
                }

                preview.hidden = false;
                showFeedback('', false);
            }

            function toggleRecordingState(isRecording) {
                indicator.hidden = !isRecording;
                recordButton.classList.toggle('is-disabled', isRecording);
                recordButton.toggleAttribute('disabled', isRecording);

                if (isRecording) {
                    preview.hidden = true;
                    if (audioEl && audioEl.dataset.objectUrl) {
                        URL.revokeObjectURL(audioEl.dataset.objectUrl);
                        delete audioEl.dataset.objectUrl;
                    }
                    if (audioEl) {
                        audioEl.removeAttribute('src');
                    }
                    showFeedback(@json(__('messages.t_voice_recording_hint')), false);
                } else {
                    showFeedback('', false);
                }
            }

            function startTimer() {
                recordingStartedAt = Date.now();
                updateTimer();
                stopTimer();
                recordingTimer = setInterval(updateTimer, 200);
            }

            function stopTimer() {
                if (recordingTimer) {
                    clearInterval(recordingTimer);
                    recordingTimer = null;
                }
            }

            function updateTimer() {
                if (!recordingStartedAt || !timerLabel) {
                    return;
                }
                recordedDuration = Math.round((Date.now() - recordingStartedAt) / 1000);
                timerLabel.textContent = formatDuration(recordedDuration);
            }

            function resetPreview() {
                preview.hidden = true;
                recordedBlob = null;
                recordedDuration = 0;

                if (audioEl && audioEl.dataset.objectUrl) {
                    URL.revokeObjectURL(audioEl.dataset.objectUrl);
                    delete audioEl.dataset.objectUrl;
                }

                if (audioEl) {
                    audioEl.pause();
                    audioEl.removeAttribute('src');
                }

                if (durationLabel) {
                    durationLabel.textContent = '00:00';
                }

                showFeedback('', false);
            }

            function showFeedback(message, isError) {
                if (!feedback) {
                    return;
                }
                feedback.textContent = message;
                feedback.classList.toggle('is-error', Boolean(isError));
            }

            function formatDuration(seconds) {
                const mins = String(Math.floor(seconds / 60)).padStart(2, '0');
                const secs = String(seconds % 60).padStart(2, '0');
                return `${mins}:${secs}`;
            }
        }
    </script>

@endpush

@push('styles')
    
    {{-- Chat style --}}
    <link rel="stylesheet" href="{{ url('public/css/chat.css') }}">

@endpush

@push('styles')
    <style>
        .conversation-area {
            background: linear-gradient(160deg, rgba(244, 246, 255, 0.92), rgba(255, 255, 255, 0.8));
            border-right: 1px solid rgba(226, 232, 240, 0.7);
            padding: 1.25rem 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        body.dark .conversation-area {
            background: linear-gradient(160deg, rgba(15, 23, 42, 0.88), rgba(17, 24, 39, 0.82));
            border-right-color: rgba(148, 163, 184, 0.18);
        }

        .conversation-area .msg {
            border-radius: 16px;
            padding: 0.9rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.85rem;
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(226, 232, 240, 0.6);
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        body.dark .conversation-area .msg {
            background: rgba(30, 41, 59, 0.65);
            border-color: rgba(148, 163, 184, 0.2);
        }

        .conversation-area .msg:hover {
            transform: translateX(4px);
            border-color: rgba(37, 99, 235, 0.35);
            box-shadow: 0 12px 18px -12px rgba(37, 99, 235, 0.35);
        }

        .conversation-area .msg.active {
            border-color: rgba(37, 99, 235, 0.55);
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.1), rgba(79, 70, 229, 0.1));
            box-shadow: 0 18px 26px -14px rgba(37, 99, 235, 0.35);
        }

        .conversation-area .msg .msg-message {
            font-size: 0.78rem;
            color: #475569;
        }

        body.dark .conversation-area .msg .msg-message {
            color: #cbd5f5;
        }

        .msg-status {
            width: 0.55rem;
            height: 0.55rem;
            border-radius: 999px;
            background: #cbd5f5;
            box-shadow: 0 0 0 3px rgba(148, 163, 184, 0.2);
        }

        .conversation-area .msg.online .msg-status {
            background: #16a34a;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.18);
        }

        .conversation-area .msg.offline .msg-status {
            background: #94a3b8;
        }

        .chat-area {
            background: linear-gradient(150deg, rgba(248, 250, 252, 0.82), rgba(255, 255, 255, 0.9));
        }

        body.dark .chat-area {
            background: linear-gradient(150deg, rgba(15, 23, 42, 0.88), rgba(17, 24, 39, 0.9));
        }

        .chat-area-main {
            background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.06), transparent 40%);
        }

        body.dark .chat-area-main {
            background: radial-gradient(circle at top right, rgba(96, 165, 250, 0.06), transparent 40%);
        }

        .chat-msg {
            display: flex;
            gap: 0.85rem;
            margin-bottom: 1.5rem;
        }

        .chat-msg.owner {
            flex-direction: row-reverse;
        }

        .chat-msg-content {
            max-width: 72%;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
        }

        .chat-msg-text {
            padding: 0.75rem 0.95rem;
            font-size: 0.84rem;
            line-height: 1.5;
            border-radius: 16px;
            background: rgba(248, 250, 252, 0.95);
            color: #1f2937;
            box-shadow: 0 10px 18px -14px rgba(15, 23, 42, 0.45);
        }

        .chat-msg.owner .chat-msg-text {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.92), rgba(79, 70, 229, 0.9));
            color: #fff;
            box-shadow: 0 18px 28px -16px rgba(37, 99, 235, 0.6);
        }

        body.dark .chat-msg-text {
            background: rgba(30, 41, 59, 0.85);
            color: #e2e8f0;
        }

        .chat-msg-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.35rem;
        }

        .chat-msg-date {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #94a3b8;
        }

        body.dark .chat-msg-date {
            color: #cbd5f5;
        }

        .chat-area-footer {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(226, 232, 240, 0.6);
        }

        body.dark .chat-area-footer {
            border-top-color: rgba(148, 163, 184, 0.2);
        }

        .chat-controls {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .chat-input {
            flex: 1;
            border: 1px solid rgba(148, 163, 184, 0.45);
            border-radius: 16px;
            padding: 0.65rem 0.9rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            background-color: rgba(255, 255, 255, 0.95);
            color: #1f2937;
        }

        .chat-input:focus {
            outline: none;
            border-color: rgba(37, 99, 235, 0.55);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        body.dark .chat-input {
            background-color: rgba(15, 23, 42, 0.75);
            border-color: rgba(148, 163, 184, 0.3);
            color: #e2e8f0;
        }

        .chat-control-btn {
            border: none;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.95), rgba(59, 130, 246, 0.9));
            color: #fff;
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
        }

        .chat-control-btn--stop {
            background: rgba(239, 68, 68, 0.9);
        }

        .chat-control-btn.is-disabled {
            opacity: 0.6;
            pointer-events: none;
        }

        .chat-control-btn:hover:not(.is-disabled) {
            transform: translateY(-2px);
            box-shadow: 0 12px 20px rgba(37, 99, 235, 0.25);
        }

        .chat-recording-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(239, 68, 68, 0.12);
            color: #b91c1c;
            border-radius: 999px;
            padding: 0.4rem 0.65rem 0.4rem 0.55rem;
        }

        .chat-recording-indicator__dot {
            width: 0.55rem;
            height: 0.55rem;
            border-radius: 999px;
            background: #ef4444;
            animation: ping 1.2s infinite;
        }

        @keyframes ping {
            0% { transform: scale(1); opacity: 1; }
            75%, 100% { transform: scale(1.6); opacity: 0; }
        }

        .chat-send {
            display: flex;
            align-items: center;
        }

        .chat-send__loader,
        .chat-send__button {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-voice-preview {
            border: 1px dashed rgba(148, 163, 184, 0.45);
            border-radius: 16px;
            padding: 0.9rem;
            background: rgba(248, 250, 252, 0.9);
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        body.dark .chat-voice-preview {
            background: rgba(30, 41, 59, 0.65);
            border-color: rgba(148, 163, 184, 0.25);
        }

        .chat-voice-preview__meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .chat-voice-preview__actions {
            display: inline-flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .chat-btn-primary,
        .chat-btn-secondary {
            border: none;
            border-radius: 12px;
            font-size: 0.78rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.55rem 0.9rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .chat-btn-primary {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.95), rgba(79, 70, 229, 0.9));
            color: #fff;
        }

        .chat-btn-secondary {
            background: rgba(148, 163, 184, 0.18);
            color: #1f2937;
        }

        body.dark .chat-btn-secondary {
            background: rgba(148, 163, 184, 0.25);
            color: #e2e8f0;
        }

        .chat-btn-primary:hover,
        .chat-btn-secondary:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 16px rgba(15, 23, 42, 0.18);
        }

        .chat-voice-feedback {
            font-size: 0.72rem;
            color: #059669;
        }

        .chat-voice-feedback.is-error {
            color: #dc2626;
        }

        .chat-msg-voice {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: rgba(37, 99, 235, 0.08);
            padding: 0.6rem 0.8rem;
            border-radius: 14px;
        }

        body.dark .chat-msg-voice {
            background: rgba(148, 163, 184, 0.15);
        }

        .chat-msg-voice audio {
            width: 190px;
        }

        .chat-msg-voice__duration {
            font-size: 0.72rem;
            font-weight: 600;
            color: #1f2937;
        }

        body.dark .chat-msg-voice__duration {
            color: #e2e8f0;
        }

        .chat-msg-text--caption {
            margin-top: 0.4rem;
            font-size: 0.76rem;
            color: #475569;
        }

        body.dark .chat-msg-text--caption {
            color: #cbd5f5;
        }

        .chat-control-btn.is-loading,
        .chat-btn-primary.is-loading {
            position: relative;
            pointer-events: none;
        }

        .chat-control-btn.is-loading::after,
        .chat-btn-primary.is-loading::after {
            content: '';
            width: 1rem;
            height: 1rem;
            border-radius: 999px;
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-top-color: #fff;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 640px) {
            .chat-controls {
                flex-wrap: wrap;
            }

            .chat-control-btn {
                width: 2.5rem;
                height: 2.5rem;
            }

            .chat-msg-voice audio {
                width: 150px;
            }
        }
    </style>
@endpush
