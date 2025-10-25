<div class="w-full space-y-12 ">

    <section class="relative overflow-hidden max-w-6xl mx-auto rounded-3xl border border-white/40 bg-gradient-to-br from-primary-600 via-primary-500 to-indigo-500 px-6 py-10 text-white shadow-xl dark:border-primary-400/40 dark:from-primary-500 dark:via-indigo-500 dark:to-purple-600">
        <div class="pointer-events-none absolute inset-0 opacity-[0.12]" style="background-image: radial-gradient(circle at 20% 20%, rgba(255,255,255,0.9) 0%, transparent 40%), radial-gradient(circle at 80% 0%, rgba(255,255,255,0.6) 0%, transparent 35%);"></div>
        <div class="relative mx-auto flex flex-col gap-6 lg:max-w-6xl lg:flex-row lg:items-center lg:justify-between">
            <div class="space-y-4">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-1 text-[12px] font-semibold uppercase tracking-[0.3em]">
                    <i class="ph ph-compass"></i>
                    <?php echo app('translator')->get('messages.t_seller_dashboard'); ?>
                </span>
                <div>
                    <h1 class="text-3xl font-bold sm:text-4xl">
                        <?php echo app('translator')->get('messages.t_welcome_back'); ?>, <?php echo e(auth()->user()->fullname ?? auth()->user()->username, false); ?>!
                    </h1>
                    <p class="mt-3 max-w-2xl text-sm text-white/80">
                        نظّم عروضك، راقب مدفوعاتك، وابقَ على تواصل مع العملاء من لوحة تحكم واحدة مصممة للمستقلين المحترفين.
                    </p>
                </div>
                <div class="flex flex-wrap gap-3 text-[12px] font-semibold uppercase tracking-[0.2em] text-white/80">
                    <!--[if BLOCK]><![endif]--><?php if(auth()->user()->status === 'verified'): ?>
                        <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1">
                            <i class="ph ph-shield-check"></i>
                            <?php echo app('translator')->get('messages.t_verified_account'); ?>
                        </span>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1">
                        <i class="ph ph-wallet"></i>
                        <?php echo e(money(auth()->user()->balance_available, settings('currency')->code, true), false); ?>

                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1">
                        <i class="ph ph-calendar-blank"></i>
                        <?php echo app('translator')->get('messages.t_member_since'); ?> <?php echo e(format_date(auth()->user()->created_at, config('carbon-formats.F_d,_Y')), false); ?>

                    </span>
                </div>
            </div>
            <div class="flex flex-col gap-3 sm:flex-row">
                <a href="<?php echo e(url('explore/projects'), false); ?>" class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-primary-600 shadow-md transition hover:-translate-y-0.5 hover:bg-white/90">
                    <i class="ph ph-magnifying-glass"></i>
                    استكشف مشاريع جديدة
                </a>
                <a href="<?php echo e(url('/'), false); ?>" class="inline-flex items-center justify-center gap-2 rounded-full border border-white/40 px-4 py-2 text-sm font-semibold text-white transition hover:bg-white/10">
                    <i class="ph ph-arrows-left-right"></i>
                    <?php echo app('translator')->get('messages.t_switch_to_buying'); ?>
                </a>
            </div>
        </div>
    </section>

    <section class="mx-auto grid max-w-6xl gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl border border-white/60 bg-white/90 p-5 shadow-sm backdrop-blur-sm dark:border-zinc-700 dark:bg-zinc-900/70">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">الإيرادات الصافية</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white"><?php echo e(money($earnings, settings('currency')->code, true), false); ?></p>
                </div>
                <span class="flex h-11 w-11 items-center justify-center rounded-full bg-primary-500/10 text-primary-600 dark:text-primary-400">
                    <i class="ph ph-trend-up text-xl"></i>
                </span>
            </div>
            <p class="mt-3 text-[12px] text-slate-500 dark:text-slate-400">يتضمن المشاريع والمعاملات الجارية التي أُفرجت دفعاتها.</p>
        </div>
        <div class="rounded-2xl border border-white/60 bg-white/90 p-5 shadow-sm backdrop-blur-sm dark:border-zinc-700 dark:bg-zinc-900/70">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">مشاريع مُنحت لك</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($awarded_projects, false); ?></p>
                </div>
                <span class="flex h-11 w-11 items-center justify-center rounded-full bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                    <i class="ph ph-briefcase text-xl"></i>
                </span>
            </div>
            <p class="mt-3 text-[12px] text-slate-500 dark:text-slate-400">عدد العقود التي وافق عليها العميل وتنتظر التنفيذ أو يتم العمل عليها.</p>
        </div>
        <div class="rounded-2xl border border-white/60 bg-white/90 p-5 shadow-sm backdrop-blur-sm dark:border-zinc-700 dark:bg-zinc-900/70">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">دفعات قيد المتابعة</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($pending_orders, false); ?></p>
                </div>
                <span class="flex h-11 w-11 items-center justify-center rounded-full bg-amber-500/10 text-amber-600 dark:text-amber-400">
                    <i class="ph ph-clock-countdown text-xl"></i>
                </span>
            </div>
            <p class="mt-3 text-[12px] text-slate-500 dark:text-slate-400">طلبات الدفعات أو التحويلات التي تحتاج إلى تحديث حالة أو تسوية.</p>
        </div>
        <div class="rounded-2xl border border-white/60 bg-white/90 p-5 shadow-sm backdrop-blur-sm dark:border-zinc-700 dark:bg-zinc-900/70">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">رسائل جديدة</p>
                    <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white"><?php echo e(count($latest_messages), false); ?></p>
                </div>
                <span class="flex h-11 w-11 items-center justify-center rounded-full bg-indigo-500/10 text-indigo-600 dark:text-indigo-400">
                    <i class="ph ph-chat-circle-dots text-xl"></i>
                </span>
            </div>
            <p class="mt-3 text-[12px] text-slate-500 dark:text-slate-400">عملاؤك بانتظار ردك على آخر الرسائل غير المقروءة.</p>
        </div>
        <!--[if BLOCK]><![endif]--><?php if($monthly_proposals_limit): ?>
            <?php
                $usagePercent = $monthly_proposals_limit > 0
                    ? min(100, ($monthly_proposals_used / max($monthly_proposals_limit, 1)) * 100)
                    : 0;
            ?>
            <div class="rounded-2xl border border-white/60 bg-white/90 p-5 shadow-sm backdrop-blur-sm dark:border-zinc-700 dark:bg-zinc-900/70 md:col-span-2 xl:col-span-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500 dark:text-slate-400">
                            <?php echo app('translator')->get('messages.t_monthly_proposals_progress_label'); ?>
                        </p>
                        <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-white">
                            <?php echo e($monthly_proposals_used, false); ?> / <?php echo e($monthly_proposals_limit, false); ?>

                        </p>
                    </div>
                    <span class="flex h-11 w-11 items-center justify-center rounded-full bg-primary-500/10 text-primary-600 dark:text-primary-400">
                        <i class="ph ph-target text-xl"></i>
                    </span>
                </div>
                <div class="mt-4 space-y-2">
                    <div class="flex items-center justify-between text-[11px] font-semibold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">
                        <span><?php echo app('translator')->get('messages.t_monthly_proposals_remaining'); ?>: <?php echo e(max($monthly_proposals_remaining, 0), false); ?></span>
                        <span><?php echo app('translator')->get('messages.t_monthly_proposals_reset', ['date' => format_date($monthly_proposals_reset_at->toDateTimeString(), config('carbon-formats.F_d,_Y'))]); ?></span>
                    </div>
                    <div class="h-2 w-full rounded-full bg-white/60 dark:bg-zinc-800/80">
                        <div class="h-2 rounded-full bg-primary-500 transition-all duration-500 ease-out dark:bg-primary-400" style="width: <?php echo e($usagePercent, false); ?>%;"></div>
                    </div>
                </div>
                <!--[if BLOCK]><![endif]--><?php if($monthly_proposals_remaining === 0): ?>
                    <a href="<?php echo e(url('seller/projects/bids'), false); ?>" class="mt-4 inline-flex w-full items-center justify-center gap-2 rounded-full bg-primary-600 px-4 py-2 text-sm font-semibold text-white shadow-md transition hover:-translate-y-0.5 hover:bg-primary-700">
                        <i class="ph ph-shopping-bag"></i>
                        <?php echo app('translator')->get('messages.t_free_plan_limit_reached_action'); ?>
                    </a>
                <?php else: ?>
                    <p class="mt-4 text-[12px] text-slate-500 dark:text-slate-400">
                        <?php echo app('translator')->get('messages.t_monthly_proposals_keep_bidding'); ?>
                    </p>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    </section>

    <div class="mx-auto grid max-w-6xl gap-8 xl:grid-cols-[minmax(0,1.7fr)_minmax(0,1fr)]">
        <div class="rounded-3xl border border-white/60 bg-white/95 p-6 shadow-sm backdrop-blur-sm dark:border-zinc-700 dark:bg-zinc-900/70">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">قناة المشاريع الممنوحة</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">تابع حالة أحدث العقود والدفعات النشطة لديك.</p>
                </div>
                <a href="<?php echo e(url('seller/projects/awarded'), false); ?>" class="inline-flex items-center gap-2 rounded-full bg-primary-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-primary-700">
                    <i class="ph ph-list-checks"></i>
                    إدارة العقود
                </a>
            </div>

            <!--[if BLOCK]><![endif]--><?php if($latest_awarded_projects && $latest_awarded_projects->count()): ?>
                <div class="mt-6 divide-y divide-slate-200 dark:divide-zinc-800">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $latest_awarded_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="flex flex-col gap-4 py-5 first:pt-0 last:pb-0 md:flex-row md:items-center md:justify-between" wire:key="freelancer-dashboard-latest-projects-<?php echo e($project->uid, false); ?>">
                            <div class="space-y-2">
                                <a href="<?php echo e(url('project/' . $project->pid . '/' . $project->slug), false); ?>" class="text-base font-semibold text-slate-900 transition hover:text-primary-600 dark:text-white"><?php echo e($project->title, false); ?></a>
                                <div class="flex flex-wrap gap-2 text-[12px] text-slate-500 dark:text-slate-400">
                                    <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 dark:bg-zinc-800"><?php echo e(__('messages.t_budget'), false); ?>: <?php echo e(money($project->budget_min, settings('currency')->code, true), false); ?> - <?php echo e(money($project->budget_max, settings('currency')->code, true), false); ?></span>
                                    <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 dark:bg-zinc-800"><?php echo e(format_date($project->created_at, config('carbon-formats.F_d,_Y')), false); ?></span>
                                </div>
                            </div>
                            <div class="flex flex-col items-end gap-3 sm:flex-row sm:items-center">
                                <span class="inline-flex items-center gap-2 rounded-full bg-primary-50 px-3 py-1 text-xs font-semibold text-primary-600 dark:bg-primary-500/15 dark:text-primary-300">
                                    <i class="ph ph-coins"></i>
                                    <?php echo e(money(optional($project->awarded_bid)->amount, settings('currency')->code, true), false); ?>

                                </span>
                                <!--[if BLOCK]><![endif]--><?php switch($project->status):
                                    case ('pending_final_review'): ?>
                                        <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-semibold text-amber-700 dark:bg-amber-500/10 dark:text-amber-300"><?php echo e(__('messages.t_pending_final_review'), false); ?></span>
                                        <?php break; ?>
                                    <?php case ('active'): ?>
                                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-blue-700 dark:bg-blue-500/10 dark:text-blue-300"><?php echo e(__('messages.t_active'), false); ?></span>
                                        <?php break; ?>
                                    <?php case ('completed'): ?>
                                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-300"><?php echo e(__('messages.t_completed'), false); ?></span>
                                        <?php break; ?>
                                    <?php case ('incomplete'): ?>
                                        <span class="rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-700 dark:bg-rose-500/10 dark:text-rose-300"><?php echo e(__('messages.t_incomplete'), false); ?></span>
                                        <?php break; ?>
                                    <?php case ('under_development'): ?>
                                        <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700 dark:bg-purple-500/10 dark:text-purple-300"><?php echo e(__('messages.t_under_development'), false); ?></span>
                                        <?php break; ?>
                                    <?php case ('closed'): ?>
                                        <span class="rounded-full bg-slate-200 px-3 py-1 text-xs font-semibold text-slate-700 dark:bg-slate-600/20 dark:text-slate-300"><?php echo e(__('messages.t_closed'), false); ?></span>
                                        <?php break; ?>
                                    <?php default: ?>
                                <?php endswitch; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            <?php else: ?>
                <div class="mt-6 rounded-2xl border border-dashed border-slate-200 bg-slate-50/70 p-6 text-center text-sm text-slate-500 dark:border-zinc-700 dark:bg-zinc-800/60 dark:text-zinc-300">
                    لم يتم منحك مشاريع بعد. ابدأ بالتقدم لعروض مختارة لتظهر هنا.
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <div class="space-y-6">
            <div class="rounded-3xl border border-white/60 bg-white/95 p-6 shadow-sm backdrop-blur-sm dark:border-zinc-700 dark:bg-zinc-900/70">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">صندوق الوارد الذكي</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">أحدث الرسائل غير المقروءة لسرعة المتابعة.</p>
                <div class="mt-5 space-y-4">
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $latest_messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a href="<?php echo e(url('messages', $message['uid']), false); ?>" class="group flex items-start gap-3 rounded-2xl border border-slate-200/70 px-4 py-3 transition hover:-translate-y-0.5 hover:border-primary-200 hover:bg-primary-50/40 dark:border-zinc-700 dark:hover:border-primary-400/40 dark:hover:bg-primary-500/10">
                            <img src="<?php echo e($message['avatar'], false); ?>" alt="<?php echo e($message['username'], false); ?>" class="h-10 w-10 rounded-full object-cover" />
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold text-slate-900 dark:text-white"><?php echo e($message['username'], false); ?></span>
                                    <!--[if BLOCK]><![endif]--><?php if($message['message']['attachment']): ?>
                                        <span class="rounded-full bg-amber-100 px-2 py-0.5 text-[11px] font-semibold text-amber-700 dark:bg-amber-500/10 dark:text-amber-300">مرفق جديد</span>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <p class="text-[13px] text-slate-500 line-clamp-2 dark:text-slate-400"><?php echo e($message['message']['body'], false); ?></p>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50/70 p-6 text-center text-sm text-slate-500 dark:border-zinc-700 dark:bg-zinc-800/60 dark:text-zinc-300">
                            لا توجد رسائل تنتظر الرد حالياً. أبقِ إشعاراتك مفعّلة لتنبيهك فور وصول جديد.
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>

            <div class="rounded-3xl border border-white/60 bg-white/95 p-6 shadow-sm backdrop-blur-sm dark:border-zinc-700 dark:bg-zinc-900/70">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">اختصارات سريعة</h3>
                <ul class="mt-4 space-y-3 text-sm">
                    <li>
                        <a href="<?php echo e(url('seller/projects'), false); ?>" class="flex items-center justify-between rounded-2xl border border-slate-200 px-4 py-3 transition hover:border-primary-200 hover:bg-primary-50/40 dark:border-zinc-700 dark:hover:border-primary-500/30 dark:hover:bg-primary-500/10">
                            <span class="flex items-center gap-2 text-slate-700 dark:text-slate-200">
                                <i class="ph ph-list-checks text-primary-500"></i>
                                المشاريع النشطة
                            </span>
                            <i class="ph ph-arrow-circle-left text-slate-400 dark:text-slate-500"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(url('seller/offers'), false); ?>" class="flex items-center justify-between rounded-2xl border border-slate-200 px-4 py-3 transition hover:border-primary-200 hover:bg-primary-50/40 dark:border-zinc-700 dark:hover:border-primary-500/30 dark:hover:bg-primary-500/10">
                            <span class="flex items-center gap-2 text-slate-700 dark:text-slate-200">
                                <i class="ph ph-flashlight text-primary-500"></i>
                                العروض المخصّصة
                            </span>
                            <i class="ph ph-arrow-circle-left text-slate-400 dark:text-slate-500"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(url('account/settings'), false); ?>" class="flex items-center justify-between rounded-2xl border border-slate-200 px-4 py-3 transition hover:border-primary-200 hover:bg-primary-50/40 dark:border-zinc-700 dark:hover:border-primary-500/30 dark:hover:bg-primary-500/10">
                            <span class="flex items-center gap-2 text-slate-700 dark:text-slate-200">
                                <i class="ph ph-gear-six text-primary-500"></i>
                                إعدادات الحساب
                            </span>
                            <i class="ph ph-arrow-circle-left text-slate-400 dark:text-slate-500"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/seller/home/home.blade.php ENDPATH**/ ?>