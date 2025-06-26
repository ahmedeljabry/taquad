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


    <div class="lg:flex lg:items-center lg:justify-between mb-2 border-b-2 border-gray-100 dark:border-zinc-800 pb-6">

        <div class="min-w-0 flex-1">


            <h2 class="text-lg font-bold leading-7 text-zinc-700 dark:text-gray-50 sm:truncate sm:text-2xl sm:tracking-tight">
                <?php echo app('translator')->get('messages.t_recent_articles'); ?>
            </h2>


            <div class="mt-2 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6 rtl:space-x-reverse">
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
                            <svg aria-hidden="true" class="w-4 h-4 text-gray-400 rtl:rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="mx-1 text-sm font-medium text-gray-400 md:mx-2 dark:text-zinc-400">
                                <?php echo app('translator')->get('messages.t_blog'); ?>
                            </span>
                        </div>
                    </li>

                </ol>
            </div>


            <?php if (settings('newsletter')->is_enabled): ?>
                <p class="text-[0.9375rem] text-gray-400 dark:text-zinc-300 font-normal mt-3">
                    <?php echo app('translator')->get('messages.t_sign_up_for_newsletter_subtitle'); ?>
                </p>
            <?php endif; ?>

        </div>


        <?php if (settings('newsletter')->is_enabled): ?>
            <div class="mt-5 flex lg:mt-0 lg:ltr::ml-4 lg:rtl:mr-4 justify-between">


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
                    <?php $component->withAttributes(['wire:submit' => 'subscribe', 'class' => 'mt-6 flex flex-col lg:mt-0 lg:justify-end']); ?>


                    <div>
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
                            <?php $component->withAttributes(['required' => true, 'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_email_address')), 'model' => 'email', 'type' => 'email', 'icon' => 'at']); ?>
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


                    <div class="mt-2 flex w-full flex-shrink-0 sm:inline-flex sm:w-auto">
                        <?php if (isset($component)) {
                            $__componentOriginal9a524495f8fba1bb9db48a43313dffc1 = $component;
                        } ?>
                        <?php if (isset($attributes)) {
                            $__attributesOriginal9a524495f8fba1bb9db48a43313dffc1 = $attributes;
                        } ?>
                        <?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.bladewind.button.index', 'data' => ['size' => 'small', 'class' => 'mx-auto block w-full !rounded-md !py-2', 'canSubmit' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
                        <?php $component->withName('bladewind.button'); ?>
                        <?php if ($component->shouldRender()): ?>
                            <?php $__env->startComponent($component->resolveView(), $component->data()); ?>
                            <?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
                                <?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
                            <?php endif; ?>
                            <?php $component->withAttributes(['size' => 'small', 'class' => 'mx-auto block w-full !rounded-md !py-2', 'can_submit' => 'true']); ?>
                            <?php echo app('translator')->get('messages.t_nofity_me'); ?>
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
        <?php endif; ?>

    </div>


    <div class="grid grid-cols-1 gap-5 lg:grid-cols-4 sm:grid-cols-2 pt-10">
        <?php $__currentLoopData = $articles;
        $__env->addLoop($__currentLoopData);
        foreach ($__currentLoopData as $article): $__env->incrementLoopIndices();
            $loop = $__env->getLastLoop(); ?>
            <div wire:key="blog-articles-<?php echo e($article->uid, false); ?>" class="relative flex items-end justify-start w-full ltr:text-left rtl:text-right bg-center bg-cover h-96 bg-gray-500" style="background-image: url(&quot;<?php echo e(src($article->image), false); ?>&quot;);">
                <div class="absolute top-0 bottom-0 left-0 right-0 bg-gradient-to-b via-transparent from-gray-900 to-gray-900"></div>
                <div class="absolute top-0 left-0 right-0 flex items-center justify-between mx-5 mt-3">


                    <span class="py-2 text-xs font-light tracking-wider uppercase text-gray-100">
                        <?php echo e(format_date($article->created_at), false); ?>

                    </span>

                </div>


                <h2 class="z-10 p-5">
                    <a href="<?php echo e(url('blog', $article->slug), false); ?>" class="font-medium text-sm hover:underline text-gray-100">
                        <?php echo e($article->title, false); ?>
                    </a>
                </h2>

            </div>
        <?php endforeach;
        $__env->popLoop();
        $loop = $__env->getLastLoop(); ?>
    </div>


    <?php if ($articles->hasPages()): ?>
        <div class="w-full flex justify-center items-center mt-24">
            <?php echo $articles->links('pagination::tailwind'); ?>

        </div>
    <?php endif; ?>

</div>

<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/blog/blog.blade.php ENDPATH**/ ?>