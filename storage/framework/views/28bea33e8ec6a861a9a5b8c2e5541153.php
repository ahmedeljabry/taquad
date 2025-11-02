<div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 mt-[7rem] py-12 lg:pt-16 lg:pb-24">
    <section
        class="relative overflow-hidden bg-gradient-to-b from-primary-50 via-white to-white dark:from-[#0f172a] dark:via-[#0b1220] dark:to-[#080d17]">



        <div class="grid grid-cols-1 gap-8 lg:grid-cols-4" id="projects-filters">
            
            <!--[if BLOCK]><![endif]--><?php if($categories->count()): ?>
                
                <aside
                    class="lg:col-span-1 bg-white dark:bg-zinc-800 rounded-2xl p-5 shadow-md sticky top-20 max-h-[85vh] overflow-y-auto custom-scroll">

                    <div wire:loading.flex wire:target="cats,budget_min,budget_max,type,date,verified,skill"
                        class="justify-center mb-4">
                        <svg class="animate-spin h-5 w-5 text-primary-600" fill="none" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25" />
                            <path d="M4 12a8 8 0 018-8v8z" fill="currentColor" class="opacity-75" />
                        </svg>
                    </div>

                    <div class="space-y-8">

                        <div x-data="{ open: true }">
                            <button @click="open=!open"
                                class="flex w-full justify-between items-center text-gray-800 dark:text-white font-extrabold tracking-wide">
                                <?php echo app('translator')->get('messages.t_categories'); ?>
                                <svg :class="open ? 'rotate-180' : ''" class="h-4 w-4 transition-transform duration-150"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="open" x-transition.opacity.duration.200ms
                                class="space-y-3 mt-3 max-h-52 overflow-y-auto pr-1 custom-scroll">
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="group flex justify-between items-center text-sm rtl:space-x-reverse">
                                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                            <input type="checkbox" wire:model.live="cats" value="<?php echo e($cat->slug, false); ?>"
                                                wire:key="cat-<?php echo e($cat->id, false); ?>" class="h-4 w-4 text-primary-600 rounded border-gray-300
                                                                        focus:ring-primary-400 transition-transform
                                                                        duration-100 checked:scale-110">
                                            <span class="text-gray-700 dark:text-gray-200
                                                                    group-[input:checked+&]:text-primary-600
                                                                    group-[input:checked+&]:font-semibold">
                                                <?php echo e($cat->name, false); ?>

                                            </span>
                                        </div>

                                        <span class="min-w-[24px] text-center text-xs rounded-full
                                                                bg-gray-100 dark:bg-zinc-700
                                                                text-gray-600 dark:text-gray-300 px-1.5 py-0.5">
                                            <?php echo e($cat->projects_count, false); ?>

                                        </span>
                                    </label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>

                        
                        <div x-data="{ open: true }">
                            <button @click="open=!open"
                                class="flex w-full justify-between items-center text-gray-800 dark:text-white font-extrabold tracking-wide">
                                الميزانية
                                <svg :class="open ? 'rotate-180' : ''"
                                    class="h-4 w-4 transition-transform duration-150"></svg>
                            </button>

                            <div x-show="open" x-transition.opacity.duration.200ms class="grid grid-cols-2 gap-2 mt-3">
                                <input type="number" placeholder="من" wire:model.lazy="budget_min" class="w-full text-sm rounded border-gray-300 focus:ring-primary-600
                                                    focus:border-primary-600 bg-white dark:bg-zinc-900">
                                <input type="number" placeholder="إلى" wire:model.lazy="budget_max" class="w-full text-sm rounded border-gray-300 focus:ring-primary-600
                                                    focus:border-primary-600 bg-white dark:bg-zinc-900">
                            </div>
                        </div>

                        
                        <div>
                            <h3 class="text-gray-800 dark:text-white font-extrabold tracking-wide mb-3">
                                نوع المشروع
                            </h3>
                            <label class="flex items-center space-x-2 rtl:space-x-reverse mb-2 text-sm">
                                <input type="radio" value="fixed" wire:model.live="type"
                                    class="h-4 w-4 text-primary-600 border-gray-300">
                                <span>سعر ثابت</span>
                            </label>
                            <label class="flex items-center space-x-2 rtl:space-x-reverse text-sm">
                                <input type="radio" value="hourly" wire:model.live="type"
                                    class="h-4 w-4 text-primary-600 border-gray-300">
                                <span>بالساعة</span>
                            </label>
                        </div>

                        
                        <div>
                            <h3 class="text-gray-800 dark:text-white font-extrabold tracking-wide mb-3">
                                تاريخ النشر
                            </h3>
                            <select wire:model.live="date"
                                class="w-full text-sm rounded border-gray-300 focus:ring-primary-600 focus:border-primary-600 bg-white dark:bg-zinc-900">
                                <option value="">الكل</option>
                                <option value="1">آخر 24 ساعة</option>
                                <option value="7">آخر 7 أيام</option>
                                <option value="30">آخر 30 يومًا</option>
                            </select>
                        </div>

                        
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <input type="checkbox" wire:model.live="verified"
                                class="h-4 w-4 text-primary-600 border-gray-300 rounded">
                            <span class="text-gray-800 dark:text-white font-extrabold tracking-wide text-sm">
                                عميل موثّق فقط
                            </span>
                        </div>

                        
                        <div>
                            <input type="text" placeholder="ابحث عن مهارة..." wire:model.lazy="skill"
                                class="w-full text-sm rounded border-gray-300 focus:ring-primary-600 focus:border-primary-600 bg-white dark:bg-zinc-900">
                        </div>
                    </div>
                </aside>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            
            <div class="lg:col-span-3 space-y-12 relative">

                <?php
                    $totalProjects = method_exists($projects, 'total') ? $projects->total() : $projects->count();
                    $selectedCategories = collect($categories ?? [])->whereIn('slug', (array) ($cats ?? []))->pluck('name');
                    $hasFilters = ($selectedCategories->count() > 0)
                        || !empty($type)
                        || !empty($skill)
                        || !empty($date)
                        || !empty($verified)
                        || !empty($budget_min)
                        || !empty($budget_max);
                ?>

                <div class="rounded-3xl border border-gray-200 bg-white/80 p-5 shadow-sm backdrop-blur dark:border-white/10 dark:bg-white/5"
                    data-animate>
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                        <div class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                            عرض <?php echo e(number_format($projects->count()), false); ?> من <?php echo e(number_format($totalProjects), false); ?> مشاريع
                            متاحة
                        </div>

                        <!--[if BLOCK]><![endif]--><?php if($hasFilters): ?>
                            <div class="flex flex-wrap gap-3 text-xs">
                                <!--[if BLOCK]><![endif]--><?php if($selectedCategories->count()): ?>
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-primary-50 px-3 py-1 font-semibold text-primary-600 dark:bg-primary-500/10 dark:text-primary-300">
                                        <i class="ph ph-folders"></i>
                                        <?php echo e(__('messages.t_categories'), false); ?>:
                                        <?php echo e($selectedCategories->take(2)->implode('، '), false); ?><!--[if BLOCK]><![endif]--><?php if($selectedCategories->count() > 2): ?>
                                        <?php echo e(' +' . ($selectedCategories->count() - 2), false); ?> <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                <!--[if BLOCK]><![endif]--><?php if(!empty($type)): ?>
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-primary-50 px-3 py-1 font-semibold text-primary-600 dark:bg-primary-500/10 dark:text-primary-300">
                                        <i class="ph ph-briefcase"></i>
                                        <?php echo e($type === 'fixed' ? 'سعر ثابت' : 'بالساعة', false); ?>

                                    </span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                <!--[if BLOCK]><![endif]--><?php if(!empty($skill)): ?>
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-primary-50 px-3 py-1 font-semibold text-primary-600 dark:bg-primary-500/10 dark:text-primary-300">
                                        <i class="ph ph-lightbulb"></i>
                                        <?php echo e($skill, false); ?>

                                    </span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                <!--[if BLOCK]><![endif]--><?php if(!empty($budget_min) || !empty($budget_max)): ?>
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-primary-50 px-3 py-1 font-semibold text-primary-600 dark:bg-primary-500/10 dark:text-primary-300">
                                        <i class="ph ph-coins"></i>
                                        الميزانية: <?php echo e($budget_min ?: '0', false); ?> - <?php echo e($budget_max ?: '∞', false); ?>

                                    </span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                <!--[if BLOCK]><![endif]--><?php if(!empty($date)): ?>
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-primary-50 px-3 py-1 font-semibold text-primary-600 dark:bg-primary-500/10 dark:text-primary-300">
                                        <i class="ph ph-calendar"></i>
                                        <?php echo e($date == 1 ? 'آخر 24 ساعة' : ($date == 7 ? 'آخر 7 أيام' : 'آخر 30 يوماً'), false); ?>

                                    </span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                <!--[if BLOCK]><![endif]--><?php if(!empty($verified)): ?>
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 font-semibold text-green-700 dark:bg-green-500/10 dark:text-green-300">
                                        <i class="ph ph-shield-check"></i>
                                        عملاء موثّقون
                                    </span>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        <?php else: ?>
                            <div class="text-xs text-gray-500 dark:text-gray-300">
                                استخدم أدوات التصفية لتضييق نطاق النتائج، أو دع المساعد الذكي يرشّح لك المشاريع المناسبة.
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>

                
                <!--[if BLOCK]><![endif]--><?php if($projects->count()): ?>
                    <section>
                        <h1 class="text-xl md:text-2xl font-bold text-gray-800 dark:text-white mb-6">
                            <?php echo app('translator')->get('messages.t_latest_projects'); ?>
                        </h1>
                        <div class="grid grid-cols-1 gap-6 lg:gap-8">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('main.cards.project', ['id' => $project->uid]);

$__html = app('livewire')->mount($__name, $__params, 'project-' . $project->uid, $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>

                        <!--[if BLOCK]><![endif]--><?php if($projects->hasPages()): ?>
                            <div class="mt-8 flex justify-center">
                                <?php echo e($projects->links(), false); ?>

                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </section>
                <?php else: ?>
                    <p class="text-center text-gray-500"><?php echo app('translator')->get('messages.t_no_projects_found'); ?></p>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </section>
</div>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/explore/projects/projects.blade.php ENDPATH**/ ?>