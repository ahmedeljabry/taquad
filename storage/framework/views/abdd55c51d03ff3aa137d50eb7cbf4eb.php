<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([ 
    // unique name for identifying the toggle element
    // useful for checking the value of the toggle when form is submitted
    'name' => 'bw-toggle',
    // label to display next to the toggle element
    'label' => '',
    // position of the label above.. left or right
    'label_position' => 'left',
    'labelPosition' => 'left',
    // sets or unsets disabled on the toggle element
    'disabled' => false,
    // sets or unsets checked on the toggle element
    'checked' => false,
    // background color to display when toggle is active
    'color' => 'blue',
    // should the label and toggle element be justified in their parent element
    'justified' => false,
    // how thin or thick should the toggle bar be
    'bar' => 'thick',
    // javascript function to run when toggle is clicked
    'onclick' => 'javascript:void(0)',
    // css for label
    'class' => '',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([ 
    // unique name for identifying the toggle element
    // useful for checking the value of the toggle when form is submitted
    'name' => 'bw-toggle',
    // label to display next to the toggle element
    'label' => '',
    // position of the label above.. left or right
    'label_position' => 'left',
    'labelPosition' => 'left',
    // sets or unsets disabled on the toggle element
    'disabled' => false,
    // sets or unsets checked on the toggle element
    'checked' => false,
    // background color to display when toggle is active
    'color' => 'blue',
    // should the label and toggle element be justified in their parent element
    'justified' => false,
    // how thin or thick should the toggle bar be
    'bar' => 'thick',
    // javascript function to run when toggle is clicked
    'onclick' => 'javascript:void(0)',
    // css for label
    'class' => '',
]); ?>
<?php foreach (array_filter(([ 
    // unique name for identifying the toggle element
    // useful for checking the value of the toggle when form is submitted
    'name' => 'bw-toggle',
    // label to display next to the toggle element
    'label' => '',
    // position of the label above.. left or right
    'label_position' => 'left',
    'labelPosition' => 'left',
    // sets or unsets disabled on the toggle element
    'disabled' => false,
    // sets or unsets checked on the toggle element
    'checked' => false,
    // background color to display when toggle is active
    'color' => 'blue',
    // should the label and toggle element be justified in their parent element
    'justified' => false,
    // how thin or thick should the toggle bar be
    'bar' => 'thick',
    // javascript function to run when toggle is clicked
    'onclick' => 'javascript:void(0)',
    // css for label
    'class' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php 
    // reset variables for Laravel 8 support
    if ($labelPosition !== $label_position) $label_position = $labelPosition;
    $name = preg_replace('/[\s-]/', '_', $name);
    $disabled = filter_var($disabled, FILTER_VALIDATE_BOOLEAN);
    $checked = filter_var($checked, FILTER_VALIDATE_BOOLEAN);
    $justified = filter_var($justified, FILTER_VALIDATE_BOOLEAN);
?>

<label class="relative <?php if(!$justified): ?>inline-flex <?php else: ?> flex justify-between <?php endif; ?> items-center group" onclick="<?php echo $onclick; ?>">
    <?php if($label_position == 'left' && $label !== ''): ?><span class="ltr:pr-3 rtl:pl-3 <?php echo e($class, false); ?>"><?php echo $label; ?></span><?php endif; ?>
    <input type="checkbox" wire:model="<?php echo e($name, false); ?>" <?php if($checked): ?> checked <?php endif; ?> <?php if($disabled): ?> disabled <?php endif; ?> class="absolute ltr:left-1/2 rtl:right-1/2 ltr:-translate-x-1/2 rtl:translate-x-1/2 w-full h-full peer sr-only appearance-none border-0 rounded-full cursor-pointer" />
    <span  class="w-8 <?php if($bar=='thick'): ?> h-5 <?php else: ?> h-4 <?php endif; ?> flex items-center flex-shrink-0 p-1 bg-gray-300  dark:bg-zinc-700 rounded-full duration-300 ease-in-out cursor-pointer
        peer-disabled:opacity-40 <?php if($color=='red'): ?>peer-checked:bg-red-500/80 <?php endif; ?> <?php if($color=='yellow'): ?>peer-checked:bg-yellow-500/80 <?php endif; ?> <?php if($color=='green'): ?>peer-checked:bg-green-500/80 <?php endif; ?> <?php if($color=='pink'): ?>peer-checked:bg-pink-500/80 <?php endif; ?> <?php if($color=='cyan'): ?>peer-checked:bg-cyan-500/80 <?php endif; ?> <?php if($color=='gray'): ?>peer-checked:bg-zinc-500 <?php endif; ?> <?php if($color=='purple'): ?>peer-checked:bg-purple-500/80 <?php endif; ?> <?php if($color=='orange'): ?>peer-checked:bg-orange-500/80 <?php endif; ?> <?php if($color=='blue'): ?>peer-checked:bg-primary-600 <?php endif; ?> after:w-3 after:h-3 after:bg-white after:rounded-full after:shadow-md after:duration-300
        peer-checked:after:translate-x-3 group-hover:after:translate-x-0"></span>
    <?php if($label_position=='right' && $label !== ''): ?><span class="ltr:pl-3 rtl:pr-3 text-xs+ text-gray-500 dark:text-zinc-300 cursor-pointer <?php echo e($class, false); ?>"><?php echo $label; ?></span><?php endif; ?>
</label><?php /**PATH C:\xampp\htdocs\taquad\resources\views/components/bladewind/toggle.blade.php ENDPATH**/ ?>