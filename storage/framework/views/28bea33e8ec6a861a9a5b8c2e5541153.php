<div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 mt-[7rem] py-12 lg:pt-16 lg:pb-24">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <?php if($categories->count()): ?>
            <aside class="lg:col-span-1 bg-white dark:bg-zinc-800 rounded-lg p-6 sticky top-24">
                <h2 class="text-lg font-bold mb-4 text-gray-800 dark:text-white">
                    <?php echo app('translator')->get('messages.t_categories'); ?>
                </h2>

                
                <div wire:loading wire:target="cats" class="flex justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="animate-spin h-6 w-6 text-primary-600" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z" />
                    </svg>
                </div>

                <div class="space-y-2 max-h-64 overflow-auto">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="flex items-center space-x-3 rtl:space-x-reverse">
                            <input type="checkbox"
                                wire:model.live="cats"
                                value="<?php echo e($cat->slug, false); ?>"
                                class="h-4 w-4 text-primary-600 border-gray-300 rounded"
                                wire:key="cat-<?php echo e($cat->id, false); ?>">
                            <span class="text-gray-700 dark:text-gray-200"><?php echo e($cat->name, false); ?></span>
                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </aside>
        <?php endif; ?>

        
        <div class="lg:col-span-3 space-y-12 relative">

            
            <?php if($projects->count()): ?>
                <section>
                    <h1 class="text-xl md:text-2xl font-bold text-gray-800 dark:text-white mb-6">
                        <?php echo app('translator')->get('messages.t_latest_projects'); ?>
                    </h1>
                    <div class="grid grid-cols-1 gap-6 lg:gap-8">
                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <?php if($projects->hasPages()): ?>
                        <div class="mt-8 flex justify-center">
                            <?php echo $projects->links('pagination::tailwind'); ?>

                        </div>
                    <?php endif; ?>
                </section>
            <?php else: ?>
                <p class="text-center text-gray-500"><?php echo app('translator')->get('messages.t_no_projects_found'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/explore/projects/projects.blade.php ENDPATH**/ ?>