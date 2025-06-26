<div class="block relative">

    
    <button type="button" onclick="showModal('main-languages-modal')" class="bg-zinc-100 border border-zinc-200 dark:border-transparent dark:bg-zinc-700 duration-200 ease-linear flex h-8 hover:bg-opacity-90 items-center justify-center rounded-full transition-colors w-8 hover:bg-zinc-200 dark:hover:bg-zinc-600">
        <img class="w-4.5 h-4.5" src="<?php echo e(countryFlag($default_country_code), false); ?>" alt="<?php echo e($default_language_name, false); ?>">
    </button>

    
    <?php $__env->startPush('scripts'); ?>
        <?php if (isset($component)) { $__componentOriginal54a4042e8569ecd9303894788710cb73 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54a4042e8569ecd9303894788710cb73 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bladewind.modal','data' => ['size' => 'tiny','okButtonLabel' => '','name' => 'main-languages-modal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bladewind.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'tiny','ok_button_label' => '','name' => 'main-languages-modal']); ?>
            
                
                <div class="space-y-3">
                    <?php $__currentLoopData = supported_languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        
                        <?php
                            //Retrieve current query strings:
                            $currentQueries = request()->query();

                            //Declare new queries you want to append to string:
                            $newQueries     = ['locale' => $lang->language_code];

                            //Merge together current and new query strings:
                            $allQueries     = array_merge($currentQueries, $newQueries);

                            //Generate the URL with all the queries:
                            $locale_link    = request()->fullUrlWithQuery($allQueries);
                        ?> 

                        <a href="<?php echo e($locale_link, false); ?>" rel="nofollow" class="py-2 px-4 rounded-sm inline-flex items-center cursor-pointer justify-between <?php echo e($default_language_code === $lang->language_code ? 'bg-primary-100/25 text-primary-600' : 'hover:bg-gray-50 dark:hover:bg-zinc-600', false); ?> focus:outline-none w-full">
                            <div class="inline-flex items-center">
                                <img src="<?php echo e(placeholder_img(), false); ?>" data-src="<?php echo e(countryFlag($lang->country_code), false); ?>" alt="<?php echo e($lang->name, false); ?>" class="lazy w-5 ltr:mr-3 rtl:ml-3">
                                <span class="font-medium text-xs dark:text-gray-200"><?php echo e($lang->name, false); ?></span>
                            </div>
                            <?php if($default_language_code === $lang->language_code): ?>
                                <div class="block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            <?php else: ?>
                                <div wire:loading wire:target="setLocale('<?php echo e($lang->language_code, false); ?>')">
                                    <svg role="status" class="block w-4 h-4 text-gray-700 animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/> <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/> </svg>
                                </div>
                            <?php endif; ?>
                        </a>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54a4042e8569ecd9303894788710cb73)): ?>
<?php $attributes = $__attributesOriginal54a4042e8569ecd9303894788710cb73; ?>
<?php unset($__attributesOriginal54a4042e8569ecd9303894788710cb73); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54a4042e8569ecd9303894788710cb73)): ?>
<?php $component = $__componentOriginal54a4042e8569ecd9303894788710cb73; ?>
<?php unset($__componentOriginal54a4042e8569ecd9303894788710cb73); ?>
<?php endif; ?>    
    <?php $__env->stopPush(); ?>
</div><?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/partials/languages.blade.php ENDPATH**/ ?>