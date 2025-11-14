<!DOCTYPE html>
<?php
    $authTheme = current_theme();
    $authPreference = in_array($authTheme, ['light', 'dark']) ? $authTheme : 'system';
?>
<html lang="<?php echo e(app()->getLocale(), false); ?>" dir="<?php echo e(config()->get('direction'), false); ?>"
    data-theme-preference="<?php echo e($authPreference, false); ?>"
    data-theme="<?php echo e($authTheme === 'dark' ? 'dark' : 'light', false); ?>"
    data-theme-endpoint="<?php echo e(url('theme/preference'), false); ?>"
    data-theme-auth="<?php echo e(auth()->check() ? 'true' : 'false', false); ?>"
    data-theme-label-light="<?php echo e(__('messages.t_theme_light'), false); ?>"
    data-theme-label-dark="<?php echo e(__('messages.t_theme_dark'), false); ?>"
    data-theme-label-system="<?php echo e(__('messages.t_theme_system'), false); ?>"
    data-theme-label-toggle="<?php echo e(__('messages.t_theme_toggle'), false); ?>"
    class="<?php echo \Illuminate\Support\Arr::toCssClasses(['dark' => $authTheme === 'dark']); ?>">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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

        
        <link href="<?php echo e(asset('vendor/bladewind/css/animate.min.css'), false); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('vendor/bladewind/css/bladewind-ui.min.css'), false); ?>" rel="stylesheet" />

        
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

        <script >window.Wireui = {hook(hook, callback) {window.addEventListener(`wireui:${hook}`, () => callback())},dispatchHook(hook) {window.dispatchEvent(new Event(`wireui:${hook}`))}}</script>
<script src="https://localhost/taquad/wireui/assets/scripts?id=2bb2382efa56ba70bd4659eaccb242c7" defer ></script>
        <?php echo $__env->make('components.wireui.basepath', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>

    </head>

    <body class="antialiased bg-gray-50 dark:bg-[#161616] text-gray-600 min-h-full flex flex-col application application-ltr overflow-x-hidden <?php echo e(app()->getLocale() === 'ar' ? 'application-ar' : '', false); ?>">

        
        <?php if (isset($component)) { $__componentOriginal10717d162484e57a570d6d2cc4597545 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal10717d162484e57a570d6d2cc4597545 = $attributes; } ?>
<?php $component = WireUi\View\Components\Notifications::resolve(['position' => 'top-center','zIndex' => 'z-[60]'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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

        
        <div class="min-h-screen flex grow bg-slate-50 dark:bg-zinc-700">
            
            <div class="hidden w-full place-items-center lg:grid">
                <div class="w-full px-2 py-40 sm:py-48 sm:px-12 flex flex-col justify-center relative bg-no-repeat bg-center bg-cover h-full" <?php if(settings('auth')->wallpaper): ?> style="background-image: url(<?php echo e(src(settings('auth')->wallpaper), false); ?>)" <?php endif; ?>>
                    <span class="absolute bg-gradient-to-b from-primary-500 to-primary-400 opacity-75 inset-0 z-0"></span>

                    
                    <div class="fixed top-0 ltr:left-0 rtl:right-0 hidden p-6 lg:block lg:px-12">
                        <?php if(settings('general')->logo_dark): ?>
                            <a href="<?php echo e(url('/'), false); ?>" class="flex items-center">
                                <img src="<?php echo e(src(settings('general')->logo_dark), false); ?>" alt="<?php echo e(settings('general')->title, false); ?>" style="height: <?php echo e(settings('appearance')->sizes['header_desktop_logo_height'], false); ?>px;">
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(url('/'), false); ?>" class="flex items-center">
                                <img src="<?php echo e(src(settings('general')->logo), false); ?>" alt="<?php echo e(settings('general')->title, false); ?>" style="height: <?php echo e(settings('appearance')->sizes['header_desktop_logo_height'], false); ?>px;">
                            </a>
                        <?php endif; ?>
                    </div>

                    
                    <div class="fixed bottom-0 ltr:left-0 rtl:right-0 hidden p-6 lg:block lg:px-12 text-white font-normal text-[13px]">
                        <?php echo settings('footer')->copyrights; ?>

                    </div>

                </div>
            </div>
            <main class="flex w-full flex-col items-center bg-white dark:bg-zinc-800 lg:max-w-md">
                <?php echo e($slot, false); ?>

            </main>
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

        
        <?php echo $__env->yieldPushContent('scripts'); ?>

        
        <?php if(settings('appearance')->custom_code_footer_main_layout): ?>
            <?php echo settings('appearance')->custom_code_footer_main_layout; ?>

        <?php endif; ?>

        
        <?php if(is_hero_section()): ?>
            <script>
                $(window).scroll(function(){
                    var   screen_width         = screen.width;
                    var   doc                  = document.documentElement;
                    var   top                  = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
                    const header_element       = $('#main-header');
                    const search_box           = $('.main-search-box');
                    const logo_img_element     = $('#primary-logo-img');
                    const primary_logo_src     = logo_img_element.attr('data-primary-logo');
                    const transparent_logo_src = logo_img_element.attr('data-transparent-logo');

                    if (top >= 100) {
                        header_element.addClass('main-header-scrolling');
                        logo_img_element.attr('src', primary_logo_src);
                    } else if (top == 0 || top <= 100) {
                        header_element.removeClass('main-header-scrolling');
                        logo_img_element.attr('src', transparent_logo_src);
                    }

                    if (screen_width > 1024) {
                        if (top >= 200) {
                            search_box.removeClass('hidden');
                        } else if (top < 200) {
                            search_box.addClass('hidden');
                        }
                    }
                });

                window.addEventListener('load', function () {
                    var   screen_width         = screen.width;
                    var   top                  = self['pageYOffset'] || document.documentElement.scrollTop;
                    const header_element       = $('#main-header');
                    const search_box           = $('.main-search-box');
                    const logo_img_element     = $('#primary-logo-img');
                    const primary_logo_src     = logo_img_element.attr('data-primary-logo');
                    const transparent_logo_src = logo_img_element.attr('data-transparent-logo');

                    if (top >= 100) {
                        header_element.addClass('main-header-scrolling');
                        logo_img_element.attr('src', primary_logo_src);
                    } else if (top == 0 || top <= 100) {
                        header_element.removeClass('main-header-scrolling');
                        logo_img_element.attr('src', transparent_logo_src);
                    }

                    if (screen_width > 1024) {
                        if (top >= 200) {
                            search_box.removeClass('hidden');
                        } else if (top < 200) {
                            search_box.addClass('hidden');
                        }
                    }

                });
        
            </script>
        <?php endif; ?>

        
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('wire-elements-modal');

$__html = app('livewire')->mount($__name, $__params, 'lw-465051188-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

        <?php echo \Rawilk\FormComponents\Facades\FormComponents::javaScript(); ?>
        

        
        <script>
            document.addEventListener('livewire:initialized', () => {

                // Change current theme
                window.Livewire.on('change-current-theme', () => {
                
                    // Remove or add dark class
                    document.getElementsByTagName("html")[0].classList.toggle("dark");

                });

                // Scroll to specific div
                window.Livewire.on('scrollTo', (event) => {

                    // Get id to scroll
                    const id = event.detail;

                    // Scroll
                    $('html, body').animate({
                        scrollTop: $("#" + id).offset().top
                    }, 500);

                });

                // Scroll to up page
                window.Livewire.on('scrollUp', () => {

                    // Scroll
                    $('html, body').animate({
                        scrollTop: $("body").offset().top
                    }, 500);

                });

            });
        </script>

    </body>

</html>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/auth/layout/auth.blade.php ENDPATH**/ ?>