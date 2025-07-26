<div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 mt-[7rem] py-12 lg:pt-16 lg:pb-24" x-data="{ step:<?php if ((object) ('step') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId(), false); ?>').entangle('<?php echo e('step'->value(), false); ?>')<?php echo e('step'->hasModifier('live') ? '.live' : '', false); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId(), false); ?>').entangle('<?php echo e('step', false); ?>')<?php endif; ?> }">
    <div class="w-full sm:mx-auto sm:max-w-2xl">

        
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

        
        <div class="card px-4 py-10 sm:p-10 md:mx-0 mb-6">

            
            <div class="flex-col md:flex-row md:justify-between flex md:items-center gap-4 border-b pb-6 border-slate-100 dark:border-zinc-700 mb-8">

                
                <div class="flex items-center gap-x-4">
                    <div class="bg-slate-100 flex h-14 items-center justify-center rounded-full shrink-0 text-2xl text-slate-500 w-14 dark:bg-zinc-700 dark:text-zinc-400">
                        <i class="ph-duotone ph-briefcase"></i>
                    </div>
                    <div class="block">
                        <h3 class="text-[0.9375rem] font-bold text-zinc-700 dark:text-white pb-0.5 tracking-wide">
                            <?php echo app('translator')->get('messages.t_post_new_project'); ?>
                        </h3>
                        <p class="text-xs+ font-medium text-slate-400 dark:text-zinc-400 tracking-wide">
                            <?php echo app('translator')->get('messages.t_post_new_project_subtitle'); ?>
                        </p>
                    </div>
                </div>

                
                <div class="md:ms-auto flex items-center gap-2"></div>

            </div>

            
            <div class="w-full">
                <div class="grid grid-cols-12 md:gap-x-8 gap-y-8 mb-6">

                    
                    <div class="col-span-12">
                        <?php if (isset($component)) { $__componentOriginal0241d3f51813223308810020791c4a83 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0241d3f51813223308810020791c4a83 = $attributes; } ?>
<?php $component = App\View\Components\Forms\TextInput::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\TextInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'label' => ''.e(__('messages.t_project_title'), false).'','placeholder' => ''.e(__('messages.t_enter_title'), false).'','model' => 'title','icon' => 'text-italic']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0241d3f51813223308810020791c4a83)): ?>
<?php $attributes = $__attributesOriginal0241d3f51813223308810020791c4a83; ?>
<?php unset($__attributesOriginal0241d3f51813223308810020791c4a83); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0241d3f51813223308810020791c4a83)): ?>
<?php $component = $__componentOriginal0241d3f51813223308810020791c4a83; ?>
<?php unset($__componentOriginal0241d3f51813223308810020791c4a83); ?>
<?php endif; ?>
                    </div>

                    
                    <div class="col-span-12">
                        <?php if (isset($component)) { $__componentOriginal2f60389a9e230471cd863683376c182f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2f60389a9e230471cd863683376c182f = $attributes; } ?>
<?php $component = App\View\Components\Forms\Textarea::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Textarea::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'label' => ''.e(__('messages.t_project_description'), false).'','placeholder' => ''.e(__('messages.t_enter_description'), false).'','model' => 'description','rows' => 12,'icon' => 'text','hint' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_post_project_description_hint'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2f60389a9e230471cd863683376c182f)): ?>
<?php $attributes = $__attributesOriginal2f60389a9e230471cd863683376c182f; ?>
<?php unset($__attributesOriginal2f60389a9e230471cd863683376c182f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2f60389a9e230471cd863683376c182f)): ?>
<?php $component = $__componentOriginal2f60389a9e230471cd863683376c182f; ?>
<?php unset($__componentOriginal2f60389a9e230471cd863683376c182f); ?>
<?php endif; ?>
                    </div>

                    
                    <div class="col-span-12" wire:key="create-service-categories">
                        <?php if (isset($component)) { $__componentOriginaldb6747d79aee05aaab45bb3a98f6c6bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb6747d79aee05aaab45bb3a98f6c6bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.forms.select-simple','data' => ['required' => true,'live' => true,'model' => 'category','label' => __('messages.t_category'),'placeholder' => __('messages.t_choose_category')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.select-simple'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'live' => true,'model' => 'category','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_category')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_choose_category'))]); ?>
                             <?php $__env->slot('options', null, []); ?> 
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($c->id, false); ?>"><?php echo e($c->name, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             <?php $__env->endSlot(); ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldb6747d79aee05aaab45bb3a98f6c6bc)): ?>
<?php $attributes = $__attributesOriginaldb6747d79aee05aaab45bb3a98f6c6bc; ?>
<?php unset($__attributesOriginaldb6747d79aee05aaab45bb3a98f6c6bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldb6747d79aee05aaab45bb3a98f6c6bc)): ?>
<?php $component = $__componentOriginaldb6747d79aee05aaab45bb3a98f6c6bc; ?>
<?php unset($__componentOriginaldb6747d79aee05aaab45bb3a98f6c6bc); ?>
<?php endif; ?>
                    </div>

                </div>
            </div>

        </div>

        
        <div class="card px-4 py-10 sm:p-10 md:mx-0 mb-6">

            
            <div class="flex-col md:flex-row md:justify-between flex md:items-center gap-4 border-b pb-6 border-slate-100 dark:border-zinc-700 mb-8">

                
                <div class="flex items-center gap-x-4">
                    <div class="bg-slate-100 flex h-14 items-center justify-center rounded-full shrink-0 text-2xl text-slate-500 w-14 dark:bg-zinc-700 dark:text-zinc-400">
                        <i class="ph-duotone ph-asterisk"></i>
                    </div>
                    <div class="block">
                        <h3 class="text-[0.9375rem] font-bold text-zinc-700 dark:text-white pb-0.5 tracking-wide">
                            <?php echo app('translator')->get('messages.t_skills'); ?>
                        </h3>
                        <p class="text-xs+ font-medium text-slate-400 dark:text-zinc-400 tracking-wide">
                            <?php echo app('translator')->get('messages.t_what_skills_are_required'); ?>
                        </p>
                    </div>
                </div>

                
                <div class="md:ms-auto flex items-center gap-2"></div>

            </div>

            
            <div class="w-full">
                <?php if($category): ?>
                    <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($skill?->name): ?>

                            
                            <?php
                                $is_skill_selected = in_array($skill->id, $required_skills);
                            ?>

                            
                            <button type="button" wire:click="addSkill('<?php echo e($skill->uid, false); ?>')" class="inline-flex items-center rounded-3xl mt-2 ltr:mr-1 rtl:ml-1 ltr:pl-1 ltr:pr-2 rtl:pr-1 rtl:pl-2 py-1.5 <?php echo e($is_skill_selected ? 'bg-primary-600 hover:bg-primary-700 text-white' : 'bg-gray-100 hover:bg-gray-200 dark:bg-zinc-700 dark:text-zinc-100 dark:hover:bg-zinc-600', false); ?>" wire:key="skills-suggestions-<?php echo e($skill->uid, false); ?>">
                                <span class="ltr:ml-2 ltr:mr-1 rtl:mr-2 rtl:ml-1 truncate max-w-xs text-xs font-semibold tracking-wide">
                                    <?php echo e($skill->name, false); ?>

                                </span>

                                
                                <?php if($is_skill_selected): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 opacity-60" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                <?php endif; ?>

                            </button>

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>

                    
                    <div class="w-full">
                        <div class="py-2.5 px-3 rounded text-yellow-700 bg-yellow-100">
                            <div class="flex items-center gap-x-3">
                                <svg class="inline-block w-5 h-5 flex-none text-yellow-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                <h3 class="font-semibold grow text-xs">
                                    <?php echo app('translator')->get('messages.t_skills_select_category_first_alert'); ?>
                                </h3>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>
            </div>

        </div>

        
        <div class="card px-4 py-10 sm:p-10 md:mx-0 mb-6">

            
            <div class="flex-col md:flex-row md:justify-between flex md:items-center gap-4 border-b pb-6 border-slate-100 dark:border-zinc-700 mb-8">

                
                <div class="flex items-center gap-x-4">
                    <div class="bg-slate-100 flex h-14 items-center justify-center rounded-full shrink-0 text-2xl text-slate-500 w-14 dark:bg-zinc-700 dark:text-zinc-400">
                        <i class="ph-duotone ph-currency-dollar"></i>
                    </div>
                    <div class="block">
                        <h3 class="text-[0.9375rem] font-bold text-zinc-700 dark:text-white pb-0.5 tracking-wide">
                            <?php echo app('translator')->get('messages.t_budget'); ?>
                        </h3>
                        <p class="text-xs+ font-medium text-slate-400 dark:text-zinc-400 tracking-wide">
                            <?php echo app('translator')->get('messages.t_how_do_u_want_to_pay'); ?>
                        </p>
                    </div>
                </div>

                
                <div class="md:ms-auto flex items-center gap-2"></div>

            </div>

            
            <div class="w-full">
                <div class="grid grid-cols-12 gap-y-8 gap-x-5">

                    
                    <div class="col-span-12">
                        <ul class="grid w-full gap-6 md:grid-cols-2">

                            
                            <li>
                                <input type="radio" id="post-project-salary-type-fixed" name="salary_type" wire:model="salary_type" value="fixed" class="hidden peer">
                                <label for="post-project-salary-type-fixed" class="inline-flex items-center justify-between w-full p-4 text-gray-500 bg-white border shadow-sm border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-zinc-700 dark:peer-checked:text-primary-600 peer-checked:border-primary-600 peer-checked:text-primary-600 hover:text-gray-600 hover:bg-gray-100 dark:text-zinc-400 dark:bg-zinc-800 dark:hover:bg-zinc-700">
                                    <div class="block">
                                        <div class="w-full text-xs+ tracking-wide font-semibold">
                                            <?php echo app('translator')->get('messages.t_fixed_price'); ?>
                                        </div>
                                    </div>
                                    <i class="ph-duotone ph-money text-2xl opacity-60"></i>
                                </label>
                            </li>

                            
                            <li>
                                <input type="radio" id="post-project-salary-type-hourly" name="salary_type" wire:model="salary_type" value="hourly" class="hidden peer">
                                <label for="post-project-salary-type-hourly" class="inline-flex items-center justify-between w-full p-4 text-gray-500 bg-white border shadow-sm border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-zinc-700 dark:peer-checked:text-primary-600 peer-checked:border-primary-600 peer-checked:text-primary-600 hover:text-gray-600 hover:bg-gray-100 dark:text-zinc-400 dark:bg-zinc-800 dark:hover:bg-zinc-700">
                                    <div class="block">
                                        <div class="w-full text-xs+ tracking-wide font-semibold">
                                            <?php echo app('translator')->get('messages.t_hourly_price'); ?>
                                        </div>
                                    </div>
                                    <i class="ph-duotone ph-clock text-2xl opacity-60"></i>
                                </label>
                            </li>
                        </ul>
                    </div>

                    
                    <div class="col-span-12 md:col-span-6">
                        <?php if (isset($component)) { $__componentOriginal0241d3f51813223308810020791c4a83 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0241d3f51813223308810020791c4a83 = $attributes; } ?>
<?php $component = App\View\Components\Forms\TextInput::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\TextInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_min_price')),'placeholder' => '0.00','model' => 'min_price','suffix' => ''.e($currency_symbol, false).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0241d3f51813223308810020791c4a83)): ?>
<?php $attributes = $__attributesOriginal0241d3f51813223308810020791c4a83; ?>
<?php unset($__attributesOriginal0241d3f51813223308810020791c4a83); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0241d3f51813223308810020791c4a83)): ?>
<?php $component = $__componentOriginal0241d3f51813223308810020791c4a83; ?>
<?php unset($__componentOriginal0241d3f51813223308810020791c4a83); ?>
<?php endif; ?>
                    </div>

                    
                    <div class="col-span-12 md:col-span-6">
                        <?php if (isset($component)) { $__componentOriginal0241d3f51813223308810020791c4a83 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0241d3f51813223308810020791c4a83 = $attributes; } ?>
<?php $component = App\View\Components\Forms\TextInput::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\TextInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_max_price')),'placeholder' => '0.00','model' => 'max_price','suffix' => ''.e($currency_symbol, false).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0241d3f51813223308810020791c4a83)): ?>
<?php $attributes = $__attributesOriginal0241d3f51813223308810020791c4a83; ?>
<?php unset($__attributesOriginal0241d3f51813223308810020791c4a83); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0241d3f51813223308810020791c4a83)): ?>
<?php $component = $__componentOriginal0241d3f51813223308810020791c4a83; ?>
<?php unset($__componentOriginal0241d3f51813223308810020791c4a83); ?>
<?php endif; ?>
                    </div>

                </div>
            </div>

        </div>

        
        <?php if(settings('projects')->is_premium_posting): ?>
            <div class="card px-4 py-10 sm:p-10 md:mx-0 mb-6">

                
                <div class="flex-col md:flex-row md:justify-between flex md:items-center gap-4 border-b pb-6 border-slate-100 dark:border-zinc-700 mb-8">

                    
                    <div class="flex items-center gap-x-4">
                        <div class="bg-slate-100 flex h-14 items-center justify-center rounded-full shrink-0 text-2xl text-slate-500 w-14 dark:bg-zinc-700 dark:text-zinc-400">
                            <i class="ph-duotone ph-megaphone-simple"></i>
                        </div>
                        <div class="block">
                            <h3 class="text-[0.9375rem] font-bold text-zinc-700 dark:text-white pb-0.5 tracking-wide">
                                <?php echo app('translator')->get('messages.t_promotion'); ?>
                            </h3>
                            <?php if(settings('projects')->is_free_posting): ?>
                                <p class="text-xs+ font-medium text-slate-400 dark:text-zinc-400 tracking-wide">
                                    <?php echo app('translator')->get('messages.t_make_ur_project_premium_optional'); ?>
                                </p>
                            <?php else: ?>
                                <p class="text-xs+ font-medium text-slate-400 dark:text-zinc-400 tracking-wide">
                                    <?php echo app('translator')->get('messages.t_make_ur_project_premium'); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="md:ms-auto flex items-center gap-2"></div>

                </div>

                
                <div class="w-full">

                    
                    <div class="grid grid-cols-1 gap-y-6 mb-7">
                        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            
                            <?php
                                $is_plan_selected = in_array($plan->id, $selected_plans);
                            ?>

                            
                            <div class="<?php echo e($is_plan_selected ? 'border-primary-600 ring-1 ring-primary-600' : '', false); ?> mb-2 rounded-lg px-4 py-4 border shadow-sm bg-white dark:bg-zinc-700 dark:border-transparent" wire:key="post-project-plans-<?php echo e($plan->id, false); ?>">
                                <div class="card-body">
                                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                                        <div class="flex items-center gap-3">
                                            <div>

                                                
                                                <div class="flex items-center mb-3 space-x-3 rtl:space-x-reverse">

                                                    
                                                    <span class="inline-flex items-center text-xs uppercase tracking-wider font-semibold px-3 py-1 rounded-full" style="color:<?php echo e($plan->text_color, false); ?>;background-color:<?php echo e($plan->bg_color, false); ?>">
                                                        <span><?php echo e($plan->title, false); ?></span>
                                                    </span>

                                                    
                                                    <div class="text-sm font-extrabold text-zinc-800 dark:text-zinc-200">
                                                        <?php echo e(money($plan->price, settings('currency')->code, true), false); ?>

                                                    </div>

                                                    
                                                    <?php if($plan->days): ?>
                                                        <div class="text-xs font-normal text-gray-400 lowercase">
                                                            <?php echo e($plan->days, false); ?> <?php echo e($plan->days > 1 ? __('messages.t_days') : __('messages.t_day'), false); ?>

                                                        </div>
                                                    <?php endif; ?>

                                                </div>

                                                <!-- Description -->
                                                <div class="text-xs+ font-normal leading-6 text-gray-500 dark:text-zinc-200 tracking-wide">
                                                    <?php echo e($plan->description, false); ?>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="flex">

                                            
                                            <button class="flex items-center border h-9 text-xs font-medium px-4 rounded-sm whitespace-nowrap <?php echo e($is_plan_selected ? 'bg-primary-600 text-white border-primary-600' : 'bg-white hover:bg-gray-50 text-gray-600 active:bg-gray-100 border-gray-300 dark:bg-zinc-800 dark:border-transparent dark:text-zinc-300 dark:hover:bg-zinc-600', false); ?>" wire:click="addPlan(<?php echo e($plan->id, false); ?>)">
                                                <span>
                                                    <?php if($is_plan_selected): ?>
                                                        <?php echo app('translator')->get('messages.t_selected'); ?>
                                                    <?php else: ?>
                                                        <?php echo app('translator')->get('messages.t_select'); ?>
                                                    <?php endif; ?>
                                                </span>
                                            </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    
                    <div class="flex items-center space-x-3 rtl:space-x-reverse bg-gray-100 hover:bg-gray-200 hover:bg-opacity-50 p-4 rounded-xl dark:bg-black">
                        <div class="grow">
                            <p class="text-sm text-gray-600 font-medium dark:text-zinc-400">
                                <?php echo app('translator')->get('messages.t_total'); ?>
                            </p>
                        </div>
                        <div class="flex-none ltr:text-right rtl:text-left text-zinc-900 font-bold text-base tracking-wide dark:text-white">
                            <?php echo e(money($promoting_total, settings('currency')->code, true), false); ?>

                        </div>
                    </div>

                </div>

            </div>
        <?php endif; ?>

        
        <div class="w-full mt-12">
            <?php if (isset($component)) { $__componentOriginal9a524495f8fba1bb9db48a43313dffc1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a524495f8fba1bb9db48a43313dffc1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bladewind.button.index','data' => ['size' => 'small','class' => 'mx-auto block w-full','wire:click' => 'create']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('bladewind.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'small','class' => 'mx-auto block w-full','wire:click' => 'create']); ?>
                <?php echo app('translator')->get('messages.t_post_project'); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a524495f8fba1bb9db48a43313dffc1)): ?>
<?php $attributes = $__attributesOriginal9a524495f8fba1bb9db48a43313dffc1; ?>
<?php unset($__attributesOriginal9a524495f8fba1bb9db48a43313dffc1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a524495f8fba1bb9db48a43313dffc1)): ?>
<?php $component = $__componentOriginal9a524495f8fba1bb9db48a43313dffc1; ?>
<?php unset($__componentOriginal9a524495f8fba1bb9db48a43313dffc1); ?>
<?php endif; ?>
        </div>

        -
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/post/project.blade.php ENDPATH**/ ?>