<?php

namespace App\Livewire\Admin\Blog\Comments;

use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\ArticleComment;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class CommentsComponent extends Component
{
    use SEOToolsTrait, LivewireAlert, Actions;

    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        // Seo
        $this->seo()->setTitle( setSeoTitle(__('messages.t_comments'), true) );
        $this->seo()->setDescription( settings('seo')->description );

        return view('livewire.admin.blog.comments.comments', [
            'comments' => $this->comments
        ]);
    }


    /**
     * Get latest comments
     *
     * @return object
     */
    public function getCommentsProperty()
    {
        return ArticleComment::with('article', 'article.image')->latest()->paginate(40); 
    }


    /**
     * Delete comment
     *
     * @param integer $id
     * @return void
     */
    public function delete($id)
    {
        // Get comment
        ArticleComment::where('id', $id)->delete();

        // Success
        $this->alert(
            'success', 
            __('messages.t_success'), 
            livewire_alert_params( __('messages.t_toast_operation_success') )
        );
    }


    /**
     * Approve comment
     *
     * @param integer $id
     * @return void
     */
    public function approve($id)
    {
        // Update comment
        ArticleComment::where('id', $id)->update([
            'status' => 'active'
        ]);

        // Success
        $this->alert(
            'success', 
            __('messages.t_success'), 
            livewire_alert_params( __('messages.t_toast_operation_success') )
        );
    }


    /**
     * Hide comment
     *
     * @param integer $id
     * @return void
     */
    public function hide($id)
    {
        // Update comment
        ArticleComment::where('id', $id)->update([
            'status' => 'hidden'
        ]);

        // Success
        $this->alert(
            'success', 
            __('messages.t_success'), 
            livewire_alert_params( __('messages.t_toast_operation_success') )
        );
    }
    
}
