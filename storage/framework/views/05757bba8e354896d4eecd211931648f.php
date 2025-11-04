<?php
    use Carbon\Carbon;
?>

<?php $__env->startSection('hideMainFooter', true); ?>

<div class="w-[95%] max-w-[1600px] mx-auto px-4 sm:px-6 mt-[7rem] lg:px-8 pb-6 flex flex-col min-h-[calc(100vh-6rem)]">
    <main class="flex-1 flex flex-col min-h-0">
        <div id="grid" class="grid grid-cols-12 gap-4 flex-1 min-h-0">
            <aside id="sidebar" class="col-span-12 md:col-span-3 rounded-2xl border border-slate-200 bg-white p-3 dark:border-slate-800 dark:bg-slate-950 md:block hidden">
                <div class="mb-3 flex items-center gap-2">
                    <input
                        type="search"
                        wire:model.debounce.400ms="search"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900"
                        placeholder="ابحث عن محادثة أو مستخدم…"
                        autocomplete="off"
                    />
                    <button
                        type="button"
                        wire:click="refreshConversations"
                        class="rounded-xl border border-slate-200 px-3 py-2 text-sm hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800"
                    >
                        بحث
                    </button>
                </div>

                <div class="mb-3 flex flex-wrap items-center gap-2 text-[11px]">
                    <span class="inline-flex items-center gap-1 rounded-full border px-2.5 py-1 border-indigo-300 bg-indigo-50 text-indigo-700 dark:border-indigo-900/40 dark:bg-indigo-900/20 dark:text-indigo-300">
                        الكل
                    </span>
                    <span class="inline-flex items-center gap-1 rounded-full border px-2.5 py-1 border-slate-200 bg-slate-50 text-slate-400 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-600">
                        غير مقروء
                    </span>
                    <span class="inline-flex items-center gap-1 rounded-full border px-2.5 py-1 border-slate-200 bg-slate-50 text-slate-400 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-600">
                        مثبّت
                    </span>
                    <span class="inline-flex items-center gap-1 rounded-full border px-2.5 py-1 border-slate-200 bg-slate-50 text-slate-400 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-600">
                        مكتوم
                    </span>
                </div>

                <div class="space-y-1">
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $conversations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conversation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $isActive = $conversation['id'] === $activeConversationId;
                            $unread = (int) ($conversation['unread'] ?? 0);
                        ?>
                        <button
                            type="button"
                            wire:key="conversation-<?php echo e($conversation['id'], false); ?>"
                            wire:click="selectConversation('<?php echo e($conversation['uid'], false); ?>')"
                            class="group w-full rounded-2xl px-3 py-3 text-left transition <?php echo e($isActive ? 'bg-indigo-50 ring-1 ring-indigo-100 dark:bg-indigo-900/20 dark:ring-indigo-900/30' : 'hover:bg-slate-50 dark:hover:bg-slate-900', false); ?>"
                        >
                            <div class="flex items-center gap-3">
                                <div class="relative">
                                    <div class="grid h-10 w-10 place-items-center overflow-hidden rounded-full bg-slate-200 text-sm font-bold text-slate-700 dark:bg-slate-800 dark:text-slate-100">
                                        <!--[if BLOCK]><![endif]--><?php if(!empty($conversation['avatar'])): ?>
                                            <img
                                                src="<?php echo e($conversation['avatar'], false); ?>"
                                                alt="<?php echo e($conversation['name'], false); ?>"
                                                class="h-full w-full object-cover"
                                            >
                                        <?php else: ?>
                                            <span><?php echo e($conversation['initials'], false); ?></span>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php if(!empty($conversation['online'])): ?>
                                        <span class="absolute -bottom-0.5 -end-0.5 h-3 w-3 rounded-full border-2 border-white bg-emerald-500 dark:border-slate-950"></span>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center justify-between gap-2">
                                        <div class="truncate font-semibold"><?php echo e($conversation['name'], false); ?></div>
                                        <!--[if BLOCK]><![endif]--><?php if(!empty($conversation['time_label'])): ?>
                                            <div class="shrink-0 text-xs text-slate-500 dark:text-slate-400">
                                                <?php echo e($conversation['time_label'], false); ?>

                                            </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                    <div class="flex items-center justify-between gap-2">
                                        <div class="truncate text-sm text-slate-500 dark:text-slate-400">
                                            <?php echo e($conversation['preview'], false); ?>

                                        </div>
                                        <!--[if BLOCK]><![endif]--><?php if($unread > 0): ?>
                                            <span class="shrink-0 rounded-full bg-indigo-600 px-2 py-0.5 text-[10px] font-bold text-white">
                                                <?php echo e($unread, false); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="text-[10px] text-slate-400 opacity-0 transition group-hover:opacity-100">
                                                فتح
                                            </span>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                            </div>
                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="rounded-2xl border border-dashed border-slate-200 px-4 py-6 text-center text-sm text-slate-500 dark:border-slate-700 dark:text-slate-400">
                            لا توجد محادثات متاحة حتى الآن.
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </aside>
            <section
                wire:poll.keep-alive.7s="pollRealtime"
                class="col-span-12 md:col-span-6 flex flex-col min-h-0 h-full rounded-2xl border border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-950 relative overflow-hidden"
            >
                <!--[if BLOCK]><![endif]--><?php if($activeConversationId): ?>
                    <?php
                        $counterpart = $activeConversation['counterpart'] ?? null;
                        $stateLabels = [
                            'sent' => 'قيد الإرسال',
                            'delivered' => 'وصل ✓',
                            'read' => 'مقروء ✓✓',
                        ];
                    ?>

                    <div class="sticky top-0 z-[5] flex items-center justify-between border-b border-slate-200 bg-white/95 px-4 py-3 backdrop-blur dark:border-slate-800 dark:bg-slate-950/95">
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <div class="grid h-10 w-10 place-items-center overflow-hidden rounded-full bg-slate-200 text-sm font-bold text-slate-700 dark:bg-slate-800 dark:text-slate-100">
                                    <!--[if BLOCK]><![endif]--><?php if(!empty($counterpart['avatar'])): ?>
                                        <img src="<?php echo e($counterpart['avatar'], false); ?>" alt="<?php echo e($counterpart['name'], false); ?>" class="h-full w-full object-cover">
                                    <?php else: ?>
                                        <span><?php echo e($counterpart['initials'] ?? '؟', false); ?></span>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <!--[if BLOCK]><![endif]--><?php if(!empty($counterpart['online'])): ?>
                                    <span class="absolute -bottom-0.5 -end-0.5 h-3 w-3 rounded-full border-2 border-white bg-emerald-500 dark:border-slate-950"></span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div>
                                <div class="font-semibold">
                                    <?php echo e($counterpart['name'] ?? 'مستخدم بدون اسم', false); ?>

                                </div>
                                <div class="text-xs text-emerald-600 dark:text-emerald-400">
                                    <!--[if BLOCK]><![endif]--><?php if(!empty($counterpart['online'])): ?>
                                        متصل الآن
                                    <?php elseif(!empty($counterpart['last_seen_at'])): ?>
                                        آخر ظهور <?php echo e(Carbon::parse($counterpart['last_seen_at'])->diffForHumans(), false); ?>

                                    <?php else: ?>
                                        غير متصل
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>
                        </div>
                        <div class="hidden sm:flex -space-x-3 rtl:space-x-reverse items-center">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span
                                    wire:key="participant-chip-<?php echo e($participant['id'], false); ?>"
                                    class="inline-grid h-7 w-7 place-items-center rounded-full bg-slate-200 text-[10px] font-bold text-slate-700 ring-2 ring-white dark:bg-slate-800 dark:text-slate-200 dark:ring-slate-950"
                                    title="<?php echo e($participant['name'], false); ?>"
                                >
                                    <?php echo e($participant['initials'] ?? '؟', false); ?>

                                </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>

                    <!--[if BLOCK]><![endif]--><?php if(!empty($activeConversation['project'])): ?>
                        <div class="mx-3 mt-3 rounded-xl border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs text-emerald-800 shadow-soft dark:border-emerald-900/40 dark:bg-emerald-900/20 dark:text-emerald-200">
                            <div class="font-semibold">
                                مشروع مرتبط: <?php echo e($activeConversation['project']['title'], false); ?>

                            </div>
                            <div class="mt-1">
                                <a
                                    href="<?php echo e(route('project', [$activeConversation['project']['id'], $activeConversation['project']['slug']]), false); ?>"
                                    class="text-emerald-700 underline decoration-dotted dark:text-emerald-300"
                                >
                                    عرض التفاصيل
                                </a>
                            </div>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <div class="flex-1 min-h-0 flex flex-col px-2 sm:px-4 py-6 bg-gradient-to-b from-slate-50/60 to-transparent dark:from-slate-900/40">
                        <!--[if BLOCK]><![endif]--><?php if($hasMoreMessages): ?>
                            <div class="mb-4 flex justify-center">
                                <button
                                    type="button"
                                    wire:click="loadMoreMessages"
                                    wire:loading.attr="disabled"
                                    wire:target="loadMoreMessages"
                                    class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-1.5 text-xs text-slate-500 shadow-sm hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300"
                                >
                                    <span wire:loading.remove wire:target="loadMoreMessages">تحميل رسائل أقدم…</span>
                                    <span wire:loading wire:target="loadMoreMessages" class="flex items-center gap-1">
                                        <span class="h-2 w-2 animate-ping rounded-full bg-indigo-500"></span>
                                        جاري التحميل…
                                    </span>
                                </button>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        <div id="chat-log" class="flex-1 min-h-0 space-y-6 overflow-y-auto pr-2 pb-24 scrollbar-slim">
                            <?php $currentDay = null; ?>

                            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $timestamp = $message['time'] ?? null;
                                    $dateKey = $timestamp ? Carbon::parse($timestamp)->setTimezone(config('app.timezone'))->toDateString() : null;
                                ?>

                                <!--[if BLOCK]><![endif]--><?php if($dateKey && $dateKey !== $currentDay): ?>
                                    <div class="relative my-4 text-center text-xs text-slate-500">
                                        <span class="relative z-10 rounded-full bg-slate-100 px-3 py-1 dark:bg-slate-800">
                                            <?php echo e(Carbon::parse($timestamp)->setTimezone(config('app.timezone'))->translatedFormat('l j F Y'), false); ?>

                                        </span>
                                        <span class="absolute inset-0 top-1/2 -z-0 h-px bg-slate-200 dark:bg-slate-800"></span>
                                    </div>
                                    <?php $currentDay = $dateKey; ?>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                <!--[if BLOCK]><![endif]--><?php if($message['from_me']): ?>
                                    <div class="flex items-start justify-end gap-2" wire:key="message-<?php echo e($message['id'], false); ?>">
                                        <div class="min-w-0 space-y-2 text-right">
                                            <div class="inline-block rounded-2xl bg-indigo-600 px-4 py-2 text-sm leading-relaxed text-white shadow-sm dark:bg-indigo-500/90">
                                                <!--[if BLOCK]><![endif]--><?php if(!empty($message['body_plain'])): ?>
                                                    <div class="whitespace-pre-line">
                                                        <?php echo e($message['body_plain'], false); ?>

                                                    </div>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                                <!--[if BLOCK]><![endif]--><?php if(!empty($message['attachments'])): ?>
                                                    <div class="mt-2 flex flex-wrap gap-2">
                                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $message['attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <a
                                                                href="<?php echo e($attachment['url'] ?? '#', false); ?>"
                                                                target="_blank"
                                                                class="inline-flex items-center gap-2 rounded-xl border border-indigo-300 bg-indigo-500/20 px-2 py-1 text-[11px] text-white/90 hover:bg-indigo-500/30"
                                                            >
                                                                <span>📎 <?php echo e($attachment['name'], false); ?></span>
                                                                <!--[if BLOCK]><![endif]--><?php if(!empty($attachment['size_human'])): ?>
                                                                    <span class="text-white/70"><?php echo e($attachment['size_human'], false); ?></span>
                                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                            </a>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                    </div>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                                <div class="mt-1 flex items-center justify-end gap-2 text-xs opacity-80">
                                                    <!--[if BLOCK]><![endif]--><?php if(!empty($message['time_human'])): ?>
                                                        <span><?php echo e($message['time_human'], false); ?></span>
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                    <span>•</span>
                                                    <span><?php echo e($stateLabels[$message['state']] ?? 'مرسل', false); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="flex items-start gap-2" wire:key="message-<?php echo e($message['id'], false); ?>">
                                        <div class="grid h-8 w-8 place-items-center rounded-full bg-slate-200 text-[11px] font-bold text-slate-700 dark:bg-slate-800 dark:text-slate-100">
                                            <?php echo e($message['sender']['initials'] ?? '؟', false); ?>

                                        </div>
                                        <div class="min-w-0 space-y-2">
                                            <div class="inline-block rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm leading-relaxed shadow-sm dark:border-slate-800 dark:bg-slate-950">
                                                <!--[if BLOCK]><![endif]--><?php if(!empty($message['body_plain'])): ?>
                                                    <div class="whitespace-pre-line text-slate-700 dark:text-slate-200">
                                                        <?php echo e($message['body_plain'], false); ?>

                                                    </div>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                                <!--[if BLOCK]><![endif]--><?php if(!empty($message['attachments'])): ?>
                                                    <div class="mt-2 flex flex-wrap gap-2">
                                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $message['attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <a
                                                                href="<?php echo e($attachment['url'] ?? '#', false); ?>"
                                                                target="_blank"
                                                                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-2 py-1 text-[11px] text-slate-600 hover:bg-slate-100 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 dark:hover:bg-slate-800"
                                                            >
                                                                <span>📎 <?php echo e($attachment['name'], false); ?></span>
                                                                <!--[if BLOCK]><![endif]--><?php if(!empty($attachment['size_human'])): ?>
                                                                    <span class="text-slate-400"><?php echo e($attachment['size_human'], false); ?></span>
                                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                            </a>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                    </div>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                                <!--[if BLOCK]><![endif]--><?php if(!empty($message['time_human'])): ?>
                                                    <div class="mt-1 text-xs text-slate-500">
                                                        <?php echo e($message['time_human'], false); ?>

                                                    </div>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="mt-10 text-center text-sm text-slate-500 dark:text-slate-400">
                                    لم تبدأ المحادثة بعد. اكتب رسالتك الأولى في الأسفل.
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                    <div class="mt-auto sticky bottom-0 border-t border-slate-200 bg-white/95 p-2 sm:p-3 backdrop-blur dark:border-slate-800 dark:bg-slate-950/95">
                        <form wire:submit.prevent="sendMessage" class="rounded-2xl border border-slate-200 bg-white p-2 shadow-sm dark:border-slate-700 dark:bg-slate-900">
                            <div class="flex items-end gap-1 sm:gap-2" @keydown.enter="if (event.shiftKey) { return; } event.preventDefault(); $wire.sendMessage();">
                                <button
                                    type="button"
                                    class="grid h-9 w-9 place-items-center rounded-lg text-slate-600 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-800"
                                    title="إيموجي"
                                >
                                    😊
                                </button>

                                <label
                                    class="grid h-9 w-9 cursor-pointer place-items-center rounded-lg text-slate-600 hover:bg-slate-50 dark:text-slate-300 dark:hover:bg-slate-800"
                                    title="إرفاق"
                                >
                                    📎
                                    <input
                                        id="attachInput"
                                        type="file"
                                        class="hidden"
                                        multiple
                                        accept="image/*,video/*,audio/*,application/pdf"
                                        wire:model="uploadQueue"
                                    />
                                </label>

                                <label
                                    class="grid h-9 w-9 cursor-pointer place-items-center rounded-lg text-slate-600 hover:bg-slate-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 dark:text-slate-300 dark:hover:bg-slate-800"
                                    title="تسجيل صوتي"
                                >
                                    🎙️
                                    <input
                                        type="file"
                                        class="hidden"
                                        accept="audio/*"
                                        capture="microphone"
                                        wire:model="uploadQueue"
                                    />
                                </label>

                                <textarea
                                    wire:model.live="messageBody"
                                    rows="1"
                                    class="min-h-[44px] max-h-32 flex-1 resize-none rounded-xl border border-transparent px-3 py-2 text-sm outline-none focus:ring-0 dark:bg-transparent"
                                    placeholder="اكتب رسالة… Enter للإرسال، Shift+Enter لسطر جديد"
                                ></textarea>

                                <button
                                    type="submit"
                                    wire:loading.attr="disabled"
                                    wire:target="sendMessage,uploadQueue"
                                    class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 disabled:cursor-not-allowed disabled:opacity-70"
                                >
                                    <span wire:loading.remove wire:target="sendMessage,uploadQueue">إرسال</span>
                                    <span wire:loading wire:target="sendMessage,uploadQueue" class="flex items-center gap-1">
                                        <span class="h-2 w-2 animate-ping rounded-full bg-white"></span>
                                        جاري الإرسال…
                                    </span>
                                </button>
                            </div>

                            <!--[if BLOCK]><![endif]--><?php if(!empty($uploadQueue)): ?>
                                <div class="mt-3 flex flex-wrap gap-2">
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $uploadQueue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div
                                            wire:key="upload-<?php echo e($index, false); ?>"
                                            class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-3 py-1 text-xs text-slate-600 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200"
                                        >
                                            <span>📎 <?php echo e($file->getClientOriginalName(), false); ?></span>
                                            <span class="text-slate-400"><?php echo e(format_bytes($file->getSize()), false); ?></span>
                                            <button
                                                type="button"
                                                wire:click="removeUpload(<?php echo e($index, false); ?>)"
                                                class="text-slate-400 hover:text-rose-500"
                                            >
                                                ✕
                                            </button>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                            <div class="mt-2 flex items-center justify-between text-[11px] text-slate-500">
                                <div class="flex items-center gap-1">
                                    <!--[if BLOCK]><![endif]--><?php if(!empty($typing)): ?>
                                        <span class="dot h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                        <span class="dot h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                        <span class="dot h-1.5 w-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                        <span class="ms-1">
                                            <?php echo e(collect($typing)->pluck('name')->implode('، '), false); ?> يكتب الآن…
                                        </span>
                                    <?php else: ?>
                                        <span class="dot h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                        <span class="dot h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                        <span class="dot h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                        <span class="ms-1">جاهز للكتابة…</span>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div class="flex items-center gap-2">
                                    <kbd class="rounded border border-slate-300 bg-slate-50 px-1.5 py-0.5 text-[10px] text-slate-600 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400">Enter</kbd>
                                    <span>إرسال • </span>
                                    <kbd class="rounded border border-slate-300 bg-slate-50 px-1.5 py-0.5 text-[10px] text-slate-600 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400">Shift</kbd>
                                    <span>+Enter سطر جديد</span>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <div class="flex flex-1 flex-col items-center justify-center gap-4 p-12 text-center">
                        <div class="grid h-16 w-16 place-items-center rounded-full bg-indigo-50 text-2xl text-indigo-600 dark:bg-indigo-900/20 dark:text-indigo-300">
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
                    <div
                        id="realtimeStatus"
                        class="mx-3 mt-3 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-xs text-slate-600 dark:border-slate-700 dark:bg-slate-900/70 dark:text-slate-300"
                        data-state="connecting"
                    >
                        <span class="font-semibold text-slate-700 dark:text-slate-200">الرسائل الفورية</span>
                        <span class="status-text ms-2">نقوم بتهيئة الاتصال…</span>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </section>

            <aside id="detailsPanel" class="col-span-12 md:col-span-3 rounded-2xl border border-slate-200 bg-white p-3 dark:border-slate-800 dark:bg-slate-950 flex flex-col gap-3">
                <!--[if BLOCK]><![endif]--><?php if($activeConversationId): ?>
                    <section class="mb-3">
                        <button
                            type="button"
                            class="collapse-toggle flex w-full items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-slate-50 dark:hover:bg-slate-900"
                            data-target="#jobBody"
                        >
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500">الوظيفة</span>
                            </div>
                            <svg class="chev h-4 w-4 text-slate-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.586l3.71-3.355a.75.75 0 111.02 1.1l-4.2 3.8a.75.75 0 01-1.02 0l-4.2-3.8a.75.75 0 01-.02-1.06z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <div id="jobBody" class="collapse-body mt-2 rounded-xl border border-slate-200 p-3 text-sm dark:border-slate-700">
                            <!--[if BLOCK]><![endif]--><?php if(!empty($activeConversation['project'])): ?>
                                <div class="font-semibold"><?php echo e($activeConversation['project']['title'], false); ?></div>
                                <div class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                    معرف المشروع #<?php echo e($activeConversation['project']['id'], false); ?>

                                </div>
                            <?php else: ?>
                                <div class="text-xs text-slate-500 dark:text-slate-400">
                                    لا يوجد مشروع مرتبط بهذه المحادثة.
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </section>

                    <section class="mb-4">
                        <button
                            type="button"
                            class="collapse-toggle flex w-full items-center justify-between rounded-xl px-3 py-2 text-sm hover:bg-slate-50 dark:hover:bg-slate-900"
                            data-target="#membersBody"
                        >
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500">المشاركون</span>
                            </div>
                            <svg class="chev h-4 w-4 text-slate-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.586l3.71-3.355a.75.75 0 111.02 1.1l-4.2 3.8a.75.75 0 01-1.02 0l-4.2-3.8a.75.75 0 01-.02-1.06z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        <div id="membersBody" class="collapse-body mt-2 space-y-2">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $participants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div
                                    wire:key="participant-row-<?php echo e($participant['id'], false); ?>"
                                    class="flex items-center justify-between rounded-xl border border-slate-200 px-3 py-2 text-sm dark:border-slate-700"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="relative">
                                            <div class="grid h-10 w-10 place-items-center rounded-full bg-slate-200 text-sm font-bold text-slate-700 dark:bg-slate-800 dark:text-slate-100">
                                                <?php echo e($participant['initials'] ?? '؟', false); ?>

                                            </div>
                                            <!--[if BLOCK]><![endif]--><?php if(!empty($participant['online'])): ?>
                                                <span class="absolute -bottom-0.5 -end-0.5 h-3 w-3 rounded-full border-2 border-white bg-emerald-500 dark:border-slate-950"></span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                        <div>
                                            <div class="font-medium text-slate-700 dark:text-slate-200"><?php echo e($participant['name'], false); ?></div>
                                            <!--[if BLOCK]><![endif]--><?php if(!empty($participant['role'])): ?>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">
                                                    <?php echo e($participant['role'] === 'client' ? 'عميل' : 'مستقل', false); ?>

                                                </div>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                    </div>
                                    <span class="text-xs <?php echo e(!empty($participant['online']) ? 'text-emerald-600 dark:text-emerald-400' : 'text-slate-400 dark:text-slate-500', false); ?>">
                                        <?php echo e(!empty($participant['online']) ? 'متصل' : 'غير متصل', false); ?>

                                    </span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </section>

                    <div class="flex flex-col gap-2">
                        <button class="rounded-xl border border-slate-200 px-3 py-2 text-sm hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800">
                            فتح عقد
                        </button>
                        <button class="rounded-xl border border-slate-200 px-3 py-2 text-sm hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800">
                            تثبيت المحادثة
                        </button>
                        <button class="rounded-xl border border-rose-200 px-3 py-2 text-sm text-rose-600 hover:bg-rose-50 dark:border-rose-700/40 dark:hover:bg-rose-900/20">
                            إبلاغ/حظر
                        </button>
                    </div>
                <?php else: ?>
                    <div class="rounded-2xl border border-dashed border-slate-200 px-4 py-6 text-center text-sm text-slate-500 dark:border-slate-700 dark:text-slate-400">
                        اختر محادثة لعرض تفاصيل المشاركين والمشروع.
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </aside>
        </div>
    </main>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        window.addEventListener('chat:scroll-bottom', () => {
            const log = document.getElementById('chat-log');

            if (! log) {
                return;
            }

            requestAnimationFrame(() => {
                log.scrollTop = log.scrollHeight;
            });
        });

        document.addEventListener('livewire:load', () => {
            const statusWrapper = document.getElementById('realtimeStatus');
            if (! statusWrapper) {
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

            if (! connector || ! connection) {
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
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/conversations/workspace.blade.php ENDPATH**/ ?>