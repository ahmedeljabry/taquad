<?php

namespace App\Livewire\Main\Includes;

use App\Models\Page;
use Livewire\Component;

class Footer extends Component
{
    
    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.main.includes.footer', [
            'pages' => $this->pages
        ]);
    }


    /**
     * Get pages
     *
     * @return object
     */
    public function getPagesProperty()
    {
        return Page::orderBy('id', 'asc')->get();
    }
}
