<div class="w-full">

    
    <div class="w-full mb-12">
        
        
        <h2 class="text-[15px] font-bold text-black dark:text-white mb-6">
            <?php echo app('translator')->get('dashboard.t_general_stats'); ?>
        </h2>

        
        <ul role="list" class="grid grid-cols-1 gap-5 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">


            
            <li class="col-span-1">
                <div class="bg-white dark:bg-zinc-800 border border-slate-200 dark:border-transparent rounded-lg text-slate-500 dark:text-zinc-300 inline-flex items-center justify-center px-4 py-3 w-full">

                    
                    <div class="bg-orange-50 dark:bg-zinc-700 dark:border-transparent border-orange-300 text-orange-600 h-9 w-9 flex items-center justify-center rounded-full border ltr:mr-3 rtl:ml-3 text-xl shrink-0">
                        <i class="ph-duotone ph-images-square"></i>
                    </div>
                    
                    
                    <span class="w-full ltr:text-left rtl:text-right font-medium tracking-wide truncate whitespace-nowrap overflow-hidden text-xs+">
                        <?php echo app('translator')->get('messages.t_net_income'); ?>
                    </span>
    
                    
                    <div class="font-bold text-black dark:text-white tracking-wider text-sm">
                        <?php echo e(money($net_income, settings('currency')->code, true), false); ?>

                    </div>
    
                </div>
            </li>

            
            <li class="col-span-1">
                <div class="bg-white dark:bg-zinc-800 border border-slate-200 dark:border-transparent rounded-lg text-slate-500 dark:text-zinc-300 inline-flex items-center justify-center px-4 py-3 w-full">

                    
                    <div class="bg-red-50 dark:bg-zinc-700 dark:border-transparent border-red-300 text-red-600 h-9 w-9 flex items-center justify-center rounded-full border ltr:mr-3 rtl:ml-3 text-xl shrink-0">
                        <i class="ph-duotone ph-images-square"></i>
                    </div>
                    
                    
                    <span class="w-full ltr:text-left rtl:text-right font-medium tracking-wide truncate whitespace-nowrap overflow-hidden text-xs+">
                        <?php echo app('translator')->get('messages.t_taxes'); ?>
                    </span>

                    
                    <div class="font-bold text-black dark:text-white tracking-wider text-sm">
                        <?php echo e(money($income_from_taxes, settings('currency')->code, true), false); ?>

                    </div>

                </div>
            </li>

            
            <li class="col-span-1">
                <div class="bg-white dark:bg-zinc-800 border border-slate-200 dark:border-transparent rounded-lg text-slate-500 dark:text-zinc-300 inline-flex items-center justify-center px-4 py-3 w-full">

                    
                    <div class="bg-indigo-50 dark:bg-zinc-700 dark:border-transparent border-indigo-300 text-indigo-600 h-9 w-9 flex items-center justify-center rounded-full border ltr:mr-3 rtl:ml-3 text-xl shrink-0">
                        <i class="ph-duotone ph-images-square"></i>
                    </div>
                    
                    
                    <span class="w-full ltr:text-left rtl:text-right font-medium tracking-wide truncate whitespace-nowrap overflow-hidden text-xs+">
                        <?php echo app('translator')->get('messages.t_commission'); ?>
                    </span>

                    
                    <div class="font-bold text-black dark:text-white tracking-wider text-sm">
                        <?php echo e(money($income_from_commission, settings('currency')->code, true), false); ?>

                    </div>

                </div>
            </li>

            
            <li class="col-span-1">
                <div class="bg-white dark:bg-zinc-800 border border-slate-200 dark:border-transparent rounded-lg text-slate-500 dark:text-zinc-300 inline-flex items-center justify-center px-4 py-3 w-full">

                    
                    <div class="bg-lime-50 dark:bg-zinc-700 dark:border-transparent border-lime-300 text-lime-600 h-9 w-9 flex items-center justify-center rounded-full border ltr:mr-3 rtl:ml-3 text-xl shrink-0">
                        <i class="ph-duotone ph-wallet"></i>
                    </div>
                    
                    
                    <span class="w-full ltr:text-left rtl:text-right font-medium tracking-wide truncate whitespace-nowrap overflow-hidden text-xs+">
                        <?php echo app('translator')->get('dashboard.t_total_payout'); ?>
                    </span>
    
                    
                    <div class="font-bold text-black dark:text-white tracking-wider text-sm">
                        <?php echo e(money($withdrawn_money, settings('currency')->code, true), false); ?>

                    </div>
    
                </div>
            </li>

            
            <li class="col-span-1">
                <div class="bg-white dark:bg-zinc-800 border border-slate-200 dark:border-transparent rounded-lg text-slate-500 dark:text-zinc-300 inline-flex items-center justify-center px-4 py-3 w-full">

                    
                    <div class="bg-pink-50 dark:bg-zinc-700 dark:border-transparent border-pink-300 text-pink-600 h-9 w-9 flex items-center justify-center rounded-full border ltr:mr-3 rtl:ml-3 text-xl shrink-0">
                        <i class="ph-duotone ph-images-square"></i>
                    </div>
                    
                    
                    <span class="w-full ltr:text-left rtl:text-right font-medium tracking-wide truncate whitespace-nowrap overflow-hidden text-xs+">
                        <?php echo app('translator')->get('messages.t_total_gigs'); ?>
                    </span>
    
                    
                    <div class="font-bold text-black dark:text-white tracking-wider text-sm">
                        <?php echo e(number_format($total_gigs), false); ?>

                    </div>
    
                </div>
            </li>

            
            <li class="col-span-1">
                <div class="bg-white dark:bg-zinc-800 border border-slate-200 dark:border-transparent rounded-lg text-slate-500 dark:text-zinc-300 inline-flex items-center justify-center px-4 py-3 w-full">

                    
                    <div class="bg-green-50 dark:bg-zinc-700 dark:border-transparent border-green-300 text-green-600 h-9 w-9 flex items-center justify-center rounded-full border ltr:mr-3 rtl:ml-3 text-xl shrink-0">
                        <i class="ph-duotone ph-users"></i>
                    </div>
                    
                    
                    <span class="w-full ltr:text-left rtl:text-right font-medium tracking-wide truncate whitespace-nowrap overflow-hidden text-xs+">
                        <?php echo app('translator')->get('messages.t_total_users'); ?>
                    </span>
    
                    
                    <div class="font-bold text-black dark:text-white tracking-wider text-sm">
                        <?php echo e(number_format($total_users), false); ?>

                    </div>
    
                </div>
            </li>

            
            <li class="col-span-1">
                <div class="bg-white dark:bg-zinc-800 border border-slate-200 dark:border-transparent rounded-lg text-slate-500 dark:text-zinc-300 inline-flex items-center justify-center px-4 py-3 w-full">

                    
                    <div class="bg-blue-50 dark:bg-zinc-700 dark:border-transparent border-blue-300 text-blue-600 h-9 w-9 flex items-center justify-center rounded-full border ltr:mr-3 rtl:ml-3 text-xl shrink-0">
                        <i class="ph-duotone ph-envelope"></i>
                    </div>
                    
                    
                    <span class="w-full ltr:text-left rtl:text-right font-medium tracking-wide truncate whitespace-nowrap overflow-hidden text-xs+">
                        <?php echo app('translator')->get('messages.t_total_messages'); ?>
                    </span>
    
                    
                    <div class="font-bold text-black dark:text-white tracking-wider text-sm">
                        <?php echo e(number_format($total_messages), false); ?>

                    </div>
    
                </div>
            </li>

            
            <li class="col-span-1">
                <div class="bg-white dark:bg-zinc-800 border border-slate-200 dark:border-transparent rounded-lg text-slate-500 dark:text-zinc-300 inline-flex items-center justify-center px-4 py-3 w-full">

                    
                    <div class="bg-amber-50 dark:bg-zinc-700 dark:border-transparent border-amber-300 text-amber-600 h-9 w-9 flex items-center justify-center rounded-full border ltr:mr-3 rtl:ml-3 text-xl shrink-0">
                        <i class="ph-duotone ph-shopping-cart-simple"></i>
                    </div>
                    
                    
                    <span class="w-full ltr:text-left rtl:text-right font-medium tracking-wide truncate whitespace-nowrap overflow-hidden text-xs+">
                        <?php echo app('translator')->get('dashboard.t_total_orders'); ?>
                    </span>
    
                    
                    <div class="font-bold text-black dark:text-white tracking-wider text-sm">
                        <?php echo e(number_format($total_sales), false); ?>

                    </div>
    
                </div>
            </li>
            
        </ul>

    </div>

    
    <div class="grid grid-cols-12 md:gap-6 gap-y-6 mb-12">

        
        <div class="col-span-12 md:col-span-6 bg-white shadow-sm border rounded-xl p-5 dark:bg-zinc-800 dark:shadow-none dark:border-transparent">

            
            <h2 class="text-[15px] font-bold text-black dark:text-white mb-10">
                <?php echo app('translator')->get('dashboard.t_recent_users'); ?>
            </h2>

            
            <div class="w-full">
                <div class="flow-root">
                    <ul role="list" class="-mb-9">
                        <?php $__currentLoopData = $recent_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li wire:key="recent-users-<?php echo e($recent_user->id, false); ?>">
                                <div class="relative pb-9">

                                    
                                    <?php if(!$loop->last): ?>
                                        <span class="absolute top-4 ltr:left-4 rtl:right-4 ltr:ml-0.5 rtl:mr-0.5 h-full w-0.5 bg-gray-200 dark:bg-zinc-700" aria-hidden="true"></span>
                                    <?php endif; ?>

                                    
                                    <div class="relative flex space-x-3 rtl:space-x-reverse">

                                        
                                        <div>
                                            <?php if($recent_user->avatar): ?>
                                                <img src="<?php echo e(src($recent_user->avatar), false); ?>" alt="<?php echo e($recent_user->username, false); ?>" class="h-10 w-10 rounded-full object-cover ring-8 ring-white dark:ring-zinc-800 bg-gray-200 dark:bg-zinc-800">
                                            <?php else: ?>
                                                <span class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center ring-8 ring-white dark:ring-zinc-800 uppercase text-xs tracking-widest text-gray-500 font-semibold text-center dark:bg-zinc-800 dark:text-zinc-200">
                                                    <span><?php echo e(Str::substr($recent_user->username, 0, 2), false); ?></span>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        
                                        <div class="flex min-w-0 flex-1 justify-between items-center space-x-4 rtl:space-x-reverse">
                                            <div>

                                                
                                                <span class="font-semibold text-gray-900 dark:text-zinc-300 text-xs+ block pb-px">
                                                    <?php echo e($recent_user->username, false); ?>

                                                </span>

                                                
                                                <span class="block text-xs font-normal text-gray-400 dark:text-zinc-400">
                                                    <?php echo e(format_date($recent_user->created_at), false); ?>

                                                </span>

                                            </div>

                                            
                                            <?php if($recent_user->status === 'pending'): ?>
                                                <div class="whitespace-nowrap flex items-center text-xs font-semibold text-orange-500 dark:text-orange-400 lowercase ltr:text-right rtl:text-left">
                                                    <i class="ph-duotone ph-dot text-2xl mt-px"></i>
                                                    <span><?php echo app('translator')->get('messages.t_pending'); ?></span>
                                                </div>
                                            <?php else: ?>
                                                <div class="whitespace-nowrap flex items-center text-xs font-semibold text-green-500 dark:text-green-400 lowercase ltr:text-right rtl:text-left">
                                                    <i class="ph-duotone ph-dot text-2xl mt-px"></i>
                                                    <span><?php echo app('translator')->get('messages.t_active'); ?></span>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    
        
        <div class="col-span-12 md:col-span-6 bg-white shadow-sm border rounded-xl p-5 dark:bg-zinc-800 dark:shadow-none dark:border-transparent">

            
            <h2 class="text-[15px] font-bold text-black dark:text-white mb-10">
                <?php echo app('translator')->get('dashboard.t_recent_gigs'); ?>
            </h2>

            
            <div class="w-full">
                <div class="flow-root">
                    <ul role="list" class="-mb-9">
                        <?php $__currentLoopData = $recent_gigs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent_gig): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li wire:key="recent-gigs-<?php echo e($recent_gig->id, false); ?>">
                                <div class="relative pb-9">

                                    
                                    <?php if(!$loop->last): ?>
                                        <span class="absolute top-4 ltr:left-4 rtl:right-4 ltr:ml-0.5 rtl:mr-0.5 h-full w-0.5 bg-gray-200 dark:bg-zinc-700" aria-hidden="true"></span>
                                    <?php endif; ?>

                                    
                                    <div class="relative flex space-x-3 rtl:space-x-reverse">

                                        
                                        <div>
                                            <?php if($recent_gig->thumbnail): ?>
                                                <img src="<?php echo e(src($recent_gig->thumbnail), false); ?>" alt="<?php echo e($recent_gig->title, false); ?>" class="h-10 w-10 rounded-full object-cover ring-8 ring-white dark:ring-zinc-800 bg-gray-200 dark:bg-zinc-800">
                                            <?php else: ?>
                                                <span class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center ring-8 ring-white dark:ring-zinc-800 uppercase text-xs tracking-widest text-gray-500 font-semibold text-center dark:bg-zinc-800 dark:text-zinc-200">
                                                    <span><?php echo e(Str::substr($recent_gig->title, 0, 2), false); ?></span>
                                                </span>
                                            <?php endif; ?>
                                        </div>

                                        
                                        <div class="flex min-w-0 flex-1 justify-between items-center space-x-4 rtl:space-x-reverse">
                                            <div>

                                                
                                                <span class="font-semibold text-gray-900 dark:text-zinc-300 text-xs+ block pb-px">
                                                    <?php echo e($recent_gig->title, false); ?>

                                                </span>

                                                
                                                <span class="block text-xs font-normal text-gray-400 dark:text-zinc-400">
                                                    <?php echo e(format_date($recent_gig->created_at), false); ?>

                                                </span>

                                            </div>

                                            
                                            <?php switch($recent_gig->status):

                                                
                                                case ('pending'): ?>
                                                    <div class="whitespace-nowrap flex items-center text-xs font-semibold text-orange-500 dark:text-orange-400 lowercase ltr:text-right rtl:text-left">
                                                        <i class="ph-duotone ph-dot text-2xl mt-px"></i>
                                                        <span><?php echo app('translator')->get('messages.t_pending'); ?></span>
                                                    </div>
                                                <?php break; ?>

                                                
                                                <?php case ('active'): ?>
                                                    <div class="whitespace-nowrap flex items-center text-xs font-semibold text-green-500 dark:text-green-400 lowercase ltr:text-right rtl:text-left">
                                                        <i class="ph-duotone ph-dot text-2xl mt-px"></i>
                                                        <span><?php echo app('translator')->get('messages.t_active'); ?></span>
                                                    </div>
                                                <?php break; ?>

                                                
                                                <?php case ('deleted'): ?>
                                                    <div class="whitespace-nowrap flex items-center text-xs font-semibold text-red-500 dark:text-red-400 lowercase ltr:text-right rtl:text-left">
                                                        <i class="ph-duotone ph-dot text-2xl mt-px"></i>
                                                        <span><?php echo app('translator')->get('messages.t_deleted'); ?></span>
                                                    </div>
                                                <?php break; ?>
                                                    
                                            <?php endswitch; ?>

                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    
    <div class="grid grid-cols-12 md:gap-6 gap-y-6 mb-12">

        
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white shadow-sm border rounded-xl p-5 dark:bg-zinc-800 dark:shadow-none dark:border-transparent">
                
                
                <h2 class="text-[15px] font-bold text-black dark:text-white mb-10">
                    <?php echo app('translator')->get('dashboard.t_visitors_map'); ?>
                </h2>

                
                <div class="w-full min-h-[25rem] grid">
                    <div id="world-map-visitors" class="w-full h-full"></div>
                </div>

            </div>
        </div>

        
        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white shadow-sm border rounded-xl p-5 dark:bg-zinc-800 dark:shadow-none dark:border-transparent">
                
                
                <h2 class="text-[15px] font-bold text-black dark:text-white mb-10">
                    <?php echo app('translator')->get('dashboard.t_top_referrers'); ?>
                </h2>

                
                <div class="w-full">
                    <div class="flow-root">
                        <ul role="list" class="-my-5 divide-y divide-gray-100 dark:divide-zinc-700">
                            <?php $__currentLoopData = $tracker_referers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tracker_referer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="py-4" wire:key="tracker-referers-<?php echo e($tracker_referer->id, false); ?>">
                                    <div class="flex items-center space-x-4 rtl:space-x-reverse">

                                        
                                        <div class="flex-shrink-0">
                                            <img class="h-5 w-5" src="https://t0.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url=https://<?php echo e($tracker_referer->domain?->name, false); ?>&size=50" alt="<?php echo e($tracker_referer->domain?->name, false); ?>">
                                        </div>

                                        
                                        <div class="min-w-0 flex-1">
                                            <a href="https://<?php echo e($tracker_referer->domain?->name, false); ?>" target="_blank" class="truncate text-sm font-semibold text-gray-700 hover:text-primary-600 dark:text-zinc-300 dark:hover:text-primary-600">
                                                <?php echo e($tracker_referer->domain?->name, false); ?>

                                            </a>
                                        </div>

                                        
                                        <div class="font-normal text-xs+ text-gray-500 dark:text-zinc-400">
                                            <?php echo e(number_format($tracker_referer->count), false); ?>

                                        </div>

                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        
        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white shadow-sm border rounded-xl p-5 dark:bg-zinc-800 dark:shadow-none dark:border-transparent">
                
                
                <h2 class="text-[15px] font-bold text-black dark:text-white mb-10">
                    <?php echo app('translator')->get('dashboard.t_browsers'); ?>
                </h2>

                
                <div class="w-full">
                    <div id="tracker-browsers" class="w-full"></div>
                </div>

            </div>
        </div>

        
        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white shadow-sm border rounded-xl p-5 dark:bg-zinc-800 dark:shadow-none dark:border-transparent">
                
                
                <h2 class="text-[15px] font-bold text-black dark:text-white mb-10">
                    <?php echo app('translator')->get('dashboard.t_platforms'); ?>
                </h2>

                
                <div class="w-full">
                    <div id="tracker-platforms" class="w-full"></div>
                </div>

            </div>
        </div>

        
        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white shadow-sm border rounded-xl p-5 dark:bg-zinc-800 dark:shadow-none dark:border-transparent">
                
                
                <h2 class="text-[15px] font-bold text-black dark:text-white mb-10">
                    <?php echo app('translator')->get('dashboard.t_devices'); ?>
                </h2>

                
                <div class="w-full">
                    <div id="tracker-devices" class="w-full"></div>
                </div>

            </div>
        </div>

    </div>

</div>


<?php $__env->startPush('styles'); ?>
    
    
    <link rel="stylesheet" href="<?php echo e(asset('js/plugins/jvectormap/jquery-jvectormap-2.0.5.css'), false); ?>" />

    
    <link rel="stylesheet" href="<?php echo e(asset('js/plugins/apexcharts/apexcharts.css'), false); ?>">

    
    <style>
        .jvectormap-tip {
            z-index: 11 !important;
        }
    </style>

<?php $__env->stopPush(); ?>


<?php $__env->startPush('scripts'); ?>

    
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="<?php echo e(asset('js/plugins/jvectormap/jquery-jvectormap-2.0.5.min.js'), false); ?>"></script>
    <script src="<?php echo e(asset('js/plugins/jvectormap/jquery-jvectormap-world-mill.js'), false); ?>"></script>
    <script>
        $(function() {

            // Get data
            var data   = <?php echo json_encode($tracker_map, 15, 512) ?>;

            // empty array
            var visits = [];

            // Loop through data
            data.forEach((element, index) => {

                const el = {
                    [element.country_code]: element.count
                };

                visits.push(el)
            });

            // Set results
            var result = visits.reduce((a, c) => {
                let [
                    [k, v]
                ] = Object.entries(c);
                a[k] = v;
                return a;
            }, {});

            // Initialize map
            $('#world-map-visitors').vectorMap({
                map: 'world_mill',
                backgroundColor: 'transparent',
                regionStyle: {
                    initial: {
                        fill            : '#94a3b8',
                        "fill-opacity"  : 1,
                        stroke          : 'none',
                        "stroke-width"  : 0,
                        "stroke-opacity": 1
                    },
                    hover: {
                        "fill-opacity": 0.8,
                        cursor        : 'pointer'
                    },
                    selected: {
                        fill: '#94a3b8'
                    },
                    selectedHover: {}
                },
                series: {
                    regions: [{
                        values           : result,
                        scale            : ['#334155', '#0f172a'],
                        normalizeFunction: 'polynomial'
                    }]
                },
                onRegionTipShow: function(e, el, code) {
                    if (result[code]) {
                        el.html(el.html() + ' ( ' + result[
                            code] + ' )');
                    }
                }
            });

        });
    </script>

    
    <script src="<?php echo e(asset('js/plugins/apexcharts/apexcharts.min.js'), false); ?>"></script>

    
    <script>

        // Set data
        var data       = <?php echo json_encode($tracker_browsers, 15, 512) ?>;
        var series     = [];
        var categories = [];

        // Loop through data
        data.forEach(element => {
            series.push(Number(element.count))
            categories.push(element.browser)
        });

        // Set chart options
        var options = {
            series: [{ data: series }],
            chart: {
                height    : 350,
                type      : 'bar',
                fontFamily: "<?php echo settings('appearance')->font_family ?>" + ', sans-serif',
                fontWeight: 'bold',
            },
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                }
            },
            dataLabels: { enabled: false },
            legend: { show: false },
            xaxis: {
                categories: categories,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            grid: {
                show: false,
            },
            tooltip: {
                custom: function({series, seriesIndex, dataPointIndex, w}) {
                    return '<div class="bg-black px-3 py-1 text-white font-semibold bg-opacity-80 tracking-wider">' + series[seriesIndex][dataPointIndex] + '</div>'
                }
            }
        };

        // Render chart
        var chart = new ApexCharts(document.querySelector("#tracker-browsers"), options);
        chart.render();

    </script>

    
    <script>

        // Set data
        var data       = <?php echo json_encode($tracker_platforms, 15, 512) ?>;
        var series     = [];
        var categories = [];

        // Loop through data
        data.forEach(element => {
            series.push(Number(element.count))
            categories.push(element.platform)
        });

        // Set chart options
        var options = {
            series: [{ data: series }],
            colors : ['#b84644', '#C4E538', '#1B1464', '#EE5A24', '#4576b5'],
            chart: {
                height    : 350,
                type      : 'bar',
                fontFamily: "<?php echo settings('appearance')->font_family ?>" + ', sans-serif',
                fontWeight: 'bold',
            },
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                }
            },
            dataLabels: { enabled: false },
            legend: { show: false },
            xaxis: {
                categories: categories,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            grid: {
                show: false,
            },
            tooltip: {
                custom: function({series, seriesIndex, dataPointIndex, w}) {
                    return '<div class="bg-black px-3 py-1 text-white font-semibold bg-opacity-80 tracking-wider">' + series[seriesIndex][dataPointIndex] + '</div>'
                }
            }
        };

        // Render chart
        var chart = new ApexCharts(document.querySelector("#tracker-platforms"), options);
        chart.render();

    </script>

    
    <script>

        // Set data
        var data       = <?php echo json_encode($tracker_devices, 15, 512) ?>;
        var series     = [];
        var categories = [];

        // Loop through data
        data.forEach(element => {
            series.push(Number(element.count))
            categories.push(element.kind)
        });

        // Set chart options
        var options = {
            series: [{ data: series }],
            colors : ['#FC427B', '#18dcff', '#EAB543', '#EE5A24', '#4576b5'],
            chart: {
                height    : 350,
                type      : 'bar',
                fontFamily: "<?php echo settings('appearance')->font_family ?>" + ', sans-serif',
                fontWeight: 'bold',
            },
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    distributed: true,
                }
            },
            dataLabels: { enabled: false },
            legend: { show: false },
            xaxis: {
                categories: categories,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            grid: {
                show: false,
            },
            tooltip: {
                custom: function({series, seriesIndex, dataPointIndex, w}) {
                    return '<div class="bg-black px-3 py-1 text-white font-semibold bg-opacity-80 tracking-wider">' + series[seriesIndex][dataPointIndex] + '</div>'
                }
            }
        };

        // Render chart
        var chart = new ApexCharts(document.querySelector("#tracker-devices"), options);
        chart.render();

    </script>
    
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/admin/home/home.blade.php ENDPATH**/ ?>