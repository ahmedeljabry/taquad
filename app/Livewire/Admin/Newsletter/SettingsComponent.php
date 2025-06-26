<?php

namespace App\Livewire\Admin\Newsletter;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\NewsletterSettings;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Http\Validators\Admin\Newsletter\EditValidator;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class SettingsComponent extends Component
{
    use SEOToolsTrait, LivewireAlert;

    public $is_enabled;

    /**
     * Init component
     *
     * @return void
     */
    public function mount()
    {
        // Set default settings
        $this->fill([
            'is_enabled' => settings('newsletter')->is_enabled ? 1 : 0
        ]);
    }

    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        // Seo
        $this->seo()->setTitle( setSeoTitle(__('messages.t_newsletter_settings'), true) );
        $this->seo()->setDescription( settings('seo')->description );

        return view('livewire.admin.newsletter.settings');
    }


    /**
     * Update settings
     *
     * @return void
     */
    public function update()
    {
        try {

            // Validate form
            EditValidator::validate($this);

            // Update newsletter settings
            NewsletterSettings::first()->update([
                'is_enabled' => $this->is_enabled ? 1 : 0
            ]);

            // Refresh settings
            settings('newsletter', true);

            // Success
            $this->alert(
                'success', 
                __('messages.t_success'), 
                livewire_alert_params( __('messages.t_toast_operation_success') )
            );

        } catch (\Illuminate\Validation\ValidationException $e) {

            // Validation error
            $this->alert(
                'error', 
                __('messages.t_error'), 
                livewire_alert_params( __('messages.t_toast_form_validation_error'), 'error' )
            );

            throw $e;

        } catch (\Throwable $th) {

            // Error
            $this->alert(
                'error', 
                __('messages.t_error'), 
                livewire_alert_params( __('messages.t_toast_something_went_wrong'), 'error' )
            );

            throw $th;

        }
    }
    
}
