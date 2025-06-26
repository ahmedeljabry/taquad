<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['icon', 'title' => null, 'href' => null, 'action' => null, 'iconColor' => 'text-gray-500 dark:text-zinc-300']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['icon', 'title' => null, 'href' => null, 'action' => null, 'iconColor' => 'text-gray-500 dark:text-zinc-300']); ?>
<?php foreach (array_filter((['icon', 'title' => null, 'href' => null, 'action' => null, 'iconColor' => 'text-gray-500 dark:text-zinc-300']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>


<?php
    $class = "h-8 w-8 flex items-center justify-center focus:ring-2 focus:ring-offset-0 focus:ring-primary-700 focus:border-transparent p-1.5 border-gray-200 text-gray-600 dark:text-gray-300 border rounded shadow-sm hover:shadow-none focus:outline-none focus:border-gray-800 focus:shadow-outline-gray dark:border-zinc-700 dark:hover:text-zinc-200 dark:hover:border-zinc-600";
?>


<?php if($href): ?>
    
    <a href="<?php echo e($href, false); ?>" class="<?php echo e($class, false); ?> " data-tooltip-target="tooltip-table-action-<?php echo e($icon, false); ?>" <?php echo e($attributes, false); ?>>

        
        <i class="ph-bold ph-<?php echo e($icon, false); ?> <?php echo e($iconColor, false); ?> text-[17px] mt-px"></i>

        
        <?php if($title): ?>
            <?php if (isset($component)) { $__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Tooltip::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.tooltip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Tooltip::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'tooltip-table-action-'.e($icon, false).'','text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265)): ?>
<?php $attributes = $__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265; ?>
<?php unset($__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265)): ?>
<?php $component = $__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265; ?>
<?php unset($__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265); ?>
<?php endif; ?>
        <?php endif; ?>

    </a>

<?php else: ?>

    <button class="<?php echo e($class, false); ?>" data-tooltip-target="tooltip-table-action-<?php echo e($icon, false); ?>" <?php if($action): ?> wire:click="<?php echo e($action, false); ?>" <?php endif; ?> <?php echo e($attributes, false); ?>>

        
        <i class="ph-bold ph-<?php echo e($icon, false); ?> <?php echo e($iconColor, false); ?> text-[17px] mt-px"></i>

        
        <?php if($title): ?>
            <?php if (isset($component)) { $__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Tooltip::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.tooltip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Tooltip::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'tooltip-table-action-'.e($icon, false).'','text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265)): ?>
<?php $attributes = $__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265; ?>
<?php unset($__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265)): ?>
<?php $component = $__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265; ?>
<?php unset($__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265); ?>
<?php endif; ?>
        <?php endif; ?>

    </button>

<?php endif; ?><?php /**PATH C:\xampp\htdocs\taquad\resources\views/components/table/action-button.blade.php ENDPATH**/ ?>