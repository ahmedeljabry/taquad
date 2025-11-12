<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['label' => null, 'placeholder' => null, 'model', 'type' => 'text', 'icon' => null, 'svg_icon' => null, 'suffix' => false, 'hint' => null, 'required' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['label' => null, 'placeholder' => null, 'model', 'type' => 'text', 'icon' => null, 'svg_icon' => null, 'suffix' => false, 'hint' => null, 'required' => false]); ?>
<?php foreach (array_filter((['label' => null, 'placeholder' => null, 'model', 'type' => 'text', 'icon' => null, 'svg_icon' => null, 'suffix' => false, 'hint' => null, 'required' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div>

    
    <!--[if BLOCK]><![endif]--><?php if($label): ?>
        <label for="text-input-component-id-<?php echo e($model, false); ?>" class="block font-medium  tracking-wide whitespace-nowrap overflow-hidden truncate <?php echo e($errors->first($model) ? 'text-red-600 dark:text-red-500' : 'text-black dark:text-white', false); ?>" title="<?php echo e(htmlspecialchars_decode($label), false); ?>">

            
            <?php echo e(htmlspecialchars_decode($label), false); ?>


            
            <!--[if BLOCK]><![endif]--><?php if($required): ?>
                <span class="font-bold text-red-400">*</span>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

        </label>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['relative', 'mt-2.5' => isset($label)]); ?>">

        
        <input
            <?php if($required): ?> required <?php endif; ?>
            type="<?php echo e($type, false); ?>"
            <?php if($placeholder): ?> placeholder="<?php echo e(htmlspecialchars_decode($placeholder), false); ?>" <?php endif; ?>
            wire:model="<?php echo e($model, false); ?>"
            id="text-input-component-id-<?php echo e($model, false); ?>"
            <?php echo e($type === 'password' ? 'readonly' : '', false); ?>

            onfocus="<?php echo e($type === 'password' ? "this.removeAttribute('readonly');" : "", false); ?>"
            class="disabled:cursor-not-allowed disabled:bg-gray-100 dark:disabled:bg-transparent focus:!ring focus:!ring-opacity-30 focus:!border-transparent block w-full ltr:pr-10 ltr:pl-4 rtl:pl-10 rtl:!pr-4 py-2.5 placeholder:font-normal placeholder:text-gray-400 dark:placeholder-zinc-300 text-xs shadow-sm font-medium tracking-wide text-zinc-700 dark:text-white rounded-md dark:bg-transparent <?php echo e($errors->first($model) ? 'focus:!ring-red-600 focus:!border-red-600 border-red-500' : 'focus:!ring-primary-600 focus:!border-primary-600 border-gray-300 dark:border-zinc-600', false); ?>"
            <?php echo e($attributes, false); ?> />

        <!--[if BLOCK]><![endif]--><?php if($suffix): ?>
            
            <div class="absolute inset-y-0 ltr:right-0 rtl:left-0 ltr:pr-3 rtl:pl-3 flex items-center pointer-events-none text-sm font-medium tracking-wider">
                <span class="<?php echo e($errors->first($model) ? 'text-red-400' : 'text-gray-400', false); ?>"><?php echo e($suffix, false); ?></span>
            </div>
        <?php elseif($icon): ?>
            
            <div class="absolute inset-y-0 ltr:right-0 rtl:left-0 ltr:pr-4 rtl:pl-4 flex items-center pointer-events-none">
                <i class="ph-duotone ph-<?php echo e($icon, false); ?> <?php echo e($errors->first($model) ? 'text-red-400' : 'text-slate-400 dark:text-zinc-400', false); ?> text-xl"></i>
            </div>
        <?php elseif($svg_icon): ?>
            
            <div class="absolute inset-y-0 ltr:right-0 rtl:left-0 ltr:pr-4 rtl:pl-4 flex items-center pointer-events-none">
                <?php echo $svg_icon; ?>

            </div>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    </div>

    
    <!--[if BLOCK]><![endif]--><?php if($hint): ?>
        <p class="mt-1 text-xs text-gray-400 dark:text-gray-200"><?php echo $hint; ?></p>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    
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

</div>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/components/forms/text-input.blade.php ENDPATH**/ ?>