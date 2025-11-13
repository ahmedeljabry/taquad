<?php
    use Illuminate\Support\Facades\View;
    $initialThemePreference = current_theme() ?: 'system';
?>
<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale(), false); ?>"
      dir="<?php echo e(config()->get('direction'), false); ?>"
      data-theme-preference="<?php echo e($initialThemePreference, false); ?>"
      data-theme="<?php echo e($initialThemePreference, false); ?>"
      data-theme-endpoint="<?php echo e(url('theme/preference'), false); ?>"
      data-theme-auth="<?php echo e(auth()->check() ? 'true' : 'false', false); ?>"
      class="<?php echo \Illuminate\Support\Arr::toCssClasses(['dark' => current_theme() === 'dark']); ?>">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">

        
        <?php echo SEO::generate(); ?>

        <?php echo JsonLd::generate(); ?>


        
		<?php echo settings('appearance')->font_link; ?>


        
        <link rel="icon" type="image/png" href="<?php echo e(src( settings('general')->favicon ), false); ?>"/>

        
        <link href="<?php echo e(asset('vendor/bladewind/css/animate.min.css'), false); ?>" rel="stylesheet" />
        <link href="<?php echo e(asset('vendor/bladewind/css/bladewind-ui.min.css'), false); ?>" rel="stylesheet" />

        
        <script>
            (function () {
                try {
                    var storageKey = 'taquad-theme-preference';
                    var root = document.documentElement;
                    var stored = null;
                    try {
                        stored = localStorage.getItem(storageKey);
                    } catch (_) {
                        stored = null;
                    }
                    var preference = stored || root.dataset.themePreference || 'system';
                    var effective = preference;
                    if (preference === 'system') {
                        effective = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                    }
                    root.dataset.themePreference = preference;
                    root.dataset.theme = effective;
                    if (effective === 'dark') {
                        root.classList.add('dark');
                    } else {
                        root.classList.remove('dark');
                    }
                } catch (error) {
                    // noop
                }
            })();
        </script>

        
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
<script src="http://localhost/taquad/wireui/assets/scripts?id=2bb2382efa56ba70bd4659eaccb242c7" defer ></script>
        <?php echo $__env->make('components.wireui.basepath', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css','resources/js/app.js']); ?>

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

		
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('main.includes.header');

$__html = app('livewire')->mount($__name, $__params, 'lw-2987333091-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

        

        <main class="flex-grow">
            <div class="min-h-screen">
                <?php echo e($slot, false); ?>

            </div>
        </main>

        
        <?php if(auth()->guard('admin')->check()): ?>
            <div data-dial-init class="fixed ltr:right-10 rtl:left-10 bottom-10 group z-10">

                
                <div id="admin-quick-links-button" class="flex flex-col items-center hidden mb-4 space-y-2">

                    
                    <a href="<?php echo e(admin_url('/'), false); ?>" target="_blank" data-tooltip-target="tooltip-admin-quick-action-dial-dashboard" data-tooltip-placement="<?php echo e(config()->get('direction') == 'ltr' ? 'left' : 'right', false); ?>" class="relative w-11 h-11 text-gray-600 bg-white rounded-md border border-gray-200 hover:text-gray-900 dark:border-zinc-600 shadow-sm dark:hover:text-white dark:text-zinc-300 hover:bg-gray-50 dark:bg-zinc-700 dark:hover:bg-zinc-600 focus:ring-2 focus:ring-slate-300 focus:outline-none dark:focus:ring-zinc-400">
                        <i class="flex h-full items-center justify-center mx-auto ph-duotone ph-layout text-2xl w-full text-slate-400"></i>
                    </a>
                    <?php if (isset($component)) { $__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Tooltip::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.tooltip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Tooltip::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'tooltip-admin-quick-action-dial-dashboard','text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_dashboard'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265)): ?>
<?php $attributes = $__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265; ?>
<?php unset($__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265)): ?>
<?php $component = $__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265; ?>
<?php unset($__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265); ?>
<?php endif; ?>

                    
                    <a href="<?php echo e(admin_url('projects'), false); ?>" target="_blank" data-tooltip-target="tooltip-admin-quick-action-dial-projects" data-tooltip-placement="<?php echo e(config()->get('direction') == 'ltr' ? 'left' : 'right', false); ?>" class="relative w-11 h-11 text-gray-600 bg-white rounded-md border border-gray-200 hover:text-gray-900 dark:border-zinc-600 shadow-sm dark:hover:text-white dark:text-zinc-300 hover:bg-gray-50 dark:bg-zinc-700 dark:hover:bg-zinc-600 focus:ring-2 focus:ring-slate-300 focus:outline-none dark:focus:ring-zinc-400">
                        <i class="flex h-full items-center justify-center mx-auto ph-duotone ph-projector-screen-chart text-2xl w-full text-slate-400"></i>
                    </a>
                    <?php if (isset($component)) { $__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Tooltip::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.tooltip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Tooltip::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'tooltip-admin-quick-action-dial-projects','text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('dashboard.t_manage_projects'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265)): ?>
<?php $attributes = $__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265; ?>
<?php unset($__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265)): ?>
<?php $component = $__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265; ?>
<?php unset($__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265); ?>
<?php endif; ?>

                    
                    <a href="<?php echo e(admin_url('logout'), false); ?>" data-tooltip-target="tooltip-admin-quick-action-dial-logout" data-tooltip-placement="<?php echo e(config()->get('direction') == 'ltr' ? 'left' : 'right', false); ?>" class="relative w-11 h-11 text-gray-600 bg-white rounded-md border border-gray-200 hover:text-gray-900 dark:border-zinc-600 shadow-sm dark:hover:text-white dark:text-zinc-300 hover:bg-gray-50 dark:bg-zinc-700 dark:hover:bg-zinc-600 focus:ring-2 focus:ring-slate-300 focus:outline-none dark:focus:ring-zinc-400">
                        <i class="flex h-full items-center justify-center mx-auto ph-duotone ph-power text-2xl w-full text-slate-400"></i>
                    </a>
                    <?php if (isset($component)) { $__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Tooltip::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.tooltip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Tooltip::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'tooltip-admin-quick-action-dial-logout','text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_logout'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265)): ?>
<?php $attributes = $__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265; ?>
<?php unset($__attributesOriginalf78ffbe4a2783cbb9a46d3509ee95265); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265)): ?>
<?php $component = $__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265; ?>
<?php unset($__componentOriginalf78ffbe4a2783cbb9a46d3509ee95265); ?>
<?php endif; ?>

                </div>

                
                <button type="button" data-dial-trigger="click" data-dial-toggle="admin-quick-links-button" aria-controls="admin-quick-links-button" aria-expanded="false" class="bg-white border border-gray-300 dark:bg-zinc-800 dark:border-zinc-700 dark:focus:ring-zinc-600 dark:text-zinc-400 flex focus:outline-none focus:ring-2 focus:ring-slate-200 h-14 hover:shadow-none hover:text-slate-500 items-center justify-center rounded-full shadow-sm text-slate-400 w-14 dark:hover:text-zinc-200">
                    <i class="ph-duotone ph-user-circle-gear text-3xl"></i>
                </button>

            </div>
        <?php endif; ?>

        
        <?php if (! (View::hasSection('hideMainFooter'))): ?>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('main.includes.footer');

$__html = app('livewire')->mount($__name, $__params, 'lw-2987333091-1', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        <?php endif; ?>

        
        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scriptConfig(); ?>

        <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


        
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

        
        <?php echo $__env->make('components.layouts.partials.ai-widget', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('wire-elements-modal');

$__html = app('livewire')->mount($__name, $__params, 'lw-2987333091-2', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

        <?php echo \Rawilk\FormComponents\Facades\FormComponents::javaScript(); ?>


        
        <script src="https://js.pusher.com/8.2/pusher.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1/dist/echo.iife.js"></script>
        <script type="text/javascript">
            (function () {
                const CONNECTION = <?php echo json_encode(config('broadcasting.connections.reverb') ?? config('broadcasting.connections.pusher'), 15, 512) ?>;
                const OPTIONS = (CONNECTION && CONNECTION.options) || {};
                const USER_ID = <?php echo e(auth()->id() ?? 'null', false); ?>;
                const BASE_TITLE = document.title.replace(/\(\d+\)\s*/, '');

                let unread = <?php echo e(unseen_messages_count(), false); ?>;

                window.Pusher = Pusher;
                const host = OPTIONS.host || window.location.hostname;
                const port = Number(OPTIONS.port || (OPTIONS.encrypted ? 443 : 6001));
                const scheme = OPTIONS.scheme || (OPTIONS.encrypted ? 'https' : 'http');
                const driver = (CONNECTION && CONNECTION.driver) || 'pusher';
                const isReverb = driver === 'reverb';
                const key = CONNECTION ? CONNECTION.key : null;
                const wsPath = (() => {
                    if (typeof OPTIONS.path !== 'string' || OPTIONS.path.length === 0) {
                        return '';
                    }

                    return OPTIONS.path.startsWith('/') ? OPTIONS.path : `/${OPTIONS.path}`;
                })();
                const authEndpoint = "<?php echo e(url('/broadcasting/auth'), false); ?>";

                const echoOptions = {
                    broadcaster: isReverb ? 'reverb' : 'pusher',
                    key,
                    wsHost: host,
                    wsPort: port,
                    wssPort: Number(OPTIONS.wssPort ?? port),
                    wsPath,
                    forceTLS: scheme === 'https',
                    disableStats: true,
                    encrypted: OPTIONS.encrypted ?? (scheme === 'https'),
                    authEndpoint,
                    auth: {
                        withCredentials: true,
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token(), false); ?>'
                        }
                    }
                };

                if (!echoOptions.forceTLS) {
                    echoOptions.enabledTransports = ['ws'];
                }

                if (!isReverb) {
                    echoOptions.cluster = OPTIONS.cluster || 'mt1';
                }

                window.Echo = new Echo(echoOptions);

                const playNotificationSound = () => {
                    try {
                        const AudioContext = window.AudioContext || window.webkitAudioContext;
                        if (AudioContext) {
                            const ctx = new AudioContext();
                            const oscillator = ctx.createOscillator();
                            const gain = ctx.createGain();

                            oscillator.type = 'sine';
                            oscillator.frequency.value = 880;
                            gain.gain.setValueAtTime(0.2, ctx.currentTime);

                            oscillator.connect(gain);
                            gain.connect(ctx.destination);

                            oscillator.start();
                            oscillator.stop(ctx.currentTime + 0.25);

                            return;
                        }
                    } catch (error) {
                        // Fallback to audio element below
                    }

                    const audio = new Audio("<?php echo e(asset('sounds/new-message.mp3'), false); ?>");
                    audio.play().catch(() => {});
                };

                const badgeHTML = `\n                    <span id="nav-badge"\n                            class="flex absolute h-2 w-2 top-0 ltr:right-0 rtl:left-0 mt-0 ltr:-mr-1 rtl:-ml-1">\n                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full\n                                    bg-primary-400 opacity-75"></span>\n                        <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>\n                    </span>`;

                const inboxLink = document.querySelector('a[href="<?php echo e(route('messages.inbox'), false); ?>"]');

                const addBadge = () => {
                    if (!inboxLink) {
                        return;
                    }

                    if (!document.getElementById('nav-badge')) {
                        inboxLink.insertAdjacentHTML('beforeend', badgeHTML);
                    }
                };

                const removeBadge = () => {
                    const el = document.getElementById('nav-badge');
                    if (el) {
                        el.remove();
                    }
                };

                const paint = () => {
                    document.title = unread ? `(${unread}) ${BASE_TITLE}` : BASE_TITLE;

                    if (unread) {
                        addBadge();
                    } else {
                        removeBadge();
                    }
                };

                paint();

                const dispatchRealtime = (event, payload) => {
                    window.dispatchEvent(new CustomEvent('realtime:notification', {
                        detail: { event, payload }
                    }));
                };

                if (USER_ID) {
                    window.Echo.private(`user.${USER_ID}`)
                        .listen('.notification.created', (payload) => dispatchRealtime('notification.created', payload))
                        .listen('.notification.sent', (payload) => dispatchRealtime('notification.sent', payload))
                        .listen('.message.sent', (payload) => {
                            if (window.Livewire && typeof window.Livewire.dispatch === 'function') {
                                window.Livewire.dispatch('conversations:refresh', {
                                    event: 'chat.message.received',
                                    payload
                                });
                            }

                            if ((payload.sender?.id ?? null) === USER_ID) {
                                return;
                            }

                            unread += 1;
                            addBadge();
                            playNotificationSound();
                            paint();
                        });
                }

                window.addEventListener('realtime:notification', (event) => {
                    if (window.Livewire && typeof window.Livewire.dispatch === 'function') {
                        window.Livewire.dispatch('notifications:refresh', {
                            event: event.detail?.event,
                            payload: event.detail?.payload
                        });
                    }
                });

                window.addEventListener('messages:unread-count', (event) => {
                    if (typeof event.detail?.count === 'number') {
                        unread = Math.max(0, event.detail.count);
                        paint();
                    }
                });
            })();
        </script>

        
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



<?php /**PATH C:\xampp\htdocs\taquad\resources\views/components/layouts/main-app.blade.php ENDPATH**/ ?>