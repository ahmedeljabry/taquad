<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['model', 'label' => null, 'required' => false, 'live' => false, 'placeholder' => null, 'hint' => null]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['model', 'label' => null, 'required' => false, 'live' => false, 'placeholder' => null, 'hint' => null]); ?>
<?php foreach (array_filter((['model', 'label' => null, 'required' => false, 'live' => false, 'placeholder' => null, 'hint' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div>

    
    <?php if($label): ?>
        <label for="select-component-id-<?php echo e($model, false); ?>" class="block text-xs font-bold tracking-wide whitespace-nowrap overflow-hidden truncate <?php echo e($errors->first($model) ? 'text-red-600 dark:text-red-500' : 'text-zinc-500 dark:text-white', false); ?>" title="<?php echo e(htmlspecialchars_decode($label), false); ?>">

            
            <?php echo e(htmlspecialchars_decode($label), false); ?>


            
            <?php if($required): ?>
                <span class="font-bold text-red-400">*</span>
            <?php endif; ?>

        </label>
    <?php endif; ?>

    
    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['relative', 'mt-2.5' => isset($label)]); ?>">
        <select 
            id="select-component-id-<?php echo e($model, false); ?>"  
            <?php if($live): ?>
                wire:model.live="<?php echo e($model, false); ?>"
            <?php else: ?>
                wire:model="<?php echo e($model, false); ?>"
            <?php endif; ?>
            class="disabled:cursor-not-allowed focus:!ring focus:!ring-opacity-30 focus:!border-transparent block w-full ltr:pr-10 ltr:pl-4 rtl:pl-10 rtl:!pr-4 py-2.5 placeholder:font-normal placeholder:!text-gray-200 dark:placeholder-zinc-300 text-xs shadow-sm font-medium tracking-wide text-zinc-700 dark:text-white rounded-md hover:!border-primary-600 dark:bg-transparent <?php echo e($errors->first($model) ? 'focus:!ring-red-600 focus:!border-red-600 border-red-500' : 'focus:!ring-primary-600 focus:!border-primary-600 border-gray-300 dark:border-zinc-600', false); ?>" <?php echo e($attributes, false); ?>>
            
            
            <?php if($placeholder): ?>
                <option hidden><?php echo e(htmlspecialchars_decode($placeholder), false); ?></option>
            <?php endif; ?>

            
            <?php echo e($options, false); ?>

    
        </select>
    </div>

    
    <?php if($hint): ?>
        <p class="mt-1 text-xs text-gray-400 dark:text-gray-200"><?php echo $hint; ?></p>
    <?php endif; ?>

    
    <?php $__errorArgs = [$model];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="mt-1 text-xs text-red-600 dark:text-red-500"><?php echo e($errors->first($model), false); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

</div><?php /**PATH C:\xampp\htdocs\taquad\resources\views/components/forms/select-simple.blade.php ENDPATH**/ ?>