<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale(), false); ?>" dir="<?php echo e(config()->get('direction'), false); ?>">

    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">

        
        <title><?php echo e(__('messages.t_login'), false); ?> | <?php echo e(__('messages.t_dashboard'), false); ?></title>

        
		<?php echo settings('appearance')->font_link; ?>


        
        <link rel="icon" type="image/png" href="<?php echo e(src( settings('general')->favicon ), false); ?>"/>

        
        <style>
            :root {
                --color-primary-h: <?php echo e(hex2hsl( settings('appearance')->colors['primary'] )[0], false); ?>;
                --color-primary-s: <?php echo e(hex2hsl( settings('appearance')->colors['primary'] )[1], false); ?>%;
                --color-primary-l: <?php echo e(hex2hsl( settings('appearance')->colors['primary'] )[2], false); ?>%;
            }
            html {
                font-family: <?php echo settings('appearance')->font_family ?>, sans-serif !important;
            }
        </style>

        
        <script>
            __var_app_url        = "<?php echo e(url('/'), false); ?>";
            __var_app_locale     = "<?php echo e(app()->getLocale(), false); ?>";
            __var_rtl            = <?php echo \Illuminate\Support\Js::from(config()->get('direction') === 'ltr' ? false : true)->toHtml() ?>;
            __var_primary_color  = "<?php echo e(settings('appearance')->colors['primary'], false); ?>";
            __var_axios_base_url = "<?php echo e(url('/'), false); ?>/";
            __var_currency_code  = "<?php echo e(settings('currency')->code, false); ?>";
        </script>

        
        <?php echo $__env->yieldPushContent('styles'); ?>

        
        <?php if(settings('appearance')->custom_code_head_admin_layout): ?>
            <?php echo settings('appearance')->custom_code_head_admin_layout; ?>

        <?php endif; ?>

        
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

        
        <script >window.Wireui = {hook(hook, callback) {window.addEventListener(`wireui:${hook}`, () => callback())},dispatchHook(hook) {window.dispatchEvent(new Event(`wireui:${hook}`))}}</script>
<script src="http://localhost/taquad/wireui/assets/scripts?id=2bb2382efa56ba70bd4659eaccb242c7" defer ></script>
        <?php echo $__env->make('components.wireui.basepath', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>

    </head>

    <body class="antialiased bg-white text-gray-600 min-h-full h-full flex flex-col application application-ltr overflow-x-hidden">

        
        <?php if (isset($component)) { $__componentOriginal10717d162484e57a570d6d2cc4597545 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal10717d162484e57a570d6d2cc4597545 = $attributes; } ?>
<?php $component = WireUi\View\Components\Notifications::resolve(['position' => 'top-center','zIndex' => 'z-[65]'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('notifications'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(WireUi\View\Components\Notifications::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal10717d162484e57a570d6d2cc4597545)): ?>
<?php $attributes = $__attributesOriginal10717d162484e57a570d6d2cc4597545; ?>
<?php unset($__attributesOriginal10717d162484e57a570d6d2cc4597545); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal10717d162484e57a570d6d2cc4597545)): ?>
<?php $component = $__componentOriginal10717d162484e57a570d6d2cc4597545; ?>
<?php unset($__componentOriginal10717d162484e57a570d6d2cc4597545); ?>
<?php endif; ?>

        
        <?php if (isset($component)) { $__componentOriginal2451dfd9df7c01154a83baa9ef28b9d5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2451dfd9df7c01154a83baa9ef28b9d5 = $attributes; } ?>
<?php $component = WireUi\View\Components\Dialog::resolve(['zIndex' => 'z-[65]','blur' => 'sm'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dialog'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(WireUi\View\Components\Dialog::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2451dfd9df7c01154a83baa9ef28b9d5)): ?>
<?php $attributes = $__attributesOriginal2451dfd9df7c01154a83baa9ef28b9d5; ?>
<?php unset($__attributesOriginal2451dfd9df7c01154a83baa9ef28b9d5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2451dfd9df7c01154a83baa9ef28b9d5)): ?>
<?php $component = $__componentOriginal2451dfd9df7c01154a83baa9ef28b9d5; ?>
<?php unset($__componentOriginal2451dfd9df7c01154a83baa9ef28b9d5); ?>
<?php endif; ?>

        
        <main class="flex-grow">
            <div class="max-w-container mx-auto px-4 sm:px-6 lg:px-36 pt-16 pb-24 space-y-8 min-h-screen">
                <?php echo e($slot, false); ?>

            </div>
        </main>

        
        <?php echo \Rawilk\FormComponents\Facades\FormComponents::javaScript(); ?>

        
        <?php if (isset($component)) { $__componentOriginal8344cca362e924d63cb0780eb5ae3ae6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8344cca362e924d63cb0780eb5ae3ae6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-alert::components.scripts','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('livewire-alert::scripts'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8344cca362e924d63cb0780eb5ae3ae6)): ?>
<?php $attributes = $__attributesOriginal8344cca362e924d63cb0780eb5ae3ae6; ?>
<?php unset($__attributesOriginal8344cca362e924d63cb0780eb5ae3ae6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8344cca362e924d63cb0780eb5ae3ae6)): ?>
<?php $component = $__componentOriginal8344cca362e924d63cb0780eb5ae3ae6; ?>
<?php unset($__componentOriginal8344cca362e924d63cb0780eb5ae3ae6); ?>
<?php endif; ?>

        
        <script src="<?php echo e(asset('vendor/bladewind/js/helpers.js'), false); ?>"></script>

        <?php echo \Rawilk\FormComponents\Facades\FormComponents::javaScript(); ?>
        
        <script src="https://unpkg.com/@phosphor-icons/web@2.0.3"></script>

        
        <?php echo $__env->yieldPushContent('scripts'); ?>

        
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scriptConfig(); ?>


        
        <?php if(settings('appearance')->custom_code_footer_admin_layout): ?>
            <?php echo settings('appearance')->custom_code_footer_admin_layout; ?>

        <?php endif; ?>

    </body>

</html>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/components/layouts/admin-auth.blade.php ENDPATH**/ ?>