<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale(), false); ?>" dir="<?php echo e(config()->get('direction'), false); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['dark' => current_theme() === 'dark']); ?>">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">
        <title><?php echo e(__('messages.t_toast_something_went_wrong'), false); ?></title>

        
		<?php echo settings('appearance')?->font_link; ?>


        
        <link rel="icon" type="image/png" href="<?php echo e(src( settings('general')->favicon ), false); ?>"/>

        
        <link href="<?php echo e(asset('vendor/bladewind/css/animate.min.css'), false); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('vendor/bladewind/css/bladewind-ui.min.css'), false); ?>" rel="stylesheet" />

        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


		
        <style>
            :root {
                --color-primary  : <?php echo e(settings('appearance')?->colors['primary'], false); ?>;
                --color-primary-h: <?php echo e(hex2hsl( settings('appearance')->colors['primary'] )[0], false); ?>;
                --color-primary-s: <?php echo e(hex2hsl( settings('appearance')->colors['primary'] )[1], false); ?>%;
                --color-primary-l: <?php echo e(hex2hsl( settings('appearance')->colors['primary'] )[2], false); ?>%;
            }
            html {
                font-family: <?php echo settings('appearance')?->font_family ?>, sans-serif !important;
            }
            .fileuploader, .fileuploader-popup {
                font-family: <?php echo settings('appearance')?->font_family ?>, sans-serif !important;
            }
        </style>

        
        <?php echo $__env->yieldPushContent('styles'); ?>

        
        <script>
            __var_app_url        = "<?php echo e(url('/'), false); ?>";
            __var_app_locale     = "<?php echo e(app()->getLocale(), false); ?>";
            __var_rtl            = <?php echo \Illuminate\Support\Js::from(config()->get('direction') === 'ltr' ? false : true)->toHtml() ?>;
            __var_primary_color  = "<?php echo e(settings('appearance')->colors['primary'], false); ?>";
            __var_axios_base_url = "<?php echo e(url('/'), false); ?>/";
            __var_currency_code  = "<?php echo e(settings('currency')->code, false); ?>";
        </script>

        <script >window.Wireui = {hook(hook, callback) {window.addEventListener(`wireui:${hook}`, () => callback())},dispatchHook(hook) {window.dispatchEvent(new Event(`wireui:${hook}`))}}</script>
<script src="http://localhost/taquad/wireui/assets/scripts?id=2bb2382efa56ba70bd4659eaccb242c7" defer ></script>

        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>

    </head>

    <body class="h-full">
        
        <div class="bg-gray-50 min-h-full px-4 py-16 sm:px-6 sm:py-24 md:grid md:place-items-center lg:px-8 h-[100vh]">
            <div class="max-w-max mx-auto">
                <main class="sm:flex">
                    <p class="text-4xl font-extrabold text-primary-600 sm:text-5xl">404</p>
                    <div class="sm:ml-6">
                        <div class="sm:border-l sm:border-gray-200 sm:pl-6">
                            <h1 class="text-2xl font-extrabold text-gray-900 sm:text-3xl uppercase tracking-widest">
                                <?php echo app('translator')->get('messages.t_page_not_fount'); ?>
                            </h1>
                            <p class="mt-1 text-base text-gray-500">
                                <?php echo app('translator')->get('messages.t_pls_check_url_address_bar_try_again'); ?>
                            </p>
                        </div>
                        <div class="mt-10 flex space-x-3 sm:border-l sm:border-transparent sm:pl-6">
                            <a href="<?php echo e(url('/'), false); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-600">
                                <?php echo app('translator')->get('messages.t_back_to_homepage'); ?>    
                            </a>
                            <a href="<?php echo e(url('help/contact'), false); ?>" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-primary-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-600">
                                <?php echo app('translator')->get('messages.t_contact_us'); ?>    
                            </a>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scriptConfig(); ?>


        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        
        <script defer src="<?php echo e(url('public/js/utils.js?v=1.3.1'), false); ?>"></script>
        <script src="<?php echo e(url('public/js/components.js?v=1.3.1'), false); ?>"></script>

        
        <script defer>
            
            document.addEventListener("DOMContentLoaded", function(){

                jQuery.event.special.touchstart = {
                    setup: function( _, ns, handle ) {
                        this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
                    }
                };
                jQuery.event.special.touchmove = {
                    setup: function( _, ns, handle ) {
                        this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
                    }
                };
                jQuery.event.special.wheel = {
                    setup: function( _, ns, handle ){
                        this.addEventListener("wheel", handle, { passive: true });
                    }
                };
                jQuery.event.special.mousewheel = {
                    setup: function( _, ns, handle ){
                        this.addEventListener("mousewheel", handle, { passive: true });
                    }
                };

                // Refresh
                window.addEventListener('refresh',() => {
                    location.reload();
                });
 
            });

            function jwUBiFxmwbrUwww() {
                return {

                    scroll: false,

                    init() {
                        var _this = this;
                        $(document).scroll(function () {
                            $(this).scrollTop() > 70 ? _this.scroll = true : _this.scroll = false;
                        });

                    }

                }
            }
            window.jwUBiFxmwbrUwww = jwUBiFxmwbrUwww();

            document.ontouchmove = function(event){
                event.preventDefault();
            }
            
        </script>

        
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

    </body>

</html>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/errors/404.blade.php ENDPATH**/ ?>