<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([

    'componentId' => null,

    // name to uniquely identity a select
    'name' => 'bw-select',

    // the default text to display when the select shows
    'placeholder' => 'Select One',

    // optional function to execute when a select item is selected
    // by default the value of a select item is written to an input field with the
    // name dd_name. Where name is the name you provided for the select
    // if you named your select countries for example, whatever country is selected can
    // be found in the <input type="hidden" clas="input-countries" name="dd_countries" />
    'onselect' => '',

    // data to pass to the select
    // your data must be a json string (not object) with the keys value and label
    // value is whatever value will be passed to your code when an item is selected
    // label is what will be displayed to the user
    // if you want to display icons for each item your json can contain the optional 'icon' key
    // where icons are required, they must be in the semantic UI icon format
    // [{"label":"Burkina Faso","icon":"bf flag","value":"+226"},{"label":"Ghana","icon":"gh flag","value":"+233"},{"label":"Ivory Coast","icon":"ivc flag","value":"+228"}]
    'data' => [],

    // what key in your data array should be used to populate 'value' of the select when an item is selected
    // by default a key of 'value' is used. If your data is something like [ {"id":"1","name":"Burkina Faso"}]
    // your value_key will be 'id'
    'value_key' => 'value',
    'valueKey' => 'value',

    // what key in your data array should be used to display the labels the user will see as select items
    // the default key used for labels is 'label'. If your data is something like [ {"id":"1","name":"Burkina Faso"}]
    // your label_key will be 'name'
    'label_key' => 'label',
    'labelKey' => 'label',

    // what key in your data array should be used to display flag icons next to the labels
    // [ {"id":"1","name":"Burkina Faso", "flag":"/assets/images/bf-flag.png"}]
    // your flag_key will be 'image'
    'flag_key' => null,
    'flagKey' => null,

    // what key in your data array should be used to display images next to the labels
    // the default key used for images is '', meaning images will be ignored. If your data is something like
    // [ {"id":"1","name":"Burkina Faso", "image":"/assets/images/bf-flag.png"}]
    // your image_key will be 'image'
    'image_key' => null,
    'imageKey' => null,

    // there are instances when you want the name passed by the select when you submit a form to be
    // different from the name you gave the select. Example. you may name the select as country but
    // want it to submit data as country_id.
    'data_serialize_as' => '',
    'dataSerializeAs' => '',

    // enforces validation if set to true
    'required' => 'false',

    'disabled' => 'false',

    'readonly' => 'false',

    'multiple' => 'false',

    // adds margin after the input box
    'add_clearing' => true,
    'addClearing' => true,

    // determines if a value passed in the data array should automatically be selected
    // useful when using the component in edit mode or as part of filter options
    // the value you specify should exist in your value_key. If your value_key is 'id', you
    // cannot set a selected_value of 'maize white'
    'selected_value' => '',
    'selectedValue' => '',

    // setting this to true adds a search box above the select items
    // this can be used to filter the contents of the select items
    'searchable' => false,

    'label' => null,

    'hint' => null
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([

    'componentId' => null,

    // name to uniquely identity a select
    'name' => 'bw-select',

    // the default text to display when the select shows
    'placeholder' => 'Select One',

    // optional function to execute when a select item is selected
    // by default the value of a select item is written to an input field with the
    // name dd_name. Where name is the name you provided for the select
    // if you named your select countries for example, whatever country is selected can
    // be found in the <input type="hidden" clas="input-countries" name="dd_countries" />
    'onselect' => '',

    // data to pass to the select
    // your data must be a json string (not object) with the keys value and label
    // value is whatever value will be passed to your code when an item is selected
    // label is what will be displayed to the user
    // if you want to display icons for each item your json can contain the optional 'icon' key
    // where icons are required, they must be in the semantic UI icon format
    // [{"label":"Burkina Faso","icon":"bf flag","value":"+226"},{"label":"Ghana","icon":"gh flag","value":"+233"},{"label":"Ivory Coast","icon":"ivc flag","value":"+228"}]
    'data' => [],

    // what key in your data array should be used to populate 'value' of the select when an item is selected
    // by default a key of 'value' is used. If your data is something like [ {"id":"1","name":"Burkina Faso"}]
    // your value_key will be 'id'
    'value_key' => 'value',
    'valueKey' => 'value',

    // what key in your data array should be used to display the labels the user will see as select items
    // the default key used for labels is 'label'. If your data is something like [ {"id":"1","name":"Burkina Faso"}]
    // your label_key will be 'name'
    'label_key' => 'label',
    'labelKey' => 'label',

    // what key in your data array should be used to display flag icons next to the labels
    // [ {"id":"1","name":"Burkina Faso", "flag":"/assets/images/bf-flag.png"}]
    // your flag_key will be 'image'
    'flag_key' => null,
    'flagKey' => null,

    // what key in your data array should be used to display images next to the labels
    // the default key used for images is '', meaning images will be ignored. If your data is something like
    // [ {"id":"1","name":"Burkina Faso", "image":"/assets/images/bf-flag.png"}]
    // your image_key will be 'image'
    'image_key' => null,
    'imageKey' => null,

    // there are instances when you want the name passed by the select when you submit a form to be
    // different from the name you gave the select. Example. you may name the select as country but
    // want it to submit data as country_id.
    'data_serialize_as' => '',
    'dataSerializeAs' => '',

    // enforces validation if set to true
    'required' => 'false',

    'disabled' => 'false',

    'readonly' => 'false',

    'multiple' => 'false',

    // adds margin after the input box
    'add_clearing' => true,
    'addClearing' => true,

    // determines if a value passed in the data array should automatically be selected
    // useful when using the component in edit mode or as part of filter options
    // the value you specify should exist in your value_key. If your value_key is 'id', you
    // cannot set a selected_value of 'maize white'
    'selected_value' => '',
    'selectedValue' => '',

    // setting this to true adds a search box above the select items
    // this can be used to filter the contents of the select items
    'searchable' => false,

    'label' => null,

    'hint' => null
]); ?>
<?php foreach (array_filter(([

    'componentId' => null,

    // name to uniquely identity a select
    'name' => 'bw-select',

    // the default text to display when the select shows
    'placeholder' => 'Select One',

    // optional function to execute when a select item is selected
    // by default the value of a select item is written to an input field with the
    // name dd_name. Where name is the name you provided for the select
    // if you named your select countries for example, whatever country is selected can
    // be found in the <input type="hidden" clas="input-countries" name="dd_countries" />
    'onselect' => '',

    // data to pass to the select
    // your data must be a json string (not object) with the keys value and label
    // value is whatever value will be passed to your code when an item is selected
    // label is what will be displayed to the user
    // if you want to display icons for each item your json can contain the optional 'icon' key
    // where icons are required, they must be in the semantic UI icon format
    // [{"label":"Burkina Faso","icon":"bf flag","value":"+226"},{"label":"Ghana","icon":"gh flag","value":"+233"},{"label":"Ivory Coast","icon":"ivc flag","value":"+228"}]
    'data' => [],

    // what key in your data array should be used to populate 'value' of the select when an item is selected
    // by default a key of 'value' is used. If your data is something like [ {"id":"1","name":"Burkina Faso"}]
    // your value_key will be 'id'
    'value_key' => 'value',
    'valueKey' => 'value',

    // what key in your data array should be used to display the labels the user will see as select items
    // the default key used for labels is 'label'. If your data is something like [ {"id":"1","name":"Burkina Faso"}]
    // your label_key will be 'name'
    'label_key' => 'label',
    'labelKey' => 'label',

    // what key in your data array should be used to display flag icons next to the labels
    // [ {"id":"1","name":"Burkina Faso", "flag":"/assets/images/bf-flag.png"}]
    // your flag_key will be 'image'
    'flag_key' => null,
    'flagKey' => null,

    // what key in your data array should be used to display images next to the labels
    // the default key used for images is '', meaning images will be ignored. If your data is something like
    // [ {"id":"1","name":"Burkina Faso", "image":"/assets/images/bf-flag.png"}]
    // your image_key will be 'image'
    'image_key' => null,
    'imageKey' => null,

    // there are instances when you want the name passed by the select when you submit a form to be
    // different from the name you gave the select. Example. you may name the select as country but
    // want it to submit data as country_id.
    'data_serialize_as' => '',
    'dataSerializeAs' => '',

    // enforces validation if set to true
    'required' => 'false',

    'disabled' => 'false',

    'readonly' => 'false',

    'multiple' => 'false',

    // adds margin after the input box
    'add_clearing' => true,
    'addClearing' => true,

    // determines if a value passed in the data array should automatically be selected
    // useful when using the component in edit mode or as part of filter options
    // the value you specify should exist in your value_key. If your value_key is 'id', you
    // cannot set a selected_value of 'maize white'
    'selected_value' => '',
    'selectedValue' => '',

    // setting this to true adds a search box above the select items
    // this can be used to filter the contents of the select items
    'searchable' => false,

    'label' => null,

    'hint' => null
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php
    //$multiple = filter_var($multiple, FILTER_VALIDATE_BOOLEAN);
    $add_clearing = filter_var($add_clearing, FILTER_VALIDATE_BOOLEAN);
    $addClearing = filter_var($addClearing, FILTER_VALIDATE_BOOLEAN);
    $searchable = filter_var($searchable, FILTER_VALIDATE_BOOLEAN);
    $required = filter_var($required, FILTER_VALIDATE_BOOLEAN);
    $readonly = filter_var($readonly, FILTER_VALIDATE_BOOLEAN);
    $disabled = filter_var($disabled, FILTER_VALIDATE_BOOLEAN);

    if ($dataSerializeAs !== $data_serialize_as) $data_serialize_as = $dataSerializeAs;
    if ($selectedValue !== $selected_value) $selected_value = $selectedValue;
    if ($valueKey !== $value_key) $value_key = $valueKey;
    if ($labelKey !== $label_key) $label_key = $labelKey;
    if ($flagKey !== $flag_key) $flag_key = $flagKey;
    if ($imageKey !== $image_key) $image_key = $imageKey;
    if (!$add_clearing) $add_clearing = $addClearing;

    $input_name = str_replace(['.'], '_', preg_replace('/[\s-]/', '_', $name));
    $selected_value = ($selected_value != '') ? explode(',', str_replace(', ', ',', $selected_value)) : [];

    if ($data !== 'manual') {
        $data = (!is_array($data)) ? json_decode(str_replace('&quot;', '"', $data), true) : $data;

        if(! isset($data[0][$label_key]) ) {
            die('<p style="color:red">
                &lt;x-bladewind.select /&gt;: ensure the value you set as label_key
                exists in your array data</p>');
        }

        if( !empty($flag_key) && !isset($data[0][$flag_key]) ) {
            die('<p style="color:red">
                &lt;x-bladewind.select /&gt;: ensure the value you set as flag_key exists in your array</p>');
        }
    }


?>
<style>
    .display-area::-webkit-scrollbar { display: none; width: 0 !important; }
    .display-area { scrollbar-width: none; -ms-overflow-style: none; scroll-behavior: smooth; }
</style>
<div class="relative bw-select bw-select-<?php echo e($input_name, false); ?> <?php if($add_clearing): ?> <?php endif; ?>"
     data-multiple="<?php echo e($multiple, false); ?>" data-type="<?php echo e($data !== 'manual' ? 'dynamic' : 'manual', false); ?>"
     <?php if($data == 'manual' && $selected_value != ''): ?> data-selected-value="<?php echo e(implode(',',$selected_value), false); ?>" <?php endif; ?>>

    
    <?php if($label): ?>
        <label class="block text-xs font-bold tracking-wide <?php echo e($errors->first($name) ? 'text-red-600 dark:text-red-500' : 'text-gray-500 dark:text-white', false); ?>">

            
            <?php echo e(htmlspecialchars_decode($label), false); ?>


            
            <?php if($required): ?>
                <span class="font-bold text-red-400">*</span>
            <?php endif; ?>
            
        </label>
    <?php endif; ?>

    <div class="<?php echo e($label ? 'mt-2.5' : '', false); ?> relative flex justify-between text-sm items-center rounded-md bg-white outline-none dark:bg-transparent text-slate-600 border border-gray-300 dark:text-slate-300 dark:border-zinc-600 py-2 ltr:pl-4 ltr:pr-2 rtl:pr-4 rtl:pl-2 shadow-sm clickable
        <?php if(!$disabled): ?> focus:!ring focus:!ring-opacity-30 focus:!border-transparent focus:!ring-primary-600 focus:outline-none cursor-pointer <?php else: ?> opacity-40 select-none cursor-not-allowed <?php endif; ?>" tabindex="0">
        <?php if (isset($component)) { $__componentOriginalb45b6a3c419c4b30c47574e702949233 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb45b6a3c419c4b30c47574e702949233 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bladewind.icon','data' => ['name' => 'chevron-left','class' => 'ltr:!-ml-3 rtl:!-mr-3 hidden scroll-left']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bladewind.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-left','class' => 'ltr:!-ml-3 rtl:!-mr-3 hidden scroll-left']); ?>
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
        <div class="ltr:text-left rtl:text-right placeholder font-medium text-xs dark:text-zinc-300 grow-0 text-gray-400"><?php echo e($placeholder, false); ?>

        </div>
        <div class="ltr:text-left rtl:text-right text-xs font-medium text-zinc-700 dark:text-white grow display-area hidden whitespace-nowrap overflow-x-scroll p-0 m-0"></div>
        <div class="whitespace-nowrap inline-flex">
            <?php if (isset($component)) { $__componentOriginalb45b6a3c419c4b30c47574e702949233 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb45b6a3c419c4b30c47574e702949233 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bladewind.icon','data' => ['name' => 'chevron-up-down','class' => 'opacity-40 ltr:!ml-4 rtl:!mr-4 w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bladewind.icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-up-down','class' => 'opacity-40 ltr:!ml-4 rtl:!mr-4 w-5 h-5']); ?>
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
        </div>
    </div>
    <div class="w-full absolute z-30 rounded-md bg-white shadow-sm border 
        border-gray-200 dark:text-zinc-300 dark:border-zinc-600 dark:bg-zinc-700 border-t-0 mt-1 
        hidden bw-select-items-container overflow-y-auto max-h-64 animate__animated animate__fadeIn animate__faster">

        
        <div class="sticky top-0 min-w-full bg-slate-100 dark:bg-zinc-600 py-1 pr-0 -pl-1 <?php if(!$searchable): ?> hidden <?php endif; ?>">
            <div class="relative m-3 rounded-md shadow-sm">
                <input type="text" class="bw_filter block w-full ltr:pr-10 ltr:pl-4 rtl:pl-10 rtl:!pr-4 py-2.5 placeholder:font-normal placeholder:text-xs placeholder:text-gray-400 dark:placeholder-zinc-300 text-xs font-medium text-zinc-800 dark:text-white rounded dark:bg-transparent focus:ring-0 focus:outline-none focus:border-gray-400 border-gray-300 dark:border-zinc-600" placeholder="<?php echo e(__('messages.t_search'), false); ?>">
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                    <i class="ph-duotone ph-magnifying-glass text-gray-400 text-lg"></i>
                </div>
            </div>
        </div>

        <div class="divide-y divide-slate-100 dark:divide-zinc-600 bw-select-items mt-0">
        <?php if($data !== 'manual'): ?>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginal38f82459cf8970d8f2d44f3eff89fff0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal38f82459cf8970d8f2d44f3eff89fff0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bladewind.select-item','data' => ['label' => ''.e($item[$label_key], false).'','value' => ''.e($item[$value_key], false).'','onselect' => ''.e($onselect, false).'','flag' => ''.e($item[$flag_key] ?? '', false).'','image' => ''.e($item[$image_key] ?? '', false).'','selected' => ''.e((in_array($item[$value_key], $selected_value)) ? 'true' : 'false', false).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bladewind.select-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => ''.e($item[$label_key], false).'','value' => ''.e($item[$value_key], false).'','onselect' => ''.e($onselect, false).'','flag' => ''.e($item[$flag_key] ?? '', false).'','image' => ''.e($item[$image_key] ?? '', false).'','selected' => ''.e((in_array($item[$value_key], $selected_value)) ? 'true' : 'false', false).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal38f82459cf8970d8f2d44f3eff89fff0)): ?>
<?php $attributes = $__attributesOriginal38f82459cf8970d8f2d44f3eff89fff0; ?>
<?php unset($__attributesOriginal38f82459cf8970d8f2d44f3eff89fff0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal38f82459cf8970d8f2d44f3eff89fff0)): ?>
<?php $component = $__componentOriginal38f82459cf8970d8f2d44f3eff89fff0; ?>
<?php unset($__componentOriginal38f82459cf8970d8f2d44f3eff89fff0); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <?php echo $slot; ?>

        <?php endif; ?>
        </div>
    </div>
    <input type="hidden" wire:model="<?php echo e(($data_serialize_as !== '') ? $data_serialize_as : $name, false); ?>"
       class="bw-<?php echo e($input_name, false); ?> <?php if($required): ?> required <?php endif; ?>" <?php if($required): ?> data-parent="bw-select-<?php echo e($input_name, false); ?>" <?php endif; ?> />

    
    <?php if($hint): ?>
        <span class="text-xs text-slate-400 mt-1 block">
            <?php echo e(htmlspecialchars_decode($hint), false); ?>

        </span>
    <?php endif; ?>

</div>

<?php if (! $__env->hasRenderedOnce('fb213fa8-6a57-42b7-ae84-94fce06b34d5')): $__env->markAsRenderedOnce('fb213fa8-6a57-42b7-ae84-94fce06b34d5');
$__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('vendor/bladewind/js/select.js'), false); ?>"></script>
<?php $__env->stopPush(); endif; ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        const bw_<?php echo e($input_name, false); ?> = new BladewindSelect('<?php echo e($input_name, false); ?>', '<?php echo e($placeholder, false); ?>', '<?php echo e($componentId, false); ?>', '<?php echo e($name, false); ?>');
        <?php if(!$disabled && !$readonly): ?> bw_<?php echo e($input_name, false); ?>.activate(); <?php endif; ?>
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\taquad\resources\views/components/bladewind/select.blade.php ENDPATH**/ ?>