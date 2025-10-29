<?php
    $siteTitle     = settings('general')->title;
    $siteSubtitle  = settings('general')->subtitle;
    $footerLogo    = settings('general')->logo_dark ?: settings('general')->logo;
    $footerPages   = collect($pages);
    $columnOne     = $footerPages->where('column', 1);
    $columnTwo     = $footerPages->where('column', 2);
    $columnThree   = $footerPages->where('column', 3);
?>

<footer class="relative overflow-hidden bg-[#0b1220] pt-16 text-gray-200">
    <div aria-hidden class="absolute inset-0 opacity-40">
        <div class="absolute -top-32 -right-24 h-96 w-96 rounded-full bg-primary-500 blur-3xl"></div>
        <div class="absolute bottom-0 -left-24 h-[420px] w-[420px] rounded-full bg-amber-400 blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(255,255,255,0.08),_transparent_55%)]"></div>
    </div>

    <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <!--[if BLOCK]><![endif]--><?php if(auth()->guard()->guest()): ?>
            
            <div class="overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-primary-600 via-primary-500 to-amber-400 px-6 py-10 sm:px-10 sm:py-12 text-white shadow-2xl">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="space-y-3 text-right lg:text-right">
                        <p class="text-xs font-semibold uppercase tracking-[0.4em] text-white/80">جاهز للخطوة التالية؟</p>
                        <h2 class="text-2xl font-bold sm:text-3xl">ابنِ مشروعك مع فريق محترف يدعمه الذكاء الاصطناعي</h2>
                        <p class="text-sm text-white/80 max-w-2xl lg:ml-auto">
                            أطلق المشروع، تابع تنفيذه بدقة، واحصل على توصيات ذكية في كل مرحلة. نحن نجمع أفضل الخبرات في مكان واحد لتسريع نمو أعمالك.
                        </p>
                    </div>
                    <div class="flex flex-col items-stretch gap-3 sm:flex-row sm:items-center">
                        <a href="<?php echo e(url('post/project'), false); ?>" class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-6 py-3 text-sm font-semibold text-primary-600 shadow-lg shadow-black/20 transition hover:-translate-y-0.5">
                            أضف مشروعاً جديداً
                            <i class="ph ph-arrow-up-right"></i>
                        </a>
                        <a href="<?php echo e(url('explore/projects'), false); ?>" class="inline-flex items-center justify-center gap-2 rounded-full border border-white/60 px-6 py-3 text-sm font-semibold text-white/90 backdrop-blur transition hover:-translate-y-0.5 hover:bg-white/10">
                            استكشف المشاريع الجاهزة
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->


        
        <div class="mt-14 grid gap-10 lg:grid-cols-5">

            
            <div class="lg:col-span-2 space-y-6 text-right">
                <!--[if BLOCK]><![endif]--><?php if($footerLogo): ?>
                    <a href="<?php echo e(url('/'), false); ?>" class="inline-flex items-center">
                        <img src="<?php echo e(src($footerLogo), false); ?>" alt="<?php echo e($siteTitle, false); ?>" class="h-10 w-auto">
                    </a>
                <?php else: ?>
                    <span class="text-2xl font-bold text-white"><?php echo e($siteTitle, false); ?></span>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                <p class="text-sm leading-relaxed text-gray-400">
                    <?php echo e($siteSubtitle, false); ?> — منصة موحدة تربطك بخبراء موهوبين في جميع أنحاء المنطقة، مع أدوات ذكية تضمن وضوح الأهداف ودقة النتائج.
                </p>
                <div class="flex flex-wrap items-center justify-end gap-3 text-xs text-gray-400">
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/10 px-3 py-1">
                        <i class="ph ph-lock-open"></i>
                        دفع آمن
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/10 px-3 py-1">
                        <i class="ph ph-timer"></i>
                        دعم على مدار الساعة
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full border border-white/10 px-3 py-1">
                        <i class="ph ph-globe"></i>
                        فرق موزعة عالميًا
                    </span>
                </div>
            </div>

            
            <div class="space-y-4 text-right">
                <h3 class="text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                    <?php echo e(__('messages.t_footer_column_1'), false); ?>

                </h3>
                <!--[if BLOCK]><![endif]--><?php if($columnOne->count()): ?>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $columnOne; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <!--[if BLOCK]><![endif]--><?php if($page->is_link && $page->link): ?>
                                    <a href="<?php echo e($page->link, false); ?>" target="_blank" class="transition hover:text-white">
                                        <?php echo e($page->title, false); ?>

                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(url('page', $page->slug), false); ?>" class="transition hover:text-white">
                                        <?php echo e($page->title, false); ?>

                                    </a>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </ul>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            
            <div class="space-y-4 text-right">
                <h3 class="text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                    <?php echo e(__('messages.t_footer_column_2'), false); ?>

                </h3>
                <!--[if BLOCK]><![endif]--><?php if($columnTwo->count()): ?>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $columnTwo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <!--[if BLOCK]><![endif]--><?php if($page->is_link && $page->link): ?>
                                    <a href="<?php echo e($page->link, false); ?>" target="_blank" class="transition hover:text-white">
                                        <?php echo e($page->title, false); ?>

                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(url('page', $page->slug), false); ?>" class="transition hover:text-white">
                                        <?php echo e($page->title, false); ?>

                                    </a>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </ul>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            
            <div class="space-y-6 text-right">
                <div class="space-y-4">
                    <h3 class="text-xs font-semibold uppercase tracking-[0.4em] text-white/70">
                        <?php echo e(__('messages.t_footer_column_3'), false); ?>

                    </h3>
                    <!--[if BLOCK]><![endif]--><?php if($columnThree->count()): ?>
                        <ul class="space-y-3 text-sm text-gray-400">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $columnThree; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <!--[if BLOCK]><![endif]--><?php if($page->is_link && $page->link): ?>
                                        <a href="<?php echo e($page->link, false); ?>" target="_blank" class="transition hover:text-white">
                                            <?php echo e($page->title, false); ?>

                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(url('page', $page->slug), false); ?>" class="transition hover:text-white">
                                            <?php echo e($page->title, false); ?>

                                        </a>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </ul>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <div class="space-y-3">
                    <h4 class="text-xs font-semibold uppercase tracking-[0.4em] text-white/70">تابعنا</h4>
                    <div class="flex flex-wrap items-center justify-end gap-3">
                        <!--[if BLOCK]><![endif]--><?php if(settings('footer')->social_facebook): ?>
                            <a href="<?php echo e(settings('footer')->social_facebook, false); ?>" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#1877f2] text-white transition hover:bg-opacity-80"> <i class="ph ph-facebook-logo"></i> </a>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <?php if(settings('footer')->social_twitter): ?>
                            <a href="<?php echo e(settings('footer')->social_twitter, false); ?>" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#1da1f2] text-white transition hover:bg-opacity-80"> <i class="ph ph-twitter-logo"></i> </a>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <?php if(settings('footer')->social_instagram): ?>
                            <a href="<?php echo e(settings('footer')->social_instagram, false); ?>" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-tr from-[#f09433] via-[#e6683c] to-[#bc1888] text-white transition hover:opacity-90"> <i class="ph ph-instagram-logo"></i> </a>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <?php if(settings('footer')->social_linkedin): ?>
                            <a href="<?php echo e(settings('footer')->social_linkedin, false); ?>" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#0a66c2] text-white transition hover:bg-opacity-80"> <i class="ph ph-linkedin-logo"></i> </a>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <?php if(settings('footer')->social_youtube): ?>
                            <a href="<?php echo e(settings('footer')->social_youtube, false); ?>" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#ff0000] text-white transition hover:bg-opacity-75"> <i class="ph ph-youtube-logo"></i> </a>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <?php if(settings('footer')->social_whatsapp): ?>
                            <a href="<?php echo e(settings('footer')->social_whatsapp, false); ?>" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#25d366] text-white transition hover:bg-opacity-80"> <i class="ph ph-whatsapp-logo"></i> </a>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <?php if(settings('footer')->social_telegram): ?>
                            <a href="<?php echo e(settings('footer')->social_telegram, false); ?>" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#26A5E4] text-white transition hover:bg-opacity-80"> <i class="ph ph-paper-plane-tilt"></i> </a>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <?php if(settings('footer')->social_vk): ?>
                            <a href="<?php echo e(settings('footer')->social_vk, false); ?>" target="_blank" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#0077FF] text-white transition hover:bg-opacity-80"> <i class="ph ph-globe-hemisphere-east"></i> </a>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>

                <div class="flex flex-wrap items-center justify-end gap-3">
                    <?php if(settings('footer')->is_language_switcher): ?>
                        <div class="rounded-full border border-white/15 px-4 py-2">
                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('main.partials.languages');

$__html = app('livewire')->mount($__name, $__params, 'lw-1367081238-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <!--[if BLOCK]><![endif]--><?php if(settings('appearance')->is_theme_switcher): ?>
                        <div x-data="themeToggle()">
                            <button type="button"
                                class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-white/10 text-white transition hover:bg-white/20 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/40"
                                @click="setTheme(preference === 'dark' ? 'light' : 'dark')">
                                <span class="sr-only"><?php echo e(__('messages.t_theme_toggle'), false); ?></span>
                                <i :class="preference === 'dark' ? 'ph ph-sun' : 'ph ph-moon'"></i>
                            </button>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
            </div>

        </div>

        
        <div class="mt-12 flex flex-col items-center justify-between gap-4 border-t border-white/10 py-6 text-xs text-gray-400 sm:flex-row">
            <p class="order-2 sm:order-1">© <?php echo e(date('Y'), false); ?> <?php echo e($siteTitle, false); ?>. جميع الحقوق محفوظة.</p>
            <div class="order-1 sm:order-2 flex flex-wrap items-center gap-3 text-xs text-gray-400">
                <span class="inline-flex items-center gap-2">
                    <i class="ph ph-shield-check"></i>
                    شهادات أمان محدثة
                </span>
                <span class="inline-flex items-center gap-2">
                    <i class="ph ph-credit-card"></i>
                    طرق دفع متعددة
                </span>
            </div>
        </div>

    </div>
</footer>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/includes/footer.blade.php ENDPATH**/ ?>