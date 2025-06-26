<div class="w-full">

    
    <?php if (isset($component)) { $__componentOriginala21f49a74cfebdbb98a47509c8a19010 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala21f49a74cfebdbb98a47509c8a19010 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.forms.loading','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.loading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala21f49a74cfebdbb98a47509c8a19010)): ?>
<?php $attributes = $__attributesOriginala21f49a74cfebdbb98a47509c8a19010; ?>
<?php unset($__attributesOriginala21f49a74cfebdbb98a47509c8a19010); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala21f49a74cfebdbb98a47509c8a19010)): ?>
<?php $component = $__componentOriginala21f49a74cfebdbb98a47509c8a19010; ?>
<?php unset($__componentOriginala21f49a74cfebdbb98a47509c8a19010); ?>
<?php endif; ?>

    
    <div class="lg:flex lg:items-center lg:justify-between mb-14">
    
        <div class="min-w-0 flex-1">

            
            <h2 class="text-lg font-bold leading-7 text-zinc-700 dark:text-gray-50 sm:truncate sm:text-xl sm:tracking-tight">
                <?php echo app('translator')->get('messages.t_skills'); ?>
            </h2>

            
            <div class="mt-3 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6 rtl:space-x-reverse">
                <ol class="inline-flex items-center mb-3 space-x-1 md:space-x-3 md:rtl:space-x-reverse sm:mb-0">

                    
                    <li>
                        <div class="flex items-center">
                            <a href="<?php echo e(url('/'), false); ?>" class="text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-zinc-300 dark:hover:text-white">
                                <?php echo app('translator')->get('messages.t_home'); ?>
                            </a>
                        </div>
                    </li>
    
                    
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-4 h-4 text-gray-400 rtl:rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="<?php echo e(admin_url('/'), false); ?>" class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-700 hover:text-primary-600 md:ltr:ml-2 md:rtl:mr-2 dark:text-zinc-300 dark:hover:text-white">
                                <?php echo app('translator')->get('messages.t_dashboard'); ?>
                            </a>
                        </div>
                    </li>
    
                    
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-4 h-4 text-gray-400 rtl:rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="mx-1 text-sm font-medium text-gray-400 md:mx-2 dark:text-zinc-400">
                                <?php echo app('translator')->get('messages.t_skills'); ?>
                            </span>
                        </div>
                    </li>
    
                </ol>
            </div>
            
        </div>

        
        <div class="mt-5 flex lg:mt-0 lg:ltr::ml-4 lg:rtl:mr-4 justify-between">

            
            <a href="<?php echo e(admin_url('projects/skills/create'), false); ?>" class="btn p-2.5 hover:shadow-none ring-slate-300 dark:ring-zinc-600 focus:ring-offset-2 focus:ring-offset-slate-300 dark:focus:ring-offset-zinc-600 space-x-2 rtl:space-x-reverse border">
                <?php if (isset($component)) { $__componentOriginal30b1ecc3bb8af1d000115fef1c04cca2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal30b1ecc3bb8af1d000115fef1c04cca2 = $attributes; } ?>
<?php $component = WireUi\View\Components\Icon::resolve(['name' => 'plus'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(WireUi\View\Components\Icon::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-6 h-6 text-gray-400 dark:text-zinc-300','variant' => 'solid','mini' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal30b1ecc3bb8af1d000115fef1c04cca2)): ?>
<?php $attributes = $__attributesOriginal30b1ecc3bb8af1d000115fef1c04cca2; ?>
<?php unset($__attributesOriginal30b1ecc3bb8af1d000115fef1c04cca2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal30b1ecc3bb8af1d000115fef1c04cca2)): ?>
<?php $component = $__componentOriginal30b1ecc3bb8af1d000115fef1c04cca2; ?>
<?php unset($__componentOriginal30b1ecc3bb8af1d000115fef1c04cca2); ?>
<?php endif; ?>
            </a>

        </div>

    </div>

    
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>

                        <th><?php echo app('translator')->get('messages.t_category'); ?></th>
                        <th><?php echo app('translator')->get('messages.t_skill'); ?></th>
                        <th class="text-center"><?php echo app('translator')->get('messages.t_options'); ?></th>

                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr wire:key="skills-<?php echo e($skill->uid, false); ?>">
                        
                            
                            <td>
                                <div class="flex items-center space-x-3 rtl:space-x-reverse">
                                    <div class="h-10 w-10 inline-flex flex-shrink-0 relative">
                                        <?php if($skill->category->icon): ?>
                                            <img class="mask is-squircle object-cover w-full h-full block" src="<?php echo e(src($skill->category->icon), false); ?>" alt="<?php echo e($skill->category->name, false); ?>">
                                        <?php else: ?>
                                            <?php
                                                $faker = Faker\Factory::create();
                                                $color = $faker->rgbColor();
                                            ?>
                                            <div class="flex items-center justify-center h-full w-full mask is-squircle text-sm uppercase dark:bg-navy-500 dark:text-navy-100 font-medium" style="background-color: rgba(<?php echo e($color, false); ?>, .1);color: rgb(<?php echo e($color, false); ?>)">
                                                <?php echo e(Str::substr($skill->category->name, 0, 2), false); ?>

                                            </div>   
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <a href="<?php echo e(url('categories', $skill->category->slug), false); ?>" target="_blank" class="text-sm font-semibold whitespace-nowrap dark:text-zinc-100">
                                            <?php echo e($skill->category->name, false); ?>

                                        </a>
                                        <div class="text-slate-500 text-xs whitespace-nowrap mt-px dark:text-zinc-300">
                                            <?php echo e($skill->category->slug, false); ?>

                                        </div>
                                    </div>
                                </div>
                            </td>

                            
                            <td>
                                <span class="text-sm font-semibold text-gray-600 dark:text-zinc-300">
                                    <?php echo e($skill->name, false); ?>

                                </span>
                            </td>

                            
                            <td class="table-report__action">
                                <div class="flex items-center justify-center space-x-2 rtl:space-x-reverse">

                                    
                                    <?php if (isset($component)) { $__componentOriginal25db5b2b4ed745b6b0fe0dc3034b2fb4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal25db5b2b4ed745b6b0fe0dc3034b2fb4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table.action-button','data' => ['icon' => 'pencil','title' => __('messages.t_edit'),'href' => ''.e(admin_url('projects/skills/edit/' . $skill->uid), false).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table.action-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'pencil','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_edit')),'href' => ''.e(admin_url('projects/skills/edit/' . $skill->uid), false).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal25db5b2b4ed745b6b0fe0dc3034b2fb4)): ?>
<?php $attributes = $__attributesOriginal25db5b2b4ed745b6b0fe0dc3034b2fb4; ?>
<?php unset($__attributesOriginal25db5b2b4ed745b6b0fe0dc3034b2fb4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal25db5b2b4ed745b6b0fe0dc3034b2fb4)): ?>
<?php $component = $__componentOriginal25db5b2b4ed745b6b0fe0dc3034b2fb4; ?>
<?php unset($__componentOriginal25db5b2b4ed745b6b0fe0dc3034b2fb4); ?>
<?php endif; ?>

                                    
                                    <?php if (isset($component)) { $__componentOriginal25db5b2b4ed745b6b0fe0dc3034b2fb4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal25db5b2b4ed745b6b0fe0dc3034b2fb4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table.action-button','data' => ['wire:confirm' => ''.e(__('messages.t_are_u_sure_u_want_to_delete_this'), false).'','icon' => 'trash','title' => __('messages.t_delete'),'iconColor' => 'text-red-600','action' => 'delete(\''.e($skill->id, false).'\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table.action-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:confirm' => ''.e(__('messages.t_are_u_sure_u_want_to_delete_this'), false).'','icon' => 'trash','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_delete')),'icon-color' => 'text-red-600','action' => 'delete(\''.e($skill->id, false).'\')']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal25db5b2b4ed745b6b0fe0dc3034b2fb4)): ?>
<?php $attributes = $__attributesOriginal25db5b2b4ed745b6b0fe0dc3034b2fb4; ?>
<?php unset($__attributesOriginal25db5b2b4ed745b6b0fe0dc3034b2fb4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal25db5b2b4ed745b6b0fe0dc3034b2fb4)): ?>
<?php $component = $__componentOriginal25db5b2b4ed745b6b0fe0dc3034b2fb4; ?>
<?php unset($__componentOriginal25db5b2b4ed745b6b0fe0dc3034b2fb4); ?>
<?php endif; ?>

                                </div>
                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5">
                                <div class="text-center px-4 bw-empty-state py-10">

                                    
                                    <img src="<?php echo e(asset('img/svg/no-results.svg'), false); ?>" class="h-44 rounded-full border w-44 object-cover border-slate-50 max-w-xs mx-auto mb-6">  
                                    
                                    
                                    <div class="text-slate-600/70 dark:text-zinc-300 font-normal px-6">
                                        <?php echo app('translator')->get('dashboard.t_no_results_table_hint'); ?>
                                    </div> 

                                    
                                    <a href="<?php echo e(admin_url('projects/skills/create'), false); ?>" class="bw-button primary !bg-primary-600 focus:ring-primary-500/70 hover:!bg-primary-700 active:!bg-primary-700 focus:!ring cursor-pointer rounded-full inline-block mx-auto my-4 !px-10 !font-normal !text-[11px] !py-2.5 tracking-widest uppercase">
                                        <span class="grow"><?php echo app('translator')->get('messages.t_create'); ?></span>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <?php if($skills->hasPages()): ?>
        <div class="bg-gray-100 px-4 py-5 sm:px-6 rounded-bl-lg rounded-br-lg flex justify-center border-t-0 border-r border-l border-b">
            <?php echo $skills->links('pagination::tailwind'); ?>

        </div>
    <?php endif; ?>

</div><?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/admin/projects/skills/skills.blade.php ENDPATH**/ ?>