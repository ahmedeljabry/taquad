<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['model', 'label' => null, 'required' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['model', 'label' => null, 'required' => false]); ?>
<?php foreach (array_filter((['model', 'label' => null, 'required' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div>

    
    <?php if($label): ?>
        <label for="gig-title-input-component-id-<?php echo e($model, false); ?>" class="block text-xs font-bold tracking-wide whitespace-nowrap overflow-hidden truncate <?php echo e($errors->first($model) ? 'text-red-600 dark:text-red-500' : 'text-zinc-500 dark:text-white', false); ?>" title="<?php echo e(htmlspecialchars_decode($label), false); ?>">

            
            <?php echo e(htmlspecialchars_decode($label), false); ?>


            
            <?php if($required): ?>
                <span class="font-bold text-red-400">*</span>
            <?php endif; ?>

        </label>
    <?php endif; ?>

    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['gig-title-input relative overflow-hidden', 'mt-2.5' => $label ? true : false]); ?>">
        
        <span class="title-prefix">
            <?php echo app('translator')->get('messages.t_i_will'); ?>
        </span>
    
        
        <textarea 
            wire:model="<?php echo e($model, false); ?>"
            id="gig-title-input-component-id-<?php echo e($model, false); ?>" 
            maxlength="100" 
            placeholder="do something I'm really good at" 
            role="textbox" 
            class="disabled:cursor-not-allowed resize-none focus:ring-0 block w-full ltr:pr-10 ltr:pl-4 rtl:pl-10 rtl:!pr-4 py-2.5 placeholder:font-normal placeholder:text-gray-400 dark:placeholder-zinc-300 text-xs font-medium tracking-wide text-zinc-700 dark:text-white rounded-md dark:bg-transparent <?php echo e($errors->first($model) ? 'focus:!border-red-600 border-red-500' : 'focus:!border-primary-600 border-gray-300 dark:border-zinc-600', false); ?> scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 dark:scrollbar-thumb-zinc-900 dark:scrollbar-track-zinc-600 gig-title-textarea"
            oninput="validateGigTitle(this)"
            style="text-indent: <?php echo e(getTextIndentValue(), false); ?>px">
        </textarea>
    
        
        <div class="title-footer mt-2.5">
            
            
            <ul class="text-xs tracking-wide list-disc list-inside">

                
                <li class="text-green-500 gig-title-validation-just-perfect hidden pb-1">
                    <?php echo app('translator')->get('messages.t_gig_title_validation_just_perfect'); ?>
                </li>

                
                <li class="text-amber-500 gig-title-validation-looks-good hidden pb-1">
                    <?php echo app('translator')->get('messages.t_gig_title_validation_looks_good_however'); ?>
                </li>

                
                <li class="text-red-500 gig-title-validation-min-chars hidden pb-1">
                    <?php echo app('translator')->get('messages.t_gig_title_validation_min_characters', ['min' => 15]); ?>
                </li>

                
                <li class="text-red-500 gig-title-validation-min-words hidden pb-1">
                    <?php echo app('translator')->get('messages.t_gig_title_validation_min_words', ['min' => 4]); ?>
                </li>

                
                <li class="text-red-500 gig-title-validation-max-words hidden pb-1">
                    <?php echo app('translator')->get('messages.t_gig_title_validation_max_words', ['min' => 4, 'max' => 15]); ?>
                </li>

                
                <li class="text-red-500 gig-title-validation-invalid-chars hidden pb-1">
                    <?php echo app('translator')->get('messages.t_gig_title_validation_invalid_chars'); ?>
                </li>

                
                <li class="text-red-500 gig-title-validation-long-title hidden pb-1">
                    <?php echo app('translator')->get('messages.t_gig_title_validation_short_title_attract_buyers'); ?>
                </li>
                
            </ul>
            
            
            <div class="chars-count lowercase ltr:text-right rtl:text-left text-xs text-gray-400" id="element-counter-container-<?php echo e($model, false); ?>">
                <span id="element-counter-maxlength-start-<?php echo e($model, false); ?>">0</span> / <span id="element-counter-maxlength-end-<?php echo e($model, false); ?>">100</span>
                <?php echo app('translator')->get('messages.t_max'); ?>
            </div>
        
        </div>

        
        <script>

            // Get input element
            let counterElementInput<?php echo e(str_replace(['.', '-'], '_', $model), false); ?>     = document.getElementById("gig-title-input-component-id-<?php echo e(str_replace(['.', '-'], '_', $model), false); ?>");

            // Get counter element container
            let counterElementContainer<?php echo e(str_replace(['.', '-'], '_', $model), false); ?> = document.getElementById("element-counter-container-<?php echo e(str_replace(['.', '-'], '_', $model), false); ?>");

            // Get counter start
            let counterElementStart<?php echo e(str_replace(['.', '-'], '_', $model), false); ?>     = document.getElementById("element-counter-maxlength-start-<?php echo e(str_replace(['.', '-'], '_', $model), false); ?>");

            // Get counter end
            let counterElementEnd<?php echo e(str_replace(['.', '-'], '_', $model), false); ?>       = document.getElementById("element-counter-maxlength-end-<?php echo e(str_replace(['.', '-'], '_', $model), false); ?>");

            // Check if element has maxlength attribute
            if ( counterElementInput<?php echo e(str_replace(['.', '-'], '_', $model), false); ?> && counterElementInput<?php echo e(str_replace(['.', '-'], '_', $model), false); ?>.hasAttribute('maxlength') ) {
                
                // Set max characters allowed
                counterElementEnd<?php echo e(str_replace(['.', '-'], '_', $model), false); ?>.textContent = counterElementInput<?php echo e(str_replace(['.', '-'], '_', $model), false); ?>.getAttribute('maxlength');

                // Listen when typing
                counterElementInput<?php echo e(str_replace(['.', '-'], '_', $model), false); ?>.addEventListener("input", function(e) {

                    // Change current characters counter
                    counterElementStart<?php echo e(str_replace(['.', '-'], '_', $model), false); ?>.textContent = counterElementInput<?php echo e(str_replace(['.', '-'], '_', $model), false); ?>.value.length;

                });


            }

        </script>

        
        <script>
            function validateGigTitle(e) {
                
                // Set the value
                const value  = e.value;

                // Count number of words
                const words  = value.trim().split(/\s+/).length;

                // Get value length
                const length = value.length;

                // Set invalid characters
                const format = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;

                // Check if value is valid
                const valid  = format.test(value);

                // Check if title looks good
                const title_long = length > 55 && length < 70 ? true : false;

                // Check if title is very long
                const title_very_long = length > 70 ? true : false;

                // Check min chars 15
                if (length < 15) {
                    $('.gig-title-validation-min-chars').removeClass('hidden');
                } else {
                    $('.gig-title-validation-min-chars').addClass('hidden');
                }
                
                // Check min words 4
                if (words < 4) {
                    $('.gig-title-validation-min-words').removeClass('hidden');
                } else {
                    $('.gig-title-validation-min-words').addClass('hidden');
                }

                // Check if title contains invalid chars
                if (valid) {
                    $('.gig-title-validation-invalid-chars').removeClass('hidden');
                } else {
                    $('.gig-title-validation-invalid-chars').addClass('hidden');
                }

                // Check if title is long
                if (title_long) {
                    $('.gig-title-validation-looks-good').removeClass('hidden');
                } else {
                    $('.gig-title-validation-looks-good').addClass('hidden');
                }

                // Check if title is very long
                if (title_very_long) {
                    $('.gig-title-validation-long-title').removeClass('hidden');
                } else {
                    $('.gig-title-validation-long-title').addClass('hidden');
                }

                // Check if words more than 15
                if (words > 15) {
                    $('.gig-title-validation-max-words').removeClass('hidden');
                } else {
                    $('.gig-title-validation-max-words').addClass('hidden');
                }

                // Check if title is good
                const is_good = !valid && words >= 4 && words <= 15 && length >= 15 && length <= 55 ? true : false;

                // Is it good title
                if (is_good) {
                    $('.gig-title-validation-just-perfect').removeClass('hidden');
                } else {
                    $('.gig-title-validation-just-perfect').addClass('hidden');
                }

            }
        </script>

    </div>

</div>

<?php $__env->startPush('scripts'); ?>
    
    <script>
        var e = document.getElementById('gig-title-input-component-id-<?php echo e($model, false); ?>');
        e.addEventListener("scroll", function() {
            var height = e.scrollTop;
            $('.title-prefix').css('transform', 'translateY(-' + height + 'px)');
        });
    </script>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\taquad\resources\views/components/forms/gig-title.blade.php ENDPATH**/ ?>