@php
    $wizardSteps = [
        ['id' => 0, 'label' => 'الفكرة والهدف', 'caption' => 'صِف النتيجة، الجمهور، والأسئلة الحرجة.'],
        ['id' => 1, 'label' => 'الفريق والمتطلبات', 'caption' => 'اختر المهارات وجهّز ملفات السياق.'],
        ['id' => 2, 'label' => 'الميزانية والإطلاق', 'caption' => 'ثبّت الميزانية وخيارات الترويج.'],
        ['id' => 3, 'label' => 'معاينة قبل النشر', 'caption' => 'راجع كل التفاصيل قبل الإطلاق.'],
    ];
    $activeTemplate = $this->selectedTemplateData;
@endphp

<div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 mt-[7rem] py-12 lg:pt-16 lg:pb-24" x-data="projectIntro()"
    x-init="init()" x-cloak>
    <div wire:loading.flex
        class="fixed inset-0 z-[70] items-center justify-center bg-white/80 backdrop-blur-sm dark:bg-slate-900/70">
        <div class="flex flex-col items-center gap-3 text-sm font-semibold text-primary-600 dark:text-primary-300">
            <svg class="h-10 w-10 animate-spin text-primary-500" viewBox="0 0 24 24" fill="none">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <span>@lang('messages.t_loading')</span>
        </div>
    </div>
    <div class="grid gap-8 lg:grid-cols-[minmax(0,2.1fr)_minmax(320px,1fr)]">
        <div class="space-y-8">

            {{-- Loading --}}
            {{-- <x-forms.loading /> --}}

            {{-- Guided intro --}}
            <div x-show="showIntro" x-transition.opacity.duration.300ms
                class="rounded-2xl border border-primary-100 bg-primary-50/70 px-6 py-5 text-sm text-primary-700 shadow-sm dark:border-primary-400/40 dark:bg-primary-500/10 dark:text-primary-200">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div class="space-y-2">
                        <p
                            class="text-xs font-semibold uppercase tracking-[0.2em] text-primary-500/90 dark:text-primary-300/90">
                            دليل البدء السريع
                        </p>
                        <h2 class="text-base font-bold text-primary-700 dark:text-primary-100">
                            ٤ خطوات ذكية لتنشر مشروعاً جاهزاً للتنفيذ
                        </h2>
                        <ul class="space-y-1.5 text-[13px] leading-5 text-primary-700/80 dark:text-primary-100/80">
                            <li class="flex items-start gap-2">
                                <i class="ph ph-lightbulb text-sm mt-0.5"></i>
                                <span>صف النتيجة المطلوبة بوضوح، وحدد خلفية الفريق أو المواد المساندة.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="ph ph-users-three text-sm mt-0.5"></i>
                                <span>اختر المهارات وارفـع ملفاتك عبر منطقة السحب والإفلات الجديدة.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="ph ph-currency-circle-dollar text-sm mt-0.5"></i>
                                <span>ثبت نطاق الميزانية وخيارات إبراز المشروع، بينما يقترح المستقلون الدفعات
                                    لاحقاً.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="flex flex-col items-stretch gap-2 md:w-56">
                        <button type="button"
                            class="inline-flex items-center justify-center gap-2 rounded-full bg-primary-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-700"
                            @click="dismissIntro(false)">
                            <span>ابدأ الجولة</span>
                            <i class="ph ph-arrow-right"></i>
                        </button>
                        <button type="button"
                            class="text-xs font-medium text-primary-600 underline-offset-4 hover:underline dark:text-primary-200"
                            @click="dismissIntro(true)">
                            لا تظهر هذه الرسالة مرة أخرى
                        </button>
                    </div>
                </div>
            </div>

            {{-- Flow header --}}
            @if (session()->has('preview_error'))
                <div
                    class="rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-xs font-semibold text-amber-700 dark:border-amber-500/40 dark:bg-amber-500/10 dark:text-amber-200">
                    {{ session('preview_error') }}
                </div>
            @endif

            <section
                class="relative overflow-hidden rounded-3xl border border-slate-200/70 bg-white/80 px-6 py-10 shadow-xl backdrop-blur-sm dark:border-zinc-700/70 dark:bg-zinc-900/70 sm:px-9 lg:px-12">
                <div
                    class="pointer-events-none absolute -top-24 ltr:-right-24 rtl:-left-24 h-64 w-64 rounded-full bg-primary-500/15 blur-3xl dark:bg-primary-400/20">
                </div>
                <div
                    class="pointer-events-none absolute top-1/2 -translate-y-1/2 ltr:-left-28 rtl:-right-28 h-64 w-64 rounded-full bg-sky-400/10 blur-3xl">
                </div>

                <div class="relative flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                    <div class="flex items-start gap-4">
                        <div
                            class="flex h-14 w-14 flex-none items-center justify-center rounded-2xl bg-gradient-to-br from-primary-500 to-sky-500 text-2xl text-white shadow-lg shadow-primary-500/35">
                            <i class="ph-duotone ph-briefcase"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-black tracking-tight text-slate-900 dark:text-white">
                                @lang('messages.t_post_new_project')
                            </h1>
                            <p class="mt-2 text-sm leading-relaxed text-slate-500 dark:text-zinc-300">
                                @lang('messages.t_post_new_project_subtitle')
                            </p>
                        </div>
                    </div>
                    @if ($activeTemplate)
                        <div
                            class="relative flex w-full flex-col gap-2 rounded-2xl border border-primary-200/60 bg-primary-50/50 px-4 py-4 text-sm text-primary-700 shadow-inner dark:border-primary-400/30 dark:bg-primary-500/10 dark:text-primary-100 md:w-72">
                            <div class="flex items-center gap-2 text-[13px] font-semibold uppercase tracking-wide">
                                <i class="ph-duotone ph-magic-wand text-base"></i>
                                <span>{{ $activeTemplate['name'] ?? __('messages.t_selected') }}</span>
                            </div>
                            <p class="leading-relaxed text-[13px] text-primary-700/80 dark:text-primary-100/80">
                                {{ $activeTemplate['headline'] ?? '' }}
                            </p>
                        </div>
                    @endif
                </div>

                @php
                    $totalSteps = count($wizardSteps);
                    $progressPercent = $totalSteps > 1 ? ($step / ($totalSteps - 1)) * 100 : 0;
                @endphp

                <div class="relative mt-10">
                    <div class="h-2 w-full rounded-full bg-slate-100 dark:bg-zinc-700">
                        <div class="h-2 rounded-full bg-gradient-to-r from-primary-500 via-sky-500 to-emerald-400 transition-all duration-500"
                            style="width: {{ $progressPercent }}%;">
                        </div>
                    </div>
                    <div class="mt-7 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($wizardSteps as $wizardStep)
                            @php
                                $isCurrent = $wizardStep['id'] === $step;
                                $isCompleted = $wizardStep['id'] < $step;
                                $isLocked = $wizardStep['id'] > $step;
                            @endphp
                            <div wire:key="wizard-step-{{ $wizardStep['id'] }}">
                                <button type="button" @if (!$isLocked) wire:click="$set('step', {{ $wizardStep['id'] }})"
                                @endif @disabled($isLocked) @class([
                                        'group relative flex w-full flex-col gap-3 rounded-2xl border bg-white/90 px-4 py-4 text-right shadow transition-all duration-200 dark:bg-zinc-900/80',
                                        'border-primary-500/70 shadow-primary-500/20 ring-2 ring-primary-500/40 dark:border-primary-400/60 dark:ring-primary-400/40' =>
                                            $isCurrent,
                                        'border-emerald-400/60 bg-emerald-50/70 text-emerald-700 dark:border-emerald-400/40 dark:bg-emerald-500/10 dark:text-emerald-200' =>
                                            $isCompleted,
                                        'border-slate-200/70 text-slate-500 hover:-translate-y-1 hover:border-primary-200 hover:text-primary-600 dark:border-zinc-700/70 dark:text-zinc-300' =>
                                            !$isCurrent && !$isCompleted,
                                        'cursor-not-allowed opacity-60 hover:translate-y-0 hover:border-slate-200 hover:text-slate-500 dark:hover:border-zinc-700' =>
                                            $isLocked,
                                    ])>
                                    <div class="flex items-center justify-between">
                                        <span @class([
                                            'flex h-10 w-10 flex-none items-center justify-center rounded-full text-sm font-semibold transition',
                                            'bg-gradient-to-br from-primary-500 to-sky-500 text-white shadow-lg shadow-primary-500/30' =>
                                                $isCurrent,
                                            'bg-emerald-500 text-white shadow-lg shadow-emerald-500/30' => $isCompleted,
                                            'bg-slate-100 text-slate-500 dark:bg-zinc-700 dark:text-zinc-200' =>
                                                !$isCurrent && !$isCompleted,
                                        ])>
                                            {{ $wizardStep['id'] + 1 }}
                                        </span>
                                    </div>
                                    <div class="text-start">
                                        <p @class([
                                            'text-[14px] font-semibold leading-5',
                                            'text-primary-600 dark:text-primary-200' => $isCurrent,
                                            'text-emerald-600 dark:text-emerald-200' => $isCompleted && !$isCurrent,
                                            'text-slate-600 dark:text-zinc-200' => !$isCurrent && !$isCompleted,
                                        ])>
                                            {{ $wizardStep['label'] }}
                                        </p>
                                        <p class="mt-2 text-[12px] leading-6 text-slate-500 dark:text-zinc-400">
                                            {{ $wizardStep['caption'] }}
                                        </p>
                                    </div>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            {{-- Step: Brief --}}
            @if ($step === 0)
                <section class="card px-5 sm:px-8 py-8 border border-slate-100/80 shadow-sm dark:border-zinc-700/60">
                    <div class="flex items-start gap-3 border-b border-slate-100 pb-6 dark:border-zinc-700/70">
                        <div
                            class="flex h-11 w-11 flex-none items-center justify-center rounded-xl bg-primary-100 text-primary-600 dark:bg-primary-500/15 dark:text-primary-200">
                            <i class="ph-duotone ph-lightbulb text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-base font-semibold text-zinc-900 dark:text-white">
                                ١. بلور الفكرة والهدف
                            </h2>
                            <p class="mt-1 text-sm text-slate-500 dark:text-zinc-400">
                                وثّق النتيجة التي تريدها، وحدد الفئة المناسبة، وأضف الأسئلة الاستكشافية لتسريع التقديمات
                                عالية الجودة.
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 space-y-8">
                        <div class="grid gap-6 md:grid-cols-2">
                            <x-forms.text-input required label="{{ __('messages.t_project_title') }}"
                                placeholder="{{ __('messages.t_enter_title') }}" model="title" icon="text-italic" />

                            <x-forms.select-simple required live model="category" :label="__('messages.t_category')"
                                :placeholder="__('messages.t_choose_category')">
                                <x-slot:options>
                                    @foreach ($categories as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </x-slot:options>
                            </x-forms.select-simple>
                        </div>

                        <div class="grid gap-6 lg:grid-cols-[minmax(0,1.4fr)_minmax(0,1fr)]">
                            <div>
                                <x-forms.textarea required label="{{ __('messages.t_project_description') }}"
                                    placeholder="{{ __('messages.t_enter_description') }}" model="description" :rows="14"
                                    icon="text" :hint="__('messages.t_post_project_description_hint')" />
                                @if (!empty($assistantShortcuts['description_blocks']) && is_array($assistantShortcuts['description_blocks']))
                                    <div
                                        class="mt-4 rounded-xl bg-slate-50 p-4 text-[12.5px] leading-6 text-slate-600 dark:bg-zinc-800 dark:text-zinc-300">
                                        <div
                                            class="mb-2 flex items-center gap-2 font-semibold text-slate-700 dark:text-zinc-200">
                                            <i class="ph-duotone ph-sparkle text-base text-primary-500"></i>
                                            <span>مقترحات تقسيم الوصف</span>
                                        </div>
                                        <ul class="space-y-1.5">
                                            @foreach ($assistantShortcuts['description_blocks'] as $block)
                                                <li class="flex items-start gap-2">
                                                    <i
                                                        class="ph ph-caret-left text-xs text-primary-500 dark:text-primary-300 mt-1"></i>
                                                    <span>{{ $block }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="space-y-5">
                                @if (!empty($assistantShortcuts['title_prompts']) && is_array($assistantShortcuts['title_prompts']))
                                    <div
                                        class="rounded-2xl border border-slate-200/80 bg-white/90 p-5 dark:border-zinc-700 dark:bg-zinc-800/80">
                                        <div
                                            class="flex items-center gap-2 text-sm font-semibold text-zinc-800 dark:text-zinc-100">
                                            <i class="ph-duotone ph-quotes text-lg text-primary-500"></i>
                                            <span>نصائح لصياغة عنوان جذاب</span>
                                        </div>
                                        <ul class="mt-4 space-y-2.5 text-[12.5px] leading-6 text-slate-600 dark:text-zinc-300">
                                            @foreach ($assistantShortcuts['title_prompts'] as $tip)
                                                <li class="flex items-start gap-2">
                                                    <i
                                                        class="ph ph-sparkle text-xs text-primary-500 dark:text-primary-300 mt-1"></i>
                                                    <span>{{ $tip }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (!empty($playbooks['briefing']) && is_array($playbooks['briefing']))
                                    <div
                                        class="rounded-2xl border border-indigo-100 bg-indigo-50/70 p-5 text-[12.5px] leading-6 text-indigo-800 dark:border-indigo-400/30 dark:bg-indigo-500/10 dark:text-indigo-200">
                                        <div class="flex items-center gap-2 text-sm font-semibold">
                                            <i class="ph-duotone ph-notepad text-lg"></i>
                                            <span>قائمة تحقق موجزة</span>
                                        </div>
                                        <ul class="mt-3 space-y-2">
                                            @foreach ($playbooks['briefing'] as $item)
                                                <li class="flex items-start gap-2">
                                                    <i class="ph ph-check-circle text-xs mt-1"></i>
                                                    <span>{{ $item }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
                                    @lang('messages.t_discovery_questions')
                                </h3>
                                <button type="button"
                                    class="inline-flex items-center gap-2 rounded-full bg-primary-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-primary-700"
                                    wire:click="addQuestion">
                                    <i class="ph ph-plus-circle text-sm"></i>
                                    <span>إضافة سؤال</span>
                                </button>
                            </div>
                            @if (is_array($questions) && count($questions))
                                <div class="space-y-3">
                                    @foreach ($questions as $i => $q)
                                        <div
                                            class="rounded-2xl border border-slate-200/70 bg-white/80 p-4 dark:border-zinc-700 dark:bg-zinc-800/70">
                                            <div class="flex items-start gap-3">
                                                <div
                                                    class="flex h-7 w-7 flex-none items-center justify-center rounded-full bg-primary-100 text-[12px] font-semibold text-primary-600 dark:bg-primary-500/15 dark:text-primary-200">
                                                    {{ $i + 1 }}
                                                </div>
                                                <div class="flex-1 space-y-3">
                                                    <input type="text"
                                                        class="block w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-200"
                                                        placeholder="{{ __('messages.t_question_placeholder') }}"
                                                        wire:model.defer="questions.{{ $i }}.text" maxlength="200" />
                                                    <label
                                                        class="inline-flex items-center gap-2 text-[12px] text-slate-500 dark:text-zinc-300">
                                                        <input type="checkbox" wire:model="questions.{{ $i }}.is_required"
                                                            class="rounded border-slate-300 text-primary-600 focus:ring-primary-500">
                                                        <span>@lang('messages.t_mark_question_required')</span>
                                                    </label>
                                                </div>
                                                <button type="button" class="text-xs font-medium text-red-600 hover:text-red-700"
                                                    wire:click="removeQuestion({{ $i }})">
                                                    @lang('messages.t_remove')
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div
                                    class="rounded-2xl border border-dashed border-slate-200 p-4 text-center text-[12.5px] text-slate-500 dark:border-zinc-600 dark:text-zinc-400">
                                    @lang('messages.t_project_discovery_questions_empty')
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mt-10 flex items-center justify-end gap-3">
                        <button type="button"
                            class="inline-flex items-center gap-2 rounded-full bg-primary-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-700 disabled:cursor-not-allowed"
                            wire:click="nextStep" wire:loading.attr="disabled" wire:loading.class="opacity-70"
                            wire:target="nextStep">
                            <span>التالي</span>
                            <i class="ph ph-arrow-circle-right text-base"></i>
                            <svg class="h-4 w-4 text-white/90" viewBox="0 0 24 24" fill="none" wire:loading
                                wire:target="nextStep">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                        </button>
                    </div>
                </section>
            @endif

            {{-- Step: Skills & files --}}
            @if ($step === 1)
                <section class="card px-5 sm:px-8 py-8 border border-slate-100/80 shadow-sm dark:border-zinc-700/60">
                    <div class="flex items-start gap-3 border-b border-slate-100 pb-6 dark:border-zinc-700/70">
                        <div
                            class="flex h-11 w-11 flex-none items-center justify-center rounded-xl bg-emerald-100 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-200">
                            <i class="ph-duotone ph-asterisk text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-base font-semibold text-zinc-900 dark:text-white">
                                ٢. مهارات الفريق والمواد الداعمة
                            </h2>
                            <p class="mt-1 text-sm text-slate-500 dark:text-zinc-400">
                                حدد المهارات المطلوبة، وارفع الملفات المرجعية، وامنح المستقلين السياق المناسب للنجاح من أول
                                مرة.
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 space-y-8">
                        <div class="grid gap-6 lg:grid-cols-[minmax(0,1.7fr)_minmax(280px,1fr)]">
                            <div class="space-y-6">
                                <div
                                    class="rounded-2xl border border-slate-200/80 bg-white/90 px-5 py-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-800/70">
                                    <div class="flex flex-wrap items-center justify-between gap-3">
                                        <div>
                                            <h3 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
                                                {{ __('messages.t_skills') }}
                                            </h3>
                                            <p class="mt-1 text-[13px] text-slate-500 dark:text-zinc-400">
                                                {{ __('messages.t_what_skills_are_required') }}
                                            </p>
                                        </div>
                                        @if ($category)
                                            <button type="button" wire:click="generateSkillRecommendations"
                                                wire:loading.attr="disabled"
                                                wire:target="generateSkillRecommendations,applyAllSkillRecommendations"
                                                class="inline-flex items-center gap-2 rounded-full bg-primary-600 px-4 py-2 text-xs font-semibold text-white transition hover:bg-primary-700 disabled:cursor-not-allowed">
                                                <svg wire:loading wire:target="generateSkillRecommendations"
                                                    class="h-4 w-4 animate-spin text-white/80" viewBox="0 0 24 24" fill="none">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                        stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                                </svg>
                                                <i class="ph ph-sparkle text-sm" wire:loading.remove
                                                    wire:target="generateSkillRecommendations"></i>
                                                <span>تشغيل المساعد الذكي</span>
                                            </button>
                                        @endif
                                    </div>

                                    <div class="mt-4 space-y-5">
                                        @if ($category)
                                            @php
                                                $skillItems = collect($skills);
                                                $availableCount = $skillItems->count();
                                            @endphp
                                            <div x-data class="relative">
                                                <i
                                                    class="ph  text-slate-400 dark:text-zinc-500 absolute inset-y-0 right-4 my-auto text-sm"></i>
                                                <input type="search" wire:model.debounce.400ms="skillSearch"
                                                    wire:keydown.enter.prevent
                                                    class="w-full rounded-full border border-slate-200/70 bg-white/85 px-12 py-2 text-xs font-semibold text-slate-600 transition focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-100 dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-200"
                                                    placeholder="ابحث ضمن 200 مهارة، مثال: Laravel أو SEO أو UX" />
                                                @if (filled($skillSearch))
                                                    <button type="button" wire:click="clearSkillSearch"
                                                        class="absolute inset-y-0 left-3 my-auto inline-flex h-7 w-7 items-center justify-center rounded-full bg-slate-100 text-slate-500 transition hover:bg-slate-200 dark:bg-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-600"
                                                        title="مسح البحث">
                                                        <i class="ph ph-x text-sm"></i>
                                                    </button>
                                                @endif
                                            </div>
                                            <div
                                                class="flex flex-wrap items-center gap-3 text-[11.5px] text-slate-500 dark:text-zinc-400">
                                                <span>
                                                    {{ $availableCount ? 'أماكن متعددة للمهارات المتخصصة، اختر حتى ' . (int) settings('projects')->max_skills . ' مهارة.' : 'لم يتم العثور على مهارات مطابقة في هذه الفئة.' }}
                                                </span>
                                                @if (filled($skillSearch))
                                                    <span
                                                        class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2 py-0.5 font-semibold text-slate-600 dark:bg-zinc-700/80 dark:text-zinc-200">
                                                        <i class="ph ph-funnel text-xs"></i>
                                                        {{ __('messages.t_search') }}: {{ $skillSearch }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="mt-3">
                                                <div class="flex flex-wrap gap-2" wire:loading.class="opacity-60"
                                                    wire:target="skillSearch,clearSkillSearch,updatedCategory">
                                                    @forelse ($skillItems as $skill)
                                                        @php
                                                            $skillId = $skill['id'] ?? null;
                                                            $skillUid = $skill['uid'] ?? null;
                                                            $skillName = $skill['name'] ?? '';
                                                            $isSelected = $skillId ? in_array($skillId, $required_skills ?? []) : false;
                                                        @endphp
                                                        @if ($skillId && $skillUid && $skillName)
                                                            <button type="button" wire:click="addSkill('{{ $skillUid }}')"
                                                                wire:key="skill-pill-{{ $skillUid }}"
                                                                class="group inline-flex items-center gap-2 rounded-full border px-4 py-2 text-xs font-semibold transition focus:outline-none focus:ring-2 focus:ring-primary-200 {{ $isSelected ? 'border-primary-600 bg-primary-600 text-white hover:bg-primary-700' : 'border-slate-200 bg-slate-50 text-slate-600 hover:border-primary-200 hover:text-primary-600 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-300' }}">
                                                                <span class="truncate max-w-[160px]">{{ $skillName }}</span>
                                                                @if ($isSelected)
                                                                    <i class="ph ph-check-circle text-sm opacity-80"></i>
                                                                @else
                                                                    <i class="ph ph-plus text-sm opacity-60"></i>
                                                                @endif
                                                            </button>
                                                        @endif
                                                    @empty
                                                        <div
                                                            class="w-full rounded-xl border border-dashed border-slate-200 px-4 py-6 text-center text-xs font-semibold text-slate-500 dark:border-zinc-600 dark:text-zinc-300">
                                                            لا توجد نتائج مطابقة. جرّب كلمة مفتاحية مختلفة أو شغّل المساعد الذكي
                                                            لاقتراح المهارات.
                                                        </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        @else
                                            <div
                                                class="rounded-xl border border-dashed border-yellow-200 bg-yellow-50/80 px-4 py-3 text-[13px] text-yellow-700 dark:border-yellow-400/40 dark:bg-yellow-500/10 dark:text-yellow-200">
                                                <div class="flex items-center gap-2">
                                                    <i class="ph ph-warning-circle text-base"></i>
                                                    <span>@lang('messages.t_skills_select_category_first_alert')</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @if (!empty($skillRecommendations))
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
                                            @foreach ($skillRecommendations as $suggested)
                                                @php
                                                    $sId = $suggested['id'] ?? null;
                                                    $sUid = $suggested['uid'] ?? null;
                                                    $sName = $suggested['name'] ?? '';
                                                    $already = $sId ? in_array($sId, $required_skills ?? []) : false;
                                                @endphp
                                                @if ($sId && $sUid && $sName)
                                                    <button type="button" wire:click="applySkillRecommendation('{{ $sUid }}')"
                                                        wire:key="skill-ai-{{ $sUid }}"
                                                        class="group inline-flex items-center gap-2 rounded-full border border-primary-200 bg-white px-4 py-1.5 text-[12px] font-semibold text-primary-700 transition hover:border-primary-400 hover:text-primary-800 dark:border-primary-500/40 dark:bg-primary-500/10 dark:text-primary-100">
                                                        <i class="ph ph-sparkle text-xs"></i>
                                                        <span class="truncate max-w-[150px]">{{ $sName }}</span>
                                                        @if ($already)
                                                            <i class="ph ph-check text-xs opacity-70"></i>
                                                        @endif
                                                    </button>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if (!empty($selectedSkills))
                                    <div
                                        class="rounded-2xl border border-emerald-200/70 bg-emerald-50/50 px-5 py-5 shadow-sm dark:border-emerald-500/30 dark:bg-emerald-500/10">
                                        <div
                                            class="flex items-center gap-2 text-sm font-semibold text-emerald-700 dark:text-emerald-200">
                                            <i class="ph ph-check-circle text-base"></i>
                                            <span>المهارات المحددة ({{ count($selectedSkills) }})</span>
                                        </div>
                                        <div class="mt-3 flex flex-wrap gap-2">
                                            @foreach ($selectedSkills as $selected)
                                                @php
                                                    $selUid = $selected['uid'] ?? null;
                                                    $selName = $selected['name'] ?? '';
                                                @endphp
                                                @if ($selUid && $selName)
                                                    <button type="button" wire:click="addSkill('{{ $selUid }}')"
                                                        wire:key="skill-selected-{{ $selUid }}"
                                                        class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-1.5 text-[12px] font-semibold text-emerald-700 shadow-sm transition hover:bg-emerald-100 dark:bg-emerald-500/20 dark:text-emerald-100 dark:hover:bg-emerald-500/30">
                                                        <i class="ph ph-lightning text-xs"></i>
                                                        <span class="truncate max-w-[160px]">{{ $selName }}</span>
                                                        <i class="ph ph-x text-xs opacity-70"></i>
                                                    </button>
                                                @endif
                                            @endforeach
                                        </div>
                                        <p class="mt-3 text-[11.5px] text-emerald-700/80 dark:text-emerald-100/80">
                                            يمكنك الضغط على المهارة لإزالتها من المشروع في أي وقت.
                                        </p>
                                    </div>
                                @endif
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
                                                        {{ (int) settings('projects')->max_skills }}) يضمن التركيز.</span>
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

                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
                                    {{ __('messages.t_project_upload_brief_title') }}
                                </label>
                                <span
                                    class="flex items-center gap-1 text-[11px] font-semibold text-primary-600 dark:text-primary-200"
                                    wire:loading wire:target="attachments">
                                    <svg class="h-3.5 w-3.5 animate-spin" viewBox="0 0 24 24" fill="none">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                    </svg>
                                    <span>جارٍ رفع الملفات...</span>
                                </span>
                            </div>

                            <label for="wizard-attachments" class="block">
                                <div
                                    class="group rounded-2xl border-2 border-dashed border-slate-200 bg-white/80 px-6 py-8 text-center text-slate-600 transition hover:border-primary-300 hover:bg-primary-50/40 dark:border-zinc-600 dark:bg-zinc-800/70 dark:text-zinc-300 dark:hover:border-primary-400">
                                    <input id="wizard-attachments" type="file" class="sr-only" multiple
                                        wire:model="attachments">
                                    <div class="flex flex-col items-center gap-3">
                                        <div
                                            class="flex h-12 w-12 items-center justify-center rounded-full bg-primary-500/10 text-primary-600 group-hover:bg-primary-500/20 dark:bg-primary-500/15 dark:text-primary-200">
                                            <i class="ph ph-cloud-arrow-up text-xl"></i>
                                        </div>
                                        <div class="space-y-1 text-[13px]">
                                            <p class="font-semibold text-slate-700 dark:text-zinc-100">اسحب الملفات إلى هنا
                                                أو اضغط للاختيار</p>
                                            <p class="text-slate-500 dark:text-zinc-400">
                                                {{ __('messages.t_project_attachment_limit_hint', ['max' => 5, 'size' => '25MB']) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            @error('attachments.*')
                                <p class="text-[12px] font-medium text-red-600">{{ $message }}</p>
                            @enderror

                            @if (is_array($attachments) && count($attachments))
                                <ul class="space-y-2">
                                    @foreach ($attachments as $idx => $file)
                                        <li
                                            class="flex items-center justify-between rounded-xl border border-slate-200 bg-white px-4 py-2 text-xs text-slate-600 shadow-sm dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-200">
                                            <div class="flex items-center gap-2">
                                                <i class="ph ph-paperclip text-sm text-primary-500"></i>
                                                <span
                                                    class="max-w-[220px] truncate">{{ $file->getClientOriginalName() ?? 'file' }}</span>
                                            </div>
                                            <button type="button" class="text-[12px] font-medium text-red-600 hover:text-red-700"
                                                wire:click="removeAttachment({{ $idx }})">
                                                @lang('messages.t_remove')
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
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
                                        @if (is_array($milestones) && count($milestones))
                                            <div
                                                class="rounded-xl border border-slate-200/70 bg-white/95 px-4 py-3 dark:border-zinc-600 dark:bg-zinc-800">
                                                <p class="text-[12px] font-semibold text-slate-500 dark:text-zinc-300">
                                                    مقترحات الدفعات في القالب المختار:
                                                </p>
                                                <ul class="mt-2 space-y-1.5">
                                                    @foreach ($milestones as $milestone)
                                                        @php
                                                            $titleValue = trim((string) ($milestone['title'] ?? ''));
                                                            $amountValue = trim((string) ($milestone['amount'] ?? ''));
                                                        @endphp
                                                        @if ($titleValue !== '' || $amountValue !== '')
                                                            <li class="flex items-start gap-2">
                                                                <i
                                                                    class="ph ph-dot-outline text-xs text-primary-500 dark:text-primary-300 mt-0.5"></i>
                                                                <span class="flex flex-wrap items-center gap-2">
                                                                    <span>{{ $titleValue ?: '—' }}</span>
                                                                    @if ($amountValue !== '')
                                                                        <span
                                                                            class="rounded-full bg-primary-50 px-2 py-0.5 text-[11px] font-semibold text-primary-600 dark:bg-primary-500/15 dark:text-primary-200">
                                                                            {{ $amountValue }} {{ settings('currency')->code }}
                                                                        </span>
                                                                    @endif
                                                                </span>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mt-10 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <button type="button"
                            class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-6 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-primary-200 hover:text-primary-600 dark:border-zinc-600 dark:text-zinc-300"
                            wire:click="prevStep">
                            <i class="ph ph-arrow-circle-left text-base"></i>
                            <span>السابق</span>
                        </button>
                        <button type="button"
                            class="inline-flex items-center gap-2 rounded-full bg-primary-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-700 disabled:cursor-not-allowed"
                            wire:click="nextStep" wire:loading.attr="disabled" wire:loading.class="opacity-70"
                            wire:target="nextStep">
                            <span>التالي</span>
                            <i class="ph ph-arrow-circle-right text-base"></i>
                            <svg class="h-4 w-4 text-white/90" viewBox="0 0 24 24" fill="none" wire:loading
                                wire:target="nextStep">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                        </button>
                    </div>
                </section>
            @endif

            {{-- Step: Budget & promotion --}}
            @if ($step === 2)
                <section class="card px-5 sm:px-8 py-8 border border-slate-100/80 shadow-sm dark:border-zinc-700/60">
                    <div class="flex items-start gap-3 border-b border-slate-100 pb-6 dark:border-zinc-700/70">
                        <div
                            class="flex h-11 w-11 flex-none items-center justify-center rounded-xl bg-amber-100 text-amber-600 dark:bg-amber-500/15 dark:text-amber-100">
                            <i class="ph-duotone ph-currency-dollar text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-base font-semibold text-zinc-900 dark:text-white">
                                ٣. الميزانية وخطط الترويج
                            </h2>
                            <p class="mt-1 text-sm text-slate-500 dark:text-zinc-400">
                                اختر أسلوب الدفع المناسب، ثبت نطاق الميزانية، وفعّل خيارات إبراز المشروع للوصول إلى أفضل
                                الخبراء.
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 space-y-10">
                        <div>
                            <div class="grid gap-5 md:grid-cols-2">
                                <label
                                    class="relative flex cursor-pointer items-center gap-3 rounded-2xl border px-4 py-4 transition hover:border-primary-200 hover:bg-primary-50/30 dark:border-zinc-600 dark:hover:border-primary-400"
                                    :class="{ 'border-primary-500 bg-primary-50/60 dark:border-primary-400/70 dark:bg-primary-500/10': $wire.salary_type === 'fixed' }">
                                    <input type="radio" id="post-project-salary-type-fixed" name="salary_type"
                                        wire:model="salary_type" value="fixed" class="hidden">
                                    <span
                                        class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-primary-600/10 text-primary-600 dark:bg-primary-500/15 dark:text-primary-200">
                                        <i class="ph-duotone ph-money text-xl"></i>
                                    </span>
                                    <span class="flex flex-col">
                                        <span class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
                                            @lang('messages.t_fixed_price')
                                        </span>
                                        <span class="text-[12.5px] text-slate-500 dark:text-zinc-400">
                                            نطاق واضح مع مخرجات محددة سلفاً.
                                        </span>
                                    </span>
                                </label>
                                <label
                                    class="relative flex cursor-pointer items-center gap-3 rounded-2xl border px-4 py-4 transition hover:border-primary-200 hover:bg-primary-50/30 dark:border-zinc-600 dark:hover:border-primary-400"
                                    :class="{ 'border-primary-500 bg-primary-50/60 dark:border-primary-400/70 dark:bg-primary-500/10': $wire.salary_type === 'hourly' }">
                                    <input type="radio" id="post-project-salary-type-hourly" name="salary_type"
                                        wire:model="salary_type" value="hourly" class="hidden">
                                    <span
                                        class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-primary-600/10 text-primary-600 dark:bg-primary-500/15 dark:text-primary-200">
                                        <i class="ph-duotone ph-clock text-xl"></i>
                                    </span>
                                    <span class="flex flex-col">
                                        <span class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
                                            @lang('messages.t_hourly_price')
                                        </span>
                                        <span class="text-[12.5px] text-slate-500 dark:text-zinc-400">
                                            @lang('messages.t_hourly_price_hint')
                                        </span>
                                    </span>
                                </label>
                            </div>

                            @php
                                $isHourly = $salary_type === 'hourly';
                                $minLabel = $isHourly ? __('messages.t_hourly_min_rate') : __('messages.t_min_price');
                                $maxLabel = $isHourly ? __('messages.t_hourly_max_rate') : __('messages.t_max_price');
                                $currencySuffix = $currency_symbol . ($isHourly ? ' / ' . __('messages.t_hour_short') : '');
                            @endphp
                            <div class="mt-6 grid gap-6 md:grid-cols-2">
                                <x-forms.text-input required :label="$minLabel" placeholder="0.00" model="min_price"
                                    :suffix="$currencySuffix" />
                                <x-forms.text-input required :label="$maxLabel" placeholder="0.00" model="max_price"
                                    :suffix="$currencySuffix" />
                            </div>

                            @if ($isHourly)
                                <div class="mt-6 grid gap-6 lg:grid-cols-[minmax(0,1.2fr)_minmax(0,1fr)]">
                                    <div>
                                        <x-forms.text-input required :label="__('messages.t_hourly_weekly_limit')"
                                            placeholder="40" model="hourly_weekly_limit"
                                            :suffix="__('messages.t_hours_per_week_suffix')" />
                                    </div>
                                    <div
                                        class="space-y-4 rounded-2xl border border-slate-200 bg-white/80 px-5 py-5 shadow-sm dark:border-zinc-600 dark:bg-zinc-800">
                                        <div>
                                            <x-forms.checkbox :label="__('messages.t_hourly_allow_manual_time')"
                                                model="hourly_allow_manual_time" />
                                            <p class="mt-2 text-[12px] leading-6 text-slate-500 dark:text-zinc-400">
                                                @lang('messages.t_hourly_allow_manual_time_hint')
                                            </p>
                                        </div>
                                        <div>
                                            <x-forms.checkbox :label="__('messages.t_hourly_auto_approve_low_activity')"
                                                model="hourly_auto_approve_low_activity" />
                                            <p class="mt-2 text-[12px] leading-6 text-slate-500 dark:text-zinc-400">
                                                @lang('messages.t_hourly_auto_approve_low_activity_hint')
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

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
                                @if ($requires_nda)
                                    <div class="mt-5 grid gap-4 md:grid-cols-2">
                                        <div class="md:col-span-2 space-y-2">
                                            <label class="text-[12px] font-semibold text-slate-500 dark:text-zinc-300">نطاق
                                                السرية</label>
                                            <textarea rows="3"
                                                class="block w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-200"
                                                placeholder="حدد الأصول أو الملفات أو البيانات التي يجب الحفاظ على سريتها."
                                                wire:model.defer="nda_scope" maxlength="500"></textarea>
                                            @error('nda_scope')
                                                <p class="text-[11.5px] font-medium text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label class="text-[12px] font-semibold text-slate-500 dark:text-zinc-300">مدة
                                                السرية (بالأشهر)</label>
                                            <input type="number" min="1" max="60"
                                                class="block w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-xs focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-200 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-200"
                                                wire:model.defer="nda_term_months" />
                                            @error('nda_term_months')
                                                <p class="text-[11.5px] font-medium text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="space-y-2">
                                            <label class="text-[12px] font-semibold text-slate-500 dark:text-zinc-300">معاينة
                                                مختصرة</label>
                                            <div
                                                class="rounded-xl border border-dashed border-slate-200 bg-slate-50 p-3 text-[12px] leading-6 text-slate-600 dark:border-zinc-600 dark:bg-zinc-900/40 dark:text-zinc-300">
                                                <p class="font-semibold text-primary-600 dark:text-primary-300">
                                                    {{ auth()->user()->fullname ?? auth()->user()->username }} ×
                                                    {{ __('messages.t_freelancer') }}
                                                </p>
                                                <p>يقر الطرفان بالحفاظ على السرية حتى
                                                    {{ now()->addMonths(max(1, (int) ($nda_term_months ?? 12)))->format('Y-m-d') }}
                                                    وتشمل المعلومات التالية:
                                                    {{ $nda_scope ? \Illuminate\Support\Str::limit($nda_scope, 120) : 'وصف المشروع، الملفات المرفقة، والحلول المقترحة.' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if (settings('projects')->is_premium_posting)
                            <div class="space-y-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">
                                            @lang('messages.t_promotion')
                                        </h3>
                                        <p class="mt-1 text-[12.5px] text-slate-500 dark:text-zinc-400">
                                            {{ settings('projects')->is_free_posting ? __('messages.t_make_ur_project_premium_optional') : __('messages.t_make_ur_project_premium') }}
                                        </p>
                                    </div>
                                    <span
                                        class="inline-flex items-center gap-2 rounded-full bg-primary-50 px-3 py-1 text-[11px] font-semibold text-primary-600 dark:bg-primary-500/10 dark:text-primary-200">
                                        <i class="ph ph-megaphone-simple text-xs"></i>
                                        موصى به
                                    </span>
                                </div>

                                <div class="space-y-4">
                                    @foreach ($plans as $plan)
                                        @php $is_plan_selected = in_array($plan->id, $selected_plans); @endphp
                                        <div class="rounded-2xl border px-5 py-4 shadow-sm transition {{ $is_plan_selected ? 'border-primary-500/80 ring-1 ring-primary-400/50 bg-primary-50/70 dark:border-primary-400/60 dark:bg-primary-500/10' : 'border-slate-200 bg-white dark:border-zinc-700 dark:bg-zinc-800' }}"
                                            wire:key="post-project-plans-{{ $plan->id }}">
                                            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                                                <div class="flex flex-1 flex-col gap-3">
                                                    <div class="flex flex-wrap items-center gap-3">
                                                        <span
                                                            class="inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold"
                                                            style="color:{{ $plan->text_color }};background-color:{{ $plan->bg_color }}">
                                                            <i class="ph ph-sparkle text-[11px]"></i>
                                                            <span>{{ $plan->title }}</span>
                                                        </span>
                                                        <span class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                                                            {{ money($plan->price, settings('currency')->code, true) }}
                                                        </span>
                                                        @if ($plan->days)
                                                            <span class="text-[12px] text-slate-500 dark:text-zinc-400">
                                                                {{ $plan->days }}
                                                                {{ $plan->days > 1 ? __('messages.t_days') : __('messages.t_day') }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <p class="text-[12.5px] leading-6 text-slate-600 dark:text-zinc-300">
                                                        {{ $plan->description }}
                                                    </p>
                                                </div>
                                                <div class="flex flex-none">
                                                    <button type="button"
                                                        class="inline-flex items-center gap-2 rounded-full border px-4 py-2 text-xs font-semibold transition {{ $is_plan_selected ? 'border-primary-600 bg-primary-600 text-white hover:bg-primary-700' : 'border-slate-200 bg-white text-slate-600 hover:border-primary-200 hover:text-primary-600 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-300' }}"
                                                        wire:click="addPlan({{ $plan->id }})">
                                                        <span>
                                                            {{ $is_plan_selected ? __('messages.t_selected') : __('messages.t_select') }}
                                                        </span>
                                                        <i class="ph ph-arrow-circle-right text-sm"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div
                                    class="flex items-center justify-between rounded-2xl border border-slate-200 bg-slate-50 px-5 py-4 dark:border-zinc-600 dark:bg-zinc-800">
                                    <div>
                                        <p
                                            class="text-[12.5px] font-semibold uppercase tracking-wide text-slate-500 dark:text-zinc-400">
                                            @lang('messages.t_total')
                                        </p>
                                        <p class="text-sm text-slate-600 dark:text-zinc-300">
                                            يشمل مجموع خيارات إبراز المشروع إن تم اختيارها.
                                        </p>
                                    </div>
                                    <div class="text-lg font-bold text-zinc-900 dark:text-white">
                                        {{ money($promoting_total, settings('currency')->code, true) }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-10 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <button type="button"
                            class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-6 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-primary-200 hover:text-primary-600 dark:border-zinc-600 dark:text-zinc-300"
                            wire:click="prevStep">
                            <i class="ph ph-arrow-circle-left text-base"></i>
                            <span>السابق</span>
                        </button>
                        <button type="button"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-primary-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-primary-700 disabled:cursor-not-allowed sm:w-auto"
                            wire:click="nextStep" wire:loading.attr="disabled" wire:loading.class="opacity-70"
                            wire:target="nextStep">
                            <span>الانتقال إلى المعاينة</span>
                            <i class="ph ph-eye text-base"></i>
                            <svg class="h-4 w-4 text-white/90" viewBox="0 0 24 24" fill="none" wire:loading
                                wire:target="nextStep">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                        </button>
                    </div>
                </section>
            @endif

            {{-- Step: Review --}}
            @if ($step === 3)
                <section class="card px-5 sm:px-8 py-8 border border-slate-100/80 shadow-sm dark:border-zinc-700/60">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                        <div class="flex items-start gap-3">
                            <div
                                class="flex h-12 w-12 flex-none items-center justify-center rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-500/15 dark:text-emerald-200">
                                <i class="ph ph-eye text-xl"></i>
                            </div>
                            <div>
                                <h2 class="text-base font-semibold text-zinc-900 dark:text-white">
                                    ٤. معاينة قبل النشر
                                </h2>
                                <p class="mt-1 text-sm text-slate-500 dark:text-zinc-400">
                                    راجع تفاصيل المشروع سريعاً ثم انقر على «نشر المشروع» لإرساله إلى المجتمع.
                                </p>
                            </div>
                        </div>
                        <div
                            class="rounded-full bg-emerald-500/15 px-4 py-1 text-[12px] font-semibold text-emerald-600 dark:bg-emerald-500/20 dark:text-emerald-200">
                            <i class="ph ph-lightning text-xs"></i>
                            كل الحقول الأساسية مكتملة
                        </div>
                    </div>

                    <div class="mt-8 grid gap-6 lg:grid-cols-[minmax(0,1.6fr)_minmax(320px,1fr)]">
                        <article
                            class="rounded-3xl border border-slate-200 bg-white/95 p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                            <header class="border-b border-slate-200 pb-5 dark:border-zinc-700">
                                <p
                                    class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-400 dark:text-zinc-500">
                                    عنوان المشروع</p>
                                <h3 class="mt-2 text-2xl font-semibold text-zinc-900 dark:text-zinc-100">
                                    {{ $review['title'] ?: 'لم يتم إدخال عنوان' }}
                                </h3>
                                <div
                                    class="mt-4 flex flex-wrap gap-2 text-[12px] font-semibold uppercase tracking-[0.15em] text-slate-500 dark:text-zinc-400">
                                    @if ($review['category'])
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 dark:bg-zinc-800">
                                            <i class="ph ph-folders"></i>
                                            {{ $review['category'] }}
                                        </span>
                                    @endif
                                    @if ($review['salary_type'] === 'hourly')
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 dark:bg-zinc-800">
                                            <i class="ph ph-clock"></i>
                                            أجر بالساعة
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 dark:bg-zinc-800">
                                            <i class="ph ph-target"></i>
                                            ميزانية ثابتة
                                        </span>
                                    @endif
                                    @if ($review['budget_label'])
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full bg-primary-50 px-3 py-1 text-primary-600 dark:bg-primary-500/15 dark:text-primary-200">
                                            <i class="ph ph-coins"></i>
                                            {{ $review['budget_label'] }}
                                        </span>
                                    @endif
                                    @if ($review['requires_nda'])
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-3 py-1 text-emerald-700 dark:bg-emerald-500/15 dark:text-emerald-200">
                                            <i class="ph ph-shield-check"></i>
                                            NDA مطلوب
                                        </span>
                                    @endif
                                </div>
                            </header>
                            <div class="mt-6 space-y-6 text-[14px] leading-7 text-slate-600 dark:text-zinc-300">
                                <div>
                                    <h4 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">الوصف التفصيلي</h4>
                                    <p class="mt-2 whitespace-pre-line">
                                        {{ $review['description'] ?: 'لم يتم إدخال وصف للمشروع بعد.' }}
                                    </p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">المهارات المطلوبة
                                    </h4>
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        @forelse ($review['skills'] as $skill)
                                            <span
                                                class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1 text-[12px] font-semibold text-slate-600 dark:bg-zinc-800 dark:text-zinc-200">
                                                <i class="ph ph-lightning text-xs"></i>
                                                {{ $skill['name'] ?? $skill }}
                                            </span>
                                        @empty
                                            <span class="text-[12px] text-slate-500 dark:text-zinc-400">لم يتم اختيار
                                                مهارات.</span>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="grid gap-6 md:grid-cols-2">
                                    <div>
                                        <h4 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">أسئلة للمستقلين
                                        </h4>
                                        <ul class="mt-3 space-y-2 text-[13px] leading-6">
                                            @forelse ($review['questions'] as $question)
                                                <li class="rounded-2xl bg-slate-50 px-3 py-2 dark:bg-zinc-800">
                                                    <div class="flex items-start justify-between gap-2">
                                                        <span>{{ $question['text'] }}</span>
                                                        @if ($question['is_required'])
                                                            <span
                                                                class="inline-flex items-center gap-1 rounded-full bg-rose-100 px-2 py-0.5 text-[11px] font-semibold text-rose-600 dark:bg-rose-500/15 dark:text-rose-200">
                                                                <i class="ph ph-asterisk text-xs"></i>
                                                                إلزامي
                                                            </span>
                                                        @endif
                                                    </div>
                                                </li>
                                            @empty
                                                <li class="text-[12px] text-slate-500 dark:text-zinc-400">لا توجد أسئلة إضافية.
                                                </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">المرفقات</h4>
                                        <ul class="mt-3 space-y-2 text-[13px] leading-6">
                                            @forelse ($review['attachments'] as $attachment)
                                                <li
                                                    class="flex items-center gap-2 rounded-2xl bg-slate-50 px-3 py-2 dark:bg-zinc-800">
                                                    <i class="ph ph-paperclip text-sm text-primary-500"></i>
                                                    <span class="truncate">{{ $attachment }}</span>
                                                </li>
                                            @empty
                                                <li class="text-[12px] text-slate-500 dark:text-zinc-400">لا توجد مرفقات مضافة.
                                                </li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">الدفعات المقترحة</h4>
                                    <ul class="mt-3 space-y-2 text-[13px] leading-6">
                                        @forelse ($review['milestones'] as $milestone)
                                            <li
                                                class="flex items-center justify-between gap-3 rounded-2xl bg-white px-4 py-3 shadow-sm ring-1 ring-slate-100 dark:bg-zinc-800 dark:ring-zinc-700">
                                                <span>{{ $milestone['title'] }}</span>
                                                @if (!empty($milestone['amount']))
                                                    <span
                                                        class="text-sm font-semibold text-primary-600 dark:text-primary-200">{{ $milestone['amount'] }}</span>
                                                @endif
                                            </li>
                                        @empty
                                            <li class="text-[12px] text-slate-500 dark:text-zinc-400">لن تظهر دفعات حتى يقدّم
                                                المستقلون عروضهم.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </article>
                        <aside
                            class="space-y-6 rounded-3xl border border-slate-200 bg-white/95 p-6 shadow-sm dark:border-zinc-700 dark:bg-zinc-900/90">
                            <div>
                                <h4 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">ملخص سريع</h4>
                                <dl class="mt-3 space-y-2 text-[13px] text-slate-600 dark:text-zinc-300">
                                    @if ($review['category'])
                                        <div class="flex items-center justify-between gap-2">
                                            <dt>الفئة</dt>
                                            <dd>{{ $review['category'] }}</dd>
                                        </div>
                                    @endif
                                    @if ($review['budget_label'])
                                        <div class="flex items-center justify-between gap-2">
                                            <dt>الميزانية</dt>
                                            <dd>{{ $review['budget_label'] }}</dd>
                                        </div>
                                    @endif
                                    <div class="flex items-center justify-between gap-2">
                                        <dt>نوع الدفع</dt>
                                        <dd>{{ $review['salary_type'] === 'hourly' ? 'بالساعة' : 'سعر ثابت' }}</dd>
                                    </div>
                                    @if ($review['requires_nda'])
                                        <div class="flex items-center justify-between gap-2">
                                            <dt>NDA</dt>
                                            <dd>مطلوب ({{ $review['nda_term'] ?? 12 }} شهر)</dd>
                                        </div>
                                    @endif
                                </dl>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-zinc-800 dark:text-zinc-100">خيارات الترويج</h4>
                                <ul class="mt-3 space-y-2 text-[13px] text-slate-600 dark:text-zinc-300">
                                    @forelse ($review['plans'] as $plan)
                                        <li
                                            class="flex items-center justify-between gap-2 rounded-2xl bg-slate-50 px-3 py-2 dark:bg-zinc-800">
                                            <span>{{ $plan['title'] }}</span>
                                            <span
                                                class="text-sm font-semibold text-primary-600 dark:text-primary-200">{{ $plan['price'] }}</span>
                                        </li>
                                    @empty
                                        <li class="text-[12px] text-slate-500 dark:text-zinc-400">لم يتم اختيار أي خيارات
                                            ترويجية.</li>
                                    @endforelse
                                </ul>
                                @if ($review['plans_total'])
                                    <div
                                        class="mt-3 rounded-2xl bg-primary-50 px-4 py-2 text-right text-[12.5px] font-semibold text-primary-700 dark:bg-primary-500/15 dark:text-primary-200">
                                        {{ __('messages.t_total') }}:
                                        {{ money($review['plans_total'], settings('currency')->code, true) }}
                                    </div>
                                @endif
                            </div>
                        </aside>
                    </div>
                    <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <button type="button"
                            class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-6 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-primary-200 hover:text-primary-600 dark:border-zinc-600 dark:text-zinc-300"
                            wire:click="prevStep">
                            <i class="ph ph-arrow-circle-left text-base"></i>
                            <span>عودة للتعديل</span>
                        </button>
                        <button type="button"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-emerald-600 px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700 disabled:cursor-not-allowed sm:w-auto"
                            wire:click="create" wire:loading.attr="disabled" wire:loading.class="opacity-70"
                            wire:target="create">
                            <span>@lang('messages.t_post_project')</span>
                            <i class="ph ph-paper-plane-right text-base"></i>
                            <svg class="h-4 w-4 text-white/90" viewBox="0 0 24 24" fill="none" wire:loading
                                wire:target="create">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                        </button>
                    </div>
                </section>
            @endif
        </div>
    </div>
</div>

@push('scripts')
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

        document.addEventListener('livewire:load', () => {
            document.body.classList.add('post-project-no-footer');
        });

        document.addEventListener('beforeunload', () => {
            document.body.classList.remove('post-project-no-footer');
        });

        document.addEventListener('livewire:navigated', (event) => {
            const destination = event?.detail?.to?.url || window.location.href;
            if (!destination.includes('post/project')) {
                document.body.classList.remove('post-project-no-footer');
            }
        });
    </script>
@endpush

@push('styles')
    <style>
        body.post-project-no-footer footer {
            display: none !important;
        }
    </style>
@endpush
