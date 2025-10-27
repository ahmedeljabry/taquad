<div>

    
    <?php
        $current_path = request()->path();
    ?>

    
    <aside class="z-20 w-full overflow-y-auto bg-white dark:bg-zinc-900 flex-shrink-0 ltr:border-r rtl:border-l border-slate-200 fixed h-[calc(100%-64px)] scrollbar-thin scrollbar-thumb-transparent  group-hover:scrollbar-thumb-gray-300 scrollbar-track-transparent transition-all duration-200 group-hover:scrollbar-track-gray-100 dark:scrollbar-thumb-zinc-800 dark:scrollbar-track-zinc-600 border-t border-t-gray-50 dark:border-transparent">
        <div class="py-4 text-gray-400 dark:text-gray-400">
            <ul class="space-y-2">

                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    
                    <!--[if BLOCK]><![endif]--><?php if(!$link['childs']): ?>

                        <li class="relative px-4 flex items-center group">
                            <a href="<?php echo e($link['href'], false); ?>" class="inline-flex items-center w-full text-slate-600 hover:text-slate-800 dark:text-zinc-200 rounded outline-none transition-colors duration-200 hover:bg-slate-100 dark:hover:bg-zinc-700 px-2 py-2 <?php echo e($current_path == $link['path'] ? 'bg-slate-50 dark:bg-zinc-800' : '', false); ?>">
        
                                
                                <i class="dark:text-zinc-300 flex h-5 items-center justify-center text-slate-400 text-xl w-5 ph-duotone ph-<?php echo e($link['icon'], false); ?>"></i>
        
                                
                                <span class="ltr:ml-4 rtl:mr-4 text-xs tracking-wide font-bold text-slate-500 group-hover:text-gray-900 dark:text-zinc-300 dark:group-hover:text-zinc-100">
                                    <?php echo e($link['text'], false); ?>    
                                </span>
                        
                            </a>
                        </li>

                    <?php else: ?>

                        
                        <li class="relative px-4 group" x-data="{ open: <?php echo e(Str::startsWith($current_path, $link['path']) ? 'true' : 'false', false); ?> }">
                            <button class="inline-flex items-center justify-between w-full text-slate-600 hover:text-slate-800 dark:text-zinc-200 rounded outline-none transition-colors duration-200 hover:bg-slate-100 dark:hover:bg-zinc-700 px-2 py-2 <?php echo e(Str::startsWith($current_path, $link['path']) ? 'bg-slate-50 dark:bg-zinc-800' : '', false); ?>"
                                x-on:click="open = !open" aria-haspopup="true">
                                <span class="inline-flex items-center">

                                    
                                    <i class="dark:text-zinc-300 flex h-5 items-center justify-center text-slate-400 text-xl w-5 ph-duotone ph-<?php echo e($link['icon'], false); ?>"></i>

                                    
                                    <span class="ltr:ml-4 rtl:mr-4 text-xs font-bold text-gray-500 group-hover:text-gray-900 dark:text-zinc-300 dark:group-hover:text-zinc-100"><?php echo e($link['text'], false); ?></span>

                                </span>
                                <svg class="w-4 h-4 text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"> <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path> </svg>
                            </button>
                            <template x-if="open">
                                <ul x-transition:enter="transition-all ease-in-out duration-300"
                                    x-transition:enter-start="opacity-25 max-h-0"
                                    x-transition:enter-end="opacity-100 max-h-xl"
                                    x-transition:leave="transition-all ease-in-out duration-300"
                                    x-transition:leave-start="opacity-100 max-h-xl"
                                    x-transition:leave-end="opacity-0 max-h-0"
                                    class="px-2 ltr:pr-2 ltr:pl-[34px] rtl:pl-2 rtl:pr-[34px] mt-2 space-y-2 overflow-hidden text-xs font-medium text-gray-500 dark:text-zinc-400"
                                    aria-label="submenu">

                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $link['childs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-zinc-200">
                                            <a class="w-full block font-medium" href="<?php echo e($child['href'], false); ?>"><?php echo e($child['text'], false); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    
                                </ul>
                            </template>
                        </li>

                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                
            </ul>
        </div>
    </aside>

</div><?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/admin/includes/sidebar.blade.php ENDPATH**/ ?>