<?php
namespace App\Livewire\Admin\System;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class ResetComponent extends Component
{
    use SEOToolsTrait, LivewireAlert;

    public $users = false;

    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        // Seo
        $this->seo()->setTitle( setSeoTitle(__('dashboard.t_factory_reset'), true) );
        $this->seo()->setDescription( settings('seo')->description );

        return view('livewire.admin.system.reset');
    }


    /**
     * Confirm factory reset
     *
     * @return void
     */
    public function confirm() : void
    {
        try {
            


        } catch (\Throwable $th) {
            //throw $th;
        }
    }

}
