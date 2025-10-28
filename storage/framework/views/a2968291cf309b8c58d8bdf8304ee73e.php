<div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 mt-[7rem] py-12 lg:pt-16 lg:pb-24">
    <div
        class="bg-white dark:bg-slate-950 dark:bg-[radial-gradient(circle_at_top,_var(--tw-gradient-stops))] dark:from-primary-900/30 dark:via-slate-950 dark:to-slate-950">
        <div class="mx-auto max-w-7xl px-4 pb-16 pt-28 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-5">
                <div class="space-y-6 lg:col-span-3">
                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-primary-100 bg-primary-50 px-4 py-2 text-xs font-semibold uppercase tracking-[0.25em] text-primary-600 dark:border-white/10 dark:bg-white/5 dark:text-white/80 dark:backdrop-blur">
                        <i class="ph-duotone ph-sparkle text-base"></i>
                        <?php echo e(__('messages.t_freelancers_directory_tagline'), false); ?>

                    </div>
                    <h1 class="text-4xl font-bold leading-tight text-slate-900 dark:text-white sm:text-5xl">
                        <?php echo e(__('messages.t_freelancers_directory_title'), false); ?>

                    </h1>
                    <p class="text-lg text-slate-600 dark:text-white/70 sm:max-w-2xl">
                        <?php echo e(__('messages.t_freelancers_directory_subtitle'), false); ?>

                    </p>
                    <div
                        class="w-full rounded-2xl border border-slate-200/70 bg-white p-4 shadow-xl shadow-primary-500/10 dark:border-white/10 dark:bg-white/10 dark:backdrop-blur">
                        <div
                            class="flex items-center gap-3 rounded-xl bg-white px-4 py-3 shadow-lg shadow-primary-500/10 dark:bg-zinc-900">
                            <i class="ph-duotone ph-magnifying-glass text-xl text-primary-600"></i>
                            <input type="search" wire:model.debounce.450ms="search"
                                placeholder="<?php echo e(__('messages.t_freelancers_directory_search_placeholder'), false); ?>"
                                class="w-full border-none bg-transparent text-base font-semibold text-slate-800 placeholder:text-slate-400 focus:outline-none focus:ring-0 dark:text-zinc-100 dark:placeholder:text-zinc-400" />
                            <!--[if BLOCK]><![endif]--><?php if($search): ?>
                                <button type="button" wire:click="$set('search', '')"
                                    class="text-sm font-semibold text-primary-600 hover:text-primary-500 dark:text-primary-300">
                                    <?php echo e(__('messages.t_clear'), false); ?>

                                </button>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                        <div class="mt-4 flex flex-wrap gap-3 text-sm text-slate-600 dark:text-white/70">
                            <div
                                class="inline-flex items-center gap-2 rounded-full bg-primary-50 px-3 py-1 text-primary-700 dark:bg-white/10 dark:text-white">
                                <i
                                    class="ph-duotone ph-users-three text-base text-primary-500 dark:text-primary-200"></i>
                                <span><?php echo e(__('messages.t_freelancers_directory_metric_profiles', ['count' => number_format($freelancers->total())]), false); ?></span>
                            </div>
                            <div
                                class="inline-flex items-center gap-2 rounded-full bg-amber-50 px-3 py-1 text-amber-600 dark:bg-white/10 dark:text-white">
                                <i class="ph-duotone ph-star text-base text-amber-500 dark:text-amber-300"></i>
                                <span><?php echo e(__('messages.t_freelancers_directory_metric_average_rating'), false); ?></span>
                            </div>
                            <div
                                class="inline-flex items-center gap-2 rounded-full bg-sky-50 px-3 py-1 text-sky-600 dark:bg-white/10 dark:text-white">
                                <i class="ph-duotone ph-globe text-base text-sky-500 dark:text-sky-300"></i>
                                <span><?php echo e(__('messages.t_freelancers_directory_metric_countries', ['count' => number_format($countries->count())]), false); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-2">
                    <div
                        class="relative overflow-hidden rounded-2xl border border-slate-200/60 bg-white p-6 text-slate-600 shadow-2xl shadow-primary-500/10 dark:border-white/10 dark:bg-white/5 dark:text-white/80 dark:backdrop-blur">
                        <div
                            class="pointer-events-none absolute -right-10 -top-10 h-32 w-32 rounded-full bg-primary-500/40 blur-3xl">
                        </div>
                        <div class="space-y-4">
                            <h2 class="text-lg font-semibold text-slate-900 dark:text-white">
                                <?php echo e(__('messages.t_freelancers_directory_filters_heading'), false); ?>

                            </h2>
                            <p class="text-sm text-slate-500 dark:text-white/60">
                                <?php echo e(__('messages.t_freelancers_directory_filters_copy'), false); ?>

                            </p>
                            <div class="flex flex-wrap gap-3">
                                <button type="button" wire:click="clearFilters"
                                    class="inline-flex items-center rounded-full border border-primary-100 bg-primary-50 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.2em] text-primary-600 transition hover:bg-primary-100/80 dark:border-white/20 dark:bg-white/10 dark:text-white dark:hover:bg-white/20">
                                    <i class="ph-duotone ph-arrow-counter-clockwise text-base ltr:mr-2 rtl:ml-2"></i>
                                    <?php echo e(__('messages.t_freelancers_directory_clear_filters'), false); ?>

                                </button>
                                <label
                                    class="inline-flex items-center gap-2 rounded-full border border-emerald-100 bg-emerald-50 px-4 py-1.5 text-sm font-medium text-emerald-700 transition hover:bg-emerald-100/80 dark:border-white/20 dark:bg-white/10 dark:text-white">
                                    <input type="checkbox" wire:model="online"
                                        class="h-4 w-4 rounded border-emerald-200 bg-white text-emerald-500 focus:ring-emerald-500 dark:border-white/30 dark:bg-white/10">
                                    <span><?php echo e(__('messages.t_freelancers_directory_filter_online'), false); ?></span>
                                </label>
                            </div>
                            <div class="mt-6 grid gap-4">
                                <div>
                                    <h3
                                        class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400 dark:text-white/50">
                                        <?php echo e(__('messages.t_freelancers_directory_filter_rating'), false); ?>

                                    </h3>
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = [5, 4, 3]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $threshold): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <button type="button"
                                                wire:click="$set('rating', <?php echo e($rating === $threshold ? 'null' : $threshold, false); ?>)"
                                                class="inline-flex items-center gap-2 rounded-full border px-3 py-1 text-sm font-semibold transition <?php echo e($rating === $threshold ? 'border-amber-400 bg-amber-100 text-amber-700 dark:bg-amber-100/20 dark:text-amber-200' : 'border-slate-200 bg-white text-slate-600 hover:border-primary-200 hover:text-primary-600 dark:border-white/20 dark:bg-white/5 dark:text-white/70 dark:hover:border-white/40 dark:hover:text-white', false); ?>">
                                                <i class="ph-duotone ph-star text-base"></i>
                                                <?php echo e($threshold, false); ?>+
                                            </button>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>

                                <div>
                                    <h3
                                        class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400 dark:text-white/50">
                                        <?php echo e(__('messages.t_freelancers_directory_filter_country'), false); ?>

                                    </h3>
                                    <select wire:model="country"
                                        class="mt-3 block w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 outline-none shadow-sm focus:border-primary-400 focus:ring-2 focus:ring-primary-200 dark:border-white/15 dark:bg-white/10 dark:text-white/80 dark:focus:ring-0">
                                        <option value="">
                                            <?php echo e(__('messages.t_all_countries'), false); ?>

                                        </option>
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($option->id, false); ?>" class="text-slate-900">
                                                <?php echo e($option->name, false); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </select>
                                </div>

                                <div>
                                    <h3
                                        class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400 dark:text-white/50">
                                        <?php echo e(__('messages.t_freelancers_directory_filter_level'), false); ?>

                                    </h3>
                                    <select wire:model="level"
                                        class="mt-3 block w-full rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 outline-none shadow-sm focus:border-primary-400 focus:ring-2 focus:ring-primary-200 dark:border-white/15 dark:bg-white/10 dark:text-white/80 dark:focus:ring-0">
                                        <option value="">
                                            <?php echo e(__('messages.t_all_levels'), false); ?>

                                        </option>
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projectLevel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($projectLevel->id, false); ?>" class="text-slate-900">
                                                <?php echo e($projectLevel->label, false); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </select>
                                </div>

                                <div>
                                    <div class="flex items-center justify-between">
                                        <h3
                                            class="text-xs font-semibold uppercase tracking-[0.35em] text-slate-400 dark:text-white/50">
                                            <?php echo e(__('messages.t_freelancers_directory_filter_skills'), false); ?>

                                        </h3>
                                        <!--[if BLOCK]><![endif]--><?php if(!empty($selectedSkills)): ?>
                                            <button type="button" wire:click="$set('selectedSkills', [])"
                                                class="text-[11px] font-semibold uppercase tracking-[0.25em] text-slate-400 hover:text-slate-700 dark:text-white/60 dark:hover:text-white">
                                                <?php echo e(__('messages.t_clear'), false); ?>

                                            </button>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $trendingSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $isSelected = in_array($skill->slug, $selectedSkills);
                                            ?>
                                            <button type="button" wire:click="toggleSkill('<?php echo e($skill->slug, false); ?>')"
                                                class="inline-flex items-center gap-2 rounded-full border px-3 py-1 text-xs font-semibold transition <?php echo e($isSelected ? 'border-primary-400 bg-primary-100 text-primary-700 dark:bg-primary-500/20 dark:text-primary-100' : 'border-slate-200 bg-white text-slate-600 hover:border-primary-200 hover:text-primary-600 dark:border-white/15 dark:bg-white/5 dark:text-white/70 dark:hover:border-white/40 dark:hover:text-white', false); ?>">
                                                <i
                                                    class="ph-duotone <?php echo e($isSelected ? 'ph-check-circle' : 'ph-plus-circle', false); ?> text-sm"></i>
                                                <?php echo e($skill->name, false); ?>

                                            </button>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative -mt-12 pb-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-[280px_minmax(0,1fr)] lg:gap-12">
                <aside
                    class="hidden rounded-3xl border border-slate-200/70 bg-white p-6 shadow-lg dark:border-zinc-700 dark:bg-zinc-900 lg:block">
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm font-semibold uppercase tracking-[0.25em] text-slate-500 dark:text-zinc-300">
                            <?php echo e(__('messages.t_freelancers_directory_sort_label'), false); ?>

                        </h2>
                    </div>
                    <div class="mt-5 space-y-2">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $sortOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button" wire:click="applySort('<?php echo e($option->value, false); ?>')"
                                class="flex w-full items-center justify-between rounded-xl px-4 py-2 text-sm font-semibold transition <?php echo e($sort === $option->value ? 'bg-primary-50 text-primary-700 shadow-sm ring-1 ring-primary-500/20 dark:bg-primary-500/10 dark:text-primary-200' : 'text-slate-600 hover:bg-slate-100 dark:text-zinc-200 dark:hover:bg-zinc-800', false); ?>">
                                <span><?php echo e($option->label(), false); ?></span>
                                <!--[if BLOCK]><![endif]--><?php if($sort === $option->value): ?>
                                    <i class="ph-duotone ph-check-circle text-lg"></i>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </aside>

                <main class="min-w-0">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <h2 class="text-lg font-semibold text-slate-800 dark:text-zinc-100">
                                <?php echo e(__('messages.t_freelancers_directory_results_title', ['count' => number_format($freelancers->total())]), false); ?>

                            </h2>
                            <p class="text-sm text-slate-500 dark:text-zinc-400">
                                <?php echo e(__('messages.t_freelancers_directory_results_subtitle'), false); ?>

                            </p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="relative inline-flex lg:hidden">
                                <select wire:model="sort"
                                    class="rounded-xl border border-slate-200 bg-white py-2 pl-3 pr-10 text-sm font-semibold text-slate-700 shadow-sm focus:border-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500/40 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100">
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $sortOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($option->value, false); ?>"><?php echo e($option->label(), false); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </select>
                                <i
                                    class="ph-duotone ph-caret-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            </div>
                            <div wire:loading.flex wire:target="search,selectedSkills,country,level,rating,sort,online"
                                class="hidden items-center gap-2 rounded-full border border-primary-200 bg-primary-50 px-4 py-1.5 text-sm font-semibold text-primary-700 dark:border-primary-500/40 dark:bg-primary-500/15 dark:text-primary-100 md:inline-flex">
                                <svg class="h-4 w-4 animate-spin text-primary-500" viewBox="0 0 100 101" fill="none">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="#E5E7EB" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentColor" />
                                </svg>
                                <span><?php echo e(__('messages.t_updating'), false); ?></span>
                            </div>
                        </div>
                    </div>

                    <!--[if BLOCK]><![endif]--><?php if(!empty($selectedSkills)): ?>
                        <div class="mt-6 flex flex-wrap gap-2">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $selectedSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        $label = optional($trendingSkills->firstWhere('slug', $slug))->name ?? $slug;
                                                    ?>
                                 <span
                                                        class="inline-flex items-center gap-2 rounded-full bg-primary-50 px-3 py-1 text-xs font-semibold text-primary-700 dark:bg-primary-500/15 dark:text-primary-100">
                                                        <i class="ph-duotone ph-tag text-sm"></i>
                                                        <?php echo e($label, false); ?>

                                                        <button type="button" wire:click="removeSkill('<?php echo e($slug, false); ?>')"
                                                            class="ml-1 text-sm text-primary-700/70 hover:text-primary-900 dark:text-primary-100/80">
                                                            <i class="ph-duotone ph-x-circle text-base"></i>
                                                        </button>
                                                    </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                    <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $freelancers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $freelancer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <article
                                class="group relative flex h-full flex-col overflow-hidden rounded-3xl border border-slate-200/80 bg-white p-6 shadow-lg transition hover:-translate-y-1 hover:border-primary-200 hover:shadow-xl dark:border-zinc-700 dark:bg-zinc-900">
                                <div class="flex items-start gap-4">
                                    <div class="relative">
                                        <img src="<?php echo e(src($freelancer->avatar?->path, 'avatar.jpg'), false); ?>"
                                            alt="<?php echo e($freelancer->username, false); ?>"
                                            class="h-14 w-14 rounded-2xl object-cover ring-2 ring-primary-500/10" />
                                        <!--[if BLOCK]><![endif]--><?php if($freelancer->last_activity && $freelancer->last_activity >= now()->subMinutes(10)): ?>
                                            <span
                                                class="absolute -bottom-1 -right-1 inline-flex h-5 w-5 items-center justify-center rounded-full bg-emerald-500 text-[10px] font-semibold text-white shadow ring-2 ring-white dark:ring-zinc-900">
                                                ●
                                            </span>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2">
                                            <a href="<?php echo e(url('profile/' . $freelancer->username), false); ?>"
                                                class="truncate text-lg font-semibold text-slate-900 hover:text-primary-600 dark:text-zinc-100 dark:hover:text-primary-300">
                                                <?php echo e($freelancer->fullname ?: $freelancer->username, false); ?>

                                            </a>
                                            <!--[if BLOCK]><![endif]--><?php if($freelancer->freelancerProjectLevel): ?>
                                                <span
                                                    class="inline-flex items-center gap-1 rounded-full px-2 py-0.5 text-xs font-semibold"
                                                    style="background-color: <?php echo e($freelancer->freelancerProjectLevel->badge_color, false); ?>; color: <?php echo e($freelancer->freelancerProjectLevel->text_color, false); ?>;">
                                                    <i class="ph-duotone ph-medal text-sm"></i>
                                                    <?php echo e($freelancer->freelancerProjectLevel->label, false); ?>

                                                </span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                        <div
                                            class="mt-1 flex flex-wrap items-center gap-3 text-sm text-slate-500 dark:text-zinc-400">
                                            <span class="inline-flex items-center gap-1 font-semibold text-amber-500">
                                                <i class="ph-duotone ph-star text-base"></i>
                                                <?php echo e(number_format($freelancer->project_rating_avg, 1), false); ?>

                                            </span>
                                            <span><?php echo e(trans_choice('messages.t_reviews_count', (int) $freelancer->project_reviews_count, ['value' => number_format($freelancer->project_reviews_count)]), false); ?></span>
                                            <!--[if BLOCK]><![endif]--><?php if($freelancer->country): ?>
                                                <span class="inline-flex items-center gap-1">
                                                    <i class="ph-duotone ph-map-pin text-base"></i>
                                                    <?php echo e($freelancer->country->name, false); ?>

                                                </span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                    </div>
                                </div>

                                <!--[if BLOCK]><![endif]--><?php if($freelancer->headline): ?>
                                    <p class="mt-4 line-clamp-3 text-sm text-slate-600 dark:text-zinc-300">
                                        <?php echo e($freelancer->headline, false); ?>

                                    </p>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                <div class="mt-4 flex flex-wrap gap-2">
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $freelancer->skills->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700 dark:bg-zinc-800 dark:text-zinc-200">
                                            <i class="ph-duotone ph-lightning text-sm text-primary-500"></i>
                                            <?php echo e($skill->name, false); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>

                                <div class="mt-auto">
                                    <div
                                        class="rounded-2xl border border-primary-100 bg-primary-50/70 px-4 py-3 text-xs font-semibold text-primary-700 dark:border-primary-500/30 dark:bg-primary-500/10 dark:text-primary-100">
                                        <?php echo e(__('messages.t_freelancers_directory_filters_copy'), false); ?>

                                    </div>
                                    <dl
                                        class="mt-4 grid grid-cols-2 gap-3 rounded-2xl border border-slate-200/80 bg-slate-50/60 p-4 text-sm font-semibold text-slate-600 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-200">
                                        <div>
                                            <dt
                                                class="text-xs font-medium uppercase tracking-[0.25em] text-slate-400 dark:text-zinc-500">
                                                <?php echo e(__('messages.t_freelancers_card_reviews'), false); ?>

                                            </dt>
                                            <dd class="mt-1 text-base text-slate-900 dark:text-zinc-100">
                                                <?php echo e(number_format($freelancer->project_reviews_count), false); ?>

                                            </dd>
                                        </div>
                                        <div>
                                            <dt
                                                class="text-xs font-medium uppercase tracking-[0.25em] text-slate-400 dark:text-zinc-500">
                                                <?php echo e(__('messages.t_freelancers_card_last_active'), false); ?>

                                            </dt>
                                            <dd class="mt-1 text-base text-slate-900 dark:text-zinc-100">
                                                <?php echo e($freelancer->last_activity ? format_date($freelancer->last_activity, 'ago') : __('messages.t_recently_joined'), false); ?>

                                            </dd>
                                        </div>
                                    </dl>
                                </div>

                                <div class="mt-6 flex flex-col gap-3">
                                    <a href="<?php echo e(url('profile/' . $freelancer->username), false); ?>"
                                        class="inline-flex items-center gap-2 rounded-xl border border-primary-500/30 bg-primary-500/10 px-4 py-2 text-sm font-semibold text-primary-700 transition hover:bg-primary-500 hover:text-white dark:border-primary-500/40 dark:bg-primary-500/15 dark:text-primary-100 dark:hover:bg-primary-500">
                                        <i class="ph-duotone ph-user-circle text-lg"></i>
                                        <?php echo e(__('messages.t_freelancers_card_profile'), false); ?>

                                    </a>
                                    <!--[if BLOCK]><![endif]--><?php if($customOffersEnabled): ?>
                                        <a href="<?php echo e(route('invite.freelancer', ['username' => $freelancer->username]), false); ?>"
                                            class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700 dark:bg-zinc-700 dark:hover:bg-zinc-600">
                                            <i class="ph-duotone ph-paper-plane-tilt text-lg"></i>
                                            <?php echo e(__('messages.t_freelancers_card_invite'), false); ?>

                                        </a>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div
                                class="col-span-full rounded-3xl border border-dashed border-slate-300 bg-white px-10 py-20 text-center shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                                <div
                                    class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-primary-100 text-primary-600 dark:bg-primary-500/10 dark:text-primary-200">
                                    <i class="ph-duotone ph-binoculars text-3xl"></i>
                                </div>
                                <h3 class="mt-6 text-2xl font-semibold text-slate-900 dark:text-zinc-100">
                                    <?php echo e(__('messages.t_freelancers_directory_empty_title'), false); ?>

                                </h3>
                                <p class="mt-2 text-sm text-slate-500 dark:text-zinc-400">
                                    <?php echo e(__('messages.t_freelancers_directory_empty_subtitle'), false); ?>

                                </p>
                                <div class="mt-6 flex flex-wrap justify-center gap-3">
                                    <button type="button" wire:click="clearFilters"
                                        class="inline-flex items-center gap-2 rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-50 dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800">
                                        <i class="ph-duotone ph-arrow-counter-clockwise text-lg"></i>
                                        <?php echo e(__('messages.t_freelancers_directory_reset_cta'), false); ?>

                                    </button>
                                </div>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    <div class="mt-10">
                        <?php echo $freelancers->links('pagination::tailwind'); ?>

                    </div>
                </main>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/sellers/browse.blade.php ENDPATH**/ ?>