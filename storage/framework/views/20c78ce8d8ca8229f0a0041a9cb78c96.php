<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'value' => 'value',
    'label' => 'label',
    'selected' => 'false',
    'flag' => '',
    'image' => '',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'value' => 'value',
    'label' => 'label',
    'selected' => 'false',
    'flag' => '',
    'image' => '',
]); ?>
<?php foreach (array_filter(([
    'value' => 'value',
    'label' => 'label',
    'selected' => 'false',
    'flag' => '',
    'image' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php foreach ((['onselect' => '']) as $__key => $__value) {
    $__consumeVariable = is_string($__key) ? $__key : $__value;
    $$__consumeVariable = is_string($__key) ? $__env->getConsumableComponentData($__key, $__value) : $__env->getConsumableComponentData($__value);
} ?>

<?php $selected = filter_var($selected, FILTER_VALIDATE_BOOLEAN); ?>
<div class="py-2.5 ltr:pl-4 ltr:pr-3 rtl:pr-4 rtl:pl-3 flex items-center cursor-pointer hover:bg-primary-600 text-gray-500 hover:text-white dark:hover:bg-zinc-800 dark:hover:text-zinc-200 bw-select-item dark:text-zinc-300"
    data-label="<?php echo e($label, false); ?>" data-value="<?php echo e($value, false); ?>" 
    <?php if($selected): ?> data-selected="true" <?php endif; ?>
    <?php if($onselect !== ''): ?> data-user-function="<?php echo e($onselect, false); ?>"<?php endif; ?>>
    <!--[if BLOCK]><![endif]--><?php if($flag !== '' && $image == ''): ?><i class="<?php echo e($flag, false); ?> flag"></i><?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <!--[if BLOCK]><![endif]--><?php if($image !== ''): ?><?php if (isset($component)) { $__componentOriginale9a07e0b7313973438509119684acb8e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale9a07e0b7313973438509119684acb8e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bladewind.avatar','data' => ['size' => 'small','class' => '!mt-0 !mr-4','image' => ''.e($image, false).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bladewind.avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'small','class' => '!mt-0 !mr-4','image' => ''.e($image, false).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale9a07e0b7313973438509119684acb8e)): ?>
<?php $attributes = $__attributesOriginale9a07e0b7313973438509119684acb8e; ?>
<?php unset($__attributesOriginale9a07e0b7313973438509119684acb8e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale9a07e0b7313973438509119684acb8e)): ?>
<?php $component = $__componentOriginale9a07e0b7313973438509119684acb8e; ?>
<?php unset($__componentOriginale9a07e0b7313973438509119684acb8e); ?>
<?php endif; ?><?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <span class="grow ltr:text-left rtl:text-right text-xs+ font-medium"><?php echo $label; ?></span>
    <?php if (isset($component)) { $__componentOriginalb45b6a3c419c4b30c47574e702949233 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb45b6a3c419c4b30c47574e702949233 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bladewind.icon','data' => ['name' => 'check-circle','class' => 'text-slate-400 h-5 w-5 hidden svg-'.e($value, false).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bladewind.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'check-circle','class' => 'text-slate-400 h-5 w-5 hidden svg-'.e($value, false).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb45b6a3c419c4b30c47574e702949233)): ?>
<?php $attributes = $__attributesOriginalb45b6a3c419c4b30c47574e702949233; ?>
<?php unset($__attributesOriginalb45b6a3c419c4b30c47574e702949233); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb45b6a3c419c4b30c47574e702949233)): ?>
<?php $component = $__componentOriginalb45b6a3c419c4b30c47574e702949233; ?>
<?php unset($__componentOriginalb45b6a3c419c4b30c47574e702949233); ?>
<?php endif; ?>
</div><?php /**PATH C:\xampp\htdocs\taquad\resources\views/components/bladewind/select-item.blade.php ENDPATH**/ ?>