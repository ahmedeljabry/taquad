<?php
namespace App\Livewire\Admin\Support;

use Livewire\Component;
use App\Models\SupportMessage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use App\Mail\Admin\Support\Reply;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Http\Validators\Admin\Support\ReplyValidator;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class ReplyComponent extends Component
{
    use SEOToolsTrait, LivewireAlert;

    // Message
    public SupportMessage $message;

    // Form
    public $reply;
    public $subject;

    #[Locked]
    public $email;

    #[Locked]
    public $ip_address;

    #[Locked]
    public $user_agent;
    
    /**
     * Initialize component
     *
     * @param string $id
     * @return void
     */
    public function mount($id) : void
    {
        // Get message
        $message = SupportMessage::where('uid', $id)->firstOrFail();

        // Fill form
        $this->fill([
            'email'      => $message->email,
            'ip_address' => $message->ip_address,
            'user_agent' => $message->user_agent,
            'subject'    => __('messages.t_re_subject_short') . ' ' . $message->subject
        ]);

        // Set message
        $this->message = $message;
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
        $this->seo()->setTitle( setSeoTitle(__('messages.t_reply_message'), true) );
        $this->seo()->setDescription( settings('seo')->description );

        return view('livewire.admin.support.reply');
    }


    /**
     * Reply message
     *
     * @return void
     */
    public function send()
    {
        try {

            // Validate form
            ReplyValidator::validate($this);

            // Send message to this email address
            Mail::to($this->message->email)->send(new Reply($this->subject, $this->reply));

            // Mark message as replied
            $this->message->is_seen    = true;
            $this->message->is_replied = true;
            $this->message->save();

            // Success
            $this->alert(
                'success', 
                __('messages.t_success'), 
                livewire_alert_params( __('messages.t_message_reply_sent_successfully') )
            );

            // Refresh the page
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
