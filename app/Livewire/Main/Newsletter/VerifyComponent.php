<?php
namespace App\Livewire\Main\Newsletter;

use Livewire\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Mail;
use App\Models\NewsletterVerification;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Mail\User\Everyone\NewsletterApproved;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class VerifyComponent extends Component
{
    use SEOToolsTrait, LivewireAlert, Actions;
    
    public $token;

    protected $queryString = [
        'token' => ['as' => 'id']
    ];

    /**
     * Init component
     *
     * @param string $slug
     * @return void
     */
    public function mount()
    {
        
        // Get email
        $verification = NewsletterVerification::where('token', $this->token)->first();

        // Check if it exists
        if (!$verification) {
            return redirect('/');
        }

        // Verify email
        $verification->list->update([
            'status' => "verified"
        ]);

        // Send welcome message
        Mail::to($verification->list->email)->send(new NewsletterApproved);

        // Delete verification
        $verification->delete();

        // Success
        return redirect('/');
    }
    
}