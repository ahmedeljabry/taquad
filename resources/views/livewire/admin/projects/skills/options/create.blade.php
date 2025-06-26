<div class="w-full sm:mx-auto sm:max-w-2xl">
	<x-form wire:submit="create" class="card px-4 py-10 sm:p-10 md:mx-0" has-files>

        {{-- Loading --}}
        <x-forms.loading />

        {{-- Section head --}}
        <div class="flex items-center gap-4 border-b pb-6 border-slate-100 dark:border-zinc-700 mb-8">
            <div class="bg-slate-100 flex h-14 items-center justify-center rounded-full shrink-0 text-2xl text-slate-500 w-14 dark:bg-zinc-700 dark:text-zinc-400">
                <i class="ph-duotone ph-suitcase"></i>
            </div>
            <div class="text-muted-700 block text-xl font-semibold">
                <h3 class="text-sm font-bold text-zinc-700 dark:text-white pb-2">
                    @lang('messages.t_create_skills')
                </h3>
                <p class="text-xs font-medium text-slate-500 dark:text-zinc-400 tracking-wide">
                    @lang('dashboard.t_create_edit_skills_subtitle')
                </p>
            </div>
        </div>

        {{-- Section body --}}
        <div class="w-full">
            <div class="grid grid-cols-12 md:gap-x-8 gap-y-8 mb-6">

                {{-- Alert --}}
                <div class="col-span-12">
                    <div class="py-2.5 px-3 rounded text-blue-700 bg-blue-50">
                        <div class="flex items-center gap-x-3">
                            <svg class="inline-block w-5 h-5 flex-none text-blue-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            <h3 class="font-semibold grow text-xs">
                                @lang('dashboard.t_create_multi_skills_alert_new_line')
                            </h3>
                        </div>
                    </div>
                </div>

                {{-- Name --}}
                <div class="col-span-12">
                    <x-forms.textarea required
                        :label="__('dashboard.t_skills_names')"
                        :placeholder="__('dashboard.t_each_skill_in_new_line')"
                        model="name"
                        :rows="10"
                        icon="list-checks" />
                </div>

                {{-- Divider --}}
                <div class="col-span-12 -mx-10">
                    <div class="h-px w-full bg-zinc-200 dark:bg-zinc-700 block"></div>
                </div>

                {{-- Category --}}
                <div class="col-span-12">

                    {{-- Select --}}
                    <div class="w-full" wire:ignore>
                        <x-bladewind.select required searchable
                            :component-id="$this->id()"
                            name="category"
                            :selected_value="$category"
                            :label="__('messages.t_category')"
                            :placeholder="__('messages.t_choose_category')"
                            data="manual">
                        
                            {{-- Values --}}
                            @foreach ($categories as $c)
                                <x-bladewind.select-item :label="$c->name" :value="$c->id" />
                            @endforeach

                        </x-bladewind.select>
                    </div>

                    {{-- Error --}}  
                    @error('category')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $errors->first('category') }}</p>
                    @enderror 

                </div>
                
            </div>
        </div>

        {{-- Section footer --}}
        <div class="w-full mt-12">
            <x-bladewind.button size="small" class="mx-auto block w-full" can_submit="true">
                @lang('messages.t_create')
            </x-bladewind.button>
        </div>
            
	</x-form>
</div>