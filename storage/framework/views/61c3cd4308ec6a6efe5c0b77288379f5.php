<div class="w-full">

    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-12 mb-16">
        <div class="mx-auto max-w-7xl">
            <div class="lg:flex lg:items-center lg:justify-between">

                <div class="min-w-0 flex-1">

                    
                    <h2 class="text-lg font-bold leading-7 text-zinc-700 dark:text-gray-50 sm:truncate sm:text-xl sm:tracking-tight">
                        <?php echo app('translator')->get('messages.t_welcome_back'); ?>, <?php echo e(auth()->user()->fullname ?? auth()->user()->username, false); ?>!
                    </h2>

                    
                    <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6 rtl:space-x-reverse">

                        
                        <?php if(auth()->user()->status === 'verified'): ?>
                            <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-zinc-200">
                                <svg class="ltr:mr-1.5 rtl:ml-1.5 -mt-0.5 h-4.5 w-4.5 flex-shrink-0 text-gray-400 dark:text-zinc-300" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g><path fill="none" d="M0 0H24V24H0z"></path><path d="M12 1l8.217 1.826c.457.102.783.507.783.976v9.987c0 2.006-1.003 3.88-2.672 4.992L12 23l-6.328-4.219C4.002 17.668 3 15.795 3 13.79V3.802c0-.469.326-.874.783-.976L12 1zm4.452 7.222l-4.95 4.949-2.828-2.828-1.414 1.414L11.503 16l6.364-6.364-1.415-1.414z"></path></g></svg>
                                <?php echo app('translator')->get('messages.t_verified_account'); ?>
                            </div>
                        <?php endif; ?>

                        
                        <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-zinc-200">
                                <svg class="ltr:mr-1.5 rtl:ml-1.5 -mt-0.5 h-4.5 w-4.5 flex-shrink-0 text-gray-400 dark:text-zinc-300" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M2 9h19a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V9zm1-6h15v4H2V4a1 1 0 0 1 1-1zm12 11v2h3v-2h-3z"></path></g></svg>
                                <?php echo e(money(auth()->user()->balance_available, settings('currency')->code, true), false); ?>

                        </div>

                        
                        <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-zinc-200">
                            <svg class="ltr:mr-1.5 rtl:ml-1.5 -mt-0.5 h-4.5 w-4.5 flex-shrink-0 text-gray-400 dark:text-zinc-300" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M2 11h20v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-9zm15-8h4a1 1 0 0 1 1 1v5H2V4a1 1 0 0 1 1-1h4V1h2v2h6V1h2v2z"></path></g></svg>
                            <?php echo app('translator')->get('messages.t_member_since'); ?> <?php echo e(format_date(auth()->user()->created_at, config('carbon-formats.F_d,_Y')), false); ?>

                        </div>

                    </div>

                </div>

                
                <div class="mt-5 sm:flex justify-between lg:mt-0 lg:ltr::ml-4 lg:rtl:mr-4">

					
					<span class="block">
                        <a href="<?php echo e(url('/'), false); ?>" class="inline-flex items-center rounded-sm border border-gray-300 bg-white px-4 py-2 text-[13px] font-semibold text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 dark:bg-zinc-800 dark:border-zinc-800 dark:text-zinc-100 dark:hover:bg-zinc-900 dark:focus:ring-offset-zinc-900 dark:focus:ring-zinc-900 whitespace-nowrap">
                            <?php echo app('translator')->get('messages.t_switch_to_buying'); ?>
                        </a>
                    </span>

				</div>

            </div>
        </div>
    </div>

    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-12">

		
		<div class="mt-4 grid grid-cols-12 gap-4 sm:mt-5 lg:mt-6 sm:gap-y-5 lg:gap-y-6 sm:gap-x-6 lg:gap-x-12">

			
			<div class="col-span-12 xl:col-span-8">
				<div class="grid grid-cols-2 gap-4 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 sm:gap-5 lg:gap-6">

					
					<div class="rounded-lg border border-slate-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 shadow-sm p-3 flex flex-col justify-between">
						<div class="flex justify-between space-x-1 rtl:space-x-reverse">
							<p class="text-lg font-bold text-zinc-700 dark:text-zinc-100">
								<?php echo e(money($earnings, settings('currency')->code, true), false); ?>

							</p>
							<div class="w-9 h-9 flex items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-700">
								<svg class="h-5 w-5 shrink-0 text-zinc-600 dark:text-zinc-300" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"xmlns="http://www.w3.org/2000/svg"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M10 20H6v2H4v-2H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h7V1.59a.5.5 0 0 1 .582-.493l10.582 1.764a1 1 0 0 1 .836.986V6h1v2h-1v7h1v2h-1v2.153a1 1 0 0 1-.836.986L20 20.333V22h-2v-1.333l-7.418 1.236A.5.5 0 0 1 10 21.41V20zm2-.36l8-1.334V4.694l-8-1.333v16.278zM16.5 14c-.828 0-1.5-1.12-1.5-2.5S15.672 9 16.5 9s1.5 1.12 1.5 2.5-.672 2.5-1.5 2.5z"></path></g></svg>
							</div>
						</div>
						<p class="mt-1 text-[13px] text-gray-500 dark:text-zinc-300 font-medium"><?php echo app('translator')->get('messages.t_earnings'); ?></p>
					</div>

					
					<div class="rounded-lg border border-slate-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 shadow-sm p-3 flex flex-col justify-between">
						<div class="flex justify-between space-x-1 rtl:space-x-reverse">
							<p class="text-lg font-bold text-zinc-700 dark:text-zinc-100">
								<?php echo e(money(convertToNumber(auth()->user()->balance_pending), settings('currency')->code, true), false); ?>

							</p>
							<div class="w-9 h-9 flex items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-700">
								<svg class="h-5 w-5 shrink-0 text-zinc-600 dark:text-zinc-300" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.484 2.17a.75.75 0 011.032 0 11.209 11.209 0 007.877 3.08.75.75 0 01.722.515 12.74 12.74 0 01.635 3.985c0 5.942-4.064 10.933-9.563 12.348a.749.749 0 01-.374 0C6.314 20.683 2.25 15.692 2.25 9.75c0-1.39.223-2.73.635-3.985a.75.75 0 01.722-.516l.143.001c2.996 0 5.718-1.17 7.734-3.08zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zM12 15a.75.75 0 00-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 00.75-.75v-.008a.75.75 0 00-.75-.75H12z" clip-rule="evenodd"></path></svg>
							</div>
						</div>
						<p class="mt-1 text-[13px] text-gray-500 dark:text-zinc-300 font-medium"><?php echo app('translator')->get('messages.t_pending_clearance'); ?></p>
					</div>

					
					<div class="rounded-lg border border-slate-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 shadow-sm p-3 flex flex-col justify-between">
						<div class="flex justify-between space-x-1 rtl:space-x-reverse">
							<p class="text-lg font-bold text-zinc-700 dark:text-zinc-100">
								<?php echo e(number_format($awarded_projects, 0, ".", " "), false); ?>

							</p>
							<div class="w-9 h-9 flex items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-700">
								<svg class="h-5 w-5 shrink-0 text-zinc-600 dark:text-zinc-300" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g><path fill="none" d="M0 0h24v24H0z"></path><path d="M14 20v2H2v-2h12zM14.586.686l7.778 7.778L20.95 9.88l-1.06-.354L17.413 12l5.657 5.657-1.414 1.414L16 13.414l-2.404 2.404.283 1.132-1.415 1.414-7.778-7.778 1.415-1.414 1.13.282 6.294-6.293-.353-1.06L14.586.686z"></path></g></svg>
							</div>
						</div>
						<p class="mt-1 text-[13px] text-gray-500 dark:text-zinc-300 font-medium"><?php echo app('translator')->get('messages.t_awarded_projects'); ?></p>
					</div>

				</div>
			</div>

			
			<div class="col-span-12 xl:col-span-4">
				<div class="rounded-lg border border-slate-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 shadow-sm px-4 py-4 sm:px-5">

					
					<div class="mb-4 flex h-8 items-center justify-between">
						<h2 class="font-black uppercase tracking-wider text-zinc-700 text-sm dark:text-zinc-100">
							<?php echo app('translator')->get('messages.t_new_messages'); ?>
						</h2>
					</div>

					
					<div class="space-y-4">
						<?php $__empty_1 = true; $__currentLoopData = $latest_messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
							<a href="<?php echo e(url('inbox', $message['uid']), false); ?>" class="flex cursor-pointer items-center justify-between space-x-2 rtl:space-x-reverse">

								<div class="flex items-center space-x-3 rtl:space-x-reverse">

									
									<div class="h-10 w-10">
										<img class="rounded-full object-contain" src="<?php echo e($message['avatar'], false); ?>" alt="<?php echo e($message['username'], false); ?>">
									</div>

									
									<div>
										<div class="flex items-center">
											<p class="font-semibold text-sm text-slate-700 dark:text-zinc-300 mb-1">
												<?php echo e($message['username'], false); ?>

											</p>
										</div>
										<p class="text-xs text-slate-400 truncate block max-w-[180px]">
											<?php if($message['message']['attachment']): ?>
												<div class="flex items-center space-x-1 rtl:space-x-reverse text-xs text-slate-400">
													<svg class="w-4 h-4" stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 20 20" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path></svg>
													<span><?php echo app('translator')->get('messages.t_attachment'); ?></span>
												</div>
											<?php else: ?>
												<?php echo e($message['message']['body'], false); ?>

											<?php endif; ?>
										</p>
									</div>

								</div>

								
								<div class="hover:text-primary-600 focus:text-primary-600 text-slate-500">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 rtl:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
								</div>

							</a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
							<span class="text-gray-400 text-sm"><?php echo app('translator')->get('messages.t_no_messages_yet'); ?></span>
						<?php endif; ?>
					</div>

				</div>
			</div>

		</div>

		
		<?php if(settings('projects')->is_enabled && $latest_awarded_projects && $latest_awarded_projects->count()): ?>
			<div class="w-full mt-8 md:mt-12">

				
				<div class="items-center block h-10 intro-y sm:flex">
					<h2 class="font-black uppercase tracking-wider text-zinc-700 text-sm truncate dark:text-white"><?php echo app('translator')->get('messages.t_latest_awarded_projects'); ?></h2>
				</div>

				
				<div class="mt-8 overflow-x-auto overflow-y-hidden sm:mt-0 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 dark:scrollbar-thumb-zinc-800 dark:scrollbar-track-zinc-600">
					<table class="w-full text-left border-spacing-y-[10px] border-separate sm:mt-2">
						<thead class="">
							<tr class="bg-slate-200 dark:bg-zinc-600">

								
								<th class="font-bold tracking-wider text-gray-600 px-5 py-4.5 border-b-0 whitespace-nowrap text-xs uppercase dark:text-zinc-300 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md rtl:text-right"><?php echo app('translator')->get('messages.t_project'); ?></th>

								
								<th class="font-bold tracking-wider text-gray-600 px-5 py-4.5 text-center border-b-0 whitespace-nowrap text-xs uppercase dark:text-zinc-300 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md"><?php echo app('translator')->get('messages.t_status'); ?></th>

								
								<th class="font-bold tracking-wider text-gray-600 px-5 py-4.5 text-center border-b-0 whitespace-nowrap text-xs uppercase dark:text-zinc-300 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md"><?php echo app('translator')->get('messages.t_my_proposal'); ?></th>

								
								<th class="font-bold tracking-wider text-gray-600 px-5 py-4.5 text-center border-b-0 whitespace-nowrap text-xs uppercase dark:text-zinc-300 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md"><?php echo app('translator')->get('messages.t_awarded_date'); ?></th>

							</tr>
						</thead>
						<thead>
							<?php $__currentLoopData = $latest_awarded_projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr class="intro-x shadow-sm bg-white dark:bg-zinc-800 rounded-md h-16" wire:key="freelancer-dashboard-latest-projects-<?php echo e($project->uid, false); ?>">

									
									<td class="px-5 py-3 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md w-60 rtl:text-right">
										<a href="<?php echo e(url('project/' . $project->pid . '/' . $project->slug), false); ?>" class="font-medium whitespace-nowrap truncate block max-w-sm hover:text-primary-600 dark:text-white text-sm" title="<?php echo e($project->title, false); ?>">
											<?php echo e($project->title, false); ?>

										</a>
									</td>

									
									<td class="px-5 py-3 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md w-40 text-center">
										<?php switch($project->status):

											
											case ('pending_final_review'): ?>
												<span class="inline-flex dark:bg-transparent items-center px-2.5 py-1 rounded-sm text-xs font-medium bg-amber-50 text-amber-800 dark:text-amber-500 tracking-wide whitespace-nowrap">
													<?php echo e(__('messages.t_pending_final_review'), false); ?>

												</span>
												<?php break; ?>

											
											<?php case ('active'): ?>
												<span class="inline-flex dark:bg-transparent items-center px-2.5 py-1 rounded-sm text-xs font-medium bg-blue-50 text-blue-800 dark:text-blue-500 tracking-wide whitespace-nowrap">
													<?php echo e(__('messages.t_active'), false); ?>

												</span>
												<?php break; ?>

											
											<?php case ('completed'): ?>
												<span class="inline-flex dark:bg-transparent items-center px-2.5 py-1 rounded-sm text-xs font-medium bg-emerald-50 text-emerald-800 dark:text-emerald-500 tracking-wide whitespace-nowrap">
													<?php echo e(__('messages.t_completed'), false); ?>

												</span>
												<?php break; ?>

											
											<?php case ('incomplete'): ?>
												<span class="inline-flex dark:bg-transparent items-center px-2.5 py-1 rounded-sm text-xs font-medium bg-red-50 text-red-800 dark:text-red-500 tracking-wide whitespace-nowrap">
													<?php echo e(__('messages.t_incomplete'), false); ?>

												</span>
												<?php break; ?>

											
											<?php case ('under_development'): ?>
												<span class="inline-flex dark:bg-transparent items-center px-2.5 py-1 rounded-sm text-xs font-medium bg-purple-50 text-purple-800 dark:text-purple-500 tracking-wide whitespace-nowrap">
													<?php echo e(__('messages.t_under_development'), false); ?>

												</span>
												<?php break; ?>

											
											<?php case ('closed'): ?>
												<span class="inline-flex dark:bg-transparent items-center px-2.5 py-1 rounded-sm text-xs font-medium bg-gray-50 text-gray-800 dark:text-gray-500 tracking-wide whitespace-nowrap">
													<?php echo e(__('messages.t_closed'), false); ?>

												</span>
												<?php break; ?>

											<?php default: ?>

										<?php endswitch; ?>
									</td>

									
									<td class="px-5 py-3 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md w-40 text-center">
										<span class="text-zinc-900 dark:text-zinc-300 text-sm font-semibold">
											<?php echo e(money($project->awarded_bid->amount, settings('currency')->code, true), false); ?>

										</span>
									</td>

									
									<td class="px-5 py-3 first:ltr:rounded-l-md last:ltr:rounded-r-md first:rtl:rounded-r-md last:rtl:rounded-l-md w-40 text-center">
										<span class="text-zinc-900 dark:text-zinc-300 text-sm font-semibold">
											<?php echo e(format_date($project->awarded_bid->awarded_date), false); ?>

										</span>
									</td>

								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</thead>
					</table>
				</div>

			</div>
		<?php endif; ?>

    </div>

</div>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/seller/home/home.blade.php ENDPATH**/ ?>