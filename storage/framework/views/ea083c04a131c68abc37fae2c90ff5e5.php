<?php
    use Illuminate\Support\Str;
?>

<div
    x-data="{ open: false }"
    class="relative hidden md:block"
    @keydown.escape.window="open = false"
    x-cloak
>
    <button
        type="button"
        @click="open = !open"
        class="relative flex h-12 w-12 items-center justify-center rounded-3xl text-primary-600 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500/70 dark:text-primary-300"
        aria-haspopup="true"
        :aria-expanded="open"
    >
        <span class="relative inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-primary-500/10 text-primary-600 transition hover:bg-primary-500/15 dark:bg-primary-500/15 dark:text-primary-300">
            <i class="ph-duotone ph-chats-circle text-xl"></i>
            <!--[if BLOCK]><![endif]--><?php if($unreadTotal > 0): ?>
                <span class="absolute -top-1 -right-1 flex h-3.5 w-3.5">
                    <span class="absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75 animate-ping"></span>
                    <span class="relative inline-flex h-3.5 w-3.5 items-center justify-center rounded-full bg-rose-500"></span>
                </span>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </span>
        <!--[if BLOCK]><![endif]--><?php if($unreadTotal > 0): ?>
            <span class="absolute -bottom-1 -right-1 inline-flex min-w-[1.9rem] items-center justify-center rounded-full bg-primary-600 px-1.5 py-0.5 text-[11px] font-semibold leading-none text-white shadow-lg shadow-primary-500/40">
                <?php echo e($unreadTotal > 9 ? '9+' : $unreadTotal, false); ?>

            </span>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </button>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        @click.outside="open = false"
        class="absolute right-0 z-50 mt-3 w-96 origin-top-right rounded-3xl bg-white/95 p-4 shadow-2xl ring-1 ring-black/5 backdrop-blur dark:bg-zinc-900/95 dark:ring-white/5"
        style="display: none;"
    >
        <div class="flex items-center justify-between gap-3 pb-4 border-b border-slate-200/70 dark:border-zinc-700/60">
            <div>
                <h3 class="text-sm font-semibold text-slate-700 dark:text-zinc-100">
                    <?php echo app('translator')->get('messages.t_messages'); ?>
                </h3>
                <p class="mt-1 text-xs text-slate-500 dark:text-zinc-400">
                    <?php echo e(__('messages.t_you_have_unread_notifications', ['count' => $unreadTotal]), false); ?>

                </p>
            </div>
            <a
                href="<?php echo e(route('messages.inbox'), false); ?>"
                class="inline-flex items-center gap-1 rounded-full border border-primary-200/70 px-3 py-1 text-xs font-semibold text-primary-600 transition hover:border-primary-300 hover:text-primary-700 dark:border-primary-500/30 dark:text-primary-300 dark:hover:border-primary-400 dark:hover:text-primary-200"
            >
                <i class="ph-duotone ph-arrow-square-out text-sm"></i>
                <?php echo app('translator')->get('messages.t_view_all'); ?>
            </a>
        </div>

        <div class="relative max-h-96 overflow-y-auto py-4 scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-transparent dark:scrollbar-thumb-zinc-700">
            <div wire:loading.flex class="absolute inset-0 z-10 hidden items-center justify-center rounded-2xl bg-white/80 backdrop-blur-sm dark:bg-zinc-900/70">
                <svg class="h-6 w-6 animate-spin text-primary-500" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v3a5 5 0 00-5 5H4z"></path>
                </svg>
            </div>

            <div class="space-y-3">
                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $conversations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conversation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $user = $conversation['user'];
                        $project = $conversation['project'];
                        $preview = $conversation['preview'];
                        $unread = $conversation['unread'];
                        $avatar = src($user->avatar ?? null);
                    ?>
                    <div
                        wire:key="conversation-dropdown-<?php echo e($user->id, false); ?>"
                        class="group relative overflow-hidden rounded-2xl border border-slate-200/80 bg-white/90 p-4 transition hover:-translate-y-0.5 hover:border-primary-200 hover:shadow-lg dark:border-zinc-700/70 dark:bg-zinc-900/90 dark:hover:border-primary-500/30"
                    >
                        <div class="flex items-start gap-3">
                            <div class="relative h-12 w-12 flex-shrink-0 overflow-hidden rounded-2xl bg-slate-100 ring-4 ring-white/80 transition group-hover:ring-primary-100 dark:bg-zinc-800 dark:ring-zinc-800/80">
                                <img
                                    src="<?php echo e(placeholder_img(), false); ?>"
                                    data-src="<?php echo e($avatar, false); ?>"
                                    alt="<?php echo e($user->username, false); ?>"
                                    class="h-full w-full object-cover lazy"
                                >
                                <!--[if BLOCK]><![endif]--><?php if($unread > 0): ?>
                                    <span class="absolute -top-1 -right-1 inline-flex h-4 w-4 items-center justify-center rounded-full bg-rose-500 text-[10px] font-bold text-white shadow-sm">
                                        <?php echo e($unread > 9 ? '9+' : $unread, false); ?>

                                    </span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex flex-wrap items-center gap-2">
                                    <h4 class="text-sm font-semibold text-slate-700 dark:text-zinc-100">
                                        <?php echo e($user->fullname ?? $user->username, false); ?>

                                    </h4>
                                    <span class="text-[11px] font-medium uppercase tracking-wide text-slate-400 dark:text-zinc-500">
                                        <?php echo e($conversation['time_human'], false); ?>

                                    </span>
                                </div>
                                <p class="mt-1 text-xs leading-relaxed text-slate-500 dark:text-zinc-300">
                                    <?php echo e($preview, false); ?>

                                </p>
                                <!--[if BLOCK]><![endif]--><?php if($project): ?>
                                    <div class="mt-2 inline-flex items-center gap-1 rounded-full bg-primary-500/10 px-2.5 py-1 text-[11px] font-semibold text-primary-600 dark:bg-primary-500/15 dark:text-primary-300">
                                        <i class="ph-duotone ph-briefcase text-xs"></i>
                                        <span class="truncate max-w-[12rem]"><?php echo e(Str::limit($project->title, 45), false); ?></span>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>
                        <div class="mt-3 flex items-center justify-end gap-2">
                            <!--[if BLOCK]><![endif]--><?php if($unread > 0): ?>
                                <button
                                    type="button"
                                    wire:click="markAsRead('<?php echo e($conversation['uid'], false); ?>')"
                                    wire:loading.attr="disabled"
                                    class="inline-flex items-center gap-1 rounded-full border border-slate-200 px-2.5 py-1 text-[11px] font-semibold text-slate-500 transition hover:border-slate-300 hover:text-slate-700 disabled:opacity-60 dark:border-zinc-700 dark:text-zinc-300 dark:hover:border-zinc-600 dark:hover:text-zinc-100"
                                >
                                    <span wire:loading wire:target="markAsRead('<?php echo e($conversation['uid'], false); ?>')">
                                        <svg class="h-3 w-3 animate-spin" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v2.5a5.5 5.5 0 00-5.5 5.5H4z"></path>
                                        </svg>
                                    </span>
                                    <span wire:loading.remove wire:target="markAsRead('<?php echo e($conversation['uid'], false); ?>')">
                                        <i class="ph-duotone ph-check-circle text-xs"></i>
                                        <?php echo app('translator')->get('messages.t_mark_as_read'); ?>
                                    </span>
                                </button>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                            <a
                                href="<?php echo e($conversation['link'], false); ?>"
                                class="inline-flex items-center gap-1 rounded-full bg-primary-600 px-3 py-1.5 text-[11px] font-semibold text-white shadow-sm transition hover:bg-primary-500"
                            >
                                <i class="ph-duotone ph-chat-circle-text text-xs"></i>
                                <?php echo app('translator')->get('messages.t_open'); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50/90 px-6 py-10 text-center text-sm text-slate-500 dark:border-zinc-700 dark:bg-zinc-900/70 dark:text-zinc-400">
                        <i class="ph-duotone ph-chats text-2xl"></i>
                        <p class="mt-3"><?php echo app('translator')->get('messages.t_no_unread_notifications'); ?></p>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/includes/conversations-dropdown.blade.php ENDPATH**/ ?>