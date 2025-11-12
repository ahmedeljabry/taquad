@php
    use Carbon\Carbon;
@endphp

@section('hideMainFooter', true)

@push('styles')
    <style>
        .custom-chat-scroll {
            max-height: clamp(20rem, calc(100vh - 22rem), 72vh);
            scrollbar-width: thin;
            scrollbar-color: rgba(79, 70, 229, 0.55) rgba(148, 163, 184, 0.2);
            scroll-behavior: smooth;
        }

        .custom-chat-scroll::-webkit-scrollbar {
            width: 7px;
        }

        .custom-chat-scroll::-webkit-scrollbar-track {
            background: rgba(148, 163, 184, 0.15);
            border-radius: 9999px;
        }

        .custom-chat-scroll::-webkit-scrollbar-thumb {
            background: rgba(79, 70, 229, 0.55);
            border-radius: 9999px;
        }

        .custom-chat-scroll::-webkit-scrollbar-thumb:hover {
            background: rgba(79, 70, 229, 0.7);
        }
    </style>
@endpush

<div class="w-[95%] max-w-[1600px] mx-auto px-4 sm:px-6 mt-[7rem] lg:px-8 pb-6 flex flex-col min-h-[calc(100vh-6rem)] h-full">
    <main class="flex-1 flex flex-col min-h-0">
        <div id="grid" class="grid grid-cols-12 gap-4 flex-1 min-h-0 h-full">
            <aside id="sidebar"
                class="col-span-12 md:col-span-3 rounded-2xl border border-slate-200 bg-white p-3 dark:border-slate-800 dark:bg-slate-950 md:block hidden">
                <div class="mb-3 flex items-center gap-2">
                    <input type="search" wire:model.debounce.400ms="search"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900"
                        placeholder="ابحث عن محادثة أو مستخدم…" autocomplete="off" />
                    <button type="button" wire:click="refreshConversations"
                        class="rounded-xl border border-slate-200 px-3 py-2 text-sm hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800">
                        بحث
                    </button>
                </div>

                <div class="mb-3 flex flex-wrap items-center gap-2 text-[11px]">
                    <span
                        class="inline-flex items-center gap-1 rounded-full border px-2.5 py-1 border-indigo-300 bg-indigo-50 text-indigo-700 dark:border-indigo-900/40 dark:bg-indigo-900/20 dark:text-indigo-300">
                        الكل
                    </span>
                    <span
                        class="inline-flex items-center gap-1 rounded-full border px-2.5 py-1 border-slate-200 bg-slate-50 text-slate-400 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-600">
                        غير مقروء
                    </span>
                    <span
                        class="inline-flex items-center gap-1 rounded-full border px-2.5 py-1 border-slate-200 bg-slate-50 text-slate-400 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-600">
                        مثبّت
                    </span>
                    <span
                        class="inline-flex items-center gap-1 rounded-full border px-2.5 py-1 border-slate-200 bg-slate-50 text-slate-400 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-600">
                        مكتوم
                    </span>
                </div>

                <div class="space-y-1">
                    @forelse ($conversations as $conversation)
                        @php
                            $isActive = $conversation['id'] === $activeConversationId;
                            $unread = (int) ($conversation['unread'] ?? 0);
                        @endphp
                        <button type="button" wire:key="conversation-{{ $conversation['id'] }}"
                            wire:click="selectConversation('{{ $conversation['uid'] }}')"
                            class="group w-full rounded-2xl px-3 py-3 text-left transition {{ $isActive ? 'bg-indigo-50 ring-1 ring-indigo-100 dark:bg-indigo-900/20 dark:ring-indigo-900/30' : 'hover:bg-slate-50 dark:hover:bg-slate-900' }}">
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <div
                                        class="grid h-10 w-10 place-items-center overflow-hidden rounded-full bg-slate-200 text-sm font-bold text-slate-700 dark:bg-slate-800 dark:text-slate-100">
                                        @if (!empty($conversation['avatar']))
                                            <img src="{{ $conversation['avatar'] }}" alt="{{ $conversation['name'] }}"
                                                class="h-full w-full object-cover">
                                        @else
                                            <span>{{ $conversation['initials'] }}</span>
                                        @endif
                                    </div>
                                    @if (!empty($conversation['online']))
                                        <span
                                            class="absolute -bottom-0.5 -end-0.5 h-3 w-3 rounded-full border-2 border-white bg-emerald-500 dark:border-slate-950"></span>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center justify-between gap-2">
                                        <div class="truncate font-semibold">{{ $conversation['name'] }}</div>
                                        @if (!empty($conversation['time_label']))
                                            <div class="shrink-0 text-xs text-slate-500 dark:text-slate-400">
                                                {{ $conversation['time_label'] }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex items-center justify-between gap-2">
                                        <div class="truncate text-sm text-slate-500 dark:text-slate-400">
                                            {{ $conversation['preview'] }}
                                        </div>
                                        @if ($unread > 0)
                                            <span
                                                class="shrink-0 rounded-full bg-indigo-600 px-2 py-0.5 text-[10px] font-bold text-white">
                                                {{ $unread }}
                                            </span>
                                        @else
                                            <span
                                                class="text-[10px] text-slate-400 opacity-0 transition group-hover:opacity-100">
                                                فتح
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </button>
                    @empty
                        <div
                            class="rounded-2xl border border-dashed border-slate-200 px-4 py-6 text-center text-sm text-slate-500 dark:border-slate-700 dark:text-slate-400">
                            لا توجد محادثات متاحة حتى الآن.
                        </div>
                    @endforelse
                </div>
            </aside>
            <section wire:poll.keep-alive.7s="pollRealtime"
                class="col-span-12 md:col-span-6 flex flex-col min-h-0 h-full rounded-2xl border border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-950 relative overflow-hidden">
                @if ($activeConversationId)
                    @php
                        $counterpart = $activeConversation['counterpart'] ?? null;
                        $stateLabels = [
                            'sent' => 'تم الإرسال',
                            'delivered' => 'وصل ✓',
                            'read' => 'مقروء ✓✓',
                        ];
                    @endphp

                    <div
                        class="sticky top-0 z-[5] flex items-center justify-between border-b border-slate-200 bg-white/95 px-4 py-3 backdrop-blur dark:border-slate-800 dark:bg-slate-950/95">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <div
                                    class="grid h-10 w-10 place-items-center overflow-hidden rounded-full bg-slate-200 text-sm font-bold text-slate-700 dark:bg-slate-800 dark:text-slate-100">
                                    @if (!empty($counterpart['avatar']))
                                        <img src="{{ $counterpart['avatar'] }}" alt="{{ $counterpart['name'] }}"
                                            class="h-full w-full object-cover">
                                    @else
                                        <span>{{ $counterpart['initials'] ?? '؟' }}</span>
                                    @endif
                                </div>
                                @if (!empty($counterpart['online']))
                                    <span
                                        class="absolute -bottom-0.5 -end-0.5 h-3 w-3 rounded-full border-2 border-white bg-emerald-500 dark:border-slate-950"></span>
                                @endif
                            </div>
                            <div>
                                <div class="font-semibold">
                                    {{ $counterpart['name'] ?? 'مستخدم بدون اسم' }}
                                </div>
                                <div class="text-xs text-emerald-600 dark:text-emerald-400">
                                    @if (!empty($counterpart['online']))
                                        متصل الآن
                                    @elseif (!empty($counterpart['last_seen_at']))
                                        آخر ظهور {{ Carbon::parse($counterpart['last_seen_at'])->diffForHumans() }}
                                    @else
                                        غير متصل
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="hidden sm:flex -space-x-3 rtl:space-x-reverse items-center">
                                @foreach ($participants as $participant)
                                    <span wire:key="participant-chip-{{ $participant['id'] }}"
                                        class="inline-grid h-7 w-7 place-items-center rounded-full bg-slate-200 text-[10px] font-bold text-slate-700 ring-2 ring-white dark:bg-slate-800 dark:text-slate-200 dark:ring-slate-950"
                                        title="{{ $participant['name'] }}">
                                        {{ $participant['initials'] ?? '؟' }}
                                    </span>
                                @endforeach
                            </div>
                            <button
                                type="button"
                                class="hidden sm:inline-flex items-center gap-2 rounded-xl border border-slate-200 px-3 py-1.5 text-sm text-slate-400 cursor-not-allowed bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-500"
                                disabled
                            >
                                <i class="ph-duotone ph-phone-call text-base"></i>
                                <span class="relative inline-flex items-center gap-1">
                                    <span class="rounded-full bg-amber-100 px-2 py-0.5 text-[10px] font-semibold text-amber-700 dark:bg-amber-900/30 dark:text-amber-200">
                                        قريباً
                                    </span>
                                </span>
                            </button>
                        </div>
                    </div>

                    @if (!empty($activeConversation['project']))
                        <div
                            class="mx-3 mt-3 rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs text-emerald-800 shadow-soft dark:border-emerald-900/40 dark:bg-emerald-900/20 dark:text-emerald-200">
                            <div class="font-semibold">
                                مشروع مرتبط: {{ $activeConversation['project']['title'] }}
                            </div>
                            <div class="mt-1">
                                <a href="{{ route('project', [$activeConversation['project']['id'], $activeConversation['project']['slug']]) }}"
                                    class="text-emerald-700 underline decoration-dotted dark:text-emerald-300">
                                    عرض التفاصيل
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="flex-1 min-h-0 overflow-hidden">
                        <div class="flex h-full flex-col overflow-hidden px-2 sm:px-4 py-6 bg-gradient-to-b from-slate-50/60 to-transparent dark:from-slate-900/40">
                            @if ($hasMoreMessages)
                                <div class="mb-4 flex shrink-0 justify-center">
                                    <button type="button" wire:click="loadMoreMessages" wire:loading.attr="disabled"
                                        wire:target="loadMoreMessages"
                                        class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-1.5 text-xs text-slate-500 shadow-sm hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300">
                                        <span wire:loading.remove wire:target="loadMoreMessages">تحميل رسائل أقدم…</span>
                                        <span wire:loading wire:target="loadMoreMessages" class="flex items-center gap-1">
                                            <span class="h-2 w-2 animate-ping rounded-full bg-indigo-500"></span>
                                            جاري التحميل…
                                        </span>
                                    </button>
                                </div>
                            @endif

                            <div id="chat-log" class="flex-1 min-h-0 space-y-6 overflow-y-auto pr-2 scrollbar-slim custom-chat-scroll">
                            @php
                                $currentDay = null;
                                $renderedNewMarker = false;
                            @endphp

                            @forelse ($messages as $message)
                                @php
                                    $timestamp = $message['time'] ?? null;
                                    $dateKey = $timestamp ? Carbon::parse($timestamp)->setTimezone(config('app.timezone'))->toDateString() : null;
                                @endphp

                                @if ($dateKey && $dateKey !== $currentDay)
                                    <div class="relative my-4 text-center text-xs text-slate-500">
                                        <span class="relative z-10 rounded-full bg-slate-100 px-3 py-1 dark:bg-slate-800">
                                            {{ Carbon::parse($timestamp)->setTimezone(config('app.timezone'))->translatedFormat('l j F Y') }}
                                        </span>
                                        <span class="absolute inset-0 top-1/2 -z-0 h-px bg-slate-200 dark:bg-slate-800"></span>
                                    </div>
                                    @php $currentDay = $dateKey; @endphp
                                @endif

                                @if (! $renderedNewMarker && ($message['is_new'] ?? false))
                                    <div class="relative my-4 text-center text-xs">
                                        <span class="relative z-10 rounded-full bg-amber-100 px-3 py-1 text-amber-800 dark:bg-amber-900/30 dark:text-amber-200">
                                            رسائل جديدة
                                        </span>
                                        <span class="absolute inset-0 top-1/2 -z-0 h-px bg-amber-200/60 dark:bg-amber-800/40"></span>
                                    </div>
                                    @php $renderedNewMarker = true; @endphp
                                @endif

                                @if ($message['from_me'])
                                    <div class="flex items-start justify-end gap-2.5" wire:key="message-{{ $message['id'] }}">
                                        <div class="flex max-w-[75%] flex-col items-end gap-1 text-right sm:max-w-[65%]">
                                            <div
                                                class="inline-block rounded-2xl rounded-tr-sm bg-indigo-600 px-4 py-2.5 text-sm leading-relaxed text-white shadow-sm dark:bg-indigo-500">
                                                @if (!empty($message['body_plain']))
                                                    <div class="whitespace-pre-wrap break-words">
                                                        {{ $message['body_plain'] }}
                                                    </div>
                                                @endif

                                                @if (!empty($message['attachments']))
                                                    <div class="mt-2.5 flex flex-wrap gap-2">
                                                        @foreach ($message['attachments'] as $attachment)
                                                            <a href="{{ $attachment['url'] ?? '#' }}" target="_blank"
                                                                class="inline-flex items-center gap-1.5 rounded-lg border border-indigo-300/50 bg-indigo-500/20 px-2.5 py-1.5 text-xs font-medium text-white/95 transition-colors hover:bg-indigo-500/30">
                                                                <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                                </svg>
                                                                <span class="max-w-[120px] truncate">{{ $attachment['name'] }}</span>
                                                                @if (!empty($attachment['size_human']))
                                                                    <span class="text-white/70">{{ $attachment['size_human'] }}</span>
                                                                @endif
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex items-center gap-1.5 text-[11px] text-slate-500 dark:text-slate-400">
                                                    @if (!empty($message['time_human']))
                                                        <span>{{ $message['time_human'] }}</span>
                                                    @endif
                                                <span class="text-slate-300 dark:text-slate-600">•</span>
                                                <span class="font-medium">{{ $stateLabels[$message['state']] ?? 'مرسل' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-start gap-2.5" wire:key="message-{{ $message['id'] }}">
                                        <div
                                            class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 text-xs font-semibold text-white shadow-sm dark:from-indigo-600 dark:to-purple-700">
                                            {{ $message['sender']['initials'] ?? '؟' }}
                                        </div>
                                        <div class="flex max-w-[75%] flex-col gap-1 sm:max-w-[65%]">
                                            <div
                                                class="inline-block rounded-2xl rounded-tl-sm border border-slate-200 bg-white px-4 py-2.5 text-sm leading-relaxed shadow-sm dark:border-slate-700 dark:bg-slate-900">
                                                @if (!empty($message['body_plain']))
                                                    <div class="whitespace-pre-wrap break-words text-slate-800 dark:text-slate-100">
                                                        {{ $message['body_plain'] }}
                                                    </div>
                                                @endif

                                                @if (!empty($message['attachments']))
                                                    <div class="mt-2.5 flex flex-wrap gap-2">
                                                        @foreach ($message['attachments'] as $attachment)
                                                            <a href="{{ $attachment['url'] ?? '#' }}" target="_blank"
                                                                class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-slate-50 px-2.5 py-1.5 text-xs font-medium text-slate-700 transition-colors hover:border-slate-300 hover:bg-slate-100 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:border-slate-600 dark:hover:bg-slate-700">
                                                                <svg class="h-3.5 w-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                                </svg>
                                                                <span class="max-w-[120px] truncate">{{ $attachment['name'] }}</span>
                                                                @if (!empty($attachment['size_human']))
                                                                    <span class="text-slate-500 dark:text-slate-400">{{ $attachment['size_human'] }}</span>
                                                                @endif
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                                @if (!empty($message['time_human']))
                                                <div class="text-[11px] text-slate-500 dark:text-slate-400">
                                                        {{ $message['time_human'] }}
                                                    </div>
                                                @endif
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="mt-10 text-center text-sm text-slate-500 dark:text-slate-400">
                                    لم تبدأ المحادثة بعد. اكتب رسالتك الأولى في الأسفل.
                                </div>
                            @endforelse
                            </div>
                        </div>
                    </div>

                    <div
                        class="sticky bottom-0 border-t border-slate-200 bg-white/98 p-3 sm:p-4 backdrop-blur-sm dark:border-slate-800 dark:bg-slate-950/98">
                        <form wire:submit.prevent="sendMessage" id="messageForm"
                            class="relative rounded-xl border border-slate-200 bg-white shadow-sm dark:border-slate-700 dark:bg-slate-900">
                            <div class="flex items-end gap-2 p-2"
                                @keydown.enter="if (event.shiftKey) { return; } event.preventDefault(); handleSendMessage();">

                                <label
                                    class="flex h-10 w-10 cursor-pointer items-center justify-center rounded-lg text-slate-500 transition-colors hover:bg-slate-100 hover:text-slate-700 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-200"
                                    title="إرفاق ملف">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                    </svg>
                                    <input id="attachInput" type="file" class="hidden" multiple
                                        accept="image/*,video/*,audio/*,application/pdf" wire:model="uploadQueue" />
                                </label>

                                <button
                                    type="button"
                                    id="voiceRecorderButton"
                                    class="flex h-10 w-10 items-center justify-center rounded-lg text-slate-500 transition-all hover:bg-slate-100 hover:text-rose-500 focus:outline-none focus-visible:ring-2 focus-visible:ring-rose-500 focus-visible:ring-offset-2 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-rose-400"
                                    title="تسجيل صوتي">
                                    <svg id="voiceRecorderIcon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                    </svg>
                                </button>
                                <input
                                    type="file"
                                    id="voiceRecorderFallback"
                                    class="hidden"
                                    accept="audio/*"
                                    wire:model="uploadQueue"
                                />

                                <div class="relative flex-1">
                                    <textarea 
                                        id="messageTextarea"
                                        wire:model.live="messageBody" 
                                        rows="1"
                                        class="w-full min-h-[44px] max-h-32 resize-none rounded-lg border-0 bg-slate-50 px-4 py-3 text-sm leading-6 text-slate-900 placeholder-slate-400 shadow-none outline-none transition-all focus:bg-white focus:ring-2 focus:ring-indigo-500 dark:bg-slate-800 dark:text-slate-100 dark:placeholder-slate-500 dark:focus:bg-slate-800 dark:focus:ring-indigo-400"
                                        placeholder="اكتب رسالة…"></textarea>
                                </div>

                                <button 
                                    type="submit" 
                                    id="sendButton"
                                    wire:loading.attr="disabled" 
                                    wire:target="sendMessage,uploadQueue"
                                    class="flex h-10 items-center justify-center rounded-lg bg-indigo-600 px-5 text-sm font-medium text-white shadow-sm transition-all hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                                    <span wire:loading.remove wire:target="sendMessage,uploadQueue" class="flex items-center gap-1.5">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                        <span>إرسال</span>
                                    </span>
                                    <span wire:loading wire:target="sendMessage,uploadQueue"
                                        class="flex items-center gap-2">
                                        <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span>جاري الإرسال…</span>
                                    </span>
                                </button>
                            </div>

                            <div id="voiceRecorderStatus" class="mx-2 mb-2 hidden text-xs font-medium"></div>
                            
                            <!-- Voice Recording Review Panel -->
                            <div id="voiceReviewPanel" class="mx-2 mb-2 hidden border-t border-slate-200 pt-3 dark:border-slate-700">
                                <div class="flex items-center gap-3 rounded-lg border border-slate-200 bg-slate-50 p-3 dark:border-slate-700 dark:bg-slate-800">
                                    <audio id="voiceReviewPlayer" controls class="flex-1 h-10" style="min-width: 200px;"></audio>
                                    <div class="flex items-center gap-2">
                                        <button type="button" id="voiceReviewSend" 
                                            class="flex items-center gap-1.5 rounded-lg bg-indigo-600 px-3 py-1.5 text-xs font-medium text-white transition-colors hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                            </svg>
                                            <span>إرسال</span>
                                        </button>
                                        <button type="button" id="voiceReviewDelete" 
                                            class="flex items-center gap-1.5 rounded-lg border border-slate-300 bg-white px-3 py-1.5 text-xs font-medium text-slate-700 transition-colors hover:bg-slate-50 dark:border-slate-600 dark:bg-slate-700 dark:text-slate-200 dark:hover:bg-slate-600">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <span>حذف</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            @if (!empty($uploadQueue))
                                <div class="border-t border-slate-200 p-2 dark:border-slate-700">
                                    <div class="flex flex-wrap gap-2">
                                    @foreach ($uploadQueue as $index => $file)
                                        <div wire:key="upload-{{ $index }}"
                                                class="group inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs text-slate-700 shadow-sm transition-all hover:border-slate-300 hover:bg-slate-100 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200 dark:hover:border-slate-600 dark:hover:bg-slate-700">
                                                <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <span class="max-w-[150px] truncate font-medium">{{ $file->getClientOriginalName() }}</span>
                                            <span class="text-slate-400">{{ format_bytes($file->getSize()) }}</span>
                                            <button type="button" wire:click="removeUpload({{ $index }})"
                                                    class="ml-1 rounded p-0.5 text-slate-400 transition-colors hover:bg-slate-200 hover:text-rose-500 dark:hover:bg-slate-600">
                                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="border-t border-slate-100 px-3 py-2 dark:border-slate-800">
                                <div class="flex items-center justify-between text-[11px] text-slate-500 dark:text-slate-400">
                                    <div class="flex items-center gap-1.5">
                                    @if (!empty($typing))
                                            <div class="flex gap-0.5">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse" style="animation-delay: 0.2s"></span>
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse" style="animation-delay: 0.4s"></span>
                                            </div>
                                            <span class="font-medium text-emerald-600 dark:text-emerald-400">
                                            {{ collect($typing)->pluck('name')->implode('، ') }} يكتب الآن…
                                        </span>
                                    @endif
                                </div>
                                    <div class="flex items-center gap-1.5">
                                        <kbd class="rounded border border-slate-300 bg-white px-1.5 py-0.5 text-[10px] font-medium text-slate-600 shadow-sm dark:border-slate-600 dark:bg-slate-800 dark:text-slate-300">Enter</kbd>
                                        <span>إرسال</span>
                                        <span class="text-slate-300 dark:text-slate-600">•</span>
                                        <kbd class="rounded border border-slate-300 bg-white px-1.5 py-0.5 text-[10px] font-medium text-slate-600 shadow-sm dark:border-slate-600 dark:bg-slate-800 dark:text-slate-300">Shift</kbd>
                                        <kbd class="rounded border border-slate-300 bg-white px-1.5 py-0.5 text-[10px] font-medium text-slate-600 shadow-sm dark:border-slate-600 dark:bg-slate-800 dark:text-slate-300">Enter</kbd>
                                        <span>سطر جديد</span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="flex flex-1 flex-col items-center justify-center gap-4 p-12 text-center">
                        <div
                            class="grid h-16 w-16 place-items-center rounded-full bg-indigo-50 text-2xl text-indigo-600 dark:bg-indigo-900/20 dark:text-indigo-300">
                            💬
                        </div>
                        <div class="space-y-2">
                            <div class="text-lg font-semibold text-slate-700 dark:text-slate-200">
                                اختر محادثة من القائمة اليسرى
                            </div>
                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                لم يتم تحديد محادثة بعد. عند الاختيار ستظهر الرسائل والمعلومات هنا.
                            </p>
                        </div>
                    </div>
                    <div id="realtimeStatus"
                        class="mx-3 mt-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-xs text-slate-600 dark:border-slate-700 dark:bg-slate-900/70 dark:text-slate-300"
                        data-state="connecting">
                        <span class="font-semibold text-slate-700 dark:text-slate-200">الرسائل الفورية</span>
                        <span class="status-text ms-2">نقوم بتهيئة الاتصال…</span>
                    </div>
                @endif
            </section>

            <aside id="detailsPanel"
                class="col-span-12 md:col-span-3 rounded-2xl border border-slate-200 bg-white p-3 dark:border-slate-800 dark:bg-slate-950 flex flex-col gap-3">
                @if ($activeConversationId)
                    <section class="mb-3">
                        <button type="button"
                            class="collapse-toggle flex w-full items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-slate-50 dark:hover:bg-slate-900"
                            data-target="#jobBody">
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500">الوظيفة</span>
                            </div>
                            <svg class="chev h-4 w-4 text-slate-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.586l3.71-3.355a.75.75 0 111.02 1.1l-4.2 3.8a.75.75 0 01-1.02 0l-4.2-3.8a.75.75 0 01-.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="jobBody"
                            class="collapse-body mt-2 rounded-xl border border-slate-200 p-3 text-sm dark:border-slate-700">
                            @if (!empty($activeConversation['project']))
                                <div class="font-semibold">{{ $activeConversation['project']['title'] }}</div>
                                <div class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                    معرف المشروع #{{ $activeConversation['project']['id'] }}
                                </div>
                            @else
                                <div class="text-xs text-slate-500 dark:text-slate-400">
                                    لا يوجد مشروع مرتبط بهذه المحادثة.
                                </div>
                            @endif
                        </div>
                    </section>

                    <section class="mb-4">
                        <button type="button"
                            class="collapse-toggle flex w-full items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-slate-50 dark:hover:bg-slate-900"
                            data-target="#membersBody">
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500">المشاركون</span>
                            </div>
                            <svg class="chev h-4 w-4 text-slate-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.586l3.71-3.355a.75.75 0 111.02 1.1l-4.2 3.8a.75.75 0 01-1.02 0l-4.2-3.8a.75.75 0 01-.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="membersBody" class="collapse-body mt-2 space-y-2">
                            @foreach ($participants as $participant)
                                <div wire:key="participant-row-{{ $participant['id'] }}"
                                    class="flex items-center justify-between rounded-xl border border-slate-200 px-3 py-2 text-sm dark:border-slate-700">
                                    <div class="flex items-center gap-3">
                                        <div class="relative">
                                            <div
                                                class="grid h-10 w-10 place-items-center rounded-full bg-slate-200 text-sm font-bold text-slate-700 dark:bg-slate-800 dark:text-slate-100">
                                                {{ $participant['initials'] ?? '؟' }}
                                            </div>
                                            @if (!empty($participant['online']))
                                                <span
                                                    class="absolute -bottom-0.5 -end-0.5 h-3 w-3 rounded-full border-2 border-white bg-emerald-500 dark:border-slate-950"></span>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-medium text-slate-700 dark:text-slate-200">
                                                {{ $participant['name'] }}</div>
                                            @if (!empty($participant['role']))
                                                <div class="text-xs text-slate-500 dark:text-slate-400">
                                                    {{ $participant['role'] === 'client' ? 'عميل' : 'مستقل' }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <span
                                        class="text-xs {{ !empty($participant['online']) ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-400 dark:text-slate-500' }}">
                                        {{ !empty($participant['online']) ? 'متصل' : 'غير متصل' }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <div class="flex flex-col gap-2">
                        <button
                            class="rounded-xl border border-slate-200 px-3 py-2 text-sm hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800">
                            فتح عقد
                        </button>
                        <button
                            class="rounded-xl border border-slate-200 px-3 py-2 text-sm hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800">
                            تثبيت المحادثة
                        </button>
                        <button
                            class="rounded-xl border border-rose-200 px-3 py-2 text-sm text-rose-600 hover:bg-rose-50 dark:border-rose-700/40 dark:hover:bg-rose-900/20">
                            إبلاغ/حظر
                        </button>
                    </div>
                @else
                    <div
                        class="rounded-2xl border border-dashed border-slate-200 px-4 py-6 text-center text-sm text-slate-500 dark:border-slate-700 dark:text-slate-400">
                        اختر محادثة لعرض تفاصيل المشاركين والمشروع.
                    </div>
                @endif
            </aside>
        </div>
    </main>
</div>

@push('scripts')
    <script>
        let chatResizeHandlerRegistered = false;

        const removeLayoutMinHeight = () => {
            const wrapper = document.querySelector('main > div.min-h-screen');

            if (wrapper) {
                wrapper.classList.remove('min-h-screen');
                wrapper.classList.add('h-full');
            }
        };

        // Voice recorder state - persistent across Livewire updates
        const voiceRecorderState = {
            recorder: null,
            stream: null,
            chunks: [],
            statusTimeout: null,
            recordingBlob: null,
            autoStopTimer: null,
            recordingStartTime: null,
            statusInterval: null,
            isInitialized: false,
            isProcessingStop: false,
            MAX_RECORDING_DURATION: 60000 // 60 seconds max
        };

        const setupVoiceRecorder = () => {
            const button = document.getElementById('voiceRecorderButton');
            const status = document.getElementById('voiceRecorderStatus');
            const fallbackInput = document.getElementById('voiceRecorderFallback');

            if (!button) {
                console.warn('[Voice Recorder] Button not found');
                return false;
            }

            // Skip if already initialized and button is still bound
            if (button.dataset.recorderBound === 'true' && voiceRecorderState.isInitialized) {
                console.log('[Voice Recorder] Already initialized');
                return true;
            }

            // If button was recreated by Livewire, we need to re-attach listeners
            if (button.dataset.recorderBound === 'true') {
                console.log('[Voice Recorder] Button recreated, re-initializing...');
                button.dataset.recorderBound = 'false';
            }

            const toneClasses = {
                info: ['text-slate-500', 'dark:text-slate-400'],
                success: ['text-emerald-600', 'dark:text-emerald-400'],
                error: ['text-rose-600', 'dark:text-rose-400'],
            };

            const updateStatus = (message = null, tone = 'info') => {
                if (!status) {
                    return;
                }

                if (voiceRecorderState.statusTimeout) {
                    window.clearTimeout(voiceRecorderState.statusTimeout);
                }
                status.classList.add('hidden');
                status.classList.remove(
                    'text-slate-500',
                    'dark:text-slate-400',
                    'text-emerald-600',
                    'dark:text-emerald-400',
                    'text-rose-600',
                    'dark:text-rose-400'
                );

                if (!message) {
                    status.textContent = '';
                    return;
                }

                status.textContent = message;
                status.classList.remove('hidden');
                status.classList.add(...(toneClasses[tone] ?? toneClasses.info));

                if (tone === 'success') {
                    voiceRecorderState.statusTimeout = window.setTimeout(() => updateStatus(null), 4000);
                }
            };

            const setButtonState = (state) => {
                const currentButton = document.getElementById('voiceRecorderButton');
                const icon = document.getElementById('voiceRecorderIcon');
                if (!currentButton || !icon) return;
                
                currentButton.dataset.state = state;
                currentButton.classList.remove(
                    'text-rose-600',
                    'bg-rose-50',
                    'dark:text-rose-300',
                    'dark:bg-rose-900/30',
                    'animate-pulse',
                    'cursor-wait',
                    'opacity-60',
                    'ring-2',
                    'ring-rose-500'
                );

                if (state === 'recording') {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />';
                    currentButton.classList.add('text-rose-600', 'bg-rose-50', 'dark:text-rose-300', 'dark:bg-rose-900/30', 'animate-pulse', 'ring-2', 'ring-rose-500');
                } else if (state === 'uploading') {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />';
                    currentButton.classList.add('cursor-wait', 'opacity-60');
                } else {
                    icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />';
                }
            };

            const cleanupStream = () => {
                console.log('[Voice Recorder] Cleaning up stream and timers');
                
                // Stop all media tracks
                if (voiceRecorderState.stream) {
                    voiceRecorderState.stream.getTracks().forEach((track) => {
                        track.stop();
                        console.log('[Voice Recorder] Track stopped:', track.kind, track.readyState);
                    });
                    voiceRecorderState.stream = null;
                }
                
                // Clear auto-stop timer
                if (voiceRecorderState.autoStopTimer) {
                    clearTimeout(voiceRecorderState.autoStopTimer);
                    voiceRecorderState.autoStopTimer = null;
                }
                
                // Clear status interval
                if (voiceRecorderState.statusInterval) {
                    clearInterval(voiceRecorderState.statusInterval);
                    voiceRecorderState.statusInterval = null;
                }
                
                // Ensure recorder is stopped
                if (voiceRecorderState.recorder) {
                    if (voiceRecorderState.recorder.state === 'recording') {
                        console.warn('[Voice Recorder] Recorder still recording during cleanup, forcing stop');
                        try {
                            voiceRecorderState.recorder.stop();
                        } catch (e) {
                            console.error('[Voice Recorder] Error stopping recorder in cleanup:', e);
                        }
                    }
                }
            };

            const showReviewPanel = (blob) => {
                console.log('[Voice Recorder] Showing review panel with blob size:', blob.size);
                
                const reviewPanel = document.getElementById('voiceReviewPanel');
                const audioPlayer = document.getElementById('voiceReviewPlayer');
                const sendBtn = document.getElementById('voiceReviewSend');
                const deleteBtn = document.getElementById('voiceReviewDelete');
                
                if (!reviewPanel || !audioPlayer) {
                    console.error('[Voice Recorder] Review panel elements not found!', {
                        reviewPanel: !!reviewPanel,
                        audioPlayer: !!audioPlayer
                    });
                    return;
                }
                
                // Ensure recording is actually stopped
                if (voiceRecorderState.recorder && voiceRecorderState.recorder.state === 'recording') {
                    console.warn('[Voice Recorder] Recorder still recording, forcing stop...');
                    try {
                        voiceRecorderState.recorder.stop();
                    } catch (e) {
                        console.error('[Voice Recorder] Error forcing stop:', e);
                    }
                }
                
                // Clean up previous blob URL if exists
                if (audioPlayer.src && audioPlayer.src.startsWith('blob:')) {
                    URL.revokeObjectURL(audioPlayer.src);
                }
                
                // Create object URL for playback
                const audioUrl = URL.createObjectURL(blob);
                audioPlayer.src = audioUrl;
                voiceRecorderState.recordingBlob = blob;
                
                // Show the review panel - use setTimeout to ensure DOM is ready
                setTimeout(() => {
                    reviewPanel.classList.remove('hidden');
                    console.log('[Voice Recorder] Review panel shown');
                    
                    // Remove old event listeners and add new ones
                    if (sendBtn && deleteBtn) {
                        const newSendBtn = sendBtn.cloneNode(true);
                        sendBtn.parentNode.replaceChild(newSendBtn, sendBtn);
                        const newDeleteBtn = deleteBtn.cloneNode(true);
                        deleteBtn.parentNode.replaceChild(newDeleteBtn, deleteBtn);
                        
                        // Get new references
                        const updatedSendBtn = document.getElementById('voiceReviewSend');
                        const updatedDeleteBtn = document.getElementById('voiceReviewDelete');
                        
                        // Handle send button
                        if (updatedSendBtn) {
                            updatedSendBtn.onclick = (e) => {
                                e.preventDefault();
                                e.stopPropagation();
                                console.log('[Voice Recorder] Send button clicked');
                                if (voiceRecorderState.recordingBlob) {
                                    uploadBlob(voiceRecorderState.recordingBlob);
                                    hideReviewPanel();
                                }
                            };
                        }
                        
                        // Handle delete button
                        if (updatedDeleteBtn) {
                            updatedDeleteBtn.onclick = (e) => {
                                e.preventDefault();
                                e.stopPropagation();
                                console.log('[Voice Recorder] Delete button clicked');
                                hideReviewPanel();
                                voiceRecorderState.recordingBlob = null;
                                voiceRecorderState.chunks = [];
                                updateStatus('تم حذف التسجيل.', 'info');
                            };
                        }
                    }
                }, 100);
            };

            const hideReviewPanel = () => {
                console.log('[Voice Recorder] Hiding review panel');
                const reviewPanel = document.getElementById('voiceReviewPanel');
                const audioPlayer = document.getElementById('voiceReviewPlayer');
                
                if (reviewPanel) {
                    reviewPanel.classList.add('hidden');
                }
                
                if (audioPlayer) {
                    audioPlayer.pause();
                    if (audioPlayer.src && audioPlayer.src.startsWith('blob:')) {
                        URL.revokeObjectURL(audioPlayer.src);
                    }
                    audioPlayer.src = '';
                }
                
                voiceRecorderState.recordingBlob = null;
            };

            const getComponent = () => {
                const currentButton = document.getElementById('voiceRecorderButton');
                if (!currentButton) return null;
                const root = currentButton.closest('[wire\\:id]');
                return root ? window.Livewire?.find(root.getAttribute('wire:id')) : null;
            };

            const uploadBlob = (blob) => {
                const component = getComponent();

                if (!component) {
                    updateStatus('تعذر الوصول إلى المحادثة. أعد تحميل الصفحة.', 'error');
                    setButtonState('idle');
                    return;
                }

                setButtonState('uploading');
                updateStatus('جاري رفع التسجيل…', 'info');

                const file = new File([blob], `voice-message-${Date.now()}.webm`, {
                    type: blob.type || 'audio/webm',
                    lastModified: Date.now(),
                });

                // Use file input with DataTransfer - most reliable method for Livewire
                try {
                    let uploadFinished = false;
                    const initialQueueLength = (component.get('uploadQueue') || []).length;
                    
                    const finishCallback = () => {
                        if (uploadFinished) return;
                        uploadFinished = true;
                        setButtonState('idle');
                        updateStatus('تمت إضافة التسجيل. يمكنك إرساله الآن.', 'success');
                        voiceRecorderState.chunks = [];
                        voiceRecorderState.recordingBlob = null;
                        hideReviewPanel();
                    };
                    
                    const errorCallback = () => {
                        if (uploadFinished) return;
                        uploadFinished = true;
                        setButtonState('idle');
                        updateStatus('تعذر رفع التسجيل. حاول مرة أخرى.', 'error');
                        voiceRecorderState.chunks = [];
                    };
                    
                    // Use the attach input which is already bound to wire:model="uploadQueue"
                    const attachInput = document.getElementById('attachInput');
                    if (!attachInput) {
                        throw new Error('Attach input not found');
                    }
                    
                    // Create DataTransfer and add the file
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    
                    // Set files on input (this will replace existing, but Livewire handles merging)
                    attachInput.files = dataTransfer.files;
                    
                    // Set up event listeners BEFORE dispatching
                    const handleFinish = (e) => {
                        if (uploadFinished) return;
                        // Accept event if it's for our component and property, or if detail is missing (some Livewire versions)
                        if (!e.detail || (e.detail.id === component.id && e.detail.property === 'uploadQueue')) {
                            uploadFinished = true;
                            finishCallback();
                        }
                    };
                    
                    const handleError = (e) => {
                        if (uploadFinished) return;
                        if (!e.detail || (e.detail.id === component.id && e.detail.property === 'uploadQueue')) {
                            uploadFinished = true;
                            errorCallback();
                        }
                    };
                    
                    // Listen on multiple levels for better compatibility
                    attachInput.addEventListener('livewire-upload-finish', handleFinish, { once: true });
                    attachInput.addEventListener('livewire-upload-error', handleError, { once: true });
                    document.addEventListener('livewire-upload-finish', handleFinish, { once: true });
                    document.addEventListener('livewire-upload-error', handleError, { once: true });
                    
                    // Also listen for the start event to confirm upload began
                    attachInput.addEventListener('livewire-upload-start', () => {
                        updateStatus('جاري رفع التسجيل…', 'info');
                    }, { once: true });
                    
                    // Dispatch change event to trigger Livewire upload
                    const changeEvent = new Event('change', { 
                        bubbles: true, 
                        cancelable: true 
                    });
                    attachInput.dispatchEvent(changeEvent);
                    
                    // Fallback: Poll uploadQueue to check if file was added
                    let checkCount = 0;
                    const maxChecks = 10;
                    const checkInterval = setInterval(() => {
                        if (uploadFinished) {
                            clearInterval(checkInterval);
                            return;
                        }
                        
                        checkCount++;
                        if (checkCount >= maxChecks) {
                            clearInterval(checkInterval);
                            if (!uploadFinished) {
                                // Final check
                                try {
                                    const finalQueue = component.get('uploadQueue') || [];
                                    if (Array.isArray(finalQueue) && finalQueue.length > initialQueueLength) {
                                        finishCallback();
                                    } else {
                                        errorCallback();
                                    }
                                } catch (e) {
                                    errorCallback();
                                }
                            }
                            return;
                        }
                        
                        try {
                            const queue = component.get('uploadQueue') || [];
                            if (Array.isArray(queue) && queue.length > initialQueueLength) {
                                clearInterval(checkInterval);
                                finishCallback();
                            }
                        } catch (e) {
                            // Component might not be ready yet
                        }
                    }, 300);
                    
                } catch (error) {
                    console.error('[Voice Recorder] Upload error:', error);
                    setButtonState('idle');
                    updateStatus('تعذر رفع التسجيل: ' + (error.message || 'خطأ غير معروف'), 'error');
                    voiceRecorderState.chunks = [];
                }
            };

            const triggerFallback = () => {
                if (fallbackInput) {
                    fallbackInput.click();
                    updateStatus('اختر ملفاً صوتياً من جهازك.', 'info');
                } else {
                    updateStatus('يمكنك رفع ملف صوتي يدوياً من زر الإرفاق.', 'info');
                }
            };

            // Add click event listener
            const handleButtonClick = async (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                const currentButton = document.getElementById('voiceRecorderButton');
                if (!currentButton) {
                    console.error('[Voice Recorder] Button not found in click handler');
                    return;
                }
                
                console.log('[Voice Recorder] Button clicked');
                const currentState = currentButton.dataset.state || 'idle';
                console.log('[Voice Recorder] Current state:', currentState);

                if (currentState === 'recording') {
                    console.log('[Voice Recorder] Stop requested, current recorder state:', voiceRecorderState.recorder?.state);
                    
                    // Stop status interval immediately
                    if (voiceRecorderState.statusInterval) {
                        clearInterval(voiceRecorderState.statusInterval);
                        voiceRecorderState.statusInterval = null;
                    }
                    
                    // Stop auto-stop timer
                    if (voiceRecorderState.autoStopTimer) {
                        clearTimeout(voiceRecorderState.autoStopTimer);
                        voiceRecorderState.autoStopTimer = null;
                    }
                    
                        updateStatus('جاري إنهاء التسجيل…', 'info');
                        setButtonState('uploading');
                    
                    if (voiceRecorderState.recorder) {
                        try {
                            // Check if recorder is actually recording
                            if (voiceRecorderState.recorder.state === 'recording') {
                                console.log('[Voice Recorder] Stopping recorder...');
                                voiceRecorderState.recorder.stop();
                            } else if (voiceRecorderState.recorder.state === 'paused') {
                                console.log('[Voice Recorder] Resuming then stopping...');
                                voiceRecorderState.recorder.resume();
                                setTimeout(() => {
                                    if (voiceRecorderState.recorder && voiceRecorderState.recorder.state === 'recording') {
                                        voiceRecorderState.recorder.stop();
                                    }
                                }, 100);
                            } else {
                                console.log('[Voice Recorder] Recorder already stopped, state:', voiceRecorderState.recorder.state);
                                // Force cleanup and show review if we have chunks
                                cleanupStream();
                                setButtonState('idle');
                                if (voiceRecorderState.chunks.length > 0) {
                                    const mimeType = voiceRecorderState.recorder.mimeType || 'audio/webm';
                                    const blob = new Blob(voiceRecorderState.chunks, { type: mimeType });
                                    if (blob.size >= 100) {
                                        showReviewPanel(blob);
                                    }
                                }
                            }
                        } catch (error) {
                            console.error('[Voice Recorder] Error stopping recorder:', error);
                            // Force cleanup on error
                            cleanupStream();
                            setButtonState('idle');
                            updateStatus('تعذر إيقاف التسجيل.', 'error');
                        }
                    } else {
                        console.warn('[Voice Recorder] No recorder instance found');
                        cleanupStream();
                        setButtonState('idle');
                    }
                    return;
                }

                // Prevent starting new recording if one is already in progress
                if (voiceRecorderState.recorder && voiceRecorderState.recorder.state === 'recording') {
                    console.warn('[Voice Recorder] Already recording, ignoring start request');
                    return;
                }
                
                // If there's a review panel showing, don't start new recording
                const reviewPanel = document.getElementById('voiceReviewPanel');
                if (reviewPanel && !reviewPanel.classList.contains('hidden') && voiceRecorderState.recordingBlob) {
                    console.log('[Voice Recorder] Review panel is showing, please finish current recording first');
                    updateStatus('يرجى إنهاء التسجيل الحالي أولاً (إرسال أو حذف)', 'info');
                    return;
                }

                if (!navigator.mediaDevices?.getUserMedia || typeof window.MediaRecorder === 'undefined') {
                    console.warn('[Voice Recorder] MediaRecorder API not available');
                    updateStatus('التسجيل الصوتي غير مدعوم في هذا المتصفح. سيتم فتح اختيار ملفات.', 'error');
                    triggerFallback();
                    return;
                }

                try {
                    console.log('[Voice Recorder] Requesting microphone access...');
                    voiceRecorderState.stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                    console.log('[Voice Recorder] Microphone access granted');
                } catch (error) {
                    console.error('[Voice Recorder] Microphone access error:', error);
                    updateStatus('تم رفض الوصول إلى الميكروفون. سيتم فتح اختيار ملفات.', 'error');
                    triggerFallback();
                    return;
                }

                // Reset state for new recording
                voiceRecorderState.chunks = [];
                voiceRecorderState.isProcessingStop = false;
                voiceRecorderState.recordingBlob = null;
                
                // Clean up any previous recorder
                if (voiceRecorderState.recorder) {
                    try {
                        if (voiceRecorderState.recorder.state === 'recording') {
                            voiceRecorderState.recorder.stop();
                        }
                    } catch (e) {
                        // Ignore
                    }
                }

                try {
                    // Try to use the best available mime type
                    const options = { mimeType: 'audio/webm' };
                    if (!MediaRecorder.isTypeSupported(options.mimeType)) {
                        options.mimeType = 'audio/webm;codecs=opus';
                        if (!MediaRecorder.isTypeSupported(options.mimeType)) {
                            options.mimeType = 'audio/ogg;codecs=opus';
                            if (!MediaRecorder.isTypeSupported(options.mimeType)) {
                                delete options.mimeType; // Use default
                            }
                        }
                    }
                    
                    voiceRecorderState.recorder = new MediaRecorder(voiceRecorderState.stream, options);
                    console.log('[Voice Recorder] MediaRecorder created with mimeType:', voiceRecorderState.recorder.mimeType);
                } catch (error) {
                    cleanupStream();
                    updateStatus('تعذر تهيئة جهاز التسجيل.', 'error');
                    console.error('[Voice Recorder] MediaRecorder error:', error);
                    return;
                }

                voiceRecorderState.recorder.addEventListener('dataavailable', (event) => {
                    if (event.data && event.data.size > 0) {
                        voiceRecorderState.chunks.push(event.data);
                        console.log('[Voice Recorder] Data chunk received:', event.data.size, 'bytes, total chunks:', voiceRecorderState.chunks.length);
                    }
                });

                voiceRecorderState.recorder.addEventListener('error', (error) => {
                    console.error('[Voice Recorder] Recorder error:', error);
                    cleanupStream();
                    updateStatus('حدث خطأ أثناء التسجيل.', 'error');
                    setButtonState('idle');
                });

                voiceRecorderState.recorder.addEventListener('stop', () => {
                    if (voiceRecorderState.isProcessingStop) {
                        console.log('[Voice Recorder] Stop event already being processed, ignoring duplicate');
                        return;
                    }
                    
                    voiceRecorderState.isProcessingStop = true;
                    console.log('[Voice Recorder] Stop event fired');
                    console.log('[Voice Recorder] Chunks count:', voiceRecorderState.chunks.length);
                    console.log('[Voice Recorder] Recorder state after stop:', voiceRecorderState.recorder?.state);
                    
                    // Stop status interval if still running
                    if (voiceRecorderState.statusInterval) {
                        clearInterval(voiceRecorderState.statusInterval);
                        voiceRecorderState.statusInterval = null;
                    }
                    
                    // Stop auto-stop timer if still running
                    if (voiceRecorderState.autoStopTimer) {
                        clearTimeout(voiceRecorderState.autoStopTimer);
                        voiceRecorderState.autoStopTimer = null;
                    }
                    
                    // Cleanup stream immediately to stop microphone
                    if (voiceRecorderState.stream) {
                        voiceRecorderState.stream.getTracks().forEach((track) => {
                            track.stop();
                            console.log('[Voice Recorder] Track stopped in stop event:', track.kind);
                        });
                        voiceRecorderState.stream = null;
                    }
                    
                    // Set button to idle immediately
                        setButtonState('idle');

                    // Wait for all chunks to be collected (MediaRecorder may send final chunk after stop)
                    const processRecording = () => {
                        console.log('[Voice Recorder] Processing chunks, total:', voiceRecorderState.chunks.length);
                        
                        if (!voiceRecorderState.chunks.length) {
                            updateStatus('لم يتم التقاط أي صوت.', 'error');
                            voiceRecorderState.isProcessingStop = false;
                        return;
                    }

                        // Determine the correct mime type
                        let mimeType = voiceRecorderState.recorder?.mimeType || 'audio/webm';
                        if (!mimeType || mimeType === '') {
                            mimeType = 'audio/webm';
                        }

                        const blob = new Blob(voiceRecorderState.chunks, { type: mimeType });
                        console.log('[Voice Recorder] Blob created:', blob.size, 'bytes, type:', blob.type);

                        if (!blob.size || blob.size < 100) {
                            updateStatus('التسجيل قصير جداً. يرجى المحاولة مرة أخرى.', 'error');
                            voiceRecorderState.chunks = [];
                            voiceRecorderState.isProcessingStop = false;
                        return;
                    }

                        // Show review panel instead of uploading immediately
                        updateStatus('تم التسجيل. راجع التسجيل قبل الإرسال.', 'success');
                        showReviewPanel(blob);
                        voiceRecorderState.isProcessingStop = false;
                    };
                    
                    // Process immediately, but also check again after a short delay in case more chunks arrive
                    processRecording();
                    setTimeout(processRecording, 300); // Check again after 300ms for any final chunks
                });

                try {
                    // Start recording with timeslice to ensure data is available
                    console.log('[Voice Recorder] Starting recorder...');
                    voiceRecorderState.recorder.start(100); // Collect data every 100ms
                    setButtonState('recording');
                    voiceRecorderState.recordingStartTime = Date.now();
                    
                    // Don't hide review panel if we're starting a new recording - let user finish current one first
                    // Only hide if there's no active recording blob
                    if (!voiceRecorderState.recordingBlob) {
                        hideReviewPanel();
                    }
                    
                    // Set up automatic stop after max duration
                    voiceRecorderState.autoStopTimer = setTimeout(() => {
                        if (voiceRecorderState.recorder && voiceRecorderState.recorder.state === 'recording') {
                            console.log('[Voice Recorder] Auto-stopping after max duration');
                            updateStatus('تم الوصول للحد الأقصى. جاري إيقاف التسجيل...', 'info');
                            try {
                                voiceRecorderState.recorder.stop();
                } catch (error) {
                                console.error('[Voice Recorder] Error auto-stopping:', error);
                            }
                        }
                    }, voiceRecorderState.MAX_RECORDING_DURATION);
                    
                    // Update status with timer
                    voiceRecorderState.statusInterval = setInterval(() => {
                        const currentButton = document.getElementById('voiceRecorderButton');
                        const currentState = currentButton?.dataset.state || 'idle';
                        
                        // Only update if we're actually recording
                        if (voiceRecorderState.recorder && 
                            voiceRecorderState.recorder.state === 'recording' && 
                            currentState === 'recording') {
                            const elapsedSeconds = Math.floor((Date.now() - voiceRecorderState.recordingStartTime) / 1000);
                            const remaining = Math.max(0, Math.floor((voiceRecorderState.MAX_RECORDING_DURATION - (Date.now() - voiceRecorderState.recordingStartTime)) / 1000));
                            updateStatus(`جاري التسجيل… (${elapsedSeconds}ث) - متبقي ${remaining}ث - انقر لإيقافه`, 'info');
                        } else {
                            // Stop the interval if recording stopped
                            console.log('[Voice Recorder] Status interval stopping, recorder state:', voiceRecorderState.recorder?.state, 'button state:', currentState);
                            if (voiceRecorderState.statusInterval) {
                                clearInterval(voiceRecorderState.statusInterval);
                                voiceRecorderState.statusInterval = null;
                            }
                        }
                    }, 1000);
                    
                    console.log('[Voice Recorder] Recorder started successfully');
                } catch (error) {
                    console.error('[Voice Recorder] Start error:', error);
                    cleanupStream();
                    setButtonState('idle');
                    updateStatus('تعذر بدء التسجيل: ' + (error.message || 'خطأ غير معروف'), 'error');
                }
            };

            // Remove any existing click listeners
            const newButton = button.cloneNode(true);
            button.parentNode.replaceChild(newButton, button);
            const updatedButton = document.getElementById('voiceRecorderButton');
            
            if (!updatedButton) {
                console.error('[Voice Recorder] Failed to get updated button');
                return false;
            }
            
            updatedButton.addEventListener('click', handleButtonClick);

            window.addEventListener('beforeunload', () => {
                if (voiceRecorderState.recorder && voiceRecorderState.recorder.state === 'recording') {
                    try {
                        voiceRecorderState.recorder.stop();
                    } catch (error) {
                        // ignore
                    }
                }
                cleanupStream();
            }, { once: true });

            updatedButton.dataset.recorderBound = 'true';
            voiceRecorderState.isInitialized = true;
            setButtonState('idle');
            updateStatus(null);
            console.log('[Voice Recorder] Initialized successfully');

            if (fallbackInput) {
                fallbackInput.addEventListener('change', () => {
                    if (fallbackInput.files && fallbackInput.files.length) {
                        updateStatus('تم اختيار ملف صوتي. أرسله الآن.', 'success');
                    }
                });
            }
            
            return true;
        };

        // Optimistic message sending handler
        window.handleSendMessage = function() {
            const form = document.getElementById('messageForm');
            const textarea = document.getElementById('messageTextarea');
            const sendButton = document.getElementById('sendButton');
            
            if (!form || !textarea) return;
            
            const messageBody = textarea.value.trim();
            const component = window.Livewire?.find(form.closest('[wire\\:id]')?.getAttribute('wire:id'));
            const uploadQueue = component?.get('uploadQueue') || [];
            
            // Don't send if empty
            if (!messageBody && (!uploadQueue || uploadQueue.length === 0)) {
                return;
            }
            
            // Disable send button immediately for better UX
            if (sendButton) {
                sendButton.disabled = true;
            }
            
            // Reset textarea height
            if (textarea) {
                textarea.style.height = 'auto';
            }
            
            // Trigger Livewire submit (component will clear the textarea via wire:model)
            form.dispatchEvent(new Event('submit', { bubbles: true, cancelable: true }));
        };

        // Initialize voice recorder on page load
        const initializeVoiceRecorder = () => {
            // Wait a bit for DOM to be ready
            setTimeout(() => {
                setupVoiceRecorder();
            }, 100);
        };

        // Initialize on DOM ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeVoiceRecorder);
        } else {
            initializeVoiceRecorder();
        }

        document.addEventListener('livewire:load', () => {
            const fitChatHeight = () => {
                const container = document.getElementById('chat-log');

                if (!container || !container.parentElement) {
                    return;
                }

                const parentBox = container.parentElement.getBoundingClientRect();
                container.style.maxHeight = `${parentBox.height}px`;
            };

        removeLayoutMinHeight();

        requestAnimationFrame(() => {
            window.dispatchEvent(new CustomEvent('chat:scroll-bottom'));
        });

            // Initialize voice recorder
            initializeVoiceRecorder();
            
            // Auto-resize textarea
            const textarea = document.getElementById('messageTextarea');
            if (textarea) {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = Math.min(this.scrollHeight, 128) + 'px';
                });
            }

        if (window.Livewire?.hook) {
            window.Livewire.hook('message.processed', (message, component) => {
                if (component?.fingerprint?.name === 'main.conversations.workspace-component') {
                        // Re-initialize voice recorder after Livewire updates
                        initializeVoiceRecorder();
                    removeLayoutMinHeight();
                        
                        // Re-enable send button after message is processed
                        const sendButton = document.getElementById('sendButton');
                        if (sendButton) {
                            sendButton.disabled = false;
                        }
                        
                    requestAnimationFrame(() => {
                        window.dispatchEvent(new CustomEvent('chat:scroll-bottom'));
                    });
                }
            });
                
                // Also hook into component updates
                window.Livewire.hook('morph.updated', ({ el, component }) => {
                    if (component?.fingerprint?.name === 'main.conversations.workspace-component') {
                        // Check if voice recorder button exists and re-initialize if needed
                        const button = document.getElementById('voiceRecorderButton');
                        if (button && button.dataset.recorderBound !== 'true') {
                            initializeVoiceRecorder();
                        }
                    }
                });
                
                // Handle message sending errors
                window.Livewire.hook('message.failed', (message, component) => {
                    if (component?.fingerprint?.name === 'main.conversations.workspace-component') {
                        const sendButton = document.getElementById('sendButton');
                        if (sendButton) {
                            sendButton.disabled = false;
                        }
                }
            });
        }
    });

        window.addEventListener('chat:scroll-bottom', () => {
            const log = document.getElementById('chat-log');

            if (!log) {
                return;
            }

            requestAnimationFrame(() => {
                log.scrollTop = log.scrollHeight;
            });
        });

        document.addEventListener('livewire:load', () => {
            const statusWrapper = document.getElementById('realtimeStatus');
            if (!statusWrapper) {
                return;
            }

            const statusText = statusWrapper.querySelector('.status-text');
            const baseClasses = [
                'border-slate-200',
                'bg-slate-50',
                'dark:bg-slate-900/70',
                'dark:border-slate-700',
                'border-emerald-200',
                'bg-emerald-50',
                'dark:bg-emerald-900/20',
                'dark:border-emerald-900/40',
                'border-rose-200',
                'bg-rose-50',
                'dark:bg-rose-900/20',
                'dark:border-rose-900/40',
                'text-slate-600',
                'dark:text-slate-300',
                'text-emerald-700',
                'dark:text-emerald-300',
                'text-rose-700',
                'dark:text-rose-300',
            ];

            const updateStatus = (state) => {
                const isOnline = state === 'connected';
                statusWrapper.dataset.state = state;
                statusWrapper.classList.remove(...baseClasses);
                statusWrapper.classList.add('rounded-xl', 'px-3', 'py-2', 'text-xs');

                statusWrapper.classList.add('mx-3', 'mt-3', 'rounded-xl', 'px-3', 'py-2', 'text-xs');

                if (isOnline) {
                    statusWrapper.classList.add(
                        'border-emerald-200',
                        'bg-emerald-50',
                        'dark:bg-emerald-900/20',
                        'dark:border-emerald-900/40',
                        'text-emerald-700',
                        'dark:text-emerald-300'
                    );
                } else {
                    statusWrapper.classList.add(
                        'border-rose-200',
                        'bg-rose-50',
                        'dark:bg-rose-900/20',
                        'dark:border-rose-900/40',
                        'text-rose-700',
                        'dark:text-rose-300'
                    );
                }

                if (statusText) {
                    statusText.textContent = isOnline
                        ? 'متصل — الرسائل تنتقل فورياً.'
                        : 'الاتصال الفوري غير متاح الآن، ستحتاج لتحديث الصفحة للحصول على الرسائل الجديدة.';
                }
            };

            const connector = window.Echo?.connector;
            const connection =
                connector?.connection
                ?? connector?.pusher?.connection
                ?? null;

            if (!connector || !connection) {
                updateStatus('offline');

                const handler = () => updateStatus('connected');

                window.addEventListener('echo:connected', handler, { once: true });

                return;
            }

            const connectionState = connection.state ?? connector?.state;
            updateStatus(connectionState === 'connected' ? 'connected' : 'connecting');

            const setConnected = () => updateStatus('connected');
            const setDisconnected = () => updateStatus('offline');

            connection.bind('connected', setConnected);
            connection.bind('disconnected', setDisconnected);
            connection.bind('unavailable', setDisconnected);
            connection.bind('failed', setDisconnected);

            window.addEventListener('beforeunload', () => {
                connection.unbind('connected', setConnected);
                connection.unbind('disconnected', setDisconnected);
                connection.unbind('unavailable', setDisconnected);
                connection.unbind('failed', setDisconnected);
            });
        });

    </script>
@endpush
