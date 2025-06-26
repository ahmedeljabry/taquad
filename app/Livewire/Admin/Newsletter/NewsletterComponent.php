<?php
namespace App\Livewire\Admin\Newsletter;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\NewsletterList;
use Livewire\Attributes\Layout;
use App\Exports\NewsletterExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\NewsletterVerification;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use App\Mail\User\Everyone\NewsletterVerification as EveryoneNewsletterVerification;

class NewsletterComponent extends Component
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
        $this->seo()->setTitle( setSeoTitle(__('messages.t_newsletter'), true) );
        $this->seo()->setDescription( settings('seo')->description );

        return view('livewire.admin.newsletter.newsletter', [
            'lists' => $this->lists
        ]);
    }


    /**
     * Get list of newsletter lists
     *
     * @return object
     */
    public function getListsProperty()
    {
        return NewsletterList::latest()->paginate(42);
    }


    /**
     * Export emails
     *
     * @param string $type
     * @return void
     */
    public function export($type)
    {
        // Check type of export
        if (!in_array($type, ['all', 'pending', 'verified'])) {
            
            // Error
            $this->alert(
                'error', 
                __('messages.t_error'), 
                livewire_alert_params( __('messages.t_pls_select_export_type'), 'error' )
            );

            return;

        }

        // Export data
        return Excel::download(new NewsletterExport($type), Str::uuid()->toString() . '.xlsx');
    }


    /**
     * Resend verification token
     *
     * @param integer $id
     * @return void
     */
    public function resend($id)
    {
        // Get list
        $list = NewsletterList::where('id', $id)->where('status', 'pending')->firstOrFail();

        // Delete old verifications
        NewsletterVerification::where('list_id', $list->id)->delete();

        // Generate new verification token
        $verification          = new NewsletterVerification();
        $verification->list_id = $list->id;
        $verification->token   = uid(60);
        $verification->save();

        // Send verification message again
        Mail::to($list->email)->send(new EveryoneNewsletterVerification($verification->token));

        // Success
        $this->alert(
            'success', 
            __('messages.t_success'), 
            livewire_alert_params( __('messages.t_a_verification_link_sent_to_this_email') )
        );
    }


    /**
     * delete email from list
     *
     * @param integer $id
     * @return void
     */
    public function delete($id)
    {
        // Get list
        $list = NewsletterList::where('id', $id)->firstOrFail();

        // Delete verification tokens
        NewsletterVerification::where('list_id', $list->id)->delete();

        // Delete email
        $list->delete();

        // Success
        $this->alert(
            'success', 
            __('messages.t_success'), 
            livewire_alert_params( __('messages.t_email_newsletter_deleted_success') )
        );
    }
    
}
