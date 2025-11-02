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

    <div class="lg:grid lg:grid-cols-12">
        <aside class="lg:col-span-3 py-6 hidden lg:block bg-white shadow-sm border border-gray-200 rounded-lg dark:bg-zinc-800 dark:border-transparent" wire:ignore>
            <?php if (isset($component)) { $__componentOriginal897c321ee9b9bb967400e80c55835c23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal897c321ee9b9bb967400e80c55835c23 = $attributes; } ?>
<?php $component = App\View\Components\Main\Account\Sidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('main.account.sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Main\Account\Sidebar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal897c321ee9b9bb967400e80c55835c23)): ?>
<?php $attributes = $__attributesOriginal897c321ee9b9bb967400e80c55835c23; ?>
<?php unset($__attributesOriginal897c321ee9b9bb967400e80c55835c23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal897c321ee9b9bb967400e80c55835c23)): ?>
<?php $component = $__componentOriginal897c321ee9b9bb967400e80c55835c23; ?>
<?php unset($__componentOriginal897c321ee9b9bb967400e80c55835c23); ?>
<?php endif; ?>
        </aside>

        <div class="lg:col-span-9 lg:ltr:ml-8 lg:rtl:mr-8">
            <div class="w-full mb-16">
                <div class="mx-auto max-w-7xl">
                    <div class="lg:flex lg:items-center lg:justify-between">
                        <div class="min-w-0 flex-1">
                            <div class="mb-3 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6 rtl:space-x-reverse">
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
                                            <svg aria-hidden="true" class="w-4 h-4 text-gray-400 rtl:rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                                            <span class="mx-1 text-sm font-medium text-gray-400 md:mx-2 dark:text-zinc-400">
                                                <?php echo app('translator')->get('messages.t_tracker_activity_review'); ?>
                                            </span>
                                        </div>
                                    </li>
                                </ol>
                            </div>

                            <h2 class="text-lg font-bold leading-7 text-zinc-700 dark:text-gray-50 sm:truncate sm:text-xl sm:tracking-tight">
                                <?php echo e($project->title, false); ?>

                            </h2>
                            <p class="leading-relaxed text-gray-400 mt-1 text-sm">
                                <?php echo app('translator')->get('messages.t_tracker_activity_review_subtitle', ['project' => $project->title]); ?>
                            </p>
                        </div>
                        <div class="mt-5 flex flex-col sm:flex-row gap-3 lg:mt-0 lg:ltr:ml-4 lg:rtl:mr-4">
                            <a href="<?php echo e(url('project/' . $project->pid . '/' . $project->slug), false); ?>" target="_blank" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-500 rounded-sm shadow-sm text-[13px] font-medium text-gray-700 dark:text-zinc-200 bg-white dark:bg-zinc-600 hover:bg-gray-50 dark:hover:bg-zinc-500 focus:outline-none focus:ring-primary-600">
                                <i class="ph-duotone ph-arrow-square-out text-lg ltr:mr-2 rtl:ml-2 text-gray-500 dark:text-zinc-200"></i>
                                <?php echo e(__('messages.t_view_project'), false); ?>

                            </a>
                            <button wire:click="refreshEntries" type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-500 rounded-sm shadow-sm text-[13px] font-medium text-gray-700 dark:text-zinc-200 bg-white dark:bg-zinc-600 hover:bg-gray-50 dark:hover:bg-zinc-500 focus:outline-none focus:ring-primary-600">
                                <i class="ph-duotone ph-arrow-clockwise text-lg ltr:mr-2 rtl:ml-2 text-gray-500 dark:text-zinc-200"></i>
                                <?php echo app('translator')->get('messages.t_refresh'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-10 flex flex-wrap gap-3">
                <a href="<?php echo e(url('account/projects/options/milestones/' . $project->uid), false); ?>"
                   class="inline-flex items-center px-3 py-2 rounded border text-xs font-semibold transition
                        <?php echo e(request()->is('account/projects/options/milestones*')
                            ? 'border-primary-500 bg-primary-50 text-primary-600 dark:border-primary-400 dark:bg-primary-500/20 dark:text-primary-200'
                            : 'border-gray-200 bg-white text-gray-600 hover:border-primary-200 hover:text-primary-600 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300', false); ?>">
                    <i class="ph-duotone ph-flag text-base ltr:mr-1 rtl:ml-1"></i>
                    <?php echo app('translator')->get('messages.t_milestone_payments'); ?>
                </a>
                <a href="<?php echo e(url('account/projects/options/tracker/' . $project->uid), false); ?>"
                   class="inline-flex items-center px-3 py-2 rounded border text-xs font-semibold transition
                        <?php echo e(request()->is('account/projects/options/tracker*')
                            ? 'border-primary-500 bg-primary-50 text-primary-600 dark:border-primary-400 dark:bg-primary-500/20 dark:text-primary-200'
                            : 'border-gray-200 bg-white text-gray-600 hover:border-primary-200 hover:text-primary-600 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300', false); ?>">
                    <i class="ph-duotone ph-monitor-play text-base ltr:mr-1 rtl:ml-1"></i>
                    <?php echo app('translator')->get('messages.t_tracker_activity_review'); ?>
                </a>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-10">
                <div class="rounded-lg border border-gray-200 bg-white dark:bg-zinc-900 dark:border-zinc-700 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400"><?php echo app('translator')->get('messages.t_total_minutes_tracked'); ?></p>
                    <p class="mt-2 text-2xl font-semibold text-gray-800 dark:text-zinc-100"><?php echo e(number_format($summary['total_minutes'] ?? 0), false); ?> <?php echo app('translator')->get('messages.t_minutes'); ?></p>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white dark:bg-zinc-900 dark:border-zinc-700 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400"><?php echo app('translator')->get('messages.t_tracker_pending_segments'); ?></p>
                    <p class="mt-2 text-2xl font-semibold text-amber-600"><?php echo e(number_format($summary['pending'] ?? 0), false); ?></p>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white dark:bg-zinc-900 dark:border-zinc-700 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400"><?php echo app('translator')->get('messages.t_tracker_approved_segments'); ?></p>
                    <p class="mt-2 text-2xl font-semibold text-emerald-600"><?php echo e(number_format($summary['approved'] ?? 0), false); ?></p>
                </div>
                <div class="rounded-lg border border-gray-200 bg-white dark:bg-zinc-900 dark:border-zinc-700 p-4">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-zinc-400"><?php echo app('translator')->get('messages.t_tracker_rejected_segments'); ?></p>
                    <p class="mt-2 text-2xl font-semibold text-rose-600"><?php echo e(number_format($summary['rejected'] ?? 0), false); ?></p>
                </div>
            </div>

            <section class="flex flex-wrap gap-3 mb-8">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = [
                    'pending'  => __('messages.t_pending'),
                    'approved' => __('messages.t_approved'),
                    'rejected' => __('messages.t_rejected'),
                    'all'      => __('messages.t_all'),
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button
                        type="button"
                        wire:click="$set('statusFilter', '<?php echo e($value, false); ?>')"
                        class="inline-flex items-center px-3 py-2 border rounded text-xs font-semibold transition
                            <?php echo e($statusFilter === $value
                                ? 'border-primary-500 bg-primary-50 text-primary-600 dark:border-primary-400 dark:bg-primary-500/20 dark:text-primary-200'
                                : 'border-gray-200 bg-white text-gray-600 hover:border-primary-200 hover:text-primary-600 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300', false); ?>"
                    >
                        <?php echo e($label, false); ?>

                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </section>

            <section class="bg-white dark:bg-zinc-800 shadow-sm border border-gray-200 dark:border-zinc-700 rounded-lg overflow-hidden" wire:poll.60s="refreshEntries">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-zinc-700 flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 dark:text-zinc-100">
                            <?php echo app('translator')->get('messages.t_tracked_sessions'); ?>
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-zinc-400">
                            <?php echo app('translator')->get('messages.t_tracked_sessions_subtitle', [
                                'name' => optional($freelancer)->fullname
                                    ?? optional($freelancer)->username
                                    ?? optional($freelancer)->name
                            ]); ?>
                        </p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                        <thead class="bg-gray-50 dark:bg-zinc-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider"><?php echo app('translator')->get('messages.t_time_range'); ?></th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider"><?php echo app('translator')->get('messages.t_minutes'); ?></th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider"><?php echo app('translator')->get('messages.t_activity'); ?></th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider"><?php echo app('translator')->get('messages.t_status'); ?></th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider"><?php echo app('translator')->get('messages.t_actions'); ?></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-zinc-100">
                                        <div class="flex flex-col">
                                            <span><?php echo e($entry->started_at->timezone(config('app.timezone'))->format('Y-m-d H:i'), false); ?></span>
                                            <span class="text-xs text-gray-400 dark:text-zinc-500">
                                                <?php echo e($entry->ended_at->timezone(config('app.timezone'))->format('Y-m-d H:i'), false); ?>

                                            </span>
                                            <!--[if BLOCK]><![endif]--><?php if($entry->snapshots->isNotEmpty()): ?>
                                                <?php
                                                    $snapshot = $entry->snapshots->first();
                                                ?>
                                                <a href="<?php echo e(\Storage::disk($snapshot->disk)->url($snapshot->image_path), false); ?>" target="_blank" class="mt-1 text-xs text-primary-600 hover:underline">
                                                    <?php echo app('translator')->get('messages.t_view_screenshot'); ?>
                                                </a>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-zinc-100">
                                        <?php echo e(number_format($entry->duration_minutes), false); ?>

                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold
                                            <?php echo e($entry->activity_score >= 60 ? 'bg-emerald-100 text-emerald-700' :
                                                ($entry->activity_score >= 30 ? 'bg-amber-100 text-amber-700' : 'bg-rose-100 text-rose-700'), false); ?>">
                                            <?php echo e($entry->activity_score, false); ?>%
                                        </span>
                                        <!--[if BLOCK]><![endif]--><?php if($entry->low_activity): ?>
                                            <span class="ml-2 text-xs text-rose-500"><?php echo app('translator')->get('messages.t_low_activity_flag'); ?></span>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <?php
                                            $statusClasses = match($entry->client_status->value) {
                                                'approved' => 'bg-emerald-100 text-emerald-700',
                                                'rejected' => 'bg-rose-100 text-rose-700',
                                                default    => 'bg-amber-100 text-amber-700',
                                            };
                                        ?>
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold <?php echo e($statusClasses, false); ?>">
                                            <?php echo app('translator')->get("messages.t_status_{$entry->client_status->value}"); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex flex-col sm:flex-row gap-2">
                                            <!--[if BLOCK]><![endif]--><?php if($entry->client_status === \App\Enums\TimeEntryClientStatus::Pending): ?>
                                                <button wire:click="approveEntry(<?php echo e($entry->id, false); ?>)" type="button" class="inline-flex items-center px-3 py-1.5 border border-emerald-500 text-emerald-600 text-xs font-semibold rounded hover:bg-emerald-50 dark:hover:bg-emerald-500/10">
                                                    <i class="ph-duotone ph-check-circle text-base ltr:mr-1 rtl:ml-1"></i>
                                                    <?php echo app('translator')->get('messages.t_approve'); ?>
                                                </button>
                                                <button wire:click="startReject(<?php echo e($entry->id, false); ?>)" type="button" class="inline-flex items-center px-3 py-1.5 border border-rose-500 text-rose-600 text-xs font-semibold rounded hover:bg-rose-50 dark:hover:bg-rose-500/10">
                                                    <i class="ph-duotone ph-x-circle text-base ltr:mr-1 rtl:ml-1"></i>
                                                    <?php echo app('translator')->get('messages.t_reject'); ?>
                                                </button>
                                            <?php else: ?>
                                                <span class="text-xs text-gray-400 dark:text-zinc-500">
                                                    <?php echo e($entry->client_reviewed_at?->timezone(config('app.timezone'))->format('Y-m-d H:i'), false); ?>

                                                </span>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                        <!--[if BLOCK]><![endif]--><?php if($rejectEntryId === $entry->id): ?>
                                            <div class="mt-3 space-y-2">
                                                <textarea wire:model.defer="rejectNotes" rows="3" class="w-full border-gray-300 dark:border-zinc-700 dark:bg-zinc-900 text-sm rounded" placeholder="<?php echo app('translator')->get('messages.t_add_rejection_note_placeholder'); ?>"></textarea>
                                                <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['rejectNotes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <p class="text-xs text-rose-500"><?php echo e($message, false); ?></p>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                                <div class="flex gap-2">
                                                    <button wire:click="rejectEntry" type="button" class="inline-flex items-center px-3 py-1.5 bg-rose-600 text-white text-xs font-semibold rounded hover:bg-rose-700">
                                                        <?php echo app('translator')->get('messages.t_submit_decision'); ?>
                                                    </button>
                                                    <button wire:click="cancelReject" type="button" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-gray-600 text-xs font-semibold rounded hover:bg-gray-50">
                                                        <?php echo app('translator')->get('messages.t_cancel'); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        <!--[if BLOCK]><![endif]--><?php if($entry->client_notes): ?>
                                            <p class="mt-2 text-xs text-gray-500 dark:text-zinc-400">
                                                <span class="font-semibold"><?php echo app('translator')->get('messages.t_client_note'); ?>:</span>
                                                <?php echo e($entry->client_notes, false); ?>

                                            </p>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-zinc-400">
                                        <?php echo app('translator')->get('messages.t_no_tracked_sessions_yet'); ?>
                                    </td>
                                </tr>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/account/projects/options/tracker.blade.php ENDPATH**/ ?>