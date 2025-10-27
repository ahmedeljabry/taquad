<div class="max-w-[1400px] mx-auto">

    
    <nav class="hidden justify-between px-4 py-3 text-gray-700 rounded-lg sm:flex sm:px-5 bg-white dark:bg-zinc-700/40 dark:border-zinc-700 shadow"
        aria-label="Breadcrumb" style="margin-top: 150px;">

        
        <ol class="inline-flex items-center mb-3 space-x-1 md:space-x-3 rtl:space-x-reverse sm:mb-0">

            
            <li>
                <div class="flex items-center">
                    <a href="<?php echo e(url('/'), false); ?>"
                        class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-700 hover:text-primary-600 ltr:md:ml-2 rtl:md:mr-2 dark:text-zinc-300 dark:hover:text-white">
                        <?php echo app('translator')->get('messages.t_home'); ?>
                    </a>
                </div>
            </li>

            
            <li aria-current="page">
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-400 rtl:rotate-180" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <a href="<?php echo e(url('explore/projects'), false); ?>"
                        class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-700 hover:text-primary-600 ltr:md:ml-2 rtl:md:mr-2 dark:text-zinc-300 dark:hover:text-white">
                        <?php echo app('translator')->get('messages.t_projects'); ?>
                    </a>

                </div>
            </li>

            
            <li aria-current="page">
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-400 rtl:rotate-180" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span
                        class="mx-1 text-sm font-medium text-gray-500 md:mx-2 dark:text-zinc-500 truncate max-w-[18rem]">
                        <?php echo e($project->title, false); ?>

                    </span>
                </div>
            </li>

        </ol>

        
        <div class="relative">
            <button x-on:click="is_actions_menu = !is_actions_menu"
                class="inline-flex items-center px-3 py-2 text-sm font-normal text-center text-gray-600 bg-gray-200 rounded hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-zinc-700 dark:hover:bg-zinc-600 dark:text-zinc-300 dark:focus:ring-zinc-700">
                <svg class="w-4 h-4 ltr:mr-2 rtl:ml-2" stroke="currentColor" fill="currentColor" stroke-width="0"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                    </path>
                </svg>
                <?php echo app('translator')->get('messages.t_actions'); ?>
                <svg class="w-4 h-4 ltr:ml-1 rtl:mr-1" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <div x-show="is_actions_menu" x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="transform opacity-0 scale-75"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-75" x-on:click.outside="is_actions_menu = false"
                role="menu" aria-labelledby="tk-dropdown-simple"
                class="absolute ltr:right-0 rtl:left-0 ltr:origin-top-right rtl:origin-top-left mt-2 w-48 shadow-xl rounded z-1"
                style="display: none">
                <div
                    class="bg-white dark:bg-zinc-900 ring-1 ring-black ring-opacity-5 rounded divide-y divide-gray-100">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="project-page-actions-default">

                        
                        <!--[if BLOCK]><![endif]--><?php if(auth()->guard()->check()): ?>
                            <!--[if BLOCK]><![endif]--><?php if(auth()->id() != $project->user_id): ?>
                                <li>
                                    <button type="button" id="modal-report-project-button"
                                        class="w-full flex items-center space-x-3 rtl:space-x-reverse px-4 py-2 hover:bg-gray-100 dark:hover:bg-zinc-600 dark:hover:text-white focus:outline-none focus:ring-transparent">
                                        <svg class="w-5 h-5 text-gray-500 dark:text-zinc-300" stroke="currentColor"
                                            fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span><?php echo app('translator')->get('messages.t_report_project'); ?></span>
                                    </button>
                                </li>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        
                        <li>
                            <button type="button" id="modal-share-project-button"
                                class="w-full flex items-center space-x-3 rtl:space-x-reverse px-4 py-2 hover:bg-gray-100 dark:hover:bg-zinc-600 dark:hover:text-white focus:outline-none focus:ring-transparent">
                                <svg class="w-5 h-5 text-gray-500 dark:text-zinc-300" stroke="currentColor"
                                    fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z">
                                    </path>
                                </svg>
                                <span><?php echo app('translator')->get('messages.t_share_project'); ?></span>
                            </button>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

    </nav>

    <?php
        $projectBudget = $project->budget_min === $project->budget_max
            ? money($project->budget_min, settings('currency')->code, true)
            : money($project->budget_min, settings('currency')->code, true) . " - " . money($project->budget_max, settings('currency')->code, true);
        $projectBidsCount = $project->bids_count ?? $project->bids()->whereStatus('active')->count();
        $projectAvgBid = $avg_bid ? money($avg_bid, settings('currency')->code, true) : __('messages.t_na');
        $projectCategory = optional($project->category)->name;
        $statusStyles = [
            'active' => ['label' => __('messages.t_active'), 'class' => 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-200'],
            'pending_approval' => ['label' => __('messages.t_pending_approval'), 'class' => 'bg-amber-500/15 text-amber-600 dark:text-amber-200'],
            'pending_payment' => ['label' => __('messages.t_pending_payment'), 'class' => 'bg-amber-500/15 text-amber-600 dark:text-amber-200'],
            'under_development' => ['label' => __('messages.t_under_development'), 'class' => 'bg-blue-500/15 text-blue-600 dark:text-blue-200'],
            'pending_final_review' => ['label' => __('messages.t_pending_final_review'), 'class' => 'bg-fuchsia-500/15 text-fuchsia-600 dark:text-fuchsia-200'],
            'completed' => ['label' => __('messages.t_completed'), 'class' => 'bg-emerald-500/15 text-emerald-600 dark:text-emerald-200'],
            'closed' => ['label' => __('messages.t_closed'), 'class' => 'bg-rose-500/15 text-rose-600 dark:text-rose-200'],
            'rejected' => ['label' => __('messages.t_rejected'), 'class' => 'bg-red-500/15 text-red-600 dark:text-red-200'],
            'hidden' => ['label' => __('messages.t_hidden'), 'class' => 'bg-slate-500/15 text-slate-700 dark:text-slate-200'],
            'incomplete' => ['label' => __('messages.t_incomplete'), 'class' => 'bg-stone-500/15 text-stone-600 dark:text-stone-200'],
        ];
        $projectStatusLabel = $statusStyles[$project->status]['label'] ?? __('messages.t_' . $project->status);
        $projectStatusClass = $statusStyles[$project->status]['class'] ?? 'bg-slate-500/15 text-slate-700 dark:text-slate-200';
    ?>

    <div class="py-0">
        <div class="gap-6 grid grid-cols-1 lg:grid-cols-3 lg:grid-flow-col-dense sm:mt-8">

            
            <div class="space-y-10 lg:col-start-1 lg:col-span-2">
                <!--[if BLOCK]><![endif]--><?php if($bestBids->isNotEmpty() && $bestBids->count() > 2  && auth()->user()?->id === $project->user_id): ?>
                    <section class="rounded-3xl border border-slate-200 bg-white/95 p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <h2 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">أفضل عرضين موصى بهما
                                </h2>
                                <p class="mt-1 text-sm text-slate-500 dark:text-zinc-400">يعتمد الاختيار على التقييم،
                                    التكلفة، وسرعة التنفيذ.</p>
                            </div>
                            <span
                                class="inline-flex items-center gap-2 rounded-full bg-primary-100 px-3 py-1 text-[11px] font-semibold text-primary-600 dark:bg-primary-500/15 dark:text-primary-200">
                                <i class="ph ph-sparkle text-xs"></i>
                                AI Insight
                            </span>
                        </div>
                        <div class="mt-5 space-y-4">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $bestBids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recommendation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $bid = $recommendation['bid'];
                                    $freelancer = $bid->user;
                                    $score = isset($recommendation['score']) ? (int) round($recommendation['score'] * 100) : null;
                                    $rating = $recommendation['rating'] ?? ($freelancer?->rating() ?? 0);
                                ?>
                                <article
                                    class="flex flex-wrap items-start justify-between gap-4 rounded-2xl border border-slate-200 bg-slate-50/70 px-4 py-4 dark:border-zinc-700 dark:bg-zinc-800/70">
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-primary-500/15 text-primary-600 dark:bg-primary-500/20 dark:text-primary-200">
                                            <i class="ph ph-user-focus text-lg"></i>
                                        </div>
                                        <div class="space-y-2">
                                            <div class="flex items-center gap-2">
                                                <p class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                                                    <?php echo e($freelancer?->fullname ?: $freelancer?->username, false); ?>

                                                </p>
                                                <!--[if BLOCK]><![endif]--><?php if($score): ?>
                                                    <span
                                                        class="inline-flex items-center gap-1 rounded-full bg-emerald-500/10 px-2 py-0.5 text-[11px] font-semibold text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-100">
                                                        <i class="ph ph-trend-up"></i>
                                                        <?php echo e($score, false); ?>%
                                                    </span>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                            <div
                                                class="flex flex-wrap gap-3 text-[12px] font-semibold text-slate-500 dark:text-zinc-300">
                                                <span class="inline-flex items-center gap-1">
                                                    <i class="ph ph-coins text-xs"></i>
                                                    <?php echo e(money($bid->amount, settings('currency')->code, true), false); ?>

                                                </span>
                                                <span class="inline-flex items-center gap-1">
                                                    <i class="ph ph-clock text-xs"></i>
                                                    <?php echo e($bid->days, false); ?> يوم/أيام
                                                </span>
                                                <span class="inline-flex items-center gap-1">
                                                    <i class="ph ph-star text-xs text-amber-500"></i>
                                                    <?php echo e(number_format($rating, 1), false); ?>/5
                                                </span>
                                                <span class="inline-flex items-center gap-1 text-slate-400 dark:text-zinc-500">
                                                    <i class="ph ph-calendar-check text-xs"></i>
                                                    <?php echo e(format_date($bid->created_at, 'ago'), false); ?>

                                                </span>
                                            </div>
                                            <!--[if BLOCK]><![endif]--><?php if($bid->message): ?>
                                                <p class="text-[12.5px] leading-6 text-slate-600 dark:text-zinc-300">
                                                    <?php echo e(\Illuminate\Support\Str::limit(strip_tags($bid->message), 200), false); ?>

                                                </p>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end gap-2">
                                        <a href="#bid-<?php echo e($recommendation['bid']->uid, false); ?>"
                                            class="inline-flex items-center gap-1 text-[12px] font-semibold text-primary-600 hover:text-primary-700 dark:text-primary-300 dark:hover:text-primary-100">
                                            فتح العرض
                                            <i class="ph ph-arrow-square-out text-xs"></i>
                                        </a>
                                    </div>
                                </article>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </section>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                
                <section>
                    <article
                        class="rounded-3xl border border-slate-200 bg-white/95 p-6 shadow-sm shadow-slate-900/5 dark:border-zinc-700 dark:bg-zinc-900">
                        <header class="flex flex-wrap items-start justify-between gap-4">
                            <div>
                                <p
                                    class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400 dark:text-zinc-500">
                                    <?php echo app('translator')->get('messages.t_project_details'); ?>
                                </p>
                                <h2 class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-zinc-100">
                                    <?php echo e($project->title, false); ?>

                                </h2>
                            </div>
                            <!--[if BLOCK]><![endif]--><?php if(auth()->guard()->check()): ?>
                                <?php if(auth()->id() != $project->user_id && $project->status === 'active' && !$already_submitted_proposal && auth()->user()->account_type === 'seller'): ?>
                                    <button id="modal-bid-button" type="button"
                                        class="inline-flex items-center gap-2 rounded-full bg-primary-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-400 dark:bg-primary-500 dark:hover:bg-primary-400">
                                        <i class="ph ph-paper-plane-right text-base"></i>
                                        <span><?php echo app('translator')->get('messages.t_bid_on_this_project'); ?></span>
                                    </button>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </header>

                        <div class="mt-6 space-y-10">
                            <section>
                                <h3 class="text-sm font-semibold text-zinc-800 dark:text-zinc-200">
                                    <?php echo app('translator')->get('messages.t_description'); ?>
                                </h3>
                                <div
                                    class="mt-3 text-[15px] leading-7 text-slate-600 dark:text-zinc-300 prose prose-slate max-w-none dark:prose-invert">
                                    <?php echo htmlspecialchars_decode(nl2br($project->description)); ?>

                                </div>
                            </section>



                            <section>
                                <h3 class="text-sm font-semibold text-zinc-800 dark:text-zinc-200">
                                    <?php echo app('translator')->get('messages.t_required_skills'); ?>
                                </h3>
                                <div class="mt-3 flex flex-wrap gap-2">
                                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $project->skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <!--[if BLOCK]><![endif]--><?php if($skill?->skill): ?>
                                            <a class="inline-flex items-center gap-2 rounded-full bg-primary-50 px-3 py-1 text-[12px] font-semibold text-primary-700 transition hover:-translate-y-0.5 hover:bg-primary-100 dark:bg-primary-500/10 dark:text-primary-200"
                                                href="<?php echo e(url('explore/projects/' . $project->category?->slug . '/' . $skill->skill->slug), false); ?>">
                                                <i class="ph ph-lightning text-xs"></i>
                                                <?php echo e($skill->skill->name, false); ?>

                                            </a>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <span class="text-[13px] text-slate-500 dark:text-zinc-400">لم يتم إضافة مهارات
                                            بعد.</span>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </section>

                            <!--[if BLOCK]><![endif]--><?php if($project->status === 'active'): ?>
                                <div
                                    class="rounded-2xl border border-amber-200 bg-amber-50 px-4 py-4 text-sm text-amber-700 dark:border-amber-500/40 dark:bg-amber-500/10 dark:text-amber-200">
                                    <div class="flex items-start gap-3">
                                        <i class="ph ph-warning text-xl"></i>
                                        <div>
                                            <h3 class="font-semibold"><?php echo app('translator')->get('messages.t_beware_of_scams'); ?></h3>
                                            <p class="mt-1 text-[13px] leading-6">
                                                <?php echo app('translator')->get('messages.t_beware_of_scams_details'); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </article>
                </section>

                
                <section class="relative" id="project-proposals">

                    
                    <div wire:loading wire:target="filter" wire:loading.block>
                        <div
                            class="absolute w-full h-full flex items-center justify-center bg-black bg-opacity-50 z-50 rounded-lg">
                            <div class="lds-ripple">
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                    </div>

                    
                    <!--[if BLOCK]><![endif]--><?php if($bids->count()): ?>
                        <div class="sm:flex sm:items-center sm:justify-between">

                            
                            <div class="">
                                <h2 class="text-base font-semibold text-zinc-900">
                                    <?php echo app('translator')->get('messages.t_proposals'); ?>
                                </h2>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500 font-normal">
                                    <?php echo app('translator')->get('messages.t_proposals_subtitle'); ?>
                                </p>
                            </div>

                            
                            <div class="flex items-center">

                                
                                <div x-data="{ open: false }" class="relative inline-block">

                                    
                                    <button type="button" aria-haspopup="true" x-bind:aria-expanded="open"
                                        x-on:click="open = true" aria-expanded="true"
                                        class="inline-flex justify-center items-center space-x-2 rtl:space-x-reverse rounded border font-semibold focus:outline-none px-3 py-2 leading-5 text-sm border-gray-300 bg-white text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow focus:ring focus:ring-gray-500 focus:ring-opacity-25 active:bg-white active:border-white active:shadow-none dark:bg-zinc-700 dark:border-transparent dark:text-zinc-300 dark:hover:bg-zinc-600">
                                        <svg class="inline-block w-5 h-5" stroke="currentColor" fill="currentColor"
                                            stroke-width="0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7 11h10v2H7zM4 7h16v2H4zm6 8h4v2h-4z"></path>
                                        </svg>
                                        <span><?php echo app('translator')->get('messages.t_filter'); ?></span>
                                        <svg class="inline-block w-4 h-4" stroke="currentColor" fill="currentColor"
                                            stroke-width="0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16.293 9.293 12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z">
                                            </path>
                                        </svg>
                                    </button>

                                    
                                    <div x-show="open" x-transition:enter="transition ease-out duration-150"
                                        x-transition:enter-start="transform opacity-0 scale-75"
                                        x-transition:enter-end="transform opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-100"
                                        x-transition:leave-start="transform opacity-100 scale-100"
                                        x-transition:leave-end="transform opacity-0 scale-75"
                                        x-on:click.outside="open = false" role="menu"
                                        class="absolute ltr:right-0 rtl:left-0 ltr:origin-top-right rtl:origin-top-left mt-2 w-32 shadow-xl rounded z-30"
                                        style="display: none">
                                        <div
                                            class="bg-white ring-1 ring-black ring-opacity-5 rounded divide-y divide-gray-100 dark:bg-zinc-600">
                                            <div class="p-2 space-y-1">

                                                
                                                <button wire:click="filter('newest')" role="menuitem"
                                                    class="w-full flex items-center rounded py-2 px-3 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-700 focus:outline-none dark:text-zinc-300 dark:hover:bg-zinc-500 dark:hover:text-zinc-200">
                                                    <span><?php echo app('translator')->get('messages.t_newest'); ?></span>
                                                </button>

                                                
                                                <button wire:click="filter('oldest')" role="menuitem"
                                                    class="w-full flex items-center rounded py-2 px-3 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-700 focus:outline-none dark:text-zinc-300 dark:hover:bg-zinc-500 dark:hover:text-zinc-200">
                                                    <span><?php echo app('translator')->get('messages.t_oldest'); ?></span>
                                                </button>

                                                
                                                <button wire:click="filter('fastest')" role="menuitem"
                                                    class="w-full flex items-center rounded py-2 px-3 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-700 focus:outline-none dark:text-zinc-300 dark:hover:bg-zinc-500 dark:hover:text-zinc-200">
                                                    <span><?php echo app('translator')->get('messages.t_fastest'); ?></span>
                                                </button>

                                                
                                                <button wire:click="filter('cheapest')" role="menuitem"
                                                    class="w-full flex items-center rounded py-2 px-3 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-700 focus:outline-none dark:text-zinc-300 dark:hover:bg-zinc-500 dark:hover:text-zinc-200">
                                                    <span><?php echo app('translator')->get('messages.t_cheapest'); ?></span>
                                                </button>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    
                    <!--[if BLOCK]><![endif]--><?php if($project->status === 'closed'): ?>
                        <div
                            class="bg-white shadow-sm rounded-lg px-6 sm:px-12 py-6 sm:py-12 mt-8 grid text-center items-center justify-center">
                            <div class="w-52 h-52 bg-gray-50 rounded-full flex items-center justify-center">
                                <svg class="w-40 h-40 text-zinc-400" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" data-name="Layer 1"
                                    viewBox="0 0 807.45276 499.98424">
                                    <path id="ad903c08-5677-4dbe-a9c7-05a0eb46801f-1657" data-name="Path 461"
                                        d="M252.30849,663.16553a22.728,22.728,0,0,0,21.947-3.866c7.687-6.452,10.1-17.081,12.058-26.924l5.8-29.112-12.143,8.362c-8.733,6.013-17.662,12.219-23.709,20.929s-8.686,20.6-3.828,30.024"
                                        transform="translate(-196.27362 -200.00788)" fill="#e6e6e6" />
                                    <path id="a94887ac-0642-4b28-b311-c351a0f7f12b-1658" data-name="Path 462"
                                        d="M253.34651,698.41151c-1.229-8.953-2.493-18.02-1.631-27.069.766-8.036,3.217-15.885,8.209-22.321a37.13141,37.13141,0,0,1,9.527-8.633c.953-.6,1.829.909.881,1.507a35.29989,35.29989,0,0,0-13.963,16.847c-3.04,7.732-3.528,16.161-3,24.374.317,4.967.988,9.9,1.665,14.83a.9.9,0,0,1-.61,1.074.878.878,0,0,1-1.074-.61Z"
                                        transform="translate(-196.27362 -200.00788)" fill="#f2f2f2" />
                                    <path
                                        d="M496.87431,505.52556a6.9408,6.9408,0,0,1-2.85071.67077l-91.60708,2.51425a14.3796,14.3796,0,0,1-.62506-28.75241l91.60729-2.51381a7.00744,7.00744,0,0,1,7.15064,6.8456l.32069,14.75586a7.01658,7.01658,0,0,1-3.99577,6.47974Z"
                                        transform="translate(-196.27362 -200.00788)" fill="currentColor" />
                                    <path
                                        d="M379.332,698.59808H364.57245a7.00786,7.00786,0,0,1-7-7V568.58392a7.00785,7.00785,0,0,1,7-7H379.332a7.00786,7.00786,0,0,1,7,7V691.59808A7.00787,7.00787,0,0,1,379.332,698.59808Z"
                                        transform="translate(-196.27362 -200.00788)" fill="currentColor" />
                                    <path
                                        d="M418.52435,698.59808H403.76459a7.00786,7.00786,0,0,1-7-7V568.58392a7.00785,7.00785,0,0,1,7-7h14.75976a7.00786,7.00786,0,0,1,7,7V691.59808A7.00787,7.00787,0,0,1,418.52435,698.59808Z"
                                        transform="translate(-196.27362 -200.00788)" fill="currentColor" />
                                    <circle cx="196.71571" cy="182.69717" r="51" fill="currentColor" />
                                    <path
                                        d="M410.30072,605.205H373.61127a43.27708,43.27708,0,0,1-37.56043-65.05664l51.30933-88.87012a6.5,6.5,0,0,1,11.2583,0l50.27612,87.08057A44.56442,44.56442,0,0,1,410.30072,605.205Z"
                                        transform="translate(-196.27362 -200.00788)" fill="#2f2e41" />
                                    <path
                                        d="M405.02686,404.114c3.30591-.0918,7.42029-.20655,10.59-2.522a8.13274,8.13274,0,0,0,3.20007-6.07275,5.47084,5.47084,0,0,0-1.86035-4.49315c-1.65552-1.39894-4.073-1.72706-6.67823-.96144l2.69922-19.72558-1.98144-.27149-3.17322,23.18994,1.65466-.75928c1.91834-.87988,4.55164-1.32763,6.188.05518a3.51514,3.51514,0,0,1,1.15271,2.89551,6.14686,6.14686,0,0,1-2.38122,4.52783c-2.46668,1.80176-5.74622,2.03418-9.46582,2.13818Z"
                                        transform="translate(-196.27362 -200.00788)" fill="#2f2e41" />
                                    <rect x="226.50312" y="172.03238" width="10.77161" height="2" fill="#2f2e41" />
                                    <rect x="192.50312" y="172.03238" width="10.77161" height="2" fill="#2f2e41" />
                                    <path
                                        d="M380.99359,593.79839a6.94088,6.94088,0,0,1-.67077-2.85072l-2.51425-91.60708a14.3796,14.3796,0,0,1,28.75241-.62506l2.51381,91.60729a7.00744,7.00744,0,0,1-6.8456,7.15064l-14.75586.32069a7.01655,7.01655,0,0,1-6.47974-3.99576Z"
                                        transform="translate(-196.27362 -200.00788)" fill="currentColor" />
                                    <path
                                        d="M388.25747,345.00549c6.19637,8.10336,16.033,13.53931,26.42938,12.25223,9.90031-1.22567,18.06785-8.12619,20.117-18.0055a29.66978,29.66978,0,0,0-7.79665-26.1905c-7.00748-7.37032-17.03634-11.335-26.96311-12.69456-18.80446-2.57537-38.1172,4.04852-52.33518,16.4023a64.1102,64.1102,0,0,0-16.69251,22.37513,62.72346,62.72346,0,0,0-5.175,27.07767c.54633,18.375,8.595,36.71479,22.48271,48.90083a63.37666,63.37666,0,0,0,5.40808,4.23578c1.58387,1.11112,3.08464-1.48868,1.51415-2.59042-14.222-9.977-23.29362-26.21093-25.78338-43.26844a59.92391,59.92391,0,0,1,14.05278-48.33971c11.48411-13.058,28.32271-21.54529,45.7628-22.30575,17.54894-.76521,39.47915,7.06943,42.7631,26.60435,1.47191,8.7558-1.801,17.95926-9.82454,22.3428-8.59053,4.69326-19.12416,2.76181-26.50661-3.29945a30.448,30.448,0,0,1-4.86258-5.01092c-1.157-1.51313-3.76387-.02044-2.59041,1.51416Z"
                                        transform="translate(-196.27362 -200.00788)" fill="#2f2e41" />
                                    <rect id="fc777aff-63b1-4720-84dc-e3a9c20790b9"
                                        data-name="ab2e16f2-9798-47da-b25d-769524f3c86f" x="484.20919" y="242.03206"
                                        width="437.1948" height="207.45652"
                                        transform="translate(-238.48792 -95.97299) rotate(-8.21995)" fill="#f1f1f1" />
                                    <rect id="ecffa418-b240-4504-be04-512edea7ccda"
                                        data-name="bf81c03f-68cf-4889-8697-1102f95f97bb" x="496.79745" y="259.81556"
                                        width="412.19197" height="173.08746"
                                        transform="translate(-238.57266 -95.95442) rotate(-8.21995)" fill="#fff" />
                                    <rect id="b49ce3f1-9d75-4481-986b-3b6beb000c79"
                                        data-name="f065dccc-d150-492a-a09f-a7f3f89523f0" x="468.80837" y="231.16611"
                                        width="437.19481" height="18.57334"
                                        transform="translate(-223.58995 -99.25677) rotate(-8.21995)" fill="#e5e5e5" />
                                    <circle id="a4219562-805a-49cd-8b89-b1f92f7a9e75"
                                        data-name="bdbbf39c-df25-4682-8b85-5a6af4a1bd14" cx="288.67474" cy="71.34324"
                                        r="3.4425" fill="#fff" />
                                    <circle id="b0f6399c-6944-4f74-a888-473f61f9730c"
                                        data-name="abcd4292-0b1f-4102-9b5e-e8bbd87baabc" cx="301.6071" cy="69.47507"
                                        r="3.4425" fill="#fff" />
                                    <circle id="b03f93dc-2c99-4323-9b17-02f51b8830c0"
                                        data-name="a3fb731e-8b3d-41ca-96f2-91600dc0b434" cx="314.54005" cy="67.6068"
                                        r="3.4425" fill="#fff" />
                                    <rect id="a6067cfc-0392-4d68-afe4-e34d11a8f0ac"
                                        data-name="ab2e16f2-9798-47da-b25d-769524f3c86f" x="370.25796" y="100.18309"
                                        width="437.1948" height="207.45652" fill="#e6e6e6" />
                                    <rect id="ecd65817-7467-4dbd-a435-c0f1d9841c98"
                                        data-name="bf81c03f-68cf-4889-8697-1102f95f97bb" x="382.75969" y="117.97286"
                                        width="412.19197" height="173.08746" fill="#fff" />
                                    <rect id="eea6c39d-8a45-4eb1-bab9-6120f465de14"
                                        data-name="f065dccc-d150-492a-a09f-a7f3f89523f0" x="370.07154" y="88.19711"
                                        width="437.19481" height="18.57334" fill="#cbcbcb" />
                                    <circle id="ab9e51f9-7431-4d30-8193-f9435a6bd5c3"
                                        data-name="bdbbf39c-df25-4682-8b85-5a6af4a1bd14" cx="383.87383" cy="99.11864"
                                        r="3.4425" fill="#fff" />
                                    <circle id="a54ed687-3b0d-413b-b405-af8897a5c032"
                                        data-name="abcd4292-0b1f-4102-9b5e-e8bbd87baabc" cx="396.94043" cy="99.11864"
                                        r="3.4425" fill="#fff" />
                                    <circle id="fd1d2195-7e97-488f-8f4b-7061a06deb9a"
                                        data-name="a3fb731e-8b3d-41ca-96f2-91600dc0b434" cx="410.00762" cy="99.11864"
                                        r="3.4425" fill="#fff" />
                                    <rect x="620.27691" y="144.28855" width="58.05212" height="4.36334" fill="#e6e6e6" />
                                    <rect x="620.27691" y="157.09784" width="89.64514" height="4.36332" fill="#e6e6e6" />
                                    <rect x="621.20899" y="169.29697" width="73.05881" height="4.36332" fill="#e6e6e6" />
                                    <rect x="620.27691" y="182.68222" width="42.65054" height="4.36332" fill="#e6e6e6" />
                                    <rect x="620.27691" y="195.75677" width="64.37073" height="4.36332" fill="#e6e6e6" />
                                    <rect x="593.81776" y="142.916" width="7.10843" height="7.10842" fill="#e6e6e6" />
                                    <rect x="593.81776" y="155.72527" width="7.10843" height="7.10841" fill="#e6e6e6" />
                                    <rect x="593.81776" y="167.92442" width="7.10843" height="7.10843" fill="#e6e6e6" />
                                    <rect x="593.81776" y="181.30967" width="7.10843" height="7.10843" fill="#e6e6e6" />
                                    <rect x="593.81776" y="194.38423" width="7.10843" height="7.10843" fill="#e6e6e6" />
                                    <rect x="620.27691" y="208.91306" width="58.05212" height="4.36332" fill="#e6e6e6" />
                                    <rect x="620.27691" y="221.72236" width="89.64514" height="4.36332" fill="#e6e6e6" />
                                    <rect x="621.20899" y="233.92149" width="73.05881" height="4.36332" fill="#e6e6e6" />
                                    <rect x="620.27691" y="247.30674" width="42.65054" height="4.36332" fill="#e6e6e6" />
                                    <rect x="620.27691" y="260.38129" width="64.37073" height="4.36332" fill="#e6e6e6" />
                                    <rect x="593.81776" y="207.54051" width="7.10843" height="7.10843" fill="#e6e6e6" />
                                    <rect x="593.81776" y="220.34979" width="7.10843" height="7.10841" fill="#e6e6e6" />
                                    <rect x="593.81776" y="232.54894" width="7.10843" height="7.10843" fill="#e6e6e6" />
                                    <rect x="593.81776" y="245.93419" width="7.10843" height="7.10843" fill="#e6e6e6" />
                                    <rect x="593.81776" y="259.00875" width="7.10843" height="7.10843" fill="#e6e6e6" />
                                    <rect x="436.63003" y="243.13905" width="58.05213" height="4.36333" fill="#e6e6e6" />
                                    <rect x="428.86266" y="254.4769" width="73.05881" height="4.36332" fill="#e6e6e6" />
                                    <path
                                        d="M699.66075,388.1056a37.91872,37.91872,0,0,1-55.87819,33.382l-.00736-.00737a37.907,37.907,0,1,1,55.88555-33.37461Z"
                                        transform="translate(-196.27362 -200.00788)" fill="#e6e6e6" />
                                    <circle cx="465.67554" cy="175.95347" r="10.30421" fill="#fff" />
                                    <path
                                        d="M679.54362,407.55657a53.11056,53.11056,0,0,1-35.56788-.13775l-.00738-.0051,7.6766-15.15329h20.60841Z"
                                        transform="translate(-196.27362 -200.00788)" fill="#fff" />
                                    <path
                                        d="M547.86351,482.19293c-17.96014,0-32.5719-15.52155-32.5719-34.60067,0-19.07858,14.61176-34.60014,32.5719-34.60014s32.5719,15.52156,32.5719,34.60014C580.43541,466.67138,565.82365,482.19293,547.86351,482.19293Zm0-60.4582c-13.13954,0-23.82929,11.59955-23.82929,25.85753s10.68975,25.85806,23.82929,25.85806,23.82928-11.60008,23.82928-25.85806S561.00305,421.73473,547.86351,421.73473Z"
                                        transform="translate(-196.27362 -200.00788)" fill="currentColor" />
                                    <path
                                        d="M578.70786,542.49212h-61.6887a20.54138,20.54138,0,0,1-20.51852-20.51826V461.46391a14.06356,14.06356,0,0,1,14.04747-14.04774h74.6308a14.06356,14.06356,0,0,1,14.04747,14.04774v60.50995A20.54138,20.54138,0,0,1,578.70786,542.49212Z"
                                        transform="translate(-196.27362 -200.00788)" fill="#3f3d56" />
                                    <path
                                        d="M559.88461,481.84022a12.0211,12.0211,0,1,0-17.48524,10.69829v18.808h10.92827v-18.808A12.01088,12.01088,0,0,0,559.88461,481.84022Z"
                                        transform="translate(-196.27362 -200.00788)" fill="#fff" />
                                    <path d="M578.27362,699.99212h-381a1,1,0,0,1,0-2h381a1,1,0,0,1,0,2Z"
                                        transform="translate(-196.27362 -200.00788)" fill="#3f3d56" />
                                </svg>
                            </div>
                            <h2 class="mt-5 block text-sm font-semibold text-zinc-800">
                                <?php echo app('translator')->get('messages.t_this_project_is_closed_for_bidding'); ?>
                            </h2>
                            <a href="<?php echo e(url('explore/projects'), false); ?>"
                                class="text-primary-600 text-[13px] hover:underline font-normal tracking-wide mt-1"><?php echo app('translator')->get('messages.t_find_another_project'); ?></a>
                        </div>
                    <?php else: ?>

                        
                        <!--[if BLOCK]><![endif]--><?php if($this->hasSponsoredBid()): ?>

                            
                            <?php
                                $sponsored_bid = $this->hasSponsoredBid();
                            ?>

                            
                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('main.cards.bid', ['bid_id' => $sponsored_bid->uid]);

$__html = app('livewire')->mount($__name, $__params, 'bid-card-id-' . $sponsored_bid->uid, $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $bids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            
                            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('main.cards.bid', ['bid_id' => $bid->uid]);

$__html = app('livewire')->mount($__name, $__params, 'bid-card-id-' . $bid->uid, $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->

                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->


                </section>

            </div>

            
            <section class="lg:col-start-3 lg:col-span-1">

                
                <div class="mb-6 rounded-3xl border border-slate-200 bg-white/95 p-6 shadow-sm shadow-slate-900/5 dark:border-zinc-700 dark:bg-zinc-900">
                    <h2 class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-400 dark:text-zinc-500">
                        <?php echo app('translator')->get('messages.t_project_summary'); ?>
                    </h2>
                    <div class="mt-4 space-y-3 text-sm text-slate-600 dark:text-zinc-200">
                        <div class="flex items-center justify-between gap-3">
                            <span><?php echo app('translator')->get('messages.t_budget'); ?></span>
                            <span class="font-semibold text-zinc-900 dark:text-zinc-100"><?php echo e($projectBudget, false); ?></span>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <span><?php echo app('translator')->get('messages.t_budget_type'); ?></span>
                            <span class="font-semibold text-zinc-900 dark:text-zinc-100">
                                <!--[if BLOCK]><![endif]--><?php if($project->budget_type === 'fixed'): ?>
                                    <?php echo app('translator')->get('messages.t_fixed_price'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('messages.t_hourly_price'); ?>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </span>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <span><?php echo app('translator')->get('messages.t_category'); ?></span>
                            <span
                                class="font-semibold text-zinc-900 dark:text-zinc-100"><?php echo e($projectCategory ?? __('messages.t_na'), false); ?></span>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <span><?php echo app('translator')->get('messages.t_status'); ?></span>
                            <span
                                class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-[12px] font-semibold <?php echo e($projectStatusClass, false); ?>">
                                <i class="ph ph-pulse text-xs"></i>
                                <?php echo e($projectStatusLabel, false); ?>

                            </span>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <span><?php echo app('translator')->get('messages.t_bids'); ?></span>
                            <span
                                class="font-semibold text-zinc-900 dark:text-zinc-100"><?php echo e(number_format($projectBidsCount), false); ?></span>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <span><?php echo app('translator')->get('messages.t_avg_bid'); ?></span>
                            <span class="font-semibold text-zinc-900 dark:text-zinc-100"><?php echo e($projectAvgBid, false); ?></span>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <span><?php echo app('translator')->get('messages.t_posted_date'); ?></span>
                            <span
                                class="font-semibold text-zinc-900 dark:text-zinc-100"><?php echo e(format_date($project->created_at, 'ago'), false); ?></span>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <span><?php echo app('translator')->get('messages.t_clicks'); ?></span>
                            <span
                                class="font-semibold text-zinc-900 dark:text-zinc-100"><?php echo e(number_format($project->counter_views), false); ?></span>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <span><?php echo app('translator')->get('messages.t_impressions'); ?></span>
                            <span
                                class="font-semibold text-zinc-900 dark:text-zinc-100"><?php echo e(number_format($project->counter_impressions), false); ?></span>
                        </div>
                    </div>
                </div>
                <section class="">
                    <div
                        class="rounded-2xl border border-slate-200 bg-slate-50/70 p-5 dark:border-zinc-700 dark:bg-zinc-800/70">
                        <h3 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
                            <?php echo app('translator')->get('messages.t_client_info'); ?>
                        </h3>
                        <div class="mt-3 flex items-center gap-3">
                            <img class="h-12 w-12 rounded-xl object-cover shadow-sm" src="<?php echo e(placeholder_img(), false); ?>"
                                data-src="<?php echo e(src($project->client->avatar), false); ?>" alt="<?php echo e($project->title, false); ?>">
                            <div>
                                <p class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                                    <?php echo e($this->clientUsername(), false); ?>

                                </p>
                                <p class="text-xs text-slate-500 dark:text-zinc-400">
                                    <?php echo app('translator')->get('messages.t_the_client_account_appear_if_contact_u'); ?>
                                </p>
                            </div>
                        </div>
                        <dl class="mt-4 space-y-2 text-sm text-slate-600 dark:text-zinc-300">
                            <!--[if BLOCK]><![endif]--><?php if($project->client?->country?->name): ?>
                                <div class="flex items-center gap-2">
                                    <i class="ph ph-map-pin text-base text-primary-500"></i>
                                    <span><?php echo e($project->client->country->name, false); ?></span>
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            <div class="flex items-center gap-2">
                                <i class="ph ph-calendar-check text-base text-primary-500"></i>
                                <span><?php echo app('translator')->get('messages.t_member_since'); ?>:
                                    <?php echo e(format_date($project->client->created_at, 'ago'), false); ?></span>
                            </div>
                        </dl>
                        <?php
                            $clientLastSeen = $clientInsights['last_activity']
                                ? format_date($clientInsights['last_activity'], 'ago')
                                : __('messages.t_na');
                            $projectsTotal = isset($clientInsights['projects_count']) ? number_format($clientInsights['projects_count']) : '—';
                            $ordersTotal = isset($clientInsights['orders_count']) && $clientInsights['orders_count'] !== null
                                ? number_format($clientInsights['orders_count'])
                                : __('messages.t_na');
                        ?>
                        <ul class="mt-4 space-y-3 text-[12.5px] leading-6 text-slate-600 dark:text-zinc-300">
                            <li
                                class="flex items-start gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3 dark:border-zinc-700 dark:bg-zinc-900/80">
                                <span
                                    class="flex h-8 w-8 flex-none items-center justify-center rounded-full bg-primary-50 text-primary-600 dark:bg-primary-500/15 dark:text-primary-200">
                                    <i class="ph ph-credit-card text-sm"></i>
                                </span>
                                <div>
                                    <p class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">وضع
                                        الدفع</p>
                                    <p class="text-[12px] text-slate-600 dark:text-zinc-300">
                                        <?php echo e($clientInsights['has_payment_method'] ? 'تم ربط وسيلة دفع جاهزة للدفع السريع.' : 'لم يقم العميل بعد بإضافة وسيلة دفع.', false); ?>

                                    </p>
                                </div>
                            </li>
                            <li
                                class="flex items-start gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3 dark:border-zinc-700 dark:bg-zinc-900/80">
                                <span
                                    class="flex h-8 w-8 flex-none items-center justify-center rounded-full bg-blue-50 text-blue-600 dark:bg-blue-500/15 dark:text-blue-200">
                                    <i class="ph ph-clock text-sm"></i>
                                </span>
                                <div>
                                    <p class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">آخر
                                        ظهور</p>
                                    <p class="text-[12px] text-slate-600 dark:text-zinc-300">
                                        <?php echo e($clientLastSeen, false); ?>

                                    </p>
                                </div>
                            </li>
                            <li
                                class="flex items-start gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3 dark:border-zinc-700 dark:bg-zinc-900/80">
                                <span
                                    class="flex h-8 w-8 flex-none items-center justify-center rounded-full bg-emerald-50 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-200">
                                    <i class="ph ph-list-checks text-sm"></i>
                                </span>
                                <div>
                                    <p class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
                                        المشاريع المنشورة</p>
                                    <p class="text-[12px] text-slate-600 dark:text-zinc-300">
                                        <?php echo e($projectsTotal, false); ?> <?php echo e(__('messages.t_projects'), false); ?>

                                    </p>
                                </div>
                            </li>
                            <li
                                class="flex items-start gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3 dark:border-zinc-700 dark:bg-zinc-900/80">
                                <span
                                    class="flex h-8 w-8 flex-none items-center justify-center rounded-full bg-rose-50 text-rose-600 dark:bg-rose-500/15 dark:text-rose-200">
                                    <i class="ph ph-handshake text-sm"></i>
                                </span>
                                <div>
                                    <p class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">العقود
                                        المرسلة</p>
                                    <p class="text-[12px] text-slate-600 dark:text-zinc-300">
                                        <?php echo e($ordersTotal, false); ?>

                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!--[if BLOCK]><![endif]--><?php if(!empty($clientFeedbackSummary['categories']) && ($clientFeedbackSummary['total'] ?? 0) > 0): ?>
                        <div
                            class="rounded-2xl border border-slate-200 bg-white/95 p-5 shadow-sm dark:border-zinc-700 dark:bg-zinc-900/90">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    <h3 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">تقييمات
                                        العميل</h3>
                                    <p class="text-[12px] text-slate-500 dark:text-zinc-400">
                                        متوسط تقييمات المستقلين الذين تعاونوا مع هذا العميل.
                                    </p>
                                    <p class="text-[11.5px] text-slate-400 dark:text-zinc-500">
                                        <?php echo e($clientFeedbackSummary['total'], false); ?> تقييم/ات موثقة.
                                    </p>
                                </div>
                                <span
                                    class="inline-flex items-center gap-2 rounded-full bg-emerald-500/10 px-3 py-1 text-[11px] font-semibold text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-100">
                                    <i class="ph ph-star text-xs"></i>
                                    <?php echo e($clientFeedbackSummary['average'], false); ?>/5
                                </span>
                            </div>
                            <div class="mt-4 space-y-3 text-[12.5px] text-slate-600 dark:text-zinc-300">
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $clientFeedbackSummary['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div
                                        class="flex items-center justify-between gap-3 rounded-2xl border border-slate-200 bg-white px-3 py-2 dark:border-zinc-700 dark:bg-zinc-800">
                                        <span><?php echo e($category['label'], false); ?></span>
                                        <span
                                            class="inline-flex items-center gap-1 font-semibold text-emerald-600 dark:text-emerald-200">
                                            <i class="ph ph-star text-xs"></i>
                                            <?php echo e(number_format($category['score'], 1), false); ?>

                                        </span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="mt-4 flex flex-wrap items-center gap-2">
                                <button type="button" wire:click="rateClient(5)"
                                    class="inline-flex items-center gap-2 rounded-full bg-emerald-600 px-4 py-1.5 text-[12px] font-semibold text-white transition hover:bg-emerald-700">
                                    <i class="ph ph-star text-xs"></i>
                                    تقييم العميل
                                </button>
                                <button type="button" wire:click="rateClient()"
                                    class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-1.5 text-[12px] font-semibold text-slate-600 transition hover:border-primary-200 hover:text-primary-600 dark:border-zinc-700 dark:text-zinc-300 dark:hover:border-primary-400">
                                    <i class="ph ph-skip-forward text-xs"></i>
                                    تخطي الآن
                                </button>
                            </div>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                </section>
            </section>
        </div>
    </div>

    
    <!--[if BLOCK]><![endif]--><?php if(auth()->guard()->check()): ?>
        <?php if(auth()->id() != $project->user_id && $project->status === 'active' && !$already_submitted_proposal): ?>
            <?php if (isset($component)) { $__componentOriginal626cd0ad8c496eb8a190505b15f0d732 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal626cd0ad8c496eb8a190505b15f0d732 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Modal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Modal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modal-bid-container','target' => 'modal-bid-button','uid' => 'modal_'.e(uid(), false).'','placement' => 'center-center','size' => 'max-w-6xl']); ?>

                
                 <?php $__env->slot('title', null, []); ?> <?php echo e(__('messages.t_bid_details'), false); ?> <?php $__env->endSlot(); ?>

                
                 <?php $__env->slot('content', null, []); ?> 

                    
                    <!--[if BLOCK]><![endif]--><?php if($bid_current_step === 1): ?>
                        <div class="grid grid-cols-12 md:gap-x-6 gap-y-6 py-2">

                            
                            <div class="col-span-12 md:col-span-6">

                                
                                <label for="bid-amount-input"
                                    class="<?php echo e($errors->first('bid_amount') ? 'text-red-600' : 'text-gray-900', false); ?> block mb-2 text-[13px] font-bold dark:text-white">
                                    <?php echo app('translator')->get('messages.t_bid_amount'); ?>
                                </label>

                                
                                <div class="relative w-full">

                                    
                                    <input wire:model.defer="bid_amount" x-on:keyup="calculateProfit" x-on:change="verifyAmount"
                                        type="text" id="bid-amount-input"
                                        class="<?php echo e($errors->first('bid_amount') ? 'focus:ring-red-600 focus:border-red-600 border-red-500' : 'focus:ring-primary-600 focus:border-primary-600 border-gray-300', false); ?> border text-gray-900 text-sm rounded-lg font-medium block w-full ltr:pr-12 rtl:pl-12 p-4  dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="0.00">

                                    
                                    <div
                                        class="absolute inset-y-0 ltr:right-0 rtl:left-0 flex items-center ltr:pr-3 rtl:pl-3 font-bold text-xs tracking-widest dark:text-gray-300 uppercase">
                                        <?php echo e(settings('currency')->code, false); ?>

                                    </div>

                                </div>

                                
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['bid_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1.5 text-[13px] tracking-wide text-red-600 font-medium ltr:pl-1 rtl:pr-1">
                                        <?php echo e($errors->first('bid_amount'), false); ?>

                                    </p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                            </div>

                            
                            <div class="col-span-12 md:col-span-6">

                                
                                <label for="bid-amount-paid-input"
                                    class="text-gray-900 mb-2 text-[13px] font-bold dark:text-white flex items-center space-x-2 rtl:space-x-reverse">
                                    <span><?php echo app('translator')->get('messages.t_paid_to_you'); ?></span>
                                    <svg data-tooltip-target="bid-paid-to-you-tooltip" class="cursor-pointer w-4 h-4 text-gray-400"
                                        stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <div id="bid-paid-to-you-tooltip" role="tooltip"
                                        class="inline-block absolute invisible z-10 py-2 px-3 text-xs font-medium text-white bg-gray-900 rounded-sm shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                        <?php echo e(__('messages.t_bid_paid_to_you_tooltip'), false); ?>

                                    </div>
                                </label>

                                
                                <div class="relative w-full">

                                    
                                    <input wire:model.defer="bid_amount_paid" type="text" id="bid-amount-paid-input"
                                        class="bg-zinc-50 cursor-not-allowed focus:ring-0 focus:outline-none border-gray-300 border text-gray-900 text-sm rounded-lg font-medium block w-full ltr:pr-12 rtl:pl-12 p-4  dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-gray-400 dark:text-white"
                                        disabled readonly placeholder="0.00">

                                    
                                    <div
                                        class="absolute inset-y-0 ltr:right-0 rtl:left-0 flex items-center ltr:pr-3 rtl:pl-3 font-bold text-xs tracking-widest dark:text-gray-300 uppercase">
                                        <?php echo e(settings('currency')->code, false); ?>

                                    </div>

                                </div>

                            </div>

                            
                            <div class="col-span-12">

                                
                                <label for="bid-days-input"
                                    class="<?php echo e($errors->first('bid_days') ? 'text-red-600' : 'text-gray-900', false); ?> block mb-2 text-[13px] font-bold dark:text-white">
                                    <?php echo app('translator')->get('messages.t_this_project_will_be_delivered_in'); ?>
                                </label>

                                
                                <div class="relative w-full">

                                    
                                    <input type="text" wire:model.defer="bid_days" id="bid-days-input"
                                        class="<?php echo e($errors->first('bid_days') ? 'focus:ring-red-600 focus:border-red-600 border-red-500' : 'focus:ring-primary-600 focus:border-primary-600 border-gray-300', false); ?> border text-gray-900 text-sm rounded-lg font-medium block w-full ltr:pr-12 rtl:pl-12 p-4  dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

                                    
                                    <div
                                        class="absolute inset-y-0 ltr:right-0 rtl:left-0 flex items-center ltr:pr-3 rtl:pl-3 font-bold text-xs tracking-widest dark:text-gray-300 uppercase">
                                        <?php echo app('translator')->get('messages.t_days'); ?>
                                    </div>

                                </div>

                                
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['bid_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1.5 text-[13px] tracking-wide text-red-600 font-medium ltr:pl-1 rtl:pr-1">
                                        <?php echo e($errors->first('bid_days'), false); ?>

                                    </p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                            </div>

                            
                            <div class="col-span-12">

                                
                                <label for="bid-description-input"
                                    class="<?php echo e($errors->first('bid_description') ? 'text-red-600' : 'text-gray-900', false); ?> block mb-2 text-[13px] font-bold dark:text-white">
                                    <?php echo app('translator')->get('messages.t_describe_ur_proposal'); ?>
                                </label>

                                
                                <div class="relative w-full">

                                    
                                    <textarea wire:model.defer="bid_description" id="bid-description-input"
                                        class="<?php echo e($errors->first('bid_description') ? 'focus:ring-red-600 focus:border-red-600 border-red-500' : 'focus:ring-primary-600 focus:border-primary-600 border-gray-300', false); ?> border text-gray-900 text-sm rounded-lg font-medium block w-full ltr:pr-12 rtl:pl-12 p-4  dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 placeholder:font-normal"
                                        rows="8" placeholder="<?php echo e(__('messages.t_describe_ur_proposal_placeholder'), false); ?>"></textarea>

                                    
                                    <div
                                        class="absolute inset-y-0 ltr:right-0 rtl:left-0 flex items-center ltr:pr-3 rtl:pl-3 font-bold text-xs tracking-widest dark:text-gray-300 uppercase">
                                        <svg class="w-5 h-5 text-gray-500" stroke="currentColor" fill="currentColor"
                                            stroke-width="0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z">
                                            </path>
                                        </svg>
                                    </div>

                                </div>

                                
                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['bid_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1.5 text-[13px] tracking-wide text-red-600 font-medium ltr:pl-1 rtl:pr-1">
                                        <?php echo e($errors->first('bid_description'), false); ?>

                                    </p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                            </div>

                            <div class="col-span-12">
                                <p class="mb-2 text-[13px] font-bold text-gray-900 dark:text-white">خطة الدفع</p>
                                <div class="grid gap-3 md:grid-cols-2">
                                    <label wire:click="$set('bid_plan_type', 'fixed')" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'flex cursor-pointer items-start gap-3 rounded-2xl border px-4 py-3 transition hover:border-primary-200 hover:bg-primary-50/40 dark:border-zinc-600 dark:hover:border-primary-400 dark:hover:bg-primary-500/10',
                                        'border-primary-600 bg-primary-50/60 dark:border-primary-400/70 dark:bg-primary-500/10' => $bid_plan_type === 'fixed',
                                    ]); ?>">
                                        <input type="radio" wire:model="bid_plan_type" value="fixed" class="hidden">
                                        <span
                                            class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-primary-600/10 text-primary-600 dark:bg-primary-500/15 dark:text-primary-200">
                                            <i class="ph ph-currency-circle-dollar text-lg"></i>
                                        </span>
                                        <span class="flex flex-col">
                                            <span class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
                                                عرض بسعر ثابت
                                            </span>
                                            <span class="text-[12px] text-slate-500 dark:text-zinc-400">
                                                مبلغ واحد يغطي كامل نطاق العمل.
                                            </span>
                                        </span>
                                    </label>
                                    <label wire:click="$set('bid_plan_type', 'milestone')" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                        'flex cursor-pointer items-start gap-3 rounded-2xl border px-4 py-3 transition hover:border-primary-200 hover:bg-primary-50/40 dark:border-zinc-600 dark:hover:border-primary-400 dark:hover:bg-primary-500/10',
                                        'border-primary-600 bg-primary-50/60 dark:border-primary-400/70 dark:bg-primary-500/10' => $bid_plan_type === 'milestone',
                                    ]); ?>">
                                        <input type="radio" wire:model="bid_plan_type" value="milestone" class="hidden">
                                        <span
                                            class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-primary-600/10 text-primary-600 dark:bg-primary-500/15 dark:text-primary-200">
                                            <i class="ph ph-flag-checkered text-lg"></i>
                                        </span>
                                        <span class="flex flex-col">
                                            <span class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
                                                عرض بخطة دفعات
                                            </span>
                                            <span class="text-[12px] text-slate-500 dark:text-zinc-400">
                                                قسمت العمل إلى دفعات محددة بمواعيد تسليم.
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <!--[if BLOCK]><![endif]--><?php if($bid_plan_type === 'milestone'): ?>
                                <div class="col-span-12 space-y-4">
                                    <div class="flex items-center justify-between">
                                        <h4 class="text-sm font-semibold text-zinc-800 dark:text-zinc-200">تفاصيل الدفعات</h4>
                                        <button type="button" wire:click="addBidMilestone"
                                            class="inline-flex items-center gap-2 rounded-full border border-primary-200 px-3 py-1.5 text-[12px] font-semibold text-primary-600 transition hover:border-primary-300 hover:text-primary-700 dark:border-primary-500/40 dark:text-primary-200 dark:hover:border-primary-400">
                                            <i class="ph ph-plus text-xs"></i>
                                            إضافة معلم
                                        </button>
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $bid_milestones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div
                                            class="rounded-2xl border border-slate-200 bg-white px-4 py-4 shadow-sm dark:border-zinc-700 dark:bg-zinc-800/80">
                                            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                                                <h5 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">المعلم رقم
                                                    <?php echo e($index + 1, false); ?>

                                                </h5>
                                                <!--[if BLOCK]><![endif]--><?php if($index > 0): ?>
                                                    <button type="button" wire:click="removeBidMilestone(<?php echo e($index, false); ?>)"
                                                        class="inline-flex items-center gap-1 text-[12px] font-semibold text-rose-500 hover:text-rose-600 dark:text-rose-300 dark:hover:text-rose-200">
                                                        <i class="ph ph-trash text-xs"></i>
                                                        إزالة
                                                    </button>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                            <div class="mt-3 grid gap-3 md:grid-cols-3">
                                                <div class="md:col-span-2">
                                                    <label
                                                        class="mb-1 block text-[12px] font-semibold text-slate-500 dark:text-zinc-300">العنوان</label>
                                                    <input type="text" wire:model.defer="bid_milestones.<?php echo e($index, false); ?>.title"
                                                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-100 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100"
                                                        placeholder="مثال: تصميم الواجهة الأولى">
                                                </div>
                                                <div>
                                                    <label
                                                        class="mb-1 block text-[12px] font-semibold text-slate-500 dark:text-zinc-300">القيمة</label>
                                                    <input type="text" wire:model.defer="bid_milestones.<?php echo e($index, false); ?>.amount"
                                                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-100 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100"
                                                        placeholder="<?php echo e(__('messages.t_amount'), false); ?>">
                                                </div>
                                                <div>
                                                    <label
                                                        class="mb-1 block text-[12px] font-semibold text-slate-500 dark:text-zinc-300">التسليم
                                                        خلال</label>
                                                    <input type="text" wire:model.defer="bid_milestones.<?php echo e($index, false); ?>.due_in"
                                                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700 focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-100 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-100"
                                                        placeholder="3 أيام / 1 أسبوع">
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    <p class="text-[11.5px] text-slate-500 dark:text-zinc-400">
                                        تأكد أن إجمالي الدفعات يناسب الميزانية العامة للعرض، ويمكن تعديل القيم لاحقاً أثناء التفاوض.
                                    </p>
                                    <!--[if BLOCK]><![endif]--><?php if($errors->has('bid_milestones')): ?>
                                        <p class="mt-2 text-[12px] font-semibold text-rose-600 dark:text-rose-400">
                                            <?php echo e($errors->first('bid_milestones'), false); ?>

                                        </p>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    
                    <!--[if BLOCK]><![endif]--><?php if(settings('projects')->is_premium_bidding && $bid_current_step === 2): ?>
                        <fieldset>

                            
                            <legend class="mb-4 dark:text-zinc-200"><?php echo app('translator')->get('messages.t_optional_upgrades'); ?></legend>

                            <div class="space-y-2 divide-y divide-gray-200 dark:divide-zinc-700 w-full">
                                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="relative flex items-center w-full py-4">
                                        <div class="flex items-center h-5">
                                            <input id="bid-promotion-plan-<?php echo e($plan->uid, false); ?>" name="bidding_selected_plans"
                                                wire:model.defer="bid_<?php echo e($plan->plan_type, false); ?>" value="<?php echo e($plan->uid, false); ?>" type="checkbox"
                                                class="focus:ring-transparent focus:outline-none ring-offset-0 focus:shadow-none h-5 w-5 text-primary-600 border-gray-300 border-2 rounded-sm cursor-pointer dark:bg-transparent dark:border-zinc-600 dark:text-zinc-500 dark:focus:ring-offset-zinc-500">
                                        </div>
                                        <div class="ltr:ml-4 rtl:mr-4 text-sm w-full">
                                            <label for="bid-promotion-plan-<?php echo e($plan->uid, false); ?>"
                                                class="font-medium text-gray-700 flex items-center justify-between">

                                                
                                                <div class="inline-flex px-2 py-1 rounded-full text-xs font-medium tracking-widest uppercase min-w-[120px] justify-center"
                                                    style="color: <?php echo e($plan->badge_text_color, false); ?>;background-color: <?php echo e($plan->badge_bg_color, false); ?>;">
                                                    <?php echo app('translator')->get('messages.t_' . $plan->plan_type); ?>
                                                </div>

                                                
                                                <span
                                                    class="text-sm font-semibold text-zinc-700 bg-gray-100 rounded-md px-3 py-2 dark:bg-zinc-900 dark:text-zinc-200"><?php echo e(money($plan->price, settings('currency')->code, true), false); ?></span>

                                            </label>

                                            
                                            <p class="text-gray-600 dark:text-zinc-300 leading-relaxed mt-2">
                                                <?php echo e(__('messages.t_bidding_plan_' . $plan->plan_type . '_subtitle'), false); ?>

                                            </p>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                        </fieldset>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                 <?php $__env->endSlot(); ?>

                
                 <?php $__env->slot('footer', null, []); ?> 
                    <div class="flex items-center justify-between w-full">

                        
                        <div>
                            <!--[if BLOCK]><![endif]--><?php if($bid_current_step === 2): ?>
                                <button wire:click="back"
                                    wire:loading.class="bg-gray-200 hover:bg-gray-300 text-gray-500 dark:bg-zinc-600 dark:text-zinc-400 cursor-not-allowed"
                                    wire:loading.class.remove="bg-white hover:bg-gray-100 text-gray-800 cursor-pointer border border-gray-300 shadow-sm"
                                    wire:loading.attr="disabled"
                                    class="text-[13px] font-semibold flex justify-center bg-white hover:bg-gray-100 text-gray-800 py-4 px-8 rounded tracking-wide focus:outline-none focus:shadow-outline cursor-pointer border border-gray-300 shadow-sm dark:bg-zinc-600 dark:border-zinc-600 dark:text-zinc-100 dark:hover:bg-zinc-700">

                                    
                                    <div wire:loading wire:target="back">
                                        <svg role="status" class="inline w-4 h-4 text-gray-700 animate-spin" viewBox="0 0 100 101"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="#E5E7EB" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentColor" />
                                        </svg>
                                    </div>

                                    
                                    <div wire:loading.remove wire:target="back">
                                        <?php echo app('translator')->get('messages.t_go_back'); ?>
                                    </div>

                                </button>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>

                        
                        <?php if (isset($component)) { $__componentOriginal039608dc70b2e4c26356f5d84408f584 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal039608dc70b2e4c26356f5d84408f584 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => 'next','text' => ''.e(__('messages.t_continue'), false).'','block' => 0]); ?>
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
                 <?php $__env->endSlot(); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal626cd0ad8c496eb8a190505b15f0d732)): ?>
<?php $attributes = $__attributesOriginal626cd0ad8c496eb8a190505b15f0d732; ?>
<?php unset($__attributesOriginal626cd0ad8c496eb8a190505b15f0d732); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal626cd0ad8c496eb8a190505b15f0d732)): ?>
<?php $component = $__componentOriginal626cd0ad8c496eb8a190505b15f0d732; ?>
<?php unset($__componentOriginal626cd0ad8c496eb8a190505b15f0d732); ?>
<?php endif; ?>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    
    <?php if (isset($component)) { $__componentOriginal626cd0ad8c496eb8a190505b15f0d732 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal626cd0ad8c496eb8a190505b15f0d732 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Modal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Modal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modal-share-project-container','target' => 'modal-share-project-button','uid' => 'modal_'.e(uid(), false).'','placement' => 'center-center','size' => 'max-w-md']); ?>

        
         <?php $__env->slot('content', null, []); ?> 

            
            <button x-on:click="close" type="button"
                class="absolute top-5 ltr:right-5 rtl:left-5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ltr:ml-auto rtl:mr-auto inline-flex items-center dark:hover:bg-zinc-600 dark:hover:text-white">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>

            <div class="grid grid-cols-12 md:gap-x-6 gap-y-6 py-6">

                
                <div class="col-span-12">
                    <div class="mt-1 relative flex items-center">
                        <input type="text" id="input-project-url-share" value="<?php echo e(url()->current(), false); ?>"
                            class="shadow-sm focus:ring-primary-600 focus:border-primary-600 block w-full ltr:pr-16 rtl:pl-16 sm:text-[13px] border-gray-200 font-medium rounded-md">
                        <div class="absolute inset-y-0 ltr:right-0 rtl:left-0 flex py-1.5 ltr:pr-1.5 rtl:pl-1.5">
                            <button x-on:click="copyToClipboard()" type="button"
                                class="inline-flex justify-center items-center rounded border font-semibold focus:outline-none px-2 py-1 leading-5 text-xs border-gray-300 bg-gray-50 text-gray-800 shadow-sm hover:text-gray-800 hover:bg-gray-100 hover:border-gray-300 hover:shadow">
                                <template x-if="is_copied">
                                    <span><?php echo app('translator')->get('messages.t_copied'); ?></span>
                                </template>
                                <template x-if="!is_copied">
                                    <span><?php echo app('translator')->get('messages.t_copy'); ?></span>
                                </template>
                            </button>
                        </div>
                    </div>
                </div>

                
                <div class="col-span-12">
                    <ul class="flex items-center justify-center space-x-3 rtl:space-x-reverse">

                        
                        <li>
                            <a href="https://www.facebook.com/share.php?u=<?php echo e(url()->current(), false); ?>&t=<?php echo e($project->title, false); ?>"
                                target="_blank"
                                class="w-12 h-12 flex items-center justify-center rounded-xl bg-[#3b5998]"
                                data-tooltip-target="share-project-btn-facebook">
                                <svg class="w-5 h-5 text-white" role="img" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <title>Facebook</title>
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                            <div id="share-project-btn-facebook" role="tooltip"
                                class="inline-block absolute invisible z-10 py-2 px-3 text-xs font-medium text-white bg-gray-900 rounded-sm shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                <?php echo e(__('messages.t_share_on_facebook'), false); ?>

                            </div>
                        </li>

                        
                        <li>
                            <a href="https://twitter.com/intent/tweet?text=<?php echo e($project->title, false); ?>%20-%20<?php echo e(url()->current(), false); ?>%20"
                                target="_blank"
                                class="w-12 h-12 flex items-center justify-center rounded-xl bg-[#1DA1F2]"
                                data-tooltip-target="share-project-btn-twitter">
                                <svg class="w-5 h-5 text-white" role="img" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <title>Twitter</title>
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                            </a>
                            <div id="share-project-btn-twitter" role="tooltip"
                                class="inline-block absolute invisible z-10 py-2 px-3 text-xs font-medium text-white bg-gray-900 rounded-sm shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                <?php echo e(__('messages.t_share_on_twitter'), false); ?>

                            </div>
                        </li>

                        
                        <li>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo e(url()->current(), false); ?>&title=<?php echo e($project->title, false); ?>&summary=<?php echo e($project->title, false); ?>"
                                target="_blank"
                                class="w-12 h-12 flex items-center justify-center rounded-xl bg-[#0A66C2]"
                                data-tooltip-target="share-project-btn-linkedin">
                                <svg class="w-5 h-5 text-white" role="img" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <title>LinkedIn</title>
                                    <path
                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                </svg>
                            </a>
                            <div id="share-project-btn-linkedin" role="tooltip"
                                class="inline-block absolute invisible z-10 py-2 px-3 text-xs font-medium text-white bg-gray-900 rounded-sm shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                <?php echo e(__('messages.t_share_on_linkedin'), false); ?>

                            </div>
                        </li>

                    </ul>
                </div>

            </div>

         <?php $__env->endSlot(); ?>

     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal626cd0ad8c496eb8a190505b15f0d732)): ?>
<?php $attributes = $__attributesOriginal626cd0ad8c496eb8a190505b15f0d732; ?>
<?php unset($__attributesOriginal626cd0ad8c496eb8a190505b15f0d732); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal626cd0ad8c496eb8a190505b15f0d732)): ?>
<?php $component = $__componentOriginal626cd0ad8c496eb8a190505b15f0d732; ?>
<?php unset($__componentOriginal626cd0ad8c496eb8a190505b15f0d732); ?>
<?php endif; ?>

    
    <!--[if BLOCK]><![endif]--><?php if(auth()->guard()->check()): ?>
        <?php if(auth()->id() != $project->user_id && auth()->user()->account_type === 'seller'): ?>
            <?php if (isset($component)) { $__componentOriginal626cd0ad8c496eb8a190505b15f0d732 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal626cd0ad8c496eb8a190505b15f0d732 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Modal::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Modal::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'modal-report-project-container','target' => 'modal-report-project-button','uid' => 'modal_'.e(uid(), false).'','placement' => 'center-center','size' => 'max-w-xl']); ?>

                
                 <?php $__env->slot('title', null, []); ?> <?php echo e(__('messages.t_report_project'), false); ?> <?php $__env->endSlot(); ?>

                
                 <?php $__env->slot('content', null, []); ?> 
                    <div class="grid grid-cols-12 md:gap-x-6 gap-y-6 py-2">

                        
                        <div class="col-span-12">
                            <fieldset class="w-full">
                                <div class="space-y-4">

                                    
                                    <!--[if BLOCK]><![endif]--><?php for($i = 1; $i <= 6; $i++): ?>
                                        <div class="flex items-center">
                                            <input wire:model.defer="report_reason" value="reason_<?php echo e($i, false); ?>"
                                                id="report_project_reason_<?php echo e($i, false); ?>" name="report_reason" type="radio"
                                                class="focus:ring-primary-600 h-4 w-4 text-primary-700 border-gray-300">
                                            <label for="report_project_reason_<?php echo e($i, false); ?>"
                                                class="ltr:ml-3 rtl:mr-3 block text-sm font-medium text-gray-700">
                                                <?php echo e(__('messages.t_report_project_reason_' . $i), false); ?>

                                            </label>
                                        </div>
                                    <?php endfor; ?><!--[if ENDBLOCK]><![endif]-->

                                </div>
                            </fieldset>
                        </div>

                        
                        <div class="col-span-12">

                            
                            <div class="relative w-full">

                                
                                <textarea wire:model.defer="report_description" id="bid-report-description-input"
                                    class="<?php echo e($errors->first('report_description') ? 'focus:ring-red-600 focus:border-red-600 border-red-500' : 'focus:ring-primary-600 focus:border-primary-600 border-gray-300', false); ?> border text-gray-900 text-sm rounded-lg font-medium block w-full ltr:pr-12 rtl:pl-12 p-4  dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 placeholder:font-normal"
                                    rows="8" placeholder="<?php echo e(__('messages.t_enter_issue_description'), false); ?>"></textarea>

                                
                                <div
                                    class="absolute inset-y-0 ltr:right-0 rtl:left-0 flex items-center ltr:pr-3 rtl:pl-3 font-bold text-xs tracking-widest dark:text-gray-300 uppercase">
                                    <svg class="w-5 h-5 text-gray-500" stroke="currentColor" fill="currentColor"
                                        stroke-width="0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z">
                                        </path>
                                    </svg>
                                </div>

                            </div>

                            
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['report_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-[13px] tracking-wide text-red-600 font-medium ltr:pl-1 rtl:pr-1">
                                    <?php echo e($errors->first('report_description'), false); ?>

                                </p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                        </div>

                    </div>
                 <?php $__env->endSlot(); ?>

                
                 <?php $__env->slot('footer', null, []); ?> 
                    <?php if (isset($component)) { $__componentOriginal039608dc70b2e4c26356f5d84408f584 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal039608dc70b2e4c26356f5d84408f584 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Button::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => 'report','text' => ''.e(__('messages.t_continue'), false).'','block' => 0]); ?>
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
                 <?php $__env->endSlot(); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal626cd0ad8c496eb8a190505b15f0d732)): ?>
<?php $attributes = $__attributesOriginal626cd0ad8c496eb8a190505b15f0d732; ?>
<?php unset($__attributesOriginal626cd0ad8c496eb8a190505b15f0d732); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal626cd0ad8c496eb8a190505b15f0d732)): ?>
<?php $component = $__componentOriginal626cd0ad8c496eb8a190505b15f0d732; ?>
<?php unset($__componentOriginal626cd0ad8c496eb8a190505b15f0d732); ?>
<?php endif; ?>
        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        function LVoePqYZdmjQURo() {
            return {

                is_copied: false,
                is_actions_menu: false,

                // Calculate profit
                calculateProfit(e) {

                    // Get amount
                    if (e.target) {
                        var amount = e.target.value;
                    } else {
                        var amount = e;
                    }

                    // Set type
                    const type = "<?php echo e(settings('projects')->commission_type, false); ?>";

                    // Set commission
                    const commission = <?php echo e(settings('projects')->commission_from_freelancer, false); ?>;

                    // Check if number
                    if (!isNaN(amount)) {

                        // Check fixed
                        if (type === 'fixed') {

                            // Get value
                            const value = amount - commission;

                            // Check value
                            if (value % 1 != 0) {

                                // Set value
                                document.getElementById("bid-amount-paid-input").value = (Math.round(value * 100) / 100).toFixed(2);

                            } else {

                                // Set value
                                document.getElementById("bid-amount-paid-input").value = value;

                            }

                        }

                        // Check percentage
                        if (type === 'percentage') {

                            // Get value
                            const value = (amount * commission) / 100;

                            // Check value
                            if ((amount - value) % 1 != 0) {

                                // Set value
                                document.getElementById("bid-amount-paid-input").value = (Math.round((amount - value) * 100) / 100).toFixed(2);

                            } else {

                                // Set value
                                document.getElementById("bid-amount-paid-input").value = amount - value;

                            }

                        }

                    }
                },

                // Verify bidding amount
                verifyAmount(e) {

                    // Get amount
                    if (e.target) {
                        var amount = e.target.value;
                    } else {
                        var amount = e;
                    }

                    // Check value
                    if (Number(amount) < Number('<?php echo e($project->budget_min, false); ?>') || Number(amount) > Number('<?php echo e($project->budget_max, false); ?>')) {

                        // Error
                        window.$wireui.notify({
                            title: "<?php echo e(__('messages.t_error'), false); ?>",
                            description: "<?php echo e(__('messages.t_pls_insert_bid_value_between_budget'), false); ?>",
                            icon: 'error'
                        });

                    }

                },

                // Copy project url to clipboard
                copyToClipboard() {

                    var _this = this;

                    // Get input
                    const copyText = document.querySelector("#input-project-url-share");

                    copyText.select()
                    copyText.setSelectionRange(0, 99999)
                    document.execCommand("copy")
                    _this.is_copied = true;
                    setTimeout(() => {
                        _this.is_copied = false;
                    }, 2000);
                },

                // Initialize component
                initialize() {
                    var _this = this;
                    document.addEventListener("DOMContentLoaded", () => {
                        Livewire.hook('message.processed', (message, component) => {
                            if (document.getElementById('bid-amount-input')) {
                                const amount = document.getElementById('bid-amount-input').value;
                                _this.calculateProfit(amount);
                            }
                        })
                    });
                }

            }
        }
        document.addEventListener('livewire:load', () => {
            const bindBidModalTriggers = () => {
                document.querySelectorAll('[data-open-bid-modal]').forEach((button) => {
                    if (button.dataset.bidModalBound === 'true') {
                        return;
                    }

                    button.dataset.bidModalBound = 'true';

                    button.addEventListener('click', (event) => {
                        event.preventDefault();
                        const trigger = document.getElementById('modal-bid-button');

                        if (trigger) {
                            trigger.click();
                        }
                    }, { passive: false });
                });
            };

            bindBidModalTriggers();

            Livewire.hook('message.processed', () => {
                bindBidModalTriggers();
            });
        });

        window.LVoePqYZdmjQURo = LVoePqYZdmjQURo();
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/project/project.blade.php ENDPATH**/ ?>