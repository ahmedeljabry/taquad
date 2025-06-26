<?php

namespace App\Livewire\Admin\Newsletter;

use Livewire\Component;
use App\Models\NewsletterList;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\Newsletter\SendEmail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Http\Validators\Admin\Newsletter\SendValidator;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class SendComponent extends Component
{
    use SEOToolsTrait, LivewireAlert;

    public NewsletterList $subscription;

    // Form
    public $email;
    public $subject;
    public $message;

    /**
     * Init component
     *
     * @return void
     */
    public function mount($id)
    {
        // Get subscription
        $subscription       = NewsletterList::where('uid', $id)->firstOrFail();

        // Fill email
        $this->fill(['email' => $subscription->email]);

        // Set subscription
        $this->subscription = $subscription;
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
        $this->seo()->setTitle( setSeoTitle(__('messages.t_send_an_email'), true) );
        $this->seo()->setDescription( settings('seo')->description );

        return view('livewire.admin.newsletter.send');
    }


    /**
     * Send an email
     *
     * @return void
     */
    public function send()
    {
        try {

            // Validate form
            SendValidator::validate($this);

            // Send this person an email
            Mail::to($this->subscription->email)->send(new SendEmail($this->subject, $this->message));

            // Success
            $this->alert(
                'success', 
                __('messages.t_success'), 
                livewire_alert_params( __('messages.t_toast_operation_success') )
            );

            // Refresh
            $this->dispatch('refresh');

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
