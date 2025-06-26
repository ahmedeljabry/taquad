<div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 mt-[7rem] py-12 lg:pt-16 lg:pb-24">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow overflow-hidden">
            <div class="divide-y divide-gray-200 dark:divide-zinc-700 lg:grid lg:grid-cols-12 lg:divide-y-0 lg:divide-x rtl:divide-x-reverse">


                <aside class="lg:col-span-3 py-6 hidden lg:block" wire:ignore>
                    <?php if (isset($component)) {
                        $__componentOriginal897c321ee9b9bb967400e80c55835c23 = $component;
                    } ?>
                    <?php if (isset($attributes)) {
                        $__attributesOriginal897c321ee9b9bb967400e80c55835c23 = $attributes;
                    } ?>
                    <?php $component = App\View\Components\Main\Account\Sidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
                    <?php $component->withName('main.account.sidebar'); ?>
                    <?php if ($component->shouldRender()): ?>
                        <?php $__env->startComponent($component->resolveView(), $component->data()); ?>
                        <?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Main\Account\Sidebar::class))->getConstructor()): ?>
                            <?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
                        <?php endif; ?>
                        <?php $component->withAttributes([]); ?>
                        <?php echo $__env->renderComponent(); ?>
                    <?php endif; ?>
                    <?php if (isset($__attributesOriginal897c321ee9b9bb967400e80c55835c23)): ?>
                        <?php $attributes = $__attributesOriginal897c321ee9b9bb967400e80c55835c23; ?>
                        <?php unset($__attributesOriginal897c321ee9b9bb967400e80c55835c23); ?>
                    <?php endif; ?>
                    <?php if (isset($__componentOriginal897c321ee9b9bb967400e80c55835c23)): ?>
                        <?php $component = $__componentOriginal897c321ee9b9bb967400e80c55835c23; ?>
                        <?php unset($__componentOriginal897c321ee9b9bb967400e80c55835c23); ?>
                    <?php endif; ?>
                </aside>


                <div class="divide-y divide-gray-200 dark:divide-zinc-700 lg:col-span-9">


                    <div class="py-6 px-4 sm:p-6 lg:pb-8 h-[calc(100%-80px)]">


                        <div class="mb-14">
                            <h2 class="text-base leading-6 font-bold text-gray-900 dark:text-gray-100"><?php echo e(__('messages.t_billing_information'), false); ?></h2>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300"><?php echo e(__('messages.t_billing_information_subtitle'), false); ?></p>
                        </div>


                        <div class="grid grid-cols-12 md:gap-x-8 gap-y-8 mb-6">


                            <?php if (session()->has('message')): ?>
                                <div class="col-span-12 mb-10">
                                    <div class="bg-yellow-100 ltr:border-l-4 rtl:border-r-4 border-yellow-400 p-4 mb-6">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ltr:ml-3 rtl:mr-3">
                                                <p class="text-sm text-yellow-700 font-medium">
                                                    <?php echo e(session()->get('message'), false); ?>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>


                            <div class="col-span-12 md:col-span-6">
                                <?php if (isset($component)) {
                                    $__componentOriginal0241d3f51813223308810020791c4a83 = $component;
                                } ?>
                                <?php if (isset($attributes)) {
                                    $__attributesOriginal0241d3f51813223308810020791c4a83 = $attributes;
                                } ?>
                                <?php $component = App\View\Components\Forms\TextInput::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
                                <?php $component->withName('forms.text-input'); ?>
                                <?php if ($component->shouldRender()): ?>
                                    <?php $__env->startComponent($component->resolveView(), $component->data()); ?>
                                    <?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\TextInput::class))->getConstructor()): ?>
                                        <?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
                                    <?php endif; ?>
                                    <?php $component->withAttributes(['required' => true, 'label' => '' . e(__('messages.t_firstname'), false) . '', 'placeholder' => '' . e(__('messages.t_enter_firstname'), false) . '', 'model' => 'firstname', 'icon' => 'user']); ?>
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
                                <?php if (isset($component)) {
                                    $__componentOriginal0241d3f51813223308810020791c4a83 = $component;
                                } ?>
                                <?php if (isset($attributes)) {
                                    $__attributesOriginal0241d3f51813223308810020791c4a83 = $attributes;
                                } ?>
                                <?php $component = App\View\Components\Forms\TextInput::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
                                <?php $component->withName('forms.text-input'); ?>
                                <?php if ($component->shouldRender()): ?>
                                    <?php $__env->startComponent($component->resolveView(), $component->data()); ?>
                                    <?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\TextInput::class))->getConstructor()): ?>
                                        <?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
                                    <?php endif; ?>
                                    <?php $component->withAttributes(['required' => true, 'label' => '' . e(__('messages.t_lastname'), false) . '', 'placeholder' => '' . e(__('messages.t_enter_lastname'), false) . '', 'model' => 'lastname', 'icon' => 'user']); ?>
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
                                <?php if (isset($component)) {
                                    $__componentOriginal0241d3f51813223308810020791c4a83 = $component;
                                } ?>
                                <?php if (isset($attributes)) {
                                    $__attributesOriginal0241d3f51813223308810020791c4a83 = $attributes;
                                } ?>
                                <?php $component = App\View\Components\Forms\TextInput::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
                                <?php $component->withName('forms.text-input'); ?>
                                <?php if ($component->shouldRender()): ?>
                                    <?php $__env->startComponent($component->resolveView(), $component->data()); ?>
                                    <?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\TextInput::class))->getConstructor()): ?>
                                        <?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
                                    <?php endif; ?>
                                    <?php $component->withAttributes(['label' => '' . e(__('messages.t_company'), false) . '', 'placeholder' => '' . e(__('messages.t_enter_company_optional'), false) . '', 'model' => 'company', 'icon' => 'globe']); ?>
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
                                <?php if (isset($component)) {
                                    $__componentOriginal0241d3f51813223308810020791c4a83 = $component;
                                } ?>
                                <?php if (isset($attributes)) {
                                    $__attributesOriginal0241d3f51813223308810020791c4a83 = $attributes;
                                } ?>
                                <?php $component = App\View\Components\Forms\TextInput::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
                                <?php $component->withName('forms.text-input'); ?>
                                <?php if ($component->shouldRender()): ?>
                                    <?php $__env->startComponent($component->resolveView(), $component->data()); ?>
                                    <?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\TextInput::class))->getConstructor()): ?>
                                        <?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
                                    <?php endif; ?>
                                    <?php $component->withAttributes(['label' => '' . e(__('messages.t_city'), false) . '', 'placeholder' => '' . e(__('messages.t_enter_city'), false) . '', 'model' => 'city', 'icon' => 'buildings']); ?>
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
                                <?php if (isset($component)) {
                                    $__componentOriginal0241d3f51813223308810020791c4a83 = $component;
                                } ?>
                                <?php if (isset($attributes)) {
                                    $__attributesOriginal0241d3f51813223308810020791c4a83 = $attributes;
                                } ?>
                                <?php $component = App\View\Components\Forms\TextInput::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
                                <?php $component->withName('forms.text-input'); ?>
                                <?php if ($component->shouldRender()): ?>
                                    <?php $__env->startComponent($component->resolveView(), $component->data()); ?>
                                    <?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\TextInput::class))->getConstructor()): ?>
                                        <?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
                                    <?php endif; ?>
                                    <?php $component->withAttributes(['label' => '' . e(__('messages.t_zip'), false) . '', 'placeholder' => '' . e(__('messages.t_enter_zip'), false) . '', 'model' => 'zip', 'icon' => 'file-zip']); ?>
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


                            <div class="col-span-12" wire:key="billing-country">


                                <div class="w-full" wire:ignore>
                                    <?php if (isset($component)) {
                                        $__componentOriginal763d7a4c405696a85a7a7ec4f959c809 = $component;
                                    } ?>
                                    <?php if (isset($attributes)) {
                                        $__attributesOriginal763d7a4c405696a85a7a7ec4f959c809 = $attributes;
                                    } ?>
                                    <?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bladewind.select', 'data' => ['required' => true, 'searchable' => true, 'componentId' => $this->id(), 'name' => 'country', 'selectedValue' => $country, 'label' => __('messages.t_country'), 'placeholder' => __('messages.t_choose_country'), 'data' => 'manual']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
                                    <?php $component->withName('bladewind.select'); ?>
                                    <?php if ($component->shouldRender()): ?>
                                        <?php $__env->startComponent($component->resolveView(), $component->data()); ?>
                                        <?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
                                            <?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
                                        <?php endif; ?>
                                        <?php $component->withAttributes(['required' => true, 'searchable' => true, 'component-id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($this->id()), 'name' => 'country', 'selected_value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($country), 'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_country')), 'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_choose_country')), 'data' => 'manual']); ?>


                                        <?php $__currentLoopData = $countries;
                                        $__env->addLoop($__currentLoopData);
                                        foreach ($__currentLoopData as $country): $__env->incrementLoopIndices();
                                            $loop = $__env->getLastLoop(); ?>
                                            <?php if (isset($component)) {
                                                $__componentOriginal38f82459cf8970d8f2d44f3eff89fff0 = $component;
                                            } ?>
                                            <?php if (isset($attributes)) {
                                                $__attributesOriginal38f82459cf8970d8f2d44f3eff89fff0 = $attributes;
                                            } ?>
                                            <?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bladewind.select-item', 'data' => ['label' => $country->name, 'value' => $country->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
                                            <?php $component->withName('bladewind.select-item'); ?>
                                            <?php if ($component->shouldRender()): ?>
                                                <?php $__env->startComponent($component->resolveView(), $component->data()); ?>
                                                <?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
                                                    <?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
                                                <?php endif; ?>
                                                <?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($country->name), 'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($country->id)]); ?>
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
                                        <?php endforeach;
                                        $__env->popLoop();
                                        $loop = $__env->getLastLoop(); ?>

                                        <?php echo $__env->renderComponent(); ?>
                                    <?php endif; ?>
                                    <?php if (isset($__attributesOriginal763d7a4c405696a85a7a7ec4f959c809)): ?>
                                        <?php $attributes = $__attributesOriginal763d7a4c405696a85a7a7ec4f959c809; ?>
                                        <?php unset($__attributesOriginal763d7a4c405696a85a7a7ec4f959c809); ?>
                                    <?php endif; ?>
                                    <?php if (isset($__componentOriginal763d7a4c405696a85a7a7ec4f959c809)): ?>
                                        <?php $component = $__componentOriginal763d7a4c405696a85a7a7ec4f959c809; ?>
                                        <?php unset($__componentOriginal763d7a4c405696a85a7a7ec4f959c809); ?>
                                    <?php endif; ?>
                                </div>


                                <?php $__errorArgs = ['country'];
                                $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                                if ($__bag->has($__errorArgs[0])) :
                                    if (isset($message)) {
                                        $__messageOriginal = $message;
                                    }
                                    $message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-500"><?php echo e($errors->first('country'), false); ?></p>
                                <?php unset($message);
                                    if (isset($__messageOriginal)) {
                                        $message = $__messageOriginal;
                                    }
                                endif;
                                unset($__errorArgs, $__bag); ?>

                            </div>


                            <div class="col-span-12" wire:key="billing-address">
                                <?php if (isset($component)) {
                                    $__componentOriginal2f60389a9e230471cd863683376c182f = $component;
                                } ?>
                                <?php if (isset($attributes)) {
                                    $__attributesOriginal2f60389a9e230471cd863683376c182f = $attributes;
                                } ?>
                                <?php $component = App\View\Components\Forms\Textarea::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
                                <?php $component->withName('forms.textarea'); ?>
                                <?php if ($component->shouldRender()): ?>
                                    <?php $__env->startComponent($component->resolveView(), $component->data()); ?>
                                    <?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Textarea::class))->getConstructor()): ?>
                                        <?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
                                    <?php endif; ?>
                                    <?php $component->withAttributes(['required' => true, 'label' => '' . e(__('messages.t_address'), false) . '', 'placeholder' => '' . e(__('messages.t_enter_address'), false) . '', 'model' => 'address', 'rows' => '8', 'icon' => 'map-pin']); ?>
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


                            <div class="col-span-12">
                                <?php if (isset($component)) {
                                    $__componentOriginal0241d3f51813223308810020791c4a83 = $component;
                                } ?>
                                <?php if (isset($attributes)) {
                                    $__attributesOriginal0241d3f51813223308810020791c4a83 = $attributes;
                                } ?>
                                <?php $component = App\View\Components\Forms\TextInput::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
                                <?php $component->withName('forms.text-input'); ?>
                                <?php if ($component->shouldRender()): ?>
                                    <?php $__env->startComponent($component->resolveView(), $component->data()); ?>
                                    <?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\TextInput::class))->getConstructor()): ?>
                                        <?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
                                    <?php endif; ?>
                                    <?php $component->withAttributes(['label' => '' . e(__('messages.t_vat_number'), false) . '', 'placeholder' => '' . e(__('messages.t_enter_vat_number_optional'), false) . '', 'model' => 'vat_number', 'icon' => 'percent']); ?>
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


                    <div class="py-4 px-4 flex justify-end sm:px-6 bg-transparent">
                        <?php if (isset($component)) {
                            $__componentOriginal039608dc70b2e4c26356f5d84408f584 = $component;
                        } ?>
                        <?php if (isset($attributes)) {
                            $__attributesOriginal039608dc70b2e4c26356f5d84408f584 = $attributes;
                        } ?>
                        <?php $component = App\View\Components\Forms\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
                        <?php $component->withName('forms.button'); ?>
                        <?php if ($component->shouldRender()): ?>
                            <?php $__env->startComponent($component->resolveView(), $component->data()); ?>
                            <?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Button::class))->getConstructor()): ?>
                                <?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
                            <?php endif; ?>
                            <?php $component->withAttributes(['action' => 'update', 'text' => '' . e(__('messages.t_update'), false) . '']); ?>
                            <?php echo $__env->renderComponent(); ?>
                        <?php endif; ?>
                        <?php if (isset($__attributesOriginal039608dc70b2e4c26356f5d84408f584)): ?>
                            <?php $attributes = $__attributesOriginal039608dc70b2e4c26356f5d84408f584; ?>
                            <?php unset($__attributesOriginal039608dc70b2e4c26356f5d84408f584); ?>
                        <?php endif; ?>
                        <?php if (isset($__componentOriginal039608dc70b2e4c26356f5d84408f584)): ?>
                            <?php $component = $__componentOriginal039608dc70b2e4c26356f5d84408f584; ?>
                            <?php unset($__componentOriginal039608dc70b2e4c26356f5d84408f584); ?>
                        <?php endif; ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/account/billing/billing.blade.php ENDPATH**/ ?>