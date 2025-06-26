<div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 mt-[7rem] py-12 lg:pt-16 lg:pb-24">


    <?php if (isset($component)) {
        $__componentOriginala21f49a74cfebdbb98a47509c8a19010 = $component;
    } ?>
    <?php if (isset($attributes)) {
        $__attributesOriginala21f49a74cfebdbb98a47509c8a19010 = $attributes;
    } ?>
    <?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.forms.loading', 'data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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


    <div class="overflow-hidden">
        <div class="relative mx-auto max-w-xl">


            <div class="text-center">
                <h2 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white sm:text-2xl">
                    <?php echo app('translator')->get('messages.t_contact_us'); ?>
                </h2>
                <p class="mt-2 text-sm leading-6 text-gray-500 dark:text-zinc-400">
                    <?php echo app('translator')->get('messages.t_contact_us_subtitle'); ?>
                </p>
            </div>

            <div class="mt-12">
                <?php if (isset($component)) {
                    $__componentOriginalefda5ddba01882262075fadff48950fb = $component;
                } ?>
                <?php if (isset($attributes)) {
                    $__attributesOriginalefda5ddba01882262075fadff48950fb = $attributes;
                } ?>
                <?php $component = Rawilk\FormComponents\Components\Form::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
                <?php $component->withName('form'); ?>
                <?php if ($component->shouldRender()): ?>
                    <?php $__env->startComponent($component->resolveView(), $component->data()); ?>
                    <?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Rawilk\FormComponents\Components\Form::class))->getConstructor()): ?>
                        <?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
                    <?php endif; ?>
                    <?php $component->withAttributes(['class' => 'grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8', 'id' => 'contact-form']); ?>


                    <div class="col-span-2">
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
                            <?php $component->withAttributes(['required' => true, 'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_name')), 'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_enter_your_fullname')), 'icon' => 'user', 'model' => 'name']); ?>
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


                    <div class="col-span-2">
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
                            <?php $component->withAttributes(['required' => true, 'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_email_address')), 'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_enter_email_address')), 'icon' => 'at', 'model' => 'email', 'type' => 'email']); ?>
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


                    <div class="col-span-2">
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
                            <?php $component->withAttributes(['required' => true, 'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_subject')), 'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_enter_message_subject')), 'icon' => 'envelope', 'model' => 'subject']); ?>
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


                    <div class="col-span-2">
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
                            <?php $component->withAttributes(['required' => true, 'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_message')), 'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_descibe_ur_message_in_details')), 'icon' => 'chat-circle-dots', 'model' => 'message']); ?>
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


                    <?php $__errorArgs = ['recaptcha_token'];
                    $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                    if ($__bag->has($__errorArgs[0])) :
                        if (isset($message)) {
                            $__messageOriginal = $message;
                        }
                        $message = $__bag->first($__errorArgs[0]); ?>
                        <div class="col-span-2">
                            <p class="text-xs text-red-600 dark:text-red-500"><?php echo e($errors->first('recaptcha_token'), false); ?></p>
                        </div>
                    <?php unset($message);
                        if (isset($__messageOriginal)) {
                            $message = $__messageOriginal;
                        }
                    endif;
                    unset($__errorArgs, $__bag); ?>


                    <div class="col-span-2">
                        <?php if (isset($component)) {
                            $__componentOriginal9a524495f8fba1bb9db48a43313dffc1 = $component;
                        } ?>
                        <?php if (isset($attributes)) {
                            $__attributesOriginal9a524495f8fba1bb9db48a43313dffc1 = $attributes;
                        } ?>
                        <?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bladewind.button.index', 'data' => ['size' => 'small', 'class' => 'mx-auto block w-full', 'canSubmit' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
                        <?php $component->withName('bladewind.button'); ?>
                        <?php if ($component->shouldRender()): ?>
                            <?php $__env->startComponent($component->resolveView(), $component->data()); ?>
                            <?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
                                <?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
                            <?php endif; ?>
                            <?php $component->withAttributes(['size' => 'small', 'class' => 'mx-auto block w-full', 'can_submit' => 'true']); ?>
                            <?php echo app('translator')->get('messages.t_lets_talk'); ?>
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


                    <div class="col-span-2">
                        <ul class="space-y-1 text-gray-500 list-disc list-inside dark:text-zinc-400">


                            <?php if (settings('security')->is_recaptcha): ?>
                                <li>
                                    <div class="text-xs tracking-wide text-slate-400 dark:text-zinc-400 inline-block">
                                        <?php echo app('translator')->get('messages.t_this_site_protected_by_recaptcha_and_google'); ?>
                                        <a href="https://policies.google.com/privacy" target="_blank" class="text-gray-900 dark:text-zinc-200 hover:underline font-medium">
                                            <?php echo app('translator')->get('messages.t_privacy_policy'); ?>
                                        </a>
                                        <span class="lowercase"><?php echo app('translator')->get('messages.t_and'); ?></span>
                                        <a href="https://policies.google.com/terms" target="_blank" class="text-gray-900 dark:text-zinc-200 hover:underline font-medium">
                                            <?php echo app('translator')->get('messages.t_terms_of_service'); ?>
                                        </a>
                                        <?php echo app('translator')->get('messages.t_recaptcha_apply'); ?>
                                    </div>
                                </li>
                            <?php endif; ?>


                            <li>
                                <div class="text-xs tracking-wide text-slate-400 dark:text-zinc-400 inline-block">
                                    <?php echo __('messages.t_by_continue_agree_terms_privacy', [
                                        'privacy_link' => settings('footer')->privacy ? url('page', settings('footer')->privacy->slug) : "#",
                                        'privacy_text' => settings('footer')->privacy ? settings('footer')->privacy->title : __('messages.t_privacy_policy'),
                                        'terms_link'   => settings('footer')->terms ? url('page', settings('footer')->terms->slug) : "#",
                                        'terms_text'   => settings('footer')->terms ? settings('footer')->terms->title : __('messages.t_terms_of_service'),
                                    ]); ?>

                                </div>
                            </li>

                        </ul>
                    </div>

                    <?php echo $__env->renderComponent(); ?>
                <?php endif; ?>
                <?php if (isset($__attributesOriginalefda5ddba01882262075fadff48950fb)): ?>
                    <?php $attributes = $__attributesOriginalefda5ddba01882262075fadff48950fb; ?>
                    <?php unset($__attributesOriginalefda5ddba01882262075fadff48950fb); ?>
                <?php endif; ?>
                <?php if (isset($__componentOriginalefda5ddba01882262075fadff48950fb)): ?>
                    <?php $component = $__componentOriginalefda5ddba01882262075fadff48950fb; ?>
                    <?php unset($__componentOriginalefda5ddba01882262075fadff48950fb); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>


<?php $__env->startPush('styles'); ?>


<?php if (settings('security')->is_recaptcha): ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(config('recaptcha.site_key'), false); ?>"></script>
<?php endif; ?>

<?php $__env->stopPush(); ?>


<?php $__env->startPush('scripts'); ?>


<?php if (settings('security')->is_recaptcha): ?>
    <script>
        grecaptcha.ready(function() {
            document.getElementById('contact-form').addEventListener("submit", function(event) {
                event.preventDefault();
                grecaptcha.execute("<?php echo e(config('recaptcha.site_key'), false); ?>", {
                        action: 'register'
                    })
                    .then(function(token) {
                        window.Livewire.find("<?php echo e($this->id(), false); ?>").set('recaptcha_token', token)
                        window.Livewire.find("<?php echo e($this->id(), false); ?>").contact();
                    });
            });
        });
    </script>
<?php endif; ?>

<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/help/contact/contact.blade.php ENDPATH**/ ?>