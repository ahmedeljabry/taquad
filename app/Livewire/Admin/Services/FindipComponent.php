<?php
namespace App\Livewire\Admin\Services;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Http\Validators\Admin\Services\FindipValidator;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class FindipComponent extends Component
{
    use SEOToolsTrait, LivewireAlert;
    
    public $key;

    /**
     * Initialize component
     *
     * @return void
     */
    public function mount()
    {
        // Fill default settings
        $this->fill([
            'key' => config('findip.key')
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
        $this->seo()->setTitle( setSeoTitle(__('dashboard.t_findip_net'), true) );
        $this->seo()->setDescription( settings('seo')->description );

        return view('livewire.admin.services.findip');
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
            FindipValidator::validate($this);

            // Update currency
            Config::write('findip.key', $this->key);

            // Clear config
            Artisan::call('config:clear');

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
