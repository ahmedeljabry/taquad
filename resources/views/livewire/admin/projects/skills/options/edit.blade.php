<div class="w-full sm:mx-auto sm:max-w-2xl">
	<x-form wire:submit="update" class="card px-4 py-10 sm:p-10 md:mx-0" has-files>

        {{-- Loading --}}
        <x-forms.loading />

        {{-- Section head --}}
        <div class="flex items-center gap-4 border-b pb-6 border-slate-100 dark:border-zinc-700 mb-8">
            <div class="bg-slate-100 flex h-14 items-center justify-center rounded-full shrink-0 text-2xl text-slate-500 w-14 dark:bg-zinc-700 dark:text-zinc-400">
                <i class="ph-duotone ph-pencil"></i>
            </div>
            <div class="text-muted-700 block text-xl font-semibold">
                <h3 class="text-sm font-bold text-zinc-700 dark:text-white pb-2">
                    @lang('messages.t_edit_skill')
                </h3>
                <p class="text-xs font-medium text-slate-500 dark:text-zinc-400 tracking-wide">
                    @lang('dashboard.t_create_edit_skills_subtitle')
                </p>
            </div>
        </div>

        {{-- Section body --}}
        <div class="w-full">
            <div class="grid grid-cols-12 md:gap-x-8 gap-y-8 mb-6">

                {{-- Name --}}
                <div class="col-span-12">
                    <x-forms.text-input required
                        :label="__('messages.t_name')"
                        :placeholder="__('messages.t_enter_skill_name')"
                        model="name"
                        icon="text-aa" />
                </div>

                {{-- Slug --}}
                <div class="col-span-12">
                    <x-forms.text-input required
                        :label="__('messages.t_slug')"
                        :placeholder="__('messages.t_enter_slug')"
                        model="slug"
                        icon="link" />
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
                @lang('messages.t_update')
            </x-bladewind.button>
        </div>
            
	</x-form>
</div>