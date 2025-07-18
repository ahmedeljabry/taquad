<div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8 mt-[7rem] py-12 lg:pt-16 lg:pb-24">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        {{-- Sidebar: Categories --}}
        @if($categories->count())
           {{-- Sidebar Filters – Sticky --}}
            <aside class="lg:col-span-1 bg-white dark:bg-zinc-800 rounded-2xl p-5 shadow-md sticky top-20 max-h-[85vh] overflow-y-auto custom-scroll">

                <div wire:loading.flex
                    wire:target="cats,budget_min,budget_max,type,date,verified,skill"
                    class="justify-center mb-4">
                    <svg class="animate-spin h-5 w-5 text-primary-600" fill="none" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"/>
                        <path d="M4 12a8 8 0 018-8v8z" fill="currentColor" class="opacity-75"/>
                    </svg>
                </div>

                <div class="space-y-8">

                    <div x-data="{ open: true }">
                        <button @click="open=!open" class="flex w-full justify-between items-center text-gray-800 dark:text-white font-extrabold tracking-wide">
                            @lang('messages.t_categories')
                            <svg :class="open ? 'rotate-180' : ''" class="h-4 w-4 transition-transform duration-150" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition.opacity.duration.200ms class="space-y-3 mt-3 max-h-52 overflow-y-auto pr-1 custom-scroll">
                            @foreach ($categories as $cat)
                                <label class="group flex justify-between items-center text-sm rtl:space-x-reverse">
                                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                        <input type="checkbox"
                                            wire:model.live="cats"
                                            value="{{ $cat->slug }}"
                                            wire:key="cat-{{ $cat->id }}"
                                            class="h-4 w-4 text-primary-600 rounded border-gray-300
                                                    focus:ring-primary-400 transition-transform
                                                    duration-100 checked:scale-110">
                                        <span
                                            class="text-gray-700 dark:text-gray-200
                                                group-[input:checked+&]:text-primary-600
                                                group-[input:checked+&]:font-semibold">
                                            {{ $cat->name }}
                                        </span>
                                    </div>

                                    <span
                                        class="min-w-[24px] text-center text-xs rounded-full
                                            bg-gray-100 dark:bg-zinc-700
                                            text-gray-600 dark:text-gray-300 px-1.5 py-0.5">
                                        {{ $cat->projects_count }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- ========== الميزانية ========== --}}
                    <div x-data="{ open: true }">
                        <button @click="open=!open" class="flex w-full justify-between items-center text-gray-800 dark:text-white font-extrabold tracking-wide">
                            الميزانية
                            <svg :class="open ? 'rotate-180' : ''" class="h-4 w-4 transition-transform duration-150"></svg>
                        </button>

                        <div x-show="open" x-transition.opacity.duration.200ms
                            class="grid grid-cols-2 gap-2 mt-3">
                            <input type="number" placeholder="من"
                                wire:model.lazy="budget_min"
                                class="w-full text-sm rounded border-gray-300 focus:ring-primary-600
                                        focus:border-primary-600 bg-white dark:bg-zinc-900">
                            <input type="number" placeholder="إلى"
                                wire:model.lazy="budget_max"
                                class="w-full text-sm rounded border-gray-300 focus:ring-primary-600
                                        focus:border-primary-600 bg-white dark:bg-zinc-900">
                        </div>
                    </div>

                    {{-- ========== نوع المشروع ========== --}}
                    <div>
                        <h3 class="text-gray-800 dark:text-white font-extrabold tracking-wide mb-3">
                            نوع المشروع
                        </h3>
                        <label class="flex items-center space-x-2 rtl:space-x-reverse mb-2 text-sm">
                            <input type="radio" value="fixed" wire:model.live="type"
                                class="h-4 w-4 text-primary-600 border-gray-300">
                            <span>سعر ثابت</span>
                        </label>
                        <label class="flex items-center space-x-2 rtl:space-x-reverse text-sm">
                            <input type="radio" value="hourly" wire:model.live="type"
                                class="h-4 w-4 text-primary-600 border-gray-300">
                            <span>بالساعة</span>
                        </label>
                    </div>

                    {{-- ========== تاريخ النشر ========== --}}
                    <div>
                        <h3 class="text-gray-800 dark:text-white font-extrabold tracking-wide mb-3">
                            تاريخ النشر
                        </h3>
                        <select wire:model.live="date" class="w-full text-sm rounded border-gray-300 focus:ring-primary-600 focus:border-primary-600 bg-white dark:bg-zinc-900">
                            <option value="">الكل</option>
                            <option value="1">آخر 24 ساعة</option>
                            <option value="7">آخر 7 أيام</option>
                            <option value="30">آخر 30 يومًا</option>
                        </select>
                    </div>

                    {{-- ========== عميل موثّق ========== --}}
                    <div class="flex items-center space-x-2 rtl:space-x-reverse">
                        <input type="checkbox" wire:model.live="verified"
                            class="h-4 w-4 text-primary-600 border-gray-300 rounded">
                        <span class="text-gray-800 dark:text-white font-extrabold tracking-wide text-sm">
                            عميل موثّق فقط
                        </span>
                    </div>

                    {{-- ========== البحث بالمهارة ========== --}}
                    <div>
                        <input type="text" placeholder="ابحث عن مهارة..." wire:model.lazy="skill" class="w-full text-sm rounded border-gray-300 focus:ring-primary-600 focus:border-primary-600 bg-white dark:bg-zinc-900">
                    </div>
                </div>
            </aside>
        @endif

        {{-- Main content: Projects --}}
        <div class="lg:col-span-3 space-y-12 relative">

            {{-- Latest projects --}}
            @if ($projects->count())
                <section>
                    <h1 class="text-xl md:text-2xl font-bold text-gray-800 dark:text-white mb-6">
                        @lang('messages.t_latest_projects')
                    </h1>
                    <div class="grid grid-cols-1 gap-6 lg:gap-8">
                        @foreach ($projects as $project)
                            @livewire('main.cards.project', ['id' => $project->uid], key('project-' . $project->uid))
                        @endforeach
                    </div>

                    @if ($projects->hasPages())
                        <div class="mt-8 flex justify-center">
                            {!! $projects->links('pagination::tailwind') !!}
                        </div>
                    @endif
                </section>
            @else
                <p class="text-center text-gray-500">@lang('messages.t_no_projects_found')</p>
            @endif
        </div>
    </div>
</div>
