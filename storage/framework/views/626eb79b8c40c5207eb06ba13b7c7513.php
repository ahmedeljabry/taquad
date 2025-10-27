<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['label' => null, 'model', 'required' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['label' => null, 'model', 'required' => false]); ?>
<?php foreach (array_filter((['label' => null, 'model', 'required' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div>

    
    <!--[if BLOCK]><![endif]--><?php if($label): ?>
        <label for="text-input-component-id-<?php echo e($model, false); ?>" class="block text-xs font-bold tracking-wide whitespace-nowrap overflow-hidden truncate <?php echo e($errors->first($model) ? 'text-red-600 dark:text-red-500' : 'text-zinc-500 dark:text-white', false); ?>" title="<?php echo e(htmlspecialchars_decode($label), false); ?>">

            
            <?php echo e(htmlspecialchars_decode($label), false); ?>


            
            <!--[if BLOCK]><![endif]--><?php if($required): ?>
                <span class="font-bold text-red-400">*</span>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        </label>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    
    <div class="mt-2.5 relative color-picker-wrapper">
        <input type="text" wire:model.defer="<?php echo e($model, false); ?>" id="color-picker-component-id-<?php echo e($model, false); ?>" class="color-picker-input disabled:cursor-not-allowed focus:!ring focus:!ring-opacity-30 focus:!border-transparent block w-full ltr:pr-10 ltr:pl-4 rtl:pl-10 rtl:!pr-4 py-2.5 placeholder:font-normal placeholder:text-xs dark:placeholder-zinc-300 text-xs font-medium shadow-sm text-zinc-700 dark:text-white rounded-md dark:bg-transparent  cursor-pointer border <?php echo e($errors->first($model) ? 'border-red-500 text-red-600 placeholder-red-400 focus:ring-red-500 focus:border-red-500' : 'border-gray-200 placeholder-gray-400 focus:ring-primary-600 focus:border-primary-600 dark:border-zinc-600', false); ?>" <?php echo e($attributes, false); ?>>
    </div>

    
    <!--[if BLOCK]><![endif]--><?php $__errorArgs = [$model];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="mt-1 text-xs text-red-600 dark:text-red-500"><?php echo e($errors->first($model), false); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

</div><?php /**PATH C:\xampp\htdocs\taquad\resources\views/components/forms/color-picker.blade.php ENDPATH**/ ?>