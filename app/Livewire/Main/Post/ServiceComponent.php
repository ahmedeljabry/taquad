<?php

namespace App\Livewire\Main\Post;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class ServiceComponent extends Component
{
    use SEOToolsTrait, LivewireAlert;

    public $title;

    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    #[Layout('components.layouts.main-app')]
    public function render()
    {
        // SEO
        $separator   = settings('general')->separator;
        $title       = __('messages.t_create_new_service') . " $separator " . settings('general')->title;
        $description = settings('seo')->description;

        $this->seo()->setTitle( $title );
        $this->seo()->setDescription( $description );
        $this->seo()->setCanonical( url()->current() );


        return view('livewire.main.post.service');
    }
    
}
