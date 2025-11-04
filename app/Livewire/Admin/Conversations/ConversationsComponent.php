<?php

namespace App\Livewire\Admin\Conversations;

use Livewire\Component;
use App\Models\Message;
use WireUi\Traits\Actions;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class ConversationsComponent extends Component
{
    use WithPagination, SEOToolsTrait, LivewireAlert, Actions;

    /**
     * Render component
     *
     * @return Illuminate\View\View
     */
    #[Layout('components.layouts.admin-app')]
    public function render()
    {
        // Seo
        $this->seo()->setTitle(setSeoTitle(__('messages.t_conversations'), true));
        $this->seo()->setDescription(settings('seo')->description);

        return view('livewire.admin.conversations.conversations', [
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
        return Message::query()
            ->with([
                'sender' => function ($query) {
                    $query->select('id', 'uid', 'username', 'fullname', 'avatar_id');
                },
                'conversation.participants.user' => function ($query) {
                    $query->select('users.id', 'users.uid', 'users.username', 'users.fullname', 'users.avatar_id');
                },
                'attachments',
            ])
            ->latest('sent_at')
            ->latest('created_at')
            ->paginate(42);
    }


    /**
     * Confirm delete message
     *
     * @param int $id
     * @return void
     */
    public function confirmDelete($id)
    {
        try {

            // Get message
            $message = Message::query()->findOrFail($id);

            // Confirm delete
            $this->dialog()->confirm([
                'title'       => __('messages.t_confirm_delete'),
                'description' => "<div class='leading-relaxed'>" . __('messages.t_are_u_sure_u_want_to_delete_this_msg') . "</div>",
                'icon'        => 'error',
                'accept'      => [
                    'label'  => __('messages.t_delete'),
                    'method' => 'delete',
                    'params' => $message->id,
                ],
                'reject' => [
                    'label'  => __('messages.t_cancel')
                ],
            ]);
        } catch (\Throwable $th) {

            // Error
            $this->alert(
                'error',
                __('messages.t_error'),
                livewire_alert_params(__('messages.t_toast_something_went_wrong'), 'error')
            );
        }
    }


    /**
     * Delete message
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        try {

            // Get message
            $message = Message::query()
                ->with(['attachments', 'conversation.participants'])
                ->findOrFail($id);

            // Delete attachments if exist
            foreach ($message->attachments as $attachment) {
                if ($attachment->path && Storage::disk($attachment->disk)->exists($attachment->path)) {
                    Storage::disk($attachment->disk)->delete($attachment->path);
                }

                $attachment->delete();
            }

            $conversation = $message->conversation;

            $message->delete();

            if ($conversation) {
                $lastMessage = $conversation->messages()
                    ->latest('sent_at')
                    ->latest('created_at')
                    ->first();

                $lastTimestamp = $lastMessage?->sent_at ?? $lastMessage?->created_at;

                $conversation->forceFill([
                    'last_message_id' => $lastMessage?->id,
                    'last_message_at' => $lastTimestamp,
                ])->save();

                $conversation->loadMissing('participants');

                foreach ($conversation->participants as $participant) {
                    $unreadQuery = $conversation->messages()
                        ->where('sender_id', '!=', $participant->user_id);

                    if ($participant->last_read_at) {
                        $lastRead = $participant->last_read_at;
                        $unreadQuery->where(function ($builder) use ($lastRead) {
                            $builder->where('sent_at', '>', $lastRead)
                                ->orWhere(function ($nested) use ($lastRead) {
                                    $nested->whereNull('sent_at')
                                        ->where('created_at', '>', $lastRead);
                                });
                        });
                    }

                    $participant->update([
                        'unread_count' => $unreadQuery->count(),
                    ]);
                }
            }

            // Success
            $this->alert(
                'success',
                __('messages.t_success'),
                livewire_alert_params(__('messages.t_toast_operation_success'))
            );
        } catch (\Throwable $th) {

            // Error
            $this->alert(
                'error',
                __('messages.t_error'),
                livewire_alert_params(__('messages.t_toast_something_went_wrong'), 'error')
            );
        }
    }
}
