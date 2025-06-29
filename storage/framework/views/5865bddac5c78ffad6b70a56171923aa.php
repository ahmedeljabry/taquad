<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    // name of the input field for use in passing form submission data
    // this is prefixed with bw- when used as a class name
    'name' => 'bw-filepicker',
    // the default text to display in the file picker
    'placeholder' => 'Select a file',
    // by default all file audo, video, image and pdf file types can be selected
    // either restrict or allow more file types by modifying this value
    'accepted_file_types' => 'audio/*,video/*,image/*, .pdf',
    'acceptedFileTypes' => 'audio/*,video/*,image/*, .pdf',
    // should the user be forced to select a file. used in conjunction with validation scripts
    // default is false.
    'required' => false,
    // maximum allowed filezie in MB
    'max_file_size' => 5,
    'maxFileSize'   => 5,
    // adds margin after the input box
    'add_clearing' => true,
    'addClearing' => true,
    // display a selected value by default
    'selected_value' => '',
    'selectedValue' => '',
    // the css to apply to the selected value
    'selected_value_class' => 'h-52',
    'selectedValueClass' => 'h-52',
    // file to display in edit mode
    'url' => '',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    // name of the input field for use in passing form submission data
    // this is prefixed with bw- when used as a class name
    'name' => 'bw-filepicker',
    // the default text to display in the file picker
    'placeholder' => 'Select a file',
    // by default all file audo, video, image and pdf file types can be selected
    // either restrict or allow more file types by modifying this value
    'accepted_file_types' => 'audio/*,video/*,image/*, .pdf',
    'acceptedFileTypes' => 'audio/*,video/*,image/*, .pdf',
    // should the user be forced to select a file. used in conjunction with validation scripts
    // default is false.
    'required' => false,
    // maximum allowed filezie in MB
    'max_file_size' => 5,
    'maxFileSize'   => 5,
    // adds margin after the input box
    'add_clearing' => true,
    'addClearing' => true,
    // display a selected value by default
    'selected_value' => '',
    'selectedValue' => '',
    // the css to apply to the selected value
    'selected_value_class' => 'h-52',
    'selectedValueClass' => 'h-52',
    // file to display in edit mode
    'url' => '',
]); ?>
<?php foreach (array_filter(([
    // name of the input field for use in passing form submission data
    // this is prefixed with bw- when used as a class name
    'name' => 'bw-filepicker',
    // the default text to display in the file picker
    'placeholder' => 'Select a file',
    // by default all file audo, video, image and pdf file types can be selected
    // either restrict or allow more file types by modifying this value
    'accepted_file_types' => 'audio/*,video/*,image/*, .pdf',
    'acceptedFileTypes' => 'audio/*,video/*,image/*, .pdf',
    // should the user be forced to select a file. used in conjunction with validation scripts
    // default is false.
    'required' => false,
    // maximum allowed filezie in MB
    'max_file_size' => 5,
    'maxFileSize'   => 5,
    // adds margin after the input box
    'add_clearing' => true,
    'addClearing' => true,
    // display a selected value by default
    'selected_value' => '',
    'selectedValue' => '',
    // the css to apply to the selected value
    'selected_value_class' => 'h-52',
    'selectedValueClass' => 'h-52',
    // file to display in edit mode
    'url' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php
       $name                                                                 = preg_replace('/[\s-]/', '_', $name);
       $required                                                             = filter_var($required, FILTER_VALIDATE_BOOLEAN);
       $add_clearing                                                         = filter_var($add_clearing, FILTER_VALIDATE_BOOLEAN);
       $addClearing                                                          = filter_var($addClearing, FILTER_VALIDATE_BOOLEAN);
    if (!$addClearing) $add_clearing                                         = $addClearing;
    if ($acceptedFileTypes !== $accepted_file_types) $accepted_file_types    = $acceptedFileTypes;
    if ($selectedValue !== $selected_value) $selected_value                  = $selectedValue;
    if ($selectedValueClass !== $selected_value_class) $selected_value_class = $selectedValueClass;
    if ($maxFileSize !== $max_file_size) $max_file_size                      = $maxFileSize;
    if (! is_numeric($max_file_size)) $max_file_size                         = 5;
       $image_file_types                                                     = [ "png", "jpg", "jpeg", "gif", "svg", "webp" ];
?>
<div class="border-gray-500"></div>
<div class="relative px-2 py-3 border-2 border-dashed border-gray-300 dark:text-dark-300 dark:border-zinc-600
    dark:bg-dark-800 hover:dark:border-gray-400 text-center cursor-pointer rounded-md bw-fp-<?php echo e($name, false); ?> <?php if($add_clearing): ?> mb-3 <?php endif; ?>">
    <?php if (isset($component)) { $__componentOriginalb45b6a3c419c4b30c47574e702949233 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb45b6a3c419c4b30c47574e702949233 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bladewind.icon','data' => ['name' => 'document-text','class' => 'h-6 w-6 absolute z-20 left-4 text-gray-300']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bladewind.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'document-text','class' => 'h-6 w-6 absolute z-20 left-4 text-gray-300']); ?>
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
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute z-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"  d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
    </svg>
    <?php if (isset($component)) { $__componentOriginalb45b6a3c419c4b30c47574e702949233 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb45b6a3c419c4b30c47574e702949233 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bladewind.icon','data' => ['name' => 'x-circle','class' => 'absolute ltr:right-3 rtl:left-3 h-6 w-6 text-gray-400 hover:text-red-600 clear cursor-pointer hidden','type' => 'solid']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bladewind.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'x-circle','class' => 'absolute ltr:right-3 rtl:left-3 h-6 w-6 text-gray-400 hover:text-red-600 clear cursor-pointer hidden','type' => 'solid']); ?>
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
    <span class="text-gray-400/80 dark:text-zinc-300 px-6 pl-10 zoom-out inline-block selection text-xs">
        <?php echo e($placeholder, false); ?>

        <?php if($required): ?> <span class="text-red-300">*</span><?php endif; ?>
    </span>
    <div class="w-0 h-0 overflow-hidden">
        <input 
            type="file" 
            wire:model="<?php echo e($name, false); ?>"
            class="bw-<?php echo e($name, false); ?> <?php if($required): ?> required <?php endif; ?>"
            id="bw_<?php echo e($name, false); ?>" 
            accept="<?php echo e($accepted_file_types, false); ?>" />
            <textarea class="b64-<?php echo e($name, false); ?><?php if($required): ?> required <?php endif; ?>" name="b64_<?php echo e($name, false); ?>"></textarea>
            <?php if(!empty($selected_value)): ?><input type="hidden" class="selected_<?php echo e($name, false); ?>" name="selected_<?php echo e($name, false); ?>" value="<?php echo e($selected_value, false); ?>" /><?php endif; ?>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>

        dom_el('.bw-fp-<?php echo e($name, false); ?>').addEventListener('drop', function (evt){
            changeCss('.bw-fp-<?php echo e($name, false); ?>','border-gray-400', 'remove');
            changeCss('.bw-fp-<?php echo e($name, false); ?>','border-gray-300');
            evt.preventDefault();
            dom_el('.bw-<?php echo e($name, false); ?>').click();
        });

        ['dragleave', 'drop', 'mouseout'].forEach(evt =>
            dom_el('.bw-fp-<?php echo e($name, false); ?>').addEventListener(evt, () => {
                changeCss('.bw-fp-<?php echo e($name, false); ?>','border-gray-400', 'remove');
                changeCss('.bw-fp-<?php echo e($name, false); ?>','border-gray-300');
            }, false)
        );

        ['dragenter', 'dragover', 'mouseover'].forEach(evt =>
            dom_el('.bw-fp-<?php echo e($name, false); ?>').addEventListener(evt, () => {
                changeCss('.bw-fp-<?php echo e($name, false); ?>','border-gray-400');
            }, false)
        );

        dom_el('.bw-fp-<?php echo e($name, false); ?>').addEventListener('click', function (){
            dom_el('.bw-<?php echo e($name, false); ?>').click();
        });

        dom_el('.bw-<?php echo e($name, false); ?>').addEventListener('change', function (){
            let selection = this.value;
            if ( selection !== '' ) {
                const [file] = this.files

                if (file) {
                    if(allowedFileSize(file.size, <?php echo e($max_file_size, false); ?>)) {
                        dom_el('.bw-fp-<?php echo e($name, false); ?> .selection').innerHTML = 
                        ( file.type.indexOf('image') !== -1) ? '<img src="'+ URL.createObjectURL(file) + '" class="w-full" />' : file.name;
                        convertToBase64(file, '.b64-<?php echo e($name, false); ?>');
                    } else {
                        dom_el('.bw-fp-<?php echo e($name, false); ?> .selection').innerHTML = '<span class="text-red-500">File must be <?php echo e($max_file_size, false); ?>mb or below</span>';
                    }
                }
                changeCss('.bw-fp-<?php echo e($name, false); ?> .clear', 'hidden', 'remove');
            }
        });

        dom_el('.bw-fp-<?php echo e($name, false); ?> .clear').addEventListener('click', function (e){
            dom_el('.bw-fp-<?php echo e($name, false); ?> .selection').innerHTML = '<?php echo e($placeholder, false); ?>';
            dom_el('.bw-<?php echo e($name, false); ?>').value = dom_el('.b64-<?php echo e($name, false); ?>').value = '';
            changeCss('.bw-fp-<?php echo e($name, false); ?> .clear', 'hidden');
            e.stopImmediatePropagation();
        });
        
        convertToBase64 = (file, el) => {
            const reader = new FileReader();
            reader.onloadend = () => {
                const base64String = reader.result;//.replace('data:', '').replace(/^.+,/, ''); 
                dom_el(el).value = base64String;
            };
            reader.readAsDataURL(file);
        }

        allowedFileSize = (file_size, max_size) => {
            return ( file_size <= ((max_size)*1)*1000000 );
        }

        <?php if(!empty($url)): ?>
            <?php if(in_array(pathinfo($url, PATHINFO_EXTENSION), $image_file_types)): ?>
                file = '<img src="<?php echo e($url, false); ?>" alt="<?php echo e($url, false); ?>" class="rounded-md <?php echo e($selected_value_class, false); ?>" />';
            <?php else: ?>
                file = '<?php echo e(($selected_value != '') ? $selected_value : $url, false); ?>';
            <?php endif; ?>
            dom_el('.bw-fp-<?php echo e($name, false); ?> .selection').innerHTML = file;
            changeCss('.bw-fp-<?php echo e($name, false); ?> .clear', 'hidden', 'remove');
        <?php endif; ?>

    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\taquad\resources\views/components/bladewind/filepicker.blade.php ENDPATH**/ ?>