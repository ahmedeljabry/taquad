<?php

namespace App\Livewire\Admin\Refunds;

use App\Models\Refund;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class RefundsComponent extends Component
{
    use WithPagination, SEOToolsTrait, LivewireAlert;

    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        // Seo
        $this->seo()->setTitle( setSeoTitle(__('messages.t_refunds'), true) );
        $this->seo()->setDescription( settings('seo')->description );

        return view('livewire.admin.refunds.refunds', [
            'refunds' => $this->refunds
        ]);
    }


    /**
     * Get list of refunds
     *
     * @return object
     */
    public function getRefundsProperty()
    {
        return Refund::latest()->paginate(42);
    }
    
}
