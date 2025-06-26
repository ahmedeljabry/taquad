<?php

namespace App\Livewire\Admin\Services\Cloud;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use App\Http\Validators\Admin\Services\Cloud\AmazonValidator;

class AmazonComponent extends Component
{
    use SEOToolsTrait, LivewireAlert;

    public $key;
    public $secret;
    public $region;
    public $bucket;
    
    /**
     * Initialize component
     *
     * @return void
     */
    public function mount() : void
    {
        // Fill form
        $this->fill([
            'key'    => config('filesystems.disks.s3.key'),
            'secret' => config('filesystems.disks.s3.secret'),
            'region' => config('filesystems.disks.s3.region'),
            'bucket' => config('filesystems.disks.s3.bucket')
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
        $this->seo()->setTitle( setSeoTitle("Amazon S3", true) );
        $this->seo()->setDescription( settings('seo')->description );

        return view('livewire.admin.services.cloud.amazon');
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
            AmazonValidator::validate($this);

            // Update data
            Config::write('filesystems.disks.s3.key', $this->key);
            Config::write('filesystems.disks.s3.secret', $this->secret);
            Config::write('filesystems.disks.s3.region', $this->region);
            Config::write('filesystems.disks.s3.bucket', $this->bucket);

            // Clear cache
            Artisan::call('cache:clear');

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
