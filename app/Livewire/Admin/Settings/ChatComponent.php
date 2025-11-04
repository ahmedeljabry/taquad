<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\SettingsLiveChat;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Http\Validators\Admin\Settings\ChatValidator;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class ChatComponent extends Component
{
    use SEOToolsTrait, LivewireAlert;

    public $allowed_images;
    public $allowed_files;
    public $max_file_size;
    public $enable_attachments;
    public $enable_emojis;
    public $play_notification_sound;

    public function mount(): void
    {
        $settings = settings('live_chat');

        $this->fill([
            'allowed_images'          => $settings->allowed_images,
            'allowed_files'           => $settings->allowed_files,
            'max_file_size'           => $settings->max_file_size,
            'enable_attachments'      => $settings->enable_attachments ? 1 : 0,
            'enable_emojis'           => $settings->enable_emojis ? 1 : 0,
            'play_notification_sound' => $settings->play_notification_sound ? 1 : 0,
        ]);
    }

    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        $this->seo()->setTitle(setSeoTitle(__('messages.t_live_chat_settings'), true));
        $this->seo()->setDescription(settings('seo')->description);

        return view('livewire.admin.settings.chat');
    }

    public function update(): void
    {
        try {
            ChatValidator::validate($this);

            SettingsLiveChat::first()->update([
                'allowed_images'          => str_replace(' ', '', $this->allowed_images),
                'allowed_files'           => str_replace(' ', '', $this->allowed_files),
                'max_file_size'           => $this->max_file_size,
                'enable_attachments'      => $this->enable_attachments ? 1 : 0,
                'enable_emojis'           => $this->enable_emojis ? 1 : 0,
                'play_notification_sound' => $this->play_notification_sound ? 1 : 0,
            ]);

            settings('live_chat', true);

            $this->alert('success', __('messages.t_success'), livewire_alert_params(__('messages.t_toast_operation_success')));
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->alert('error', __('messages.t_error'), livewire_alert_params(__('messages.t_toast_form_validation_error'), 'error'));
            throw $e;
        } catch (\Throwable $th) {
            $this->alert('error', __('messages.t_error'), livewire_alert_params(__('messages.t_toast_something_went_wrong'), 'error'));
            throw $th;
        }
    }
}
