<?php
    $wizardSteps = [
        ['id' => 0, 'label' => 'الفكرة والهدف', 'caption' => 'صِف النتيجة، الجمهور، والأسئلة الحرجة.'],
        ['id' => 1, 'label' => 'الفريق والمتطلبات', 'caption' => 'اختر المهارات وجهّز ملفات السياق.'],
        ['id' => 2, 'label' => 'الميزانية والإطلاق', 'caption' => 'ثبّت الميزانية وخيارات الترويج.'],
        ['id' => 3, 'label' => 'معاينة قبل النشر', 'caption' => 'راجع كل التفاصيل قبل الإطلاق.'],
    ];
    $activeTemplate = $this->selectedTemplateData;
    $currency = settings('currency');
    $currencyCode = $currency?->code ?? 'SAR';
    $totalSteps = count($wizardSteps);
?>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-50 dark:from-zinc-900 dark:via-zinc-900 dark:to-zinc-950">
    <div class="post-project-container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-24 pb-40 sm:mt-28 sm:pb-44"
        x-data="projectIntro()"
        x-init="init()"
        x-cloak>
        
    <div wire:loading.flex
            class="fixed inset-0 z-[70] items-center justify-center bg-white/90 backdrop-blur-md dark:bg-zinc-900/90">
            <div class="flex flex-col items-center gap-4">
                <div class="relative">
                    <div class="h-16 w-16 border-4 border-primary-200 border-t-primary-600 rounded-full animate-spin"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="ph ph-spinner text-2xl text-primary-600 animate-spin"></i>
        </div>
    </div>
                <p class="text-sm font-medium text-slate-700 dark:text-zinc-300"><?php echo app('translator')->get('messages.t_loading'); ?></p>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_360px] xl:grid-cols-[minmax(0,1fr)_420px]">
            <div class="space-y-6 sm:space-y-8 lg:sticky lg:top-28 lg:self-start lg:max-h-[calc(100vh-8rem)] lg:overflow-y-auto lg:pr-2">
            
            <div x-show="showIntro" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-y-2"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="rounded-xl bg-gradient-to-r from-primary-50 to-sky-50 dark:from-primary-900/20 dark:to-sky-900/20 border border-primary-100/50 dark:border-primary-800/30 px-4 py-3 sm:px-5 sm:py-4">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-primary-900 dark:text-primary-100 mb-1">
                            مرحباً! ابدأ بإنشاء مشروعك في 4 خطوات بسيطة
                        </p>
                        <p class="text-xs text-primary-700/80 dark:text-primary-200/70 leading-relaxed">
                            املأ المعلومات الأساسية، اختر المهارات المطلوبة، حدد الميزانية، ثم راجع ونشر
                        </p>
                    </div>
                        <button type="button"
                        class="flex-shrink-0 inline-flex items-center gap-1.5 rounded-lg bg-primary-600 hover:bg-primary-700 px-3 py-1.5 text-xs font-medium text-white transition-colors"
                            @click="dismissIntro(false)">
                        <span>ابدأ</span>
                        <i class="ph ph-arrow-right text-sm"></i>
                        </button>
                </div>
                        <button type="button"
                    class="mt-2 text-[11px] font-medium text-primary-600/70 hover:text-primary-700 dark:text-primary-300/70 dark:hover:text-primary-200 transition-colors"
                            @click="dismissIntro(true)">
                    لا تظهر مرة أخرى
                        </button>
            </div>

            
            <!--[if BLOCK]><![endif]--><?php if(session()->has('preview_error')): ?>
                <div
                    class="rounded-lg border border-amber-300 bg-amber-50 px-4 py-3 text-sm font-medium text-amber-800 dark:border-amber-600/40 dark:bg-amber-900/20 dark:text-amber-200">
                    <div class="flex items-start gap-2">
                        <i class="ph ph-warning-circle text-lg flex-shrink-0 mt-0.5"></i>
                        <span><?php echo e(session('preview_error'), false); ?></span>
                    </div>
                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            
            <section class="sticky top-28 z-30 rounded-2xl bg-white dark:bg-zinc-900/50 shadow-sm border border-slate-200/50 dark:border-zinc-800/50 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-primary-500/5 via-transparent to-sky-500/5 pointer-events-none"></div>

                <div class="relative px-5 py-6 sm:px-6 sm:py-8">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div class="flex items-start gap-3 sm:gap-4">
                            <div
                                class="flex h-12 w-12 sm:h-14 sm:w-14 flex-none items-center justify-center rounded-xl bg-gradient-to-br from-primary-500 to-sky-500 text-white shadow-lg shadow-primary-500/25">
                                <i class="ph-duotone ph-briefcase text-xl sm:text-2xl"></i>
                        </div>
                            <div class="min-w-0 flex-1">
                                <h1 class="text-lg sm:text-xl font-bold text-slate-900 dark:text-white tracking-tight">
                                <?php echo app('translator')->get('messages.t_post_new_project'); ?>
                            </h1>
                                <p class="mt-1.5 text-sm text-slate-600 dark:text-zinc-400 leading-relaxed">
                                <?php echo app('translator')->get('messages.t_post_new_project_subtitle'); ?>
                            </p>
                        </div>
                    </div>
                    <!--[if BLOCK]><![endif]--><?php if($activeTemplate): ?>
                        <div
                                class="flex-shrink-0 w-full sm:w-auto sm:max-w-xs rounded-lg border border-primary-200/60 bg-primary-50/80 dark:border-primary-800/40 dark:bg-primary-900/20 px-3 py-2.5">
                                <div class="flex items-center gap-2 mb-1">
                                    <i class="ph-duotone ph-magic-wand text-sm text-primary-600 dark:text-primary-400"></i>
                                    <span class="text-xs font-semibold text-primary-700 dark:text-primary-200">
                                        <?php echo e($activeTemplate['name'] ?? __('messages.t_selected'), false); ?>

                                    </span>
                            </div>
                                <p class="text-[11px] text-primary-600/80 dark:text-primary-300/70 leading-snug line-clamp-2">
                                <?php echo e($activeTemplate['headline'] ?? '', false); ?>

                            </p>
                        </div>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>
                        </div>

            </section>
            
            <!--[if BLOCK]><![endif]--><?php if($step === 0): ?>
                <section class="rounded-xl bg-white dark:bg-zinc-900/50 shadow-sm border border-slate-200/50 dark:border-zinc-800/50">
                    <div class="px-5 py-6 sm:px-6 sm:py-8 space-y-6">
                        
                        <div class="grid gap-5 sm:gap-6 sm:grid-cols-2">
                        <div>
                            <?php if (isset($component)) { $__componentOriginal0241d3f51813223308810020791c4a83 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0241d3f51813223308810020791c4a83 = $attributes; } ?>
<?php $component = App\View\Components\Forms\TextInput::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\TextInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'label' => ''.e(__('messages.t_project_title'), false).'','placeholder' => ''.e(__('messages.t_enter_title'), false).'','model' => 'title','icon' => 'text-italic']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0241d3f51813223308810020791c4a83)): ?>
<?php $attributes = $__attributesOriginal0241d3f51813223308810020791c4a83; ?>
<?php unset($__attributesOriginal0241d3f51813223308810020791c4a83); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0241d3f51813223308810020791c4a83)): ?>
<?php $component = $__componentOriginal0241d3f51813223308810020791c4a83; ?>
<?php unset($__componentOriginal0241d3f51813223308810020791c4a83); ?>
<?php endif; ?>
                            </div>
                            <div>
                            <?php if (isset($component)) { $__componentOriginaldb6747d79aee05aaab45bb3a98f6c6bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb6747d79aee05aaab45bb3a98f6c6bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.forms.select-simple','data' => ['required' => true,'live' => true,'model' => 'category','label' => __('messages.t_category'),'placeholder' => __('messages.t_choose_category')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.select-simple'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'live' => true,'model' => 'category','label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_category')),'placeholder' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_choose_category'))]); ?>
                                 <?php $__env->slot('options', null, []); ?> 
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($c->id, false); ?>"><?php echo e($c->name, false); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                 <?php $__env->endSlot(); ?>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldb6747d79aee05aaab45bb3a98f6c6bc)): ?>
<?php $attributes = $__attributesOriginaldb6747d79aee05aaab45bb3a98f6c6bc; ?>
<?php unset($__attributesOriginaldb6747d79aee05aaab45bb3a98f6c6bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldb6747d79aee05aaab45bb3a98f6c6bc)): ?>
<?php $component = $__componentOriginaldb6747d79aee05aaab45bb3a98f6c6bc; ?>
<?php unset($__componentOriginaldb6747d79aee05aaab45bb3a98f6c6bc); ?>
<?php endif; ?>
                            </div>
                        </div>

                        
                        <div class="grid gap-6 lg:grid-cols-[1.4fr_1fr]">
                            <div class="space-y-4">
                                <?php if (isset($component)) { $__componentOriginal2f60389a9e230471cd863683376c182f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2f60389a9e230471cd863683376c182f = $attributes; } ?>
<?php $component = App\View\Components\Forms\Textarea::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Textarea::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'label' => ''.e(__('messages.t_project_description'), false).'','placeholder' => ''.e(__('messages.t_enter_description'), false).'','model' => 'description','rows' => 12,'icon' => 'text','hint' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_post_project_description_hint'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2f60389a9e230471cd863683376c182f)): ?>
<?php $attributes = $__attributesOriginal2f60389a9e230471cd863683376c182f; ?>
<?php unset($__attributesOriginal2f60389a9e230471cd863683376c182f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2f60389a9e230471cd863683376c182f)): ?>
<?php $component = $__componentOriginal2f60389a9e230471cd863683376c182f; ?>
<?php unset($__componentOriginal2f60389a9e230471cd863683376c182f); ?>
<?php endif; ?>
                                <!--[if BLOCK]><![endif]--><?php if(!empty($assistantShortcuts['description_blocks']) && is_array($assistantShortcuts['description_blocks'])): ?>
                                    <div
                                        class="rounded-lg border border-primary-200/50 bg-primary-50/50 dark:border-primary-800/30 dark:bg-primary-900/10 p-4">
                                        <div class="flex items-center gap-2 mb-3">
                                            <i class="ph-duotone ph-sparkle text-base text-primary-600 dark:text-primary-400"></i>
                                            <span class="text-xs font-semibold text-primary-800 dark:text-primary-200">مقترحات تقسيم الوصف</span>
                                        </div>
                                        <ul class="space-y-2 text-xs leading-relaxed text-primary-700 dark:text-primary-300">
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $assistantShortcuts['description_blocks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="flex items-start gap-2">
                                                    <i class="ph ph-caret-right text-xs text-primary-500 dark:text-primary-400 mt-1 flex-shrink-0"></i>
                                                    <span><?php echo e($block, false); ?></span>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        </ul>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <div class="space-y-4">
                                <!--[if BLOCK]><![endif]--><?php if(!empty($assistantShortcuts['title_prompts']) && is_array($assistantShortcuts['title_prompts'])): ?>
                                    <div
                                        class="rounded-lg border border-slate-200 bg-white dark:border-zinc-700 dark:bg-zinc-800/50 p-4">
                                        <div class="flex items-center gap-2 mb-3">
                                            <i class="ph-duotone ph-quotes text-base text-primary-500"></i>
                                            <span class="text-xs font-semibold text-slate-800 dark:text-zinc-100">نصائح لصياغة عنوان جذاب</span>
                                        </div>
                                        <ul class="space-y-2 text-xs leading-relaxed text-slate-600 dark:text-zinc-300">
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $assistantShortcuts['title_prompts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="flex items-start gap-2">
                                                    <i class="ph ph-sparkle text-xs text-primary-500 dark:text-primary-400 mt-0.5 flex-shrink-0"></i>
                                                    <span><?php echo e($tip, false); ?></span>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        </ul>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                <!--[if BLOCK]><![endif]--><?php if(!empty($playbooks['briefing']) && is_array($playbooks['briefing'])): ?>
                                    <div
                                        class="rounded-lg border border-indigo-200 bg-indigo-50/50 dark:border-indigo-800/30 dark:bg-indigo-900/10 p-4">
                                        <div class="flex items-center gap-2 mb-3">
                                            <i class="ph-duotone ph-notepad text-base text-indigo-600 dark:text-indigo-400"></i>
                                            <span class="text-xs font-semibold text-indigo-800 dark:text-indigo-200">قائمة تحقق موجزة</span>
                                        </div>
                                        <ul class="space-y-2 text-xs leading-relaxed text-indigo-700 dark:text-indigo-300">
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $playbooks['briefing']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="flex items-start gap-2">
                                                    <i class="ph ph-check-circle text-xs text-indigo-500 dark:text-indigo-400 mt-0.5 flex-shrink-0"></i>
                                                    <span><?php echo e($item, false); ?></span>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        </ul>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>

                        
                        <div class="rounded-2xl border border-slate-200 bg-white px-4 py-5 shadow-sm dark:border-zinc-700 dark:bg-zinc-900/60 sm:px-6">
                            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">المخرجات المتوقعة</p>
                                    <p class="text-xs text-slate-500 dark:text-zinc-400">حدد ما الذي سيستلمه العميل عند اكتمال المشروع بحد أقصى <?php echo e($this->deliverablesLimit, false); ?> عناصر.</p>
                                </div>
                                <button type="button"
                                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-primary-200 bg-primary-50 px-3 py-2 text-xs font-semibold text-primary-700 transition hover:bg-primary-100 dark:border-primary-600/70 dark:bg-primary-900/10 dark:text-primary-200"
                                    wire:click="addDeliverable"
                                    <?php if(count($expected_deliverables ?? []) >= $this->deliverablesLimit): echo 'disabled'; endif; ?>">
                                    <i class="ph ph-plus-circle"></i>
                                    <span>إضافة مخرج</span>
                                </button>
                            </div>
                            <div class="mt-5 space-y-3">
                                <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $expected_deliverables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $deliverable): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="flex flex-col gap-2 rounded-xl border border-slate-200 bg-white px-3 py-3 shadow-sm dark:border-zinc-700 dark:bg-zinc-900/70" wire:key="deliverable-row-<?php echo e($index, false); ?>">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-8 w-8 flex-none items-center justify-center rounded-lg bg-primary-100 text-xs font-bold text-primary-700 dark:bg-primary-500/20 dark:text-primary-200">
                                                <?php echo e($index + 1, false); ?>

                                            </div>
                                            <input type="text"
                                                class="flex-1 rounded-lg border border-slate-200 bg-transparent px-3 py-2 text-sm text-slate-700 placeholder:text-slate-400 focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200 dark:border-zinc-600 dark:text-zinc-100 dark:placeholder:text-zinc-500"
                                                placeholder="مثال: لوحة تحكم تفاعلية تعرض مؤشرات الأداء الرئيسة"
                                                wire:model.defer="expected_deliverables.<?php echo e($index, false); ?>"
                                                maxlength="160" />
                                            <button type="button"
                                                class="flex h-8 w-8 flex-none items-center justify-center rounded-lg text-slate-400 hover:text-rose-500 focus:outline-none"
                                                wire:click="removeDeliverable(<?php echo e($index, false); ?>)"
                                                title="<?php echo app('translator')->get('messages.t_remove'); ?>">
                                                <i class="ph ph-x text-lg"></i>
                                            </button>
                                        </div>
                                        <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['expected_deliverables.' . $index];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <p class="text-xs font-medium text-rose-500"><?php echo e($message, false); ?></p>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="rounded-xl border-2 border-dashed border-slate-200 px-4 py-6 text-center text-sm text-slate-500 dark:border-zinc-700 dark:text-zinc-400">
                                        ابدأ بإضافة أول مخرج لضمان وضوح التسليمات.
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['expected_deliverables'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-3 text-xs font-semibold text-rose-500"><?php echo e($message, false); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>

                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-bold text-slate-900 dark:text-white">
                                    <?php echo app('translator')->get('messages.t_discovery_questions'); ?>
                                </h3>
                                    <p class="mt-0.5 text-xs text-slate-500 dark:text-zinc-400">
                                        أسئلة اختيارية للمستقلين لتوضيح تفاصيل المشروع
                                    </p>
                                </div>
                                <button type="button"
                                    class="inline-flex items-center gap-1.5 rounded-lg bg-primary-600 hover:bg-primary-700 px-3 py-1.5 text-xs font-medium text-white transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                    wire:click="addQuestion" <?php if(count($questions ?? []) >= 8): echo 'disabled'; endif; ?>>
                                    <i class="ph ph-plus text-sm"></i>
                                    <span>إضافة</span>
                                </button>
                            </div>
                            <!--[if BLOCK]><![endif]--><?php if(is_array($questions) && count($questions)): ?>
                                <div class="space-y-3">
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $q): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div
                                            class="group rounded-lg border border-slate-200 bg-white dark:border-zinc-700 dark:bg-zinc-800/50 p-4 transition-colors hover:border-primary-300 dark:hover:border-primary-700">
                                            <div class="flex items-start gap-3">
                                                <div
                                                    class="flex h-7 w-7 flex-none items-center justify-center rounded-md bg-primary-100 text-xs font-bold text-primary-700 dark:bg-primary-500/20 dark:text-primary-300">
                                                    <?php echo e($i + 1, false); ?>

                                                </div>
                                                <div class="flex-1 space-y-2.5 min-w-0">
                                                    <input type="text"
                                                        class="block w-full rounded-md border border-slate-200 bg-white px-3 py-2 text-sm focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-200 dark:focus:ring-primary-800"
                                                        placeholder="<?php echo e(__('messages.t_question_placeholder'), false); ?>"
                                                        wire:model.defer="questions.<?php echo e($i, false); ?>.text" maxlength="200" />
                                                    <label
                                                        class="inline-flex items-center gap-2 text-xs text-slate-600 dark:text-zinc-400 cursor-pointer">
                                                        <input type="checkbox" wire:model="questions.<?php echo e($i, false); ?>.is_required"
                                                            class="h-4 w-4 rounded border-slate-300 text-primary-600 focus:ring-primary-500 dark:border-zinc-600">
                                                        <span><?php echo app('translator')->get('messages.t_mark_question_required'); ?></span>
                                                    </label>
                                                </div>
                                                <button type="button"
                                                    class="flex-shrink-0 text-xs font-medium text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors p-1"
                                                    wire:click="removeQuestion(<?php echo e($i, false); ?>)" title="<?php echo app('translator')->get('messages.t_remove'); ?>">
                                                    <i class="ph ph-x text-base"></i>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            <?php else: ?>
                                <div
                                    class="rounded-lg border-2 border-dashed border-slate-200 dark:border-zinc-700 bg-slate-50/50 dark:bg-zinc-800/30 p-6 text-center">
                                    <i class="ph ph-question text-2xl text-slate-400 dark:text-zinc-500 mb-2"></i>
                                    <p class="text-xs text-slate-500 dark:text-zinc-400">
                                    <?php echo app('translator')->get('messages.t_project_discovery_questions_empty'); ?>
                                    </p>
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>

                </section>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            
            <!--[if BLOCK]><![endif]--><?php if($step === 1): ?>
                <section class="rounded-xl bg-white dark:bg-zinc-900/50 shadow-sm border border-slate-200/50 dark:border-zinc-800/50">
                    <div class="px-5 py-6 sm:px-6 sm:py-8 space-y-6">
                        <div class="grid gap-6 lg:grid-cols-[minmax(0,1.7fr)_minmax(280px,1fr)]">
                            <div class="space-y-6">
                                <div
                                    class="rounded-lg border border-slate-200 bg-white dark:border-zinc-700 dark:bg-zinc-800/50 px-4 py-5 shadow-sm">
                                    <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                                        <div>
                                            <h3 class="text-sm font-bold text-slate-900 dark:text-white">
                                                <?php echo e(__('messages.t_skills'), false); ?>

                                            </h3>
                                            <p class="mt-0.5 text-xs text-slate-600 dark:text-zinc-400">
                                                <?php echo e(__('messages.t_what_skills_are_required'), false); ?>

                                            </p>
                                        </div>
                                        <!--[if BLOCK]><![endif]--><?php if($category): ?>
                                            <button type="button" wire:click="generateSkillRecommendations"
                                                wire:loading.attr="disabled"
                                                wire:target="generateSkillRecommendations,applyAllSkillRecommendations"
                                                class="inline-flex items-center gap-1.5 rounded-lg bg-primary-600 hover:bg-primary-700 px-3 py-1.5 text-xs font-medium text-white transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                                <svg wire:loading wire:target="generateSkillRecommendations"
                                                    class="h-3.5 w-3.5 animate-spin" viewBox="0 0 24 24" fill="none">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                        stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                                </svg>
                                                <i class="ph ph-sparkle text-sm" wire:loading.remove
                                                    wire:target="generateSkillRecommendations"></i>
                                                <span>مساعد ذكي</span>
                                            </button>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>

                                    <div class="mt-4 space-y-5">
                                        <!--[if BLOCK]><![endif]--><?php if($category): ?>
                                            <?php
                                                $skillItems = collect($skills);
                                                $availableCount = $skillItems->count();
                                            ?>
                                            <div x-data class="relative">
                                                <i class="ph ph-magnifying-glass text-slate-400 dark:text-zinc-500 absolute inset-y-0 right-3 my-auto text-base pointer-events-none"></i>
                                                <input type="search" wire:model.debounce.400ms="skillSearch"
                                                    wire:keydown.enter.prevent
                                                    class="w-full rounded-lg border border-slate-200 bg-white px-10 py-2.5 text-sm text-slate-700 placeholder:text-slate-400 transition focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-200 dark:placeholder:text-zinc-500 dark:focus:ring-primary-800"
                                                    placeholder="ابحث عن مهارة... مثال: Laravel, SEO, UX" />
                                                <!--[if BLOCK]><![endif]--><?php if(filled($skillSearch)): ?>
                                                    <button type="button" wire:click="clearSkillSearch"
                                                        class="absolute inset-y-0 left-3 my-auto inline-flex h-7 w-7 items-center justify-center rounded-md bg-slate-100 text-slate-500 transition-colors hover:bg-slate-200 dark:bg-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-600"
                                                        title="مسح البحث">
                                                        <i class="ph ph-x text-sm"></i>
                                                    </button>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                            <div
                                                class="flex flex-wrap items-center gap-3 text-[11.5px] text-slate-500 dark:text-zinc-400">
                                                <span>
                                                    <?php echo e($availableCount ? 'أماكن متعددة للمهارات المتخصصة، اختر حتى ' . (int) settings('projects')->max_skills . ' مهارة.' : 'لم يتم العثور على مهارات مطابقة في هذه الفئة.', false); ?>

                                                </span>
                                                <!--[if BLOCK]><![endif]--><?php if(filled($skillSearch)): ?>
                                                    <span
                                                        class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2 py-0.5 font-semibold text-slate-600 dark:bg-zinc-700/80 dark:text-zinc-200">
                                                        <i class="ph ph-funnel text-xs"></i>
                                                        <?php echo e(__('messages.t_search'), false); ?>: <?php echo e($skillSearch, false); ?>

                                                    </span>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                            <div class="mt-3">
                                                <div class="flex flex-wrap gap-2" wire:loading.class="opacity-60"
                                                    wire:target="skillSearch,clearSkillSearch,updatedCategory">
                                                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $skillItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                        <?php
                                                            $skillId = $skill['id'] ?? null;
                                                            $skillUid = $skill['uid'] ?? null;
                                                            $skillName = $skill['name'] ?? '';
                                                            $isSelected = $skillId ? in_array($skillId, $required_skills ?? []) : false;
                                                        ?>
                                                        <!--[if BLOCK]><![endif]--><?php if($skillId && $skillUid && $skillName): ?>
                                                            <button type="button" wire:click="addSkill('<?php echo e($skillUid, false); ?>')"
                                                                wire:key="skill-pill-<?php echo e($skillUid, false); ?>"
                                                                class="group inline-flex items-center gap-1.5 rounded-lg border px-3 py-1.5 text-xs font-medium transition-all focus:outline-none focus:ring-2 focus:ring-primary-200 min-h-[32px] <?php echo e($isSelected ? 'border-primary-600 bg-primary-600 text-white hover:bg-primary-700 shadow-sm' : 'border-slate-200 bg-white text-slate-700 hover:border-primary-300 hover:bg-primary-50 hover:text-primary-700 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:border-primary-600 dark:hover:bg-primary-900/20', false); ?>">
                                                                <span class="truncate max-w-[140px]"><?php echo e($skillName, false); ?></span>
                                                                <!--[if BLOCK]><![endif]--><?php if($isSelected): ?>
                                                                    <i class="ph ph-check text-sm flex-shrink-0"></i>
                                                                <?php else: ?>
                                                                    <i class="ph ph-plus text-sm opacity-70 flex-shrink-0"></i>
                                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                            </button>
                                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                        <div
                                                            class="w-full rounded-xl border border-dashed border-slate-200 px-4 py-6 text-center text-xs font-semibold text-slate-500 dark:border-zinc-600 dark:text-zinc-300">
                                                            لا توجد نتائج مطابقة. جرّب كلمة مفتاحية مختلفة أو شغّل المساعد الذكي
                                                            لاقتراح المهارات.
                                                        </div>
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div
                                                class="rounded-xl border border-dashed border-yellow-200 bg-yellow-50/80 px-4 py-3 text-[13px] text-yellow-700 dark:border-yellow-400/40 dark:bg-yellow-500/10 dark:text-yellow-200">
                                                <div class="flex items-center gap-2">
                                                    <i class="ph ph-warning-circle text-base"></i>
                                                    <span><?php echo app('translator')->get('messages.t_skills_select_category_first_alert'); ?></span>
                                                </div>
                                            </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>

                                <!--[if BLOCK]><![endif]--><?php if(!empty($skillRecommendations)): ?>
                                    <div
                                        class="rounded-2xl border border-primary-200/80 bg-primary-50/60 px-5 py-5 shadow-sm dark:border-primary-500/30 dark:bg-primary-500/10">
                                        <div class="flex items-center justify-between gap-3">
                                            <div>
                                                <p class="text-sm font-semibold text-primary-700 dark:text-primary-200">
                                                    اقتراحات المساعد الذكي
                                                </p>
                                                <p class="text-[12px] text-primary-700/80 dark:text-primary-200/80">
                                                    اختر ما يناسب مشروعك أو اضغط على تعبئة الكل لإضافتها دفعة واحدة.
                                                </p>
                                            </div>
                                            <button type="button" wire:click="applyAllSkillRecommendations"
                                                wire:loading.attr="disabled" wire:target="applyAllSkillRecommendations"
                                                class="inline-flex items-center gap-2 rounded-full bg-primary-600 px-4 py-1.5 text-xs font-semibold text-white transition hover:bg-primary-700 disabled:cursor-not-allowed">
                                                <svg wire:loading wire:target="applyAllSkillRecommendations"
                                                    class="h-3.5 w-3.5 animate-spin text-white/80" viewBox="0 0 24 24"
                                                    fill="none">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                        stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                                </svg>
                                                <i class="ph ph-lightning text-base" wire:loading.remove
                                                    wire:target="applyAllSkillRecommendations"></i>
                                                <span>تعبئة الكل</span>
                                            </button>
                                        </div>
                                        <div class="mt-4 flex flex-wrap gap-2">
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $skillRecommendations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suggested): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $sId = $suggested['id'] ?? null;
                                                    $sUid = $suggested['uid'] ?? null;
                                                    $sName = $suggested['name'] ?? '';
                                                    $already = $sId ? in_array($sId, $required_skills ?? []) : false;
                                                ?>
                                                <!--[if BLOCK]><![endif]--><?php if($sId && $sUid && $sName): ?>
                                                    <button type="button" wire:click="applySkillRecommendation('<?php echo e($sUid, false); ?>')"
                                                        wire:key="skill-ai-<?php echo e($sUid, false); ?>"
                                                        class="group inline-flex items-center gap-2 rounded-full border border-primary-200 bg-white px-4 py-1.5 text-[12px] font-semibold text-primary-700 transition hover:border-primary-400 hover:text-primary-800 dark:border-primary-500/40 dark:bg-primary-500/10 dark:text-primary-100">
                                                        <i class="ph ph-sparkle text-xs"></i>
                                                        <span class="truncate max-w-[150px]"><?php echo e($sName, false); ?></span>
                                                        <!--[if BLOCK]><![endif]--><?php if($already): ?>
                                                            <i class="ph ph-check text-xs opacity-70"></i>
                                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                    </button>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                <!--[if BLOCK]><![endif]--><?php if(!empty($selectedSkills)): ?>
                                    <div
                                        class="rounded-2xl border border-emerald-200/70 bg-emerald-50/50 px-5 py-5 shadow-sm dark:border-emerald-500/30 dark:bg-emerald-500/10">
                                        <div
                                            class="flex items-center gap-2 text-sm font-semibold text-emerald-700 dark:text-emerald-200">
                                            <i class="ph ph-check-circle text-base"></i>
                                            <span>المهارات المحددة (<?php echo e(count($selectedSkills), false); ?>)</span>
                                        </div>
                                        <div class="mt-3 flex flex-wrap gap-2">
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $selectedSkills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $selected): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    $selUid = $selected['uid'] ?? null;
                                                    $selName = $selected['name'] ?? '';
                                                ?>
                                                <!--[if BLOCK]><![endif]--><?php if($selUid && $selName): ?>
                                                    <button type="button" wire:click="addSkill('<?php echo e($selUid, false); ?>')"
                                                        wire:key="skill-selected-<?php echo e($selUid, false); ?>"
                                                        class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-1.5 text-[12px] font-semibold text-emerald-700 shadow-sm transition hover:bg-emerald-100 dark:bg-emerald-500/20 dark:text-emerald-100 dark:hover:bg-emerald-500/30">
                                                        <i class="ph ph-lightning text-xs"></i>
                                                        <span class="truncate max-w-[160px]"><?php echo e($selName, false); ?></span>
                                                        <i class="ph ph-x text-xs opacity-70"></i>
                                                    </button>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                        <p class="mt-3 text-[11.5px] text-emerald-700/80 dark:text-emerald-100/80">
                                            يمكنك الضغط على المهارة لإزالتها من المشروع في أي وقت.
                                        </p>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <div class="space-y-4">
                                <div
                                    class="rounded-2xl border border-slate-200/80 bg-white/85 px-5 py-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-800/70">
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-primary-100 text-primary-600 dark:bg-primary-500/15 dark:text-primary-200">
                                            <i class="ph ph-student text-lg"></i>
                                        </div>
                                        <div class="space-y-2 text-[12.5px] leading-6 text-slate-600 dark:text-zinc-300">
                                            <p class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
                                                ما الذي يبحث عنه المستقلون؟
                                            </p>
                                            <ul class="space-y-1.5">
                                                <li class="flex items-start gap-2">
                                                    <i class="ph ph-dot-outline mt-0.5 text-primary-500"></i>
                                                    <span>مهارات واضحة توضح نطاق العمل والتقنيات المعتمدة.</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <i class="ph ph-dot-outline mt-0.5 text-primary-500"></i>
                                                    <span>عدد مهارات متوازن (4 -
                                                        <?php echo e((int) settings('projects')->max_skills, false); ?>) يضمن التركيز.</span>
                                                </li>
                                                <li class="flex items-start gap-2">
                                                    <i class="ph ph-dot-outline mt-0.5 text-primary-500"></i>
                                                    <span>تنوع بين الخبرة التقنية والمهارية (مثل إدارة المشروع أو تصميم
                                                        الواجهات).</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="rounded-2xl border border-slate-200/80 bg-white/85 px-5 py-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-800/70">
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-blue-100 text-blue-600 dark:bg-blue-500/15 dark:text-blue-200">
                                            <i class="ph ph-magic-wand text-lg"></i>
                                        </div>
                                        <div class="space-y-2 text-[12.5px] leading-6 text-slate-600 dark:text-zinc-300">
                                            <p class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
                                                كيف يستفيد المساعد الذكي؟
                                            </p>
                                            <p>
                                                يحلل العنوان والوصف الحالي لتقديم أفضل 12 مهارة مقترحة. يمكنك تحديث الوصف ثم
                                                إعادة تشغيل المساعد للحصول على اقتراحات أحدث.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label class="text-sm font-bold text-slate-900 dark:text-white">
                                    <?php echo e(__('messages.t_project_upload_brief_title'), false); ?>

                                </label>
                                    <p class="mt-0.5 text-xs text-slate-500 dark:text-zinc-400">
                                        رفع ملفات مرجعية (اختياري)
                                    </p>
                                </div>
                                <span class="flex items-center gap-1.5 text-xs font-medium text-primary-600 dark:text-primary-400"
                                    wire:loading wire:target="attachments">
                                    <svg class="h-3.5 w-3.5 animate-spin" viewBox="0 0 24 24" fill="none">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                    </svg>
                                    <span>جاري الرفع...</span>
                                </span>
                            </div>

                            <label for="wizard-attachments" class="block cursor-pointer">
                                <div
                                    class="group rounded-lg border-2 border-dashed border-slate-300 bg-slate-50/50 dark:border-zinc-600 dark:bg-zinc-800/30 px-6 py-8 text-center transition-all hover:border-primary-400 hover:bg-primary-50/30 dark:hover:border-primary-600 dark:hover:bg-primary-900/10">
                                    <input id="wizard-attachments" type="file" class="sr-only" multiple
                                        wire:model="attachments">
                                    <div class="flex flex-col items-center gap-3">
                                        <div
                                            class="flex h-14 w-14 items-center justify-center rounded-xl bg-primary-100 text-primary-600 transition-colors group-hover:bg-primary-200 dark:bg-primary-900/30 dark:text-primary-400">
                                            <i class="ph ph-cloud-arrow-up text-2xl"></i>
                                        </div>
                                        <div class="space-y-1">
                                            <p class="text-sm font-semibold text-slate-700 dark:text-zinc-100">
                                                اسحب الملفات هنا أو اضغط للاختيار
                                            </p>
                                            <p class="text-xs text-slate-500 dark:text-zinc-400">
                                                <?php echo e(__('messages.t_project_attachment_limit_hint', ['max' => 5, 'size' => '25MB']), false); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['attachments.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-xs font-medium text-red-600 dark:text-red-400"><?php echo e($message, false); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->

                            <!--[if BLOCK]><![endif]--><?php if(is_array($attachments) && count($attachments)): ?>
                                <ul class="space-y-2">
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li
                                            class="flex items-center justify-between gap-3 rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-700 shadow-sm dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-200">
                                            <div class="flex items-center gap-2 min-w-0 flex-1">
                                                <i class="ph ph-file text-base text-primary-500 flex-shrink-0"></i>
                                                <span class="truncate"><?php echo e($file->getClientOriginalName() ?? 'file', false); ?></span>
                                            </div>
                                            <button type="button"
                                                class="flex-shrink-0 text-xs font-medium text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors p-1"
                                                wire:click="removeAttachment(<?php echo e($idx, false); ?>)" title="<?php echo app('translator')->get('messages.t_remove'); ?>">
                                                <i class="ph ph-x text-base"></i>
                                            </button>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </ul>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>

                        <div class="space-y-4">
                            <div
                                class="rounded-2xl border border-slate-200/80 bg-white/85 px-5 py-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-800/70">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-emerald-500/15 text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-200">
                                        <i class="ph ph-flag-checkered text-lg"></i>
                                    </div>
                                    <div class="space-y-2 text-[13px] leading-6 text-slate-600 dark:text-zinc-300">
                                        <div>
                                            <h3 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
                                                الدفعات المالية يحددها المستقل بعد قبول العرض
                                            </h3>
                                            <p>
                                                بعد نشر المشروع سيقترح المستقلون خطة الدفعات المناسبة ضمن عروضهم. شارك أي
                                                ملاحظات أو قيود خاصة في وصف المشروع، وسيتم تنفيذ الدفعات داخل لوحة العمل بعد
                                                التعاقد.
                                            </p>
                                        </div>
                                        <!--[if BLOCK]><![endif]--><?php if(is_array($milestones) && count($milestones)): ?>
                                            <div
                                                class="rounded-xl border border-slate-200/70 bg-white/95 px-4 py-3 dark:border-zinc-600 dark:bg-zinc-800">
                                                <p class="text-[12px] font-semibold text-slate-500 dark:text-zinc-300">
                                                    مقترحات الدفعات في القالب المختار:
                                                </p>
                                                <ul class="mt-2 space-y-1.5">
                                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $milestones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                            $titleValue = trim((string) ($milestone['title'] ?? ''));
                                                            $amountValue = trim((string) ($milestone['amount'] ?? ''));
                                                        ?>
                                                        <!--[if BLOCK]><![endif]--><?php if($titleValue !== '' || $amountValue !== ''): ?>
                                                            <li class="flex items-start gap-2">
                                                                <i
                                                                    class="ph ph-dot-outline text-xs text-primary-500 dark:text-primary-300 mt-0.5"></i>
                                                                <span class="flex flex-wrap items-center gap-2">
                                                                    <span><?php echo e($titleValue ?: '—', false); ?></span>
                                                                    <!--[if BLOCK]><![endif]--><?php if($amountValue !== ''): ?>
                                                                        <span
                                                                            class="rounded-full bg-primary-50 px-2 py-0.5 text-[11px] font-semibold text-primary-600 dark:bg-primary-500/15 dark:text-primary-200">
                                                                            <?php echo e($amountValue, false); ?> <?php echo e(settings('currency')->code, false); ?>

                                                                        </span>
                                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                                </span>
                                                            </li>
                                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                </ul>
                                            </div>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    </div>

                </section>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            
            <!--[if BLOCK]><![endif]--><?php if($step === 2): ?>
                <section class="rounded-xl bg-white dark:bg-zinc-900/50 shadow-sm border border-slate-200/50 dark:border-zinc-800/50">
                    <div class="px-5 py-6 sm:px-6 sm:py-8 space-y-6">
                        <div>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <label
                                    class="group relative flex cursor-pointer items-start gap-3 rounded-lg border-2 px-4 py-4 transition-all hover:border-primary-300 hover:shadow-sm dark:hover:border-primary-600"
                                    :class="{ 'border-primary-500 bg-primary-50/50 shadow-sm dark:border-primary-400 dark:bg-primary-900/20': $wire.salary_type === 'fixed', 'border-slate-200 bg-white dark:border-zinc-700 dark:bg-zinc-800/50': $wire.salary_type !== 'fixed' }">
                                    <input type="radio" id="post-project-salary-type-fixed" name="salary_type"
                                        wire:model="salary_type" value="fixed" class="sr-only">
                                    <span
                                        class="flex h-10 w-10 flex-none items-center justify-center rounded-lg transition-colors"
                                        :class="{ 'bg-primary-600 text-white': $wire.salary_type === 'fixed', 'bg-slate-100 text-slate-600 dark:bg-zinc-700 dark:text-zinc-300': $wire.salary_type !== 'fixed' }">
                                        <i class="ph-duotone ph-money text-lg"></i>
                                    </span>
                                    <span class="flex flex-col min-w-0 flex-1">
                                        <span class="text-sm font-bold text-slate-900 dark:text-white">
                                            <?php echo app('translator')->get('messages.t_fixed_price'); ?>
                                        </span>
                                        <span class="mt-0.5 text-xs text-slate-600 dark:text-zinc-400 leading-relaxed">
                                            نطاق واضح مع مخرجات محددة
                                        </span>
                                    </span>
                                </label>
                                <label
                                    class="group relative flex cursor-pointer items-start gap-3 rounded-lg border-2 px-4 py-4 transition-all hover:border-primary-300 hover:shadow-sm dark:hover:border-primary-600"
                                    :class="{ 'border-primary-500 bg-primary-50/50 shadow-sm dark:border-primary-400 dark:bg-primary-900/20': $wire.salary_type === 'hourly', 'border-slate-200 bg-white dark:border-zinc-700 dark:bg-zinc-800/50': $wire.salary_type !== 'hourly' }">
                                    <input type="radio" id="post-project-salary-type-hourly" name="salary_type"
                                        wire:model="salary_type" value="hourly" class="sr-only">
                                    <span
                                        class="flex h-10 w-10 flex-none items-center justify-center rounded-lg transition-colors"
                                        :class="{ 'bg-primary-600 text-white': $wire.salary_type === 'hourly', 'bg-slate-100 text-slate-600 dark:bg-zinc-700 dark:text-zinc-300': $wire.salary_type !== 'hourly' }">
                                        <i class="ph-duotone ph-clock text-lg"></i>
                                    </span>
                                    <span class="flex flex-col min-w-0 flex-1">
                                        <span class="text-sm font-bold text-slate-900 dark:text-white">
                                            <?php echo app('translator')->get('messages.t_hourly_price'); ?>
                                        </span>
                                        <span class="mt-0.5 text-xs text-slate-600 dark:text-zinc-400 leading-relaxed">
                                            مثالي للأعمال المستمرة والدفع حسب الوقت الفعلي المبذول
                                        </span>
                                    </span>
                                </label>
                            </div>

                            <?php
                                $isHourly = $salary_type === 'hourly';
                                $minLabel = $isHourly ? __('messages.t_hourly_min_rate') : __('messages.t_min_price');
                                $maxLabel = $isHourly ? __('messages.t_hourly_max_rate') : __('messages.t_max_price');
                                $currencySuffix = $currency_symbol . ($isHourly ? ' / ' . __('messages.t_hour_short') : '');

                                // Predefined price ranges
                                $priceRanges = [
                                    ['min' => 5, 'max' => 10, 'label' => '5 - 10'],
                                    ['min' => 10, 'max' => 20, 'label' => '10 - 20'],
                                    ['min' => 20, 'max' => 50, 'label' => '20 - 50'],
                                    ['min' => 50, 'max' => 100, 'label' => '50 - 100'],
                                    ['min' => 100, 'max' => 200, 'label' => '100 - 200'],
                                    ['min' => 200, 'max' => 500, 'label' => '200 - 500'],
                                    ['min' => 500, 'max' => 1000, 'label' => '500 - 1,000'],
                                    ['min' => 1000, 'max' => 2500, 'label' => '1,000 - 2,500'],
                                    ['min' => 2500, 'max' => 5000, 'label' => '2,500 - 5,000'],
                                    ['min' => 5000, 'max' => 10000, 'label' => '5,000 - 10,000'],
                                    ['min' => 10000, 'max' => 25000, 'label' => '10,000 - 25,000'],
                                    ['min' => 25000, 'max' => 50000, 'label' => '25,000+'],
                                ];
                            ?>
                            <div class="mt-6 grid gap-6 md:grid-cols-2">
                                <div>
                                    <label for="min_price_select" class="block text-xs font-bold tracking-wide mb-2.5 text-slate-700 dark:text-white">
                                        <?php echo e($minLabel, false); ?>

                                        <span class="font-bold text-red-400">*</span>
                                    </label>
                                    <select id="min_price_select" wire:model.live="min_price"
                                        class="block w-full rounded-md border border-slate-200 bg-white px-3 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-200 dark:focus:ring-primary-800">
                                        <option value="">اختر السعر الأدنى</option>
                                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $priceRanges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $range): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($range['min'], false); ?>"><?php echo e($range['label'], false); ?> <?php echo e($currency_symbol, false); ?><?php echo e($isHourly ? ' / ' . __('messages.t_hour_short') : '', false); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                    </select>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['min_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400"><?php echo e($message, false); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div>
                                    <label for="max_price_select" class="block text-xs font-bold tracking-wide mb-2.5 text-slate-700 dark:text-white">
                                        <?php echo e($maxLabel, false); ?>

                                        <span class="font-bold text-red-400">*</span>
                                    </label>
                                    <select id="max_price_select" wire:model.live="max_price"
                                        class="block w-full rounded-md border border-slate-200 bg-white px-3 py-2.5 text-sm font-medium text-slate-700 shadow-sm transition focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-200 dark:focus:ring-primary-800">
                                        <option value="">اختر السعر الأقصى</option>
                                        <?php if($min_price): ?>
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $priceRanges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $range): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <!--[if BLOCK]><![endif]--><?php if($range['max'] > $min_price): ?>
                                                    <option value="<?php echo e($range['max'], false); ?>"><?php echo e($range['max'], false); ?>+ <?php echo e($currency_symbol, false); ?><?php echo e($isHourly ? ' / ' . __('messages.t_hour_short') : '', false); ?></option>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        <?php else: ?>
                                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $priceRanges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $range): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($range['max'], false); ?>"><?php echo e($range['max'], false); ?>+ <?php echo e($currency_symbol, false); ?><?php echo e($isHourly ? ' / ' . __('messages.t_hour_short') : '', false); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </select>
                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['max_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1 text-xs font-medium text-red-600 dark:text-red-400"><?php echo e($message, false); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </div>

                            <!--[if BLOCK]><![endif]--><?php if($isHourly): ?>
                                <div class="mt-6 grid gap-6 lg:grid-cols-[minmax(0,1.2fr)_minmax(0,1fr)]">
                                    <div>
                                        <?php if (isset($component)) { $__componentOriginal0241d3f51813223308810020791c4a83 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0241d3f51813223308810020791c4a83 = $attributes; } ?>
<?php $component = App\View\Components\Forms\TextInput::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\TextInput::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['required' => true,'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_hourly_weekly_limit')),'placeholder' => '40','model' => 'hourly_weekly_limit','suffix' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_hours_per_week_suffix'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0241d3f51813223308810020791c4a83)): ?>
<?php $attributes = $__attributesOriginal0241d3f51813223308810020791c4a83; ?>
<?php unset($__attributesOriginal0241d3f51813223308810020791c4a83); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0241d3f51813223308810020791c4a83)): ?>
<?php $component = $__componentOriginal0241d3f51813223308810020791c4a83; ?>
<?php unset($__componentOriginal0241d3f51813223308810020791c4a83); ?>
<?php endif; ?>
                                    </div>
                                    <div
                                        class="space-y-4 rounded-2xl border border-slate-200 bg-white/80 px-5 py-5 shadow-sm dark:border-zinc-600 dark:bg-zinc-800">
                                        <div>
                                            <?php if (isset($component)) { $__componentOriginal9c5d7e5b2e4b8b16cfa941b5e69189f3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c5d7e5b2e4b8b16cfa941b5e69189f3 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Checkbox::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Checkbox::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_hourly_allow_manual_time')),'model' => 'hourly_allow_manual_time']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9c5d7e5b2e4b8b16cfa941b5e69189f3)): ?>
<?php $attributes = $__attributesOriginal9c5d7e5b2e4b8b16cfa941b5e69189f3; ?>
<?php unset($__attributesOriginal9c5d7e5b2e4b8b16cfa941b5e69189f3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c5d7e5b2e4b8b16cfa941b5e69189f3)): ?>
<?php $component = $__componentOriginal9c5d7e5b2e4b8b16cfa941b5e69189f3; ?>
<?php unset($__componentOriginal9c5d7e5b2e4b8b16cfa941b5e69189f3); ?>
<?php endif; ?>
                                            <p class="mt-2 text-[12px] leading-6 text-slate-500 dark:text-zinc-400">
                                                <?php echo app('translator')->get('messages.t_hourly_allow_manual_time_hint'); ?>
                                            </p>
                                        </div>
                                        <div>
                                            <?php if (isset($component)) { $__componentOriginal9c5d7e5b2e4b8b16cfa941b5e69189f3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9c5d7e5b2e4b8b16cfa941b5e69189f3 = $attributes; } ?>
<?php $component = App\View\Components\Forms\Checkbox::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('forms.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Forms\Checkbox::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('messages.t_hourly_auto_approve_low_activity')),'model' => 'hourly_auto_approve_low_activity']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9c5d7e5b2e4b8b16cfa941b5e69189f3)): ?>
<?php $attributes = $__attributesOriginal9c5d7e5b2e4b8b16cfa941b5e69189f3; ?>
<?php unset($__attributesOriginal9c5d7e5b2e4b8b16cfa941b5e69189f3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9c5d7e5b2e4b8b16cfa941b5e69189f3)): ?>
<?php $component = $__componentOriginal9c5d7e5b2e4b8b16cfa941b5e69189f3; ?>
<?php unset($__componentOriginal9c5d7e5b2e4b8b16cfa941b5e69189f3); ?>
<?php endif; ?>
                                            <p class="mt-2 text-[12px] leading-6 text-slate-500 dark:text-zinc-400">
                                                <?php echo app('translator')->get('messages.t_hourly_auto_approve_low_activity_hint'); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                            <div
                                class="rounded-2xl border border-slate-200 bg-white/80 px-5 py-5 shadow-sm dark:border-zinc-600 dark:bg-zinc-800">
                                <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <h3 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">اتفاقية عدم
                                            الإفصاح (NDA)</h3>
                                        <p class="text-[12.5px] text-slate-500 dark:text-zinc-400">
                                            فعّل هذا الخيار إذا رغبت أن يوافق المستقل على NDA مولّد تلقائياً قبل مشاركة
                                            ملفات المشروع الحساسة.
                                        </p>
                                    </div>
                                    <label
                                        class="inline-flex items-center gap-2 text-sm font-semibold text-primary-600 dark:text-primary-300">
                                        <input type="checkbox" wire:model.lazy="requires_nda"
                                            class="h-4 w-4 rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                                        <span>مطلوب توقيع NDA</span>
                                    </label>
                                </div>
                                <!--[if BLOCK]><![endif]--><?php if($requires_nda): ?>
                                    <div class="mt-5 grid gap-4 md:grid-cols-2">
                                        <div class="md:col-span-2 space-y-2">
                                            <label class="text-[12px] font-semibold text-slate-500 dark:text-zinc-300">نطاق
                                                السرية</label>
                                            <textarea rows="3"
                                                class="block w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-200"
                                                placeholder="حدد الأصول أو الملفات أو البيانات التي يجب الحفاظ على سريتها."
                                                wire:model.defer="nda_scope" maxlength="500"></textarea>
                                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['nda_scope'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-[11.5px] font-medium text-red-600"><?php echo e($message, false); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                        <div class="space-y-2">
                                            <label class="text-[12px] font-semibold text-slate-500 dark:text-zinc-300">مدة
                                                السرية (بالأشهر)</label>
                                            <input type="number" min="1" max="60"
                                                class="block w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-200"
                                                wire:model.defer="nda_term_months" />
                                            <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['nda_term_months'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-[11.5px] font-medium text-red-600"><?php echo e($message, false); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                        <div class="space-y-2">
                                            <label class="text-[12px] font-semibold text-slate-500 dark:text-zinc-300">معاينة
                                                مختصرة</label>
                                            <div
                                                class="rounded-xl border border-dashed border-slate-200 bg-slate-50 p-3 text-[12px] leading-6 text-slate-600 dark:border-zinc-600 dark:bg-zinc-900/40 dark:text-zinc-300">
                                                <p class="font-semibold text-primary-600 dark:text-primary-300">
                                                    <?php echo e(auth()->user()->fullname ?? auth()->user()->username, false); ?> ×
                                                    <?php echo e(__('messages.t_freelancer'), false); ?>

                                                </p>
                                                <p>يقر الطرفان بالحفاظ على السرية حتى
                                                    <?php echo e(now()->addMonths(max(1, (int) ($nda_term_months ?? 12)))->format('Y-m-d'), false); ?>

                                                    وتشمل المعلومات التالية:
                                                    <?php echo e($nda_scope ? \Illuminate\Support\Str::limit($nda_scope, 120) : 'وصف المشروع، الملفات المرفقة، والحلول المقترحة.', false); ?>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>

                        <!--[if BLOCK]><![endif]--><?php if(settings('projects')->is_premium_posting): ?>
                            <div class="space-y-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
                                            <?php echo app('translator')->get('messages.t_promotion'); ?>
                                        </h3>
                                        <p class="mt-1 text-[12.5px] text-slate-500 dark:text-zinc-400">
                                            <?php echo e(settings('projects')->is_free_posting ? __('messages.t_make_ur_project_premium_optional') : __('messages.t_make_ur_project_premium'), false); ?>

                                        </p>
                                    </div>
                                    <span
                                        class="inline-flex items-center gap-2 rounded-full bg-primary-50 px-3 py-1 text-[11px] font-semibold text-primary-600 dark:bg-primary-500/10 dark:text-primary-200">
                                        <i class="ph ph-megaphone-simple text-xs"></i>
                                        موصى به
                                    </span>
                                </div>

                                <div class="space-y-4">
                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $is_plan_selected = in_array($plan->id, $selected_plans); ?>
                                        <div class="rounded-2xl border px-5 py-4 shadow-sm transition <?php echo e($is_plan_selected ? 'border-primary-500/80 ring-1 ring-primary-400/50 bg-primary-50/70 dark:border-primary-400/60 dark:bg-primary-500/10' : 'border-slate-200 bg-white dark:border-zinc-700 dark:bg-zinc-800', false); ?>"
                                            wire:key="post-project-plans-<?php echo e($plan->id, false); ?>">
                                            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                                                <div class="flex flex-1 flex-col gap-3">
                                                    <div class="flex flex-wrap items-center gap-3">
                                                        <span
                                                            class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold"
                                                            style="color:<?php echo e($plan->text_color, false); ?>;background-color:<?php echo e($plan->bg_color, false); ?>">
                                                            <i class="ph ph-sparkle text-[11px]"></i>
                                                            <span><?php echo e($plan->title, false); ?></span>
                                                        </span>
                                                        <span class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                                                            <?php echo e(money($plan->price, settings('currency')->code, true), false); ?>

                                                        </span>
                                                        <!--[if BLOCK]><![endif]--><?php if($plan->days): ?>
                                                            <span class="text-[12px] text-slate-500 dark:text-zinc-400">
                                                                <?php echo e($plan->days, false); ?>

                                                                <?php echo e($plan->days > 1 ? __('messages.t_days') : __('messages.t_day'), false); ?>

                                                            </span>
                                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                    </div>
                                                    <p class="text-[12.5px] leading-6 text-slate-600 dark:text-zinc-300">
                                                        <?php echo e($plan->description, false); ?>

                                                    </p>
                                                </div>
                                                <div class="flex flex-none">
                                                    <button type="button"
                                                        class="inline-flex items-center gap-2 rounded-full border px-4 py-2 text-xs font-semibold transition <?php echo e($is_plan_selected ? 'border-primary-600 bg-primary-600 text-white hover:bg-primary-700' : 'border-slate-200 bg-white text-slate-600 hover:border-primary-200 hover:text-primary-600 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-300', false); ?>"
                                                        wire:click="addPlan(<?php echo e($plan->id, false); ?>)">
                                                        <span>
                                                            <?php echo e($is_plan_selected ? __('messages.t_selected') : __('messages.t_select'), false); ?>

                                                        </span>
                                                        <i class="ph ph-arrow-circle-right text-sm"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                </div>

                                <div
                                    class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 dark:border-zinc-600 dark:bg-zinc-800">
                                    <div>
                                        <p
                                            class="text-[12.5px] font-semibold uppercase tracking-wide text-slate-500 dark:text-zinc-400">
                                            <?php echo app('translator')->get('messages.t_total'); ?>
                                        </p>
                                        <p class="text-sm text-slate-600 dark:text-zinc-300">
                                            يشمل مجموع خيارات إبراز المشروع إن تم اختيارها.
                                        </p>
                                    </div>
                                    <div class="text-lg font-bold text-zinc-900 dark:text-white">
                                        <?php echo e(money($promoting_total, settings('currency')->code, true), false); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>

                    </div>

                </section>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            
            <!--[if BLOCK]><![endif]--><?php if($step === 3): ?>
                <section class="rounded-xl bg-white dark:bg-zinc-900/50 shadow-sm border border-slate-200/50 dark:border-zinc-800/50">
                    <div class="px-5 py-6 sm:px-6 sm:py-8">
                        <div class="grid gap-6 lg:grid-cols-[minmax(0,1.6fr)_minmax(320px,1fr)]">
                        <article
                            class="rounded-3xl border border-slate-200 bg-white/95 p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                            <header class="border-b border-slate-200 pb-5 dark:border-zinc-700">
                                <p
                                    class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400 dark:text-zinc-500">
                                    عنوان المشروع</p>
                                <h3 class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-zinc-100">
                                    <?php echo e($review['title'] ?: 'لم يتم إدخال عنوان', false); ?>

                                </h3>
                                <div
                                    class="mt-4 flex flex-wrap gap-2 text-[12px] font-semibold uppercase tracking-[0.15em] text-slate-500 dark:text-zinc-400">
                                    <!--[if BLOCK]><![endif]--><?php if($review['category']): ?>
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 dark:bg-zinc-800">
                                            <i class="ph ph-folders"></i>
                                            <?php echo e($review['category'], false); ?>

                                        </span>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    <!--[if BLOCK]><![endif]--><?php if($review['salary_type'] === 'hourly'): ?>
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 dark:bg-zinc-800">
                                            <i class="ph ph-clock"></i>
                                            أجر بالساعة
                                        </span>
                                    <?php else: ?>
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 dark:bg-zinc-800">
                                            <i class="ph ph-target"></i>
                                            ميزانية ثابتة
                                        </span>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    <!--[if BLOCK]><![endif]--><?php if($review['budget_label']): ?>
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full bg-primary-50 px-3 py-1 text-primary-600 dark:bg-primary-500/15 dark:text-primary-200">
                                            <i class="ph ph-coins"></i>
                                            <?php echo e($review['budget_label'], false); ?>

                                        </span>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    <!--[if BLOCK]><![endif]--><?php if($review['requires_nda']): ?>
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1 text-emerald-700 dark:bg-emerald-500/15 dark:text-emerald-200">
                                            <i class="ph ph-shield-check"></i>
                                            NDA مطلوب
                                        </span>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            </header>
                            <div class="mt-6 space-y-6 text-[14px] leading-7 text-slate-600 dark:text-zinc-300">
                                <div>
                                    <h4 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">الوصف التفصيلي</h4>
                                    <p class="mt-2 whitespace-pre-line">
                                        <?php echo e($review['description'] ?: 'لم يتم إدخال وصف للمشروع بعد.', false); ?>

                                    </p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">المهارات المطلوبة
                                    </h4>
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $review['skills']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <span
                                                class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-[12px] font-semibold text-slate-600 dark:bg-zinc-800 dark:text-zinc-200">
                                                <i class="ph ph-lightning text-xs"></i>
                                                <?php echo e($skill['name'] ?? $skill, false); ?>

                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <span class="text-[12px] text-slate-500 dark:text-zinc-400">لم يتم اختيار
                                                مهارات.</span>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </div>
                                </div>
                                <div class="grid gap-6 md:grid-cols-2">
                                    <div>
                                        <h4 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">أسئلة للمستقلين
                                        </h4>
                                        <ul class="mt-3 space-y-2 text-[13px] leading-6">
                                            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $review['questions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <li class="rounded-2xl bg-slate-50 px-3 py-2 dark:bg-zinc-800">
                                                    <div class="flex items-start justify-between gap-2">
                                                        <span><?php echo e($question['text'], false); ?></span>
                                                        <!--[if BLOCK]><![endif]--><?php if($question['is_required']): ?>
                                                            <span
                                                                class="inline-flex items-center gap-1 rounded-full bg-rose-100 px-2 py-0.5 text-[11px] font-semibold text-rose-600 dark:bg-rose-500/15 dark:text-rose-200">
                                                                <i class="ph ph-asterisk text-xs"></i>
                                                                إلزامي
                                                            </span>
                                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <li class="text-[12px] text-slate-500 dark:text-zinc-400">لا توجد أسئلة إضافية.
                                                </li>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </ul>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">المرفقات</h4>
                                        <ul class="mt-3 space-y-2 text-[13px] leading-6">
                                            <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $review['attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <li
                                                    class="flex items-center gap-2 rounded-2xl bg-slate-50 px-3 py-2 dark:bg-zinc-800">
                                                    <i class="ph ph-paperclip text-sm text-primary-500"></i>
                                                    <span class="truncate"><?php echo e($attachment, false); ?></span>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <li class="text-[12px] text-slate-500 dark:text-zinc-400">لا توجد مرفقات مضافة.
                                                </li>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">الدفعات المقترحة</h4>
                                    <ul class="mt-3 space-y-2 text-[13px] leading-6">
                                        <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $review['milestones']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <li
                                                class="flex items-center justify-between gap-3 rounded-2xl bg-white px-4 py-3 shadow-sm ring-1 ring-slate-100 dark:bg-zinc-800 dark:ring-zinc-700">
                                                <span><?php echo e($milestone['title'], false); ?></span>
                                                <!--[if BLOCK]><![endif]--><?php if(!empty($milestone['amount'])): ?>
                                                    <span
                                                        class="text-sm font-semibold text-primary-600 dark:text-primary-200"><?php echo e($milestone['amount'], false); ?></span>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <li class="text-[12px] text-slate-500 dark:text-zinc-400">لن تظهر دفعات حتى يقدّم
                                                المستقلون عروضهم.</li>
                                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    </ul>
                                </div>
                            </div>
                        </article>
                        <aside
                            class="space-y-6 rounded-3xl border border-slate-200 bg-white/95 p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900/90">
                            <div>
                                <h4 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">ملخص سريع</h4>
                                <dl class="mt-3 space-y-2 text-[13px] text-slate-600 dark:text-zinc-300">
                                    <!--[if BLOCK]><![endif]--><?php if($review['category']): ?>
                                        <div class="flex items-center justify-between gap-2">
                                            <dt>الفئة</dt>
                                            <dd><?php echo e($review['category'], false); ?></dd>
                                        </div>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    <!--[if BLOCK]><![endif]--><?php if($review['budget_label']): ?>
                                        <div class="flex items-center justify-between gap-2">
                                            <dt>الميزانية</dt>
                                            <dd><?php echo e($review['budget_label'], false); ?></dd>
                                        </div>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                    <div class="flex items-center justify-between gap-2">
                                        <dt>نوع الدفع</dt>
                                        <dd><?php echo e($review['salary_type'] === 'hourly' ? 'بالساعة' : 'سعر ثابت', false); ?></dd>
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php if($review['requires_nda']): ?>
                                        <div class="flex items-center justify-between gap-2">
                                            <dt>NDA</dt>
                                            <dd>مطلوب (<?php echo e($review['nda_term'] ?? 12, false); ?> شهر)</dd>
                                        </div>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </dl>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">خيارات الترويج</h4>
                                <ul class="mt-3 space-y-2 text-[13px] text-slate-600 dark:text-zinc-300">
                                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $review['plans']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <li
                                            class="flex items-center justify-between gap-2 rounded-2xl bg-slate-50 px-3 py-2 dark:bg-zinc-800">
                                            <span><?php echo e($plan['title'], false); ?></span>
                                            <span
                                                class="text-sm font-semibold text-primary-600 dark:text-primary-200"><?php echo e($plan['price'], false); ?></span>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <li class="text-[12px] text-slate-500 dark:text-zinc-400">لم يتم اختيار أي خيارات
                                            ترويجية.</li>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </ul>
                                <!--[if BLOCK]><![endif]--><?php if($review['plans_total']): ?>
                                    <div
                                        class="mt-3 rounded-2xl bg-primary-50 px-4 py-2 text-right text-[12.5px] font-semibold text-primary-700 dark:bg-primary-500/15 dark:text-primary-200">
                                        <?php echo e(__('messages.t_total'), false); ?>:
                                        <?php echo e(money($review['plans_total'], settings('currency')->code, true), false); ?>

                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </aside>
                    </div>
                    </div>
                </section>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>

            <aside class="space-y-6">
                
                <div class="fixed right-4 top-28 w-[360px] z-40 hidden lg:flex flex-col h-[calc(100vh-8rem)] rounded-2xl border border-slate-200 bg-white/95 backdrop-blur-sm shadow-xl dark:border-zinc-800 dark:bg-zinc-900/95" 
                                x-data="{ 
                                    showSuggestions: false,
                                    suggestions: [],
                                    searchDebounce: null,
                                    isTyping: false,
                                    init() {
                                        this.$watch('$wire.templateMessage', (value) => {
                                            clearTimeout(this.searchDebounce);
                                            if (value && value.length > 2) {
                                                this.isTyping = true;
                                                this.searchDebounce = setTimeout(() => {
                                                    this.showSuggestions = true;
                                                    this.isTyping = false;
                                                    window.Livewire.find('<?php echo e($_instance->getId(), false); ?>').call('searchTemplates', value).then((results) => {
                                                        this.suggestions = results || [];
                                                    });
                                                }, 300);
                                            } else {
                                                this.showSuggestions = false;
                                                this.suggestions = [];
                                                this.isTyping = false;
                                            }
                                        });
                                    },
                                    selectTemplate(template) {
                                        $wire.templateMessage = template.name;
                                        this.showSuggestions = false;
                                        setTimeout(() => {
                                            $wire.sendTemplatePrompt();
                                        }, 100);
                                    }
                                }">
                                <div class="p-4 border-b border-slate-200 dark:border-zinc-800 bg-gradient-to-r from-primary-50 to-sky-50 dark:from-primary-900/20 dark:to-sky-900/20">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary-100 text-primary-600 dark:bg-primary-500/20 dark:text-primary-300">
                                            <i class="ph ph-sparkle text-xl"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-[11px] font-semibold uppercase tracking-wide text-primary-500 dark:text-primary-300">قوالب ذكية</p>
                                            <h3 class="text-sm font-bold text-slate-900 dark:text-white">اختر قالباً يملأ العنوان، الوصف والمهارات تلقائياً</h3>
                                            <p class="text-xs text-slate-600 dark:text-zinc-400 mt-0.5">اكتب وصف مشروعك ليقترح لك المساعد أقرب قالب</p>
                                        </div>
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php if($activeTemplate): ?>
                                        <div class="mt-3 flex items-center justify-between rounded-lg bg-emerald-50 px-3 py-2 dark:bg-emerald-900/20">
                                            <div class="flex items-center gap-2">
                                                <i class="ph ph-check-circle text-emerald-600 dark:text-emerald-400"></i>
                                                <span class="text-xs font-semibold text-emerald-700 dark:text-emerald-200">قالب مفعل</span>
                                            </div>
                                            <button type="button" class="text-[10px] font-semibold text-emerald-700 hover:text-emerald-900 dark:text-emerald-200"
                                                wire:click="clearTemplate">
                                                إزالة
                                            </button>
                                        </div>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div class="flex-1 overflow-y-auto p-4 space-y-3 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 dark:scrollbar-thumb-zinc-900 dark:scrollbar-track-zinc-600">
                                    
                                    <div x-show="showSuggestions && suggestions.length > 0" 
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 transform translate-y-2"
                                        x-transition:enter-end="opacity-100 transform translate-y-0"
                                        class="space-y-2 mb-4">
                                        <div class="flex items-center gap-1.5 text-[10px] font-semibold text-primary-600 dark:text-primary-400">
                                            <i class="ph ph-sparkle text-xs"></i>
                                            <span>اقتراحات ذكية:</span>
                                        </div>
                                        <div class="grid gap-2">
                                            <template x-for="(template, index) in suggestions.slice(0, 4)" :key="index">
                                                <button type="button"
                                                    @click="selectTemplate(template)"
                                                    class="group text-right rounded-xl border-2 border-primary-200 bg-gradient-to-r from-primary-50 to-sky-50 p-3 transition-all hover:border-primary-400 hover:shadow-md dark:border-primary-800/40 dark:from-primary-900/20 dark:to-sky-900/20 dark:hover:border-primary-600">
                                                    <div class="flex items-start justify-between gap-2">
                                                        <i class="ph ph-magic-wand text-primary-600 dark:text-primary-400 text-base flex-shrink-0"></i>
                                                        <div class="flex-1 min-w-0">
                                                            <div class="font-bold text-xs text-primary-900 dark:text-primary-100 mb-1" x-text="template.name"></div>
                                                            <div x-show="template.summary" class="text-[10px] font-normal text-primary-700/80 dark:text-primary-300/70 line-clamp-2" x-text="template.summary"></div>
                                                        </div>
                                                    </div>
                                                </button>
                                            </template>
                                        </div>
                                    </div>
                                    
                                    <!--[if BLOCK]><![endif]--><?php $__empty_1 = true; $__currentLoopData = $templateConversation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <?php
                                            $isUserMessage = ($message['role'] ?? 'assistant') === 'user';
                                            $timestamp = $message['timestamp'] ?? null;
                                        ?>
                                        <div wire:key="template-msg-<?php echo e($loop->index, false); ?>"
                                            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                                'rounded-xl px-3 py-2 text-xs leading-relaxed',
                                                'bg-primary-600/10 text-primary-900 dark:bg-primary-500/20 dark:text-primary-100 text-right' => $isUserMessage,
                                                'bg-slate-100 text-slate-700 dark:bg-zinc-800/80 dark:text-zinc-100 text-right' => !$isUserMessage,
                                            ]); ?>">
                                            <div class="mb-1 flex items-center justify-between text-[10px] font-semibold">
                                                <span><?php echo e($isUserMessage ? 'أنت' : 'المساعد', false); ?></span>
                                                <!--[if BLOCK]><![endif]--><?php if($timestamp): ?>
                                                    <time class="text-[10px] font-normal text-slate-400 dark:text-zinc-500">
                                                        <?php echo e(\Illuminate\Support\Carbon::parse($timestamp)->diffForHumans(null, null, true), false); ?>

                                                    </time>
                                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                            </div>
                                            <p class="whitespace-pre-line text-[11px]">
                                                <?php echo e($message['content'], false); ?>

                                            </p>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="text-center py-8">
                                            <i class="ph ph-sparkle text-3xl text-primary-400 dark:text-primary-500 mb-2"></i>
                                            <p class="text-xs font-semibold text-slate-700 dark:text-zinc-300 mb-1">ابدأ بكتابة وصف مشروعك</p>
                                            <p class="text-[11px] text-slate-500 dark:text-zinc-400">سيقترح لك المساعد القوالب المناسبة تلقائياً</p>
                                        </div>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                                <div class="p-4 border-t border-slate-200 dark:border-zinc-800 space-y-2">
                                    <div x-show="isTyping" class="flex items-center gap-2 text-[10px] text-slate-500 dark:text-zinc-400 mb-2">
                                        <i class="ph ph-circle-dashed animate-spin text-xs"></i>
                                        <span>جارٍ البحث عن قوالب مناسبة...</span>
                                    </div>
                                    <form wire:submit.prevent="sendTemplatePrompt" class="flex items-center gap-2">
                                        <div class="relative flex-1">
                                            <input type="text"
                                                wire:model.live.debounce.300ms="templateMessage"
                                                placeholder="اكتب وصف مشروعك..."
                                                class="w-full rounded-xl border border-slate-200 bg-white/90 px-3 py-2 text-xs text-slate-700 placeholder:text-slate-400 focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200 dark:border-zinc-700 dark:bg-zinc-900/60 dark:text-zinc-100 dark:placeholder:text-zinc-500" />
                                        </div>
                                        <button type="submit"
                                            class="inline-flex items-center gap-1 rounded-xl bg-primary-600 px-3 py-2 text-xs font-semibold text-white transition hover:bg-primary-700 disabled:opacity-60"
                                            wire:loading.attr="disabled"
                                            wire:target="sendTemplatePrompt">
                                            <i class="ph ph-paper-plane-tilt text-sm"></i>
                                            <span class="hidden sm:inline">إرسال</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
            </aside>
        </div>

        <?php
            $progressPercent = $totalSteps > 1 ? ($step / ($totalSteps - 1)) * 100 : 0;
            $isFirstStep = $step === 0;
            $isLastStep = $step === ($totalSteps - 1);
            $primaryAction = $isLastStep ? 'create' : 'nextStep';
            $primaryLabel = $isLastStep ? __('messages.t_post_project') : 'التالي';
            $primaryIcon = $isLastStep ? 'ph-paper-plane-right' : 'ph-arrow-left';
            $prevLabel = $isLastStep ? 'عودة للتعديل' : 'السابق';
        ?>

        
        <div class="post-project-navigation fixed bottom-0 left-0 right-0 z-50 bg-white dark:bg-zinc-900 border-t border-slate-200 dark:border-zinc-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3">
                
                <div class="mb-3">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs font-medium text-slate-600 dark:text-zinc-400">
                            الخطوة <?php echo e($step + 1, false); ?> من <?php echo e($totalSteps, false); ?>

                        </span>
                        <span class="text-xs font-semibold text-primary-600 dark:text-primary-400">
                            <?php echo e(round($progressPercent), false); ?>%
                        </span>
                    </div>
                    <div class="h-1.5 w-full rounded-full bg-slate-200 dark:bg-zinc-700 overflow-hidden">
                        <div class="h-full rounded-full bg-gradient-to-r from-primary-500 via-sky-500 to-emerald-500 transition-all duration-500 ease-out"
                            style="width: <?php echo e($progressPercent, false); ?>%;">
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center justify-between gap-3 rtl:flex-row-reverse">
                        <button type="button"
                        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            'inline-flex items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition-colors dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-300 min-h-[44px] shadow-sm hover:shadow-md',
                            'hover:border-primary-300 hover:bg-primary-50 dark:hover:border-primary-600 dark:hover:bg-primary-900/20' => !$isFirstStep,
                            'opacity-50 cursor-not-allowed' => $isFirstStep,
                        ]); ?>"
                        wire:click="prevStep"
                        <?php if($isFirstStep): echo 'disabled'; endif; ?>>
                        <i class="ph ph-arrow-right text-sm rtl:rotate-180"></i>
                        <span><?php echo e($prevLabel, false); ?></span>
                    </button>
                    <button type="button"
                        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                            'inline-flex items-center justify-center gap-2 rounded-lg px-5 py-2.5 text-sm font-semibold text-white transition-colors min-h-[44px] shadow-sm hover:shadow-md disabled:opacity-50 disabled:cursor-not-allowed',
                            'bg-emerald-600 hover:bg-emerald-700' => $isLastStep,
                            'bg-primary-600 hover:bg-primary-700' => !$isLastStep,
                        ]); ?>"
                        wire:click="<?php echo e($primaryAction, false); ?>"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-70"
                        wire:target="<?php echo e($primaryAction, false); ?>">
                        <span wire:loading.remove wire:target="<?php echo e($primaryAction, false); ?>"><?php echo e($primaryLabel, false); ?></span>
                        <i class="ph <?php echo e($primaryIcon, false); ?> text-sm rtl:rotate-180" wire:loading.remove wire:target="<?php echo e($primaryAction, false); ?>"></i>
                        <svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none" wire:loading
                            wire:target="<?php echo e($primaryAction, false); ?>">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                        </button>
                    </div>
        </div>
        </div>

    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('projectIntro', () => ({
                showIntro: true,

                init() {
                    if (window.localStorage) {
                        this.showIntro = localStorage.getItem('project-wizard-intro') !== 'hidden';
                    }
                },

                dismissIntro(persist = false) {
                    this.showIntro = false;
                    if (persist && window.localStorage) {
                        localStorage.setItem('project-wizard-intro', 'hidden');
                    }
                },
            }));
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
    <style>
        .post-project-navigation {
            box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1), 0 -2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        [dir="rtl"] .post-project-navigation {
            direction: rtl;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('hideMainFooter'); ?>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\xampp\htdocs\taquad\resources\views/livewire/main/post/project.blade.php ENDPATH**/ ?>