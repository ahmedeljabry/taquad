<?php

namespace App\Livewire\Main\Messages;

use App\Models\User;
use Livewire\Component;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class NewComponent extends Component
{
    use SEOToolsTrait;
    
    /**
     * Init component
     *
     * @param string $username
     * @param string|null $project_id
     * @return void
     */
    public function mount($username , ?string $project_id = null)
    {
        // Get user
        $user = User::where('username', $username)
                    ->whereIn('status', ['active', 'verified'])
                    ->where('id', '!=', auth()->id())
                    ->first();

        // Check if user exists
        if (!$user) {
            return redirect('/');
        }

        // Set redirect url & pass project_id for first conversition
        $url = "inbox/$user->uid?project=$project_id";

        // Redirect to conversation
        return redirect($url);

    }
    
}