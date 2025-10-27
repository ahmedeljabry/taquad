<div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 mt-[7rem] py-12 lg:pt-16 lg:pb-24">

    
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

    
    <div class="w-full mb-16">
        <div class="lg:flex lg:items-center lg:justify-between">

            <div class="min-w-0 flex-1">

                
                <h2 class="text-lg font-bold leading-7 text-zinc-700 dark:text-gray-50 sm:truncate sm:text-xl sm:tracking-tight">
                    <?php echo app('translator')->get('messages.t_deposit_history'); ?>
                </h2>

                
                <div class="mt-3 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6 rtl:space-x-reverse">
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
                                <svg aria-hidden="true" class="w-4 h-4 text-gray-400 rtl:rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="mx-1 text-sm font-medium text-gray-400 md:mx-2 dark:text-zinc-400">
                                    <?php echo app('translator')->get('messages.t_deposit'); ?>
                                </span>
                            </div>
                        </li>

                    </ol>
                </div>

            </div>

            
            <div class="mt-5 flex justify-between lg:mt-0 lg:ltr::ml-4 lg:rtl:mr-4">

                
                <span class="">
                    <a href="<?php echo e(url('account/deposit'), false); ?>" class="inline-flex items-center rounded border border-transparent bg-primary-600 px-4 py-3 text-xs font-medium uppercase text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-opacity-25 focus:ring-primary-500 tracking-widest">
                        <?php echo app('translator')->get('messages.t_deposit'); ?>
                    </a>
                </span>

            </div>

        </div>
    </div>

    
    <!--[if BLOCK]><![endif]--><?php if(session()->has('success')): ?>
        <div class="p-4 relative flex bg-emerald-50 dark:bg-emerald-500 text-emerald-500 dark:text-emerald-50 text-xs font-semibold rounded-lg mb-6">
            <div class="flex items-center">
                <span class="text-2xl text-emerald-400 dark:text-emerald-50">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </span>
                <div class="ltr:ml-2 rtl:mr-2"><?php echo e(session()->get('success'), false); ?></div>
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    
    <?php if(session()->has('error')): ?>
        <div class="p-4 relative flex bg-red-50 dark:bg-red-500 text-red-500 dark:text-red-50 text-xs font-semibold rounded-lg mb-6">
            <div class="flex items-center">
                <span class="text-2xl text-red-400 dark:text-red-50">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                </span>
                <div class="ltr:ml-2 rtl:mr-2"><?php echo e(session()->get('error'), false); ?></div>
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    
    <?php if(session()->has('warning')): ?>
        <div class="p-4 relative flex bg-amber-50 dark:bg-amber-500 text-amber-500 dark:text-amber-50 text-xs font-semibold rounded-lg mb-6">
            <div class="flex items-center">
                <span class="text-2xl text-amber-400 dark:text-amber-50">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                </span>
                <div class="ltr:ml-2 rtl:mr-2"><?php echo e(session()->get('warning'), false); ?></div>
            </div>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    
    <div class="w-full">
        <div class="mt-8 overflow-x-auto overflow-y-hidden sm:mt-0 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 dark:scrollbar-thumb-zinc-800 dark:scrollbar-track-zinc-600">
            <table class="w-full text-left border-spacing-y-[10px] border-separate -mt-2">
                <thead class="">
                    <tr class="bg-slate-200 dark:bg-zinc-600">

                        
                        <th class="font-bold tracking-wider text-gray-600 px-5 py-4.5 text-center border-b-0 whitespace-nowrap text-xs uppercase dark:text-zinc-300 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md"><?php echo app('translator')->get('messages.t_date'); ?></th>

                        
                        <th class="font-bold tracking-wider text-gray-600 px-5 py-4.5 border-b-0 whitespace-nowrap text-xs uppercase dark:text-zinc-300 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md rtl:text-right"><?php echo app('translator')->get('messages.t_payment_method'); ?></th>

                        
                        <th class="font-bold tracking-wider text-gray-600 px-5 py-4.5 text-center border-b-0 whitespace-nowrap text-xs uppercase dark:text-zinc-300 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md"><?php echo app('translator')->get('messages.t_amount'); ?></th>

                        
                        <th class="font-bold tracking-wider text-gray-600 px-5 py-4.5 text-center border-b-0 whitespace-nowrap text-xs uppercase dark:text-zinc-300 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md"><?php echo app('translator')->get('messages.t_status'); ?></th>

                    </tr>
                </thead>
                <thead>
                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="intro-x shadow-sm bg-white dark:bg-zinc-800 rounded-md h-16" wire:key="deposit-history-transactions-<?php echo e($t->uid, false); ?>">

                            
                            <td class="px-5 py-3 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md text-center">

                                
                                <?php
                                    \Carbon\Carbon::setLocale(config()->get('backend_timing_locale'));
                                    $formatted_date = \Carbon\Carbon::create($t->created_at);
                                ?>

                                <div class="grid items-center text-center justify-center" data-tooltip-target="tooltip-year-date-<?php echo e($t->id, false); ?>">
                                    <span class="text-base font-medium text-gray-500 dark:text-gray-200 mb-2">
                                        <?php echo e($formatted_date->translatedFormat('d'), false); ?>

                                    </span>
                                    <span class="text-[10px] text-gray-400 dark:text-gray-300 uppercase tracking-widest">
                                        <?php echo e($formatted_date->translatedFormat('F'), false); ?>

                                    </span>
                                </div>

                                <div id="tooltip-year-date-<?php echo e($t->id, false); ?>" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-xs font-semibold text-white bg-gray-900 rounded-md shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    <?php echo e($formatted_date->translatedFormat('Y'), false); ?>

                                </div>

                            </td>

                            
                            <td class="px-5 py-3 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md w-96 rtl:text-right">
                                <div class="flex items-center">
                                    <div class="space-y-1 font-medium dark:text-white">

                                        
                                        <div class="flex items-center">
                                            <div class="font-bold whitespace-nowrap truncate block max-w-[240px] hover:text-zinc-900 dark:text-white text-sm text-zinc-700">

                                                
                                                <!--[if BLOCK]><![endif]--><?php if($t->payment_method === "offline"): ?>

                                                    
                                                    <!--[if BLOCK]><![endif]--><?php if( !empty(payment_gateway($t->payment_method, false, true)->name) ): ?>

                                                        
                                                        <?php echo e(payment_gateway($t->payment_method, false, true)?->name, false); ?>


                                                    <?php else: ?>

                                                        
                                                        -

                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                                <?php elseif( !empty(payment_gateway($t->payment_method)->name) ): ?>

                                                    
                                                    <?php echo e(payment_gateway($t->payment_method)?->name, false); ?>


                                                <?php else: ?>

                                                    -

                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                            </div>
                                        </div>

                                        
                                        <div class="flex items-center space-x-3 rtl:space-x-reverse text-xs font-normal text-gray-400 dark:text-zinc-300">
                                            <?php echo e($t->transaction_id, false); ?>

                                        </div>

                                    </div>
                                </div>

                            </td>

                            
                            <td class="px-5 py-3 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md text-center">
                                <span class="text-black dark:text-white font-semibold text-sm whitespace-nowrap">
                                    <?php echo e(money($t->amount_net, settings('currency')->code, true), false); ?>

                                </span>
                            </td>

                            
                            <td class="px-5 py-3 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md text-center">
                                <!--[if BLOCK]><![endif]--><?php switch($t->status):

                                    
                                    case ('paid'): ?>
                                        <span class="bg-emerald-100 text-emerald-700 px-4 py-2 inline-block rounded-3xl font-medium text-xs whitespace-nowrap">
                                            <?php echo app('translator')->get('messages.t_paid'); ?>
                                        </span>
                                    <?php break; ?>

                                    
                                    <?php case ('pending'): ?>
                                        <span class="bg-amber-100 text-amber-700 px-4 py-2 inline-block rounded-3xl font-medium text-xs whitespace-nowrap">
                                            <?php echo app('translator')->get('messages.t_pending'); ?>
                                        </span>
                                    <?php break; ?>

                                    
                                    <?php case ('rejected'): ?>
                                        <span class="bg-red-100 text-red-600 px-4 py-2 inline-block rounded-3xl font-medium text-xs whitespace-nowrap">
                                            <?php echo app('translator')->get('messages.t_rejected'); ?>
                                        </span>
                                    <?php break; ?>

                                <?php endswitch; ?><!--[if ENDBLOCK]><![endif]-->
                            </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="py-4.5 font-light text-sm text-gray-400 dark:text-zinc-200 text-center tracking-wide shadow-sm bg-white dark:bg-zinc-800 rounded-md">
                                <?php echo app('translator')->get('messages.t_no_results_found'); ?>
                            </td>
                        </tr>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </thead>
            </table>
        </div>
    </div>

    
    <!--[if BLOCK]><![endif]--><?php if($transactions->hasPages()): ?>
        <div class="flex justify-center pt-12">
            <?php echo $transactions->links('pagination::tailwind'); ?>

        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

</div>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/account/deposit/history.blade.php ENDPATH**/ ?>