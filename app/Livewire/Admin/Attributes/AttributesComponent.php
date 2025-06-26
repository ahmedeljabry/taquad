<?php

namespace App\Livewire\Admin\Attributes;

use Livewire\Component;
use App\Models\Attribute;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class AttributesComponent extends Component
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
        $this->seo()->setTitle( setSeoTitle(__('dashboard.t_attributes'), true) );
        $this->seo()->setDescription( settings('seo')->description );

        return view('livewire.admin.attributes.attributes', [
            'attributes' => $this->attributes_list
        ]);
    }


    /**
     * Get list of attributes
     *
     * @return object
     */
    public function getAttributesListProperty()
    {
        return Attribute::withTranslation()
                        ->with('options', 'category', 'subcategory', 'childcategory')
                        ->latest('id')
                        ->paginate(42);
    }
    
}
