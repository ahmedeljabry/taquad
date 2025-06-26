<?php

namespace App\Livewire\Admin\Support;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SupportMessage;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class SupportComponent extends Component
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
        $this->seo()->setTitle( setSeoTitle(__('messages.t_support'), true) );
        $this->seo()->setDescription( settings('seo')->description );

        return view('livewire.admin.support.support', [
            'messages' => $this->messages
        ]);
    }


    /**
     * Get list of messages
     *
     * @return object
     */
    public function getMessagesProperty()
    {
        return SupportMessage::latest()->paginate(42);
    }


    /**
     * Read message
     *
     * @param integer $id
     * @return void
     */
    public function read($id)
    {
        // Get message
        $message = SupportMessage::where('id', $id)->firstOrFail();

        // Mark as read
        $message->is_seen = true;
        $message->save();

        // Return message
        $this->dispatch('support-messages-read-response', nl2br(clean($message->message)));

        // Open dialog
        $this->dispatch('open-modal', 'read-message');
    }


    /**
     * Delete message
     *
     * @param integer $id
     * @return void
     */
    public function delete($id)
    {
        // Delete
        SupportMessage::where('id', $id)->delete();

        // Success
        $this->alert(
            'success', 
            __('messages.t_success'), 
            livewire_alert_params( __('messages.t_message_has_been_deleted') )
        );
    }
    
}
