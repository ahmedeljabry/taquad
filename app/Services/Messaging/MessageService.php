<?php

namespace App\Services\Messaging;

use App\Events\MessageDelivered;
use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\Message;
use App\Models\MessageAttachment;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MessageService
{
    public function send(
        Conversation $conversation,
        User $sender,
        string $body,
        array $uploadedAttachments = []
    ): Message {
        [$message, $hasAttachments] = DB::transaction(function () use ($conversation, $sender, $body, $uploadedAttachments) {
            $message = $conversation->messages()->create([
                'user_id' => $sender->id,
                'body' => $body ?: null,
                'type' => 'text',
                'sent_at' => now(),
            ]);

            $attachments = $this->storeAttachments($message, $uploadedAttachments);

            $this->syncConversationState($conversation, $message, $sender);

            $message->loadMissing([
                'attachments',
                'sender:id,username,fullname,avatar_id',
                'conversation.participants',
            ]);

            $hasAttachments = ! empty($attachments);

            if ($hasAttachments) {
                // For MVP we mark attachments as delivered immediately.
                $message->markAsDelivered();
            }

            return [$message, $hasAttachments];
        });

        logger()->info('messaging.store', [
            'conversation_id' => $conversation->id,
            'message_id' => $message->id,
            'user_id' => $sender->id,
            'has_attachments' => $hasAttachments,
        ]);

        try {
            event(new MessageSent($message));
        } catch (\Throwable $exception) {
            report($exception);
        }

        if ($hasAttachments) {
            try {
                event(new MessageDelivered($message));
            } catch (\Throwable $exception) {
                report($exception);
            }
        }

        return $message;
    }

    protected function storeAttachments(Message $message, array $uploaded): array
    {
        if (empty($uploaded)) {
            return [];
        }

        $disk = config('filesystems.default', 'public');
        $directory = 'conversations/' . $message->conversation_id;

        return collect($uploaded)
            ->filter(fn ($file) => $file instanceof UploadedFile)
            ->map(function (UploadedFile $file) use ($message, $disk, $directory) {
                $extension = $file->getClientOriginalExtension();
                $generatedName = Str::uuid()->toString() . ($extension ? '.' . $extension : '');
                $path = $file->storeAs($directory, $generatedName, $disk);

                return $message->attachments()->create([
                    'disk' => $disk,
                    'path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime' => $file->getMimeType(),
                    'size' => $file->getSize(),
                ]);
            })
            ->all();
    }

    protected function syncConversationState(Conversation $conversation, Message $message, User $sender): void
    {
        $conversation->forceFill([
            'last_message_id' => $message->id,
            'last_message_at' => $message->created_at,
        ])->save();

        $participants = $conversation->participants()->lockForUpdate()->get();

        /** @var Collection<int, ConversationParticipant> $participants */
        $participants->each(function (ConversationParticipant $participant) use ($message, $sender) {
            if ($participant->user_id === $sender->id) {
                $participant->forceFill([
                    'last_read_message_id' => $message->id,
                    'last_seen_at' => now(),
                    'last_read_at' => now(),
                    'unread_count' => 0,
                ])->save();
            } else {
                $participant->forceFill([
                    'last_seen_at' => now(),
                    'unread_count' => (int) $participant->unread_count + 1,
                ])->save();

                $this->bustUnreadCache($participant->user_id);
            }
        });
    }

    protected function bustUnreadCache(int $userId): void
    {
        Cache::forget("conversations:unread-count:{$userId}");
    }
}
