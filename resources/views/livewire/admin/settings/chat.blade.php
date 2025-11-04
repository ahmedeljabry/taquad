<div class="w-full sm:mx-auto sm:max-w-2xl">
    <x-form wire:submit="update" class="card px-4 py-10 sm:p-10 md:mx-0">
        <x-forms.loading />

        <div class="flex items-center gap-4 border-b pb-6 border-slate-100 dark:border-zinc-700 mb-8">
            <div class="bg-slate-100 flex h-14 items-center justify-center rounded-full shrink-0 text-2xl text-slate-500 w-14 dark:bg-zinc-700 dark:text-zinc-400">
                <i class="ph-duotone ph-chats-circle"></i>
            </div>
            <div class="text-muted-700 block text-xl font-semibold">
                <h3 class="text-sm font-bold text-zinc-700 dark:text-white pb-2">
                    @lang('messages.t_live_chat_settings')
                </h3>
                <p class="text-xs font-medium text-slate-500 dark:text-zinc-400 tracking-wide">
                    @lang('dashboard.t_live_chat_settings_subtite')
                </p>
            </div>
        </div>

        <div class="grid grid-cols-12 md:gap-x-8 gap-y-8 mb-6">
            <div class="col-span-12">
                <x-bladewind.toggle
                    :checked="$enable_attachments"
                    name="enable_attachments"
                    :label="__('dashboard.t_enable_chat_attachments')"
                    label_position="right" />
            </div>

            <div class="col-span-12">
                <x-bladewind.toggle
                    :checked="$enable_emojis"
                    name="enable_emojis"
                    :label="__('dashboard.t_enable_emojis')"
                    label_position="right" />
            </div>

            <div class="col-span-12">
                <x-bladewind.toggle
                    :checked="$play_notification_sound"
                    name="play_notification_sound"
                    :label="__('dashboard.t_play_new_message_notification_sound')"
                    label_position="right" />
            </div>

            <div class="col-span-12 -mx-4 sm:-mx-10">
                <div class="h-0.5 w-full bg-zinc-100 dark:bg-zinc-700 block"></div>
            </div>

            <div class="col-span-12">
                <x-forms.textarea required
                    :label="__('dashboard.t_allowed_image_extensions')"
                    :placeholder="__('dashboard.t_separate_each_ext_with_comma')"
                    model="allowed_images"
                    :rows="6" />
            </div>

            <div class="col-span-12">
                <x-forms.textarea required
                    :label="__('dashboard.t_allowed_file_extensions')"
                    :placeholder="__('dashboard.t_separate_each_ext_with_comma')"
                    model="allowed_files"
                    :rows="6" />
            </div>

            <div class="col-span-12">
                <x-forms.text-input required
                    :label="__('dashboard.t_max_size_mb')"
                    placeholder="00"
                    model="max_file_size"
                    icon="floppy-disk" />
            </div>
        </div>

        <div class="w-full mt-12">
            <x-bladewind.button size="small" class="mx-auto block w-full" can_submit="true">
                @lang('messages.t_update')
            </x-bladewind.button>
        </div>
    </x-form>
</div>
