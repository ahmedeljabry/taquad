<?php
namespace App\Livewire\Admin\System;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class CacheComponent extends Component
{
    use SEOToolsTrait, LivewireAlert;

    /**
     * Init component
     *
     * @return void
     */
    public function mount()
    {
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
        $this->seo()->setTitle( setSeoTitle(__('messages.t_caching'), true) );
        $this->seo()->setDescription( settings('seo')->description );

        return view('livewire.admin.system.cache');
    }


    /**
     * Clear cache
     *
     * @param string $action
     * @return void
     */
    public function clear($action) : void
    {
        try {
            
            // Check action
            switch ($action) {

                // Cache
                case 'cache':
                    Artisan::call('cache:clear');
                break;

                // View
                case 'views':
                    Artisan::call('view:clear');
                break;

                // Sessions
                case 'sessions':
                    DB::table('sessions')->truncate();
                break;

                // Log
                case 'log':
                    
                    // Get files
                    $files = glob(storage_path('logs') . "/*.log");
                
                    // Delete files
                    foreach ($files as $file) {
                        
                        // Delete this file
                        File::delete($file);

                    }

                break;
                
            }

            // Success
            $this->alert(
                'success', 
                __('messages.t_success'), 
                livewire_alert_params( __('messages.t_toast_operation_success') )
            );

        } catch (\Throwable $th) {
            
            // Something went wrong
            $this->alert(
                'error', 
                __('messages.t_error'), 
                livewire_alert_params( __('messages.t_toast_something_went_wrong'), 'error' )
            );

        }
    }

}
