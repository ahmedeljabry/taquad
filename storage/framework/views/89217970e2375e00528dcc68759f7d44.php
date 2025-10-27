<!DOCTYPE html>
<?php
    $serverTheme = current_theme();
    $serverThemePreference = in_array($serverTheme, ['light', 'dark']) ? $serverTheme : 'system';
?>
<html lang="<?php echo e(app()->getLocale(), false); ?>" dir="<?php echo e(config()->get('direction'), false); ?>"
    data-theme-preference="<?php echo e($serverThemePreference, false); ?>"
    data-theme="<?php echo e($serverTheme === 'dark' ? 'dark' : 'light', false); ?>"
    data-theme-label-light="<?php echo e(__('messages.t_theme_light'), false); ?>"
    data-theme-label-dark="<?php echo e(__('messages.t_theme_dark'), false); ?>"
    data-theme-label-system="<?php echo e(__('messages.t_theme_system'), false); ?>"
    data-theme-label-toggle="<?php echo e(__('messages.t_theme_toggle'), false); ?>"
    class="<?php echo \Illuminate\Support\Arr::toCssClasses(['dark' => $serverTheme === 'dark']); ?>">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">
        <script>
            (function () {
                const storageKey = 'taquad-theme-preference';
                const root = document.documentElement;
                let preference = root.dataset.themePreference || 'system';

                try {
                    const stored = localStorage.getItem(storageKey);
                    if (stored) {
                        preference = stored;
                    }
                } catch (error) {
                    console.warn('Theme preference unavailable', error);
                }

                const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                let theme = preference;

                if (preference !== 'light' && preference !== 'dark') {
                    theme = systemPrefersDark ? 'dark' : 'light';
                    preference = 'system';
                }

                root.dataset.themePreference = preference;
                root.dataset.theme = theme;
                if (theme === 'dark') {
                    root.classList.add('dark');
                } else {
                    root.classList.remove('dark');
                }
            })();
        </script>

        
        <?php echo SEO::generate(); ?>

        <?php echo JsonLd::generate(); ?>


        
		<?php echo settings('appearance')->font_link; ?>


        
        <link rel="icon" type="image/png" href="<?php echo e(src( settings('general')->favicon ), false); ?>"/>

        
		<?php if(settings('hero')->enable_bg_img): ?>

            
            <?php if(settings('hero')->background_small): ?>
                <link rel="preload prefetch" as="image" href="<?php echo e(src(settings('hero')->background_small), false); ?>" type="image/webp" />
            <?php endif; ?>

            
            <?php if(settings('hero')->background_medium): ?>
                <link rel="preload prefetch" as="image" href="<?php echo e(src(settings('hero')->background_medium), false); ?>" type="image/webp" />
            <?php endif; ?>

            
            <?php if(settings('hero')->background_large): ?>
                <link rel="preload prefetch" as="image" href="<?php echo e(src(settings('hero')->background_large), false); ?>" type="image/webp" />
            <?php endif; ?>

        <?php endif; ?>

        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


        
        <?php echo $__env->make('components.phosphor.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        <link rel="preload" href="<?php echo e(mix('css/app.css'), false); ?>" as="style">
        <link rel="stylesheet" href="<?php echo e(mix('css/app.css'), false); ?>">

        
        <link rel="preload" href="<?php echo e(livewire_asset_path(), false); ?>" as="script">

		
        <style>
            :root {
                --color-primary  : <?php echo e(settings('appearance')->colors['primary'], false); ?>;
                --color-primary-h: <?php echo e(hex2hsl( settings('appearance')->colors['primary'] )[0], false); ?>;
                --color-primary-s: <?php echo e(hex2hsl( settings('appearance')->colors['primary'] )[1], false); ?>%;
                --color-primary-l: <?php echo e(hex2hsl( settings('appearance')->colors['primary'] )[2], false); ?>%;
            }
            html {
                font-family: <?php echo settings('appearance')->font_family ?>, sans-serif !important;
            }
            .fileuploader, .fileuploader-popup {
                font-family: <?php echo settings('appearance')->font_family ?>, sans-serif !important;
            }
            .home-hero-section {
                background-color: <?php echo e(settings('hero')->bg_color, false); ?>;
                background-repeat: no-repeat;
                background-position: center center;
                background-size: cover;
                height: <?php echo e(settings('hero')->bg_large_height, false); ?>px;
            }

            
            <?php if(settings('hero')->enable_bg_img): ?>

                
                <?php if(settings('hero')->background_small): ?>

                    @media only screen and (max-width: 600px) {
                        .home-hero-section {
                            background-image: url('<?php echo e(src(settings('hero')->background_small), false); ?>');
                            height: <?php echo e(settings('hero')->bg_small_height, false); ?>px;
                        }
                    }

                <?php endif; ?>

                
                <?php if(settings('hero')->background_medium): ?>

                    @media only screen and (min-width: 600px) {
                        .home-hero-section {
                            background-image: url('<?php echo e(src(settings('hero')->background_medium), false); ?>')
                        }
                    }

                <?php endif; ?>

                
                <?php if(settings('hero')->background_large): ?>

                    @media only screen and (min-width: 768px) {
                        .home-hero-section {
                            background-image: url('<?php echo e(src(settings('hero')->background_large), false); ?>');
                        }
                    }

                <?php endif; ?>

                
                <?php if(settings('hero')->background_large): ?>

                    @media only screen and (min-width: 992px) {
                        .home-hero-section {
                            background-image: url('<?php echo e(src(settings('hero')->background_large), false); ?>');
                        }
                    }

                <?php endif; ?>

                
                <?php if(settings('hero')->background_large): ?>

                    @media only screen and (min-width: 1200px) {
                        .home-hero-section {
                            background-image: url('<?php echo e(src(settings('hero')->background_large), false); ?>');
                        }
                    }

                <?php endif; ?>

            <?php endif; ?>

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

        
        <?php if(advertisements('header_code')): ?>
            <?php echo advertisements('header_code'); ?>

        <?php endif; ?>

        
        <?php if(settings('appearance')->custom_code_head_main_layout): ?>
            <?php echo settings('appearance')->custom_code_head_main_layout; ?>

        <?php endif; ?>

    </head>

    <body class="antialiased bg-[#fafafa] dark:bg-[#161616] text-gray-600 min-h-full flex flex-col application application-ltr overflow-x-hidden overflow-y-scroll <?php echo e(app()->getLocale() === 'ar' ? 'application-ar' : '', false); ?>" style="overflow-y: scroll">

        
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

        <?php if (! ($disabeld_header)): ?>
		    
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('main.includes.header');

$__html = app('livewire')->mount($__name, $__params, 'lw-3494792778-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        <?php endif; ?>

        
        <?php if(request()->is('/')): ?>

            
            <div class="home-hero-section">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
                    <div class="w-full md:max-w-lg">

                        
                        <h1 class="text-center sm:ltr:text-left sm:rtl:text-right mt-4 text-xl tracking-tight font-extrabold text-white sm:mt-5 sm:text-3xl lg:mt-6 xl:text-4xl">
                            <?php echo e(__('messages.t_find_best'), false); ?> <?php echo e(__('messages.t_freelance'), false); ?><br> <?php echo e(__('messages.t_services_for_ur_business'), false); ?>

                        </h1>
                        <div class="mt-10 sm:mt-12">

                            
                            <form class="flex items-center mb-4" action="<?php echo e(url('search'), false); ?>" accept="GET">

                                
                                <div class="relative w-full">
                                    <div class="absolute inset-y-0 ltr:left-0 rtl:right-0 flex items-center ltr:pl-3 rtl:pr-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <input type="search" name="q" class="bg-white border-none text-gray-900 text-sm font-medium rounded-md block w-full ltr:pl-10 rtl:pr-10 px-2.5 py-4 focus:outline-none focus:ring-0" placeholder="<?php echo e(__('messages.t_what_service_are_u_looking_for_today'), false); ?>" required>
                                </div>

                                
                                <button type="submit" class="px-5 py-4 ltr:ml-2 rtl:mr-2 text-sm font-medium text-white bg-primary-600 rounded-md border-none hover:bg-primary-800 focus:ring-0 focus:outline-none">
                                    <?php echo app('translator')->get('messages.t_search'); ?>
                                </button>

                            </form>

                            
                            <?php
                                $popular_tags = App\Models\Category::whereHas('gigs')->withCount('gigs')->take(5)->orderBy('gigs_count')->get();
                            ?>
                            <div class="hidden sm:flex items-center text-white font-semibold text-sm whitespace-nowrap">
                                <?php echo app('translator')->get('messages.t_popular_colon'); ?>
                                <ul class="flex ltr:ml-3 rtl:mr-3">
                                    <?php $__currentLoopData = $popular_tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="flex ltr:mr-3 rtl:ml-3 whitespace-nowrap">
                                            <a href="<?php echo e(url('categories', $tag->slug), false); ?>" class="border-2 border-white rounded-[40px] hover:bg-white hover:text-gray-700 transition-all duration-200 px-3 py-0.5 text-xs">
                                                <?php echo e($tag->name, false); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        <?php endif; ?>

        
        <main class="flex-grow">
            <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['container max-w-7xl lg:px-8 min-h-screen pt-16 pb-24 space-y-8 py-12 mx-auto px-4 sm:px-6' => !$do_not_add_width, 'space-y-6 mt-20' => $do_not_add_width ]); ?>">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>

        
        <?php if (! ($disable_footer)): ?>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('main.includes.footer');

$__html = app('livewire')->mount($__name, $__params, 'lw-3494792778-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        <?php endif; ?>


        
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


        
        <script >window.Wireui = {hook(hook, callback) {window.addEventListener(`wireui:${hook}`, () => callback())},dispatchHook(hook) {window.dispatchEvent(new Event(`wireui:${hook}`))}}</script>
<script src="http://localhost/taquad/wireui/assets/scripts?id=2bb2382efa56ba70bd4659eaccb242c7" defer ></script>
        <?php echo $__env->make('components.wireui.basepath', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        <script defer src="<?php echo e(mix('js/app.js'), false); ?>"></script>

        
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

                // Scroll to specific div
                window.addEventListener('scrollTo', (event) => {

                    // Get id to scroll
                    const id = event.detail;

                    // Scroll
                    $('html, body').animate({
                        scrollTop: $("#" + id).offset().top
                    }, 500);

                });

                // Scroll to up page
                window.addEventListener('scrollUp', () => {

                    // Scroll
                    $('html, body').animate({
                        scrollTop: $("body").offset().top
                    }, 500);

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

        
        <?php echo $__env->yieldPushContent('scripts'); ?>

        
        <?php if(settings('appearance')->custom_code_footer_main_layout): ?>
            <?php echo settings('appearance')->custom_code_footer_main_layout; ?>

        <?php endif; ?>

    </body>

</html>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/layout/app.blade.php ENDPATH**/ ?>