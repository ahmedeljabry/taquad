<?php
    $summary = \Illuminate\Support\Str::limit(strip_tags(htmlspecialchars_decode($description)), 190);
    $isFixed = $budget_type === 'fixed';
?>

<article class="group relative overflow-hidden rounded-3xl border border-gray-200 bg-white/85 p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl dark:border-white/10 dark:bg-white/5">
    <div aria-hidden class="absolute inset-0 bg-gradient-to-br from-primary-50 via-transparent to-transparent opacity-0 transition group-hover:opacity-100 dark:from-primary-500/10"></div>

    <!--[if BLOCK]><![endif]--><?php if($highlighted): ?>
        <span class="absolute ltr:left-6 rtl:right-6 top-6 inline-flex items-center gap-1 rounded-full bg-primary-600/10 px-3 py-1 text-xs font-semibold text-primary-700 dark:text-primary-300">
            <i class="ph ph-sparkle text-sm"></i>
            مشروع مميز
        </span>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <div class="relative flex flex-col gap-6 lg:flex-row lg:items-start">
        <div class="flex-1 space-y-5">
            <div class="flex flex-wrap items-start justify-between gap-4">
                <div class="space-y-2">
                    <a href="<?php echo e(url('explore/projects', $category['slug']), false); ?>" class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600 transition hover:bg-gray-200 dark:bg-white/10 dark:text-gray-300 dark:hover:bg-white/20">
                        <i class="ph ph-folders"></i>
                        <?php echo e($category['title'], false); ?>

                    </a>

                    <a href="<?php echo e(url('project/' . $pid . '/' . $slug), false); ?>" class="block text-lg font-bold leading-snug text-gray-900 transition hover:text-primary-600 dark:text-white dark:hover:text-primary-300">
                        <?php echo e($title, false); ?>

                    </a>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <!--[if BLOCK]><![endif]--><?php if($urgent): ?>
                        <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-600 animate-pulse dark:bg-red-500/10 dark:text-red-300">
                            <i class="ph ph-lightning"></i>
                            مشروع مستعجل
                        </span>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <!--[if BLOCK]><![endif]--><?php if($status === 'completed'): ?>
                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-600 dark:bg-green-500/10 dark:text-green-300">
                            <i class="ph ph-check-circle"></i>
                            <?php echo e(__('messages.t_project_completed'), false); ?>

                        </span>
                    <?php elseif($status === 'active'): ?>
                        <span class="inline-flex items-center gap-1 rounded-full bg-primary-50 px-3 py-1 text-xs font-semibold text-primary-600 dark:bg-primary-500/10 dark:text-primary-300">
                            <i class="ph ph-clock"></i>
                            مشروع مفتوح للعروض
                        </span>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <!--[if BLOCK]><![endif]--><?php if($hasSubmittedBid): ?>
                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-300">
                            <i class="ph ph-paper-plane-tilt"></i>
                            <?php echo e(__('messages.t_you_submitted_proposal'), false); ?>

                        </span>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>

            <div class="flex flex-wrap gap-4 text-sm text-gray-500 dark:text-gray-300">
                <span class="inline-flex items-center gap-2">
                    <i class="ph ph-users-three text-base text-primary-500"></i>
                    <?php echo e($total_bids, false); ?> <?php echo e(strtolower(__('messages.t_bids')), false); ?>

                </span>
                <span class="inline-flex items-center gap-2">
                    <i class="ph ph-wallet text-base text-primary-500"></i>
                    <?php echo e($isFixed ? __('messages.t_fixed_price') : __('messages.t_hourly_price'), false); ?>

                </span>
                <span class="inline-flex items-center gap-2">
                    <i class="ph ph-calendar-blank text-base text-primary-500"></i>
                    <?php echo e($created_at, false); ?>

                </span>
            </div>

            <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-300">
                <?php echo e($summary, false); ?>

            </p>

            <!--[if BLOCK]><![endif]--><?php if($skills->count()): ?>
                <div class="flex flex-wrap gap-2">
                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600 transition hover:bg-gray-200 dark:bg-white/10 dark:text-gray-200 dark:hover:bg-white/20">
                            <i class="ph ph-hash"></i>
                            <?php echo e($skill->skill->name, false); ?>

                        </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>

        <div class="flex w-full flex-col justify-between gap-4 rounded-3xl border border-gray-200 bg-white px-5 py-6 shadow-sm lg:w-64 dark:border-white/10 dark:bg-white/10">
            <div class="space-y-2 text-center">
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-gray-400 dark:text-gray-300">الميزانية المقدّرة</p>
                <div class="text-2xl font-bold text-gray-900 dark:text-white">
                    <?php echo e($budget_min, false); ?>

                    <span class="text-sm text-gray-400">–</span>
                    <?php echo e($budget_max, false); ?>

                </div>
                <p class="text-xs text-gray-500 dark:text-gray-300">
                    <?php echo e($isFixed ? 'قيمة إجمالية للمشروع' : 'أجر بالساعة', false); ?>

                </p>
            </div>

            <div class="flex flex-col gap-3">
                <a href="<?php echo e(url('project/' . $pid . '/' . $slug), false); ?>" class="inline-flex items-center justify-center rounded-full bg-primary-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-primary-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-primary-500">
                    <!--[if BLOCK]><![endif]--><?php if($status === 'active'): ?>
                        <?php echo e(__('messages.t_bid_now'), false); ?>

                    <?php else: ?>
                        <?php echo e(__('messages.t_view_project'), false); ?>

                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </a>
                <a href="<?php echo e(url('project/' . $pid . '/' . $slug), false); ?>" class="inline-flex items-center justify-center gap-2 rounded-full border border-gray-200 px-5 py-2 text-xs font-semibold text-gray-600 transition hover:border-primary-400 hover:text-primary-600 dark:border-white/20 dark:text-gray-200 dark:hover:border-primary-400 dark:hover:text-primary-300">
                    <i class="ph ph-robot"></i>
                    اطلب ملخص المساعد الذكي
                </a>
            </div>
        </div>
    </div>
</article>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/cards/project.blade.php ENDPATH**/ ?>