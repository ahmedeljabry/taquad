<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;

class MessagePolicy
{
    public function view(User $user, Message $message): bool
    {
        return $message->conversation
            ->participants()
            ->where('user_id', $user->id)
            ->exists();
    }

    public function update(User $user, Message $message): bool
    {
        if ($this->canModerate($user)) {
            return true;
        }

        return $this->isAuthor($user, $message)
            && $this->withinWindow($message, (int) config('messaging.edit_window_seconds', 120));
    }

    public function delete(User $user, Message $message): bool
    {
        return $this->isAuthor($user, $message) || $this->canModerate($user);
    }

    public function forceDelete(User $user, Message $message): bool
    {
        if ($this->canModerate($user)) {
            return true;
        }

        $window = (int) config('messaging.revoke_window_seconds', 120);

        if (! $this->isAuthor($user, $message) || ! $this->withinWindow($message, $window)) {
            return false;
        }

        $conversation = $message->conversation->loadMissing('participants');

        foreach ($conversation->participants as $participant) {
            if ($participant->user_id === $user->id) {
                continue;
            }

            if ($participant->last_read_message_id && $participant->last_read_message_id >= $message->id) {
                return false;
            }
        }

        return true;
    }

    protected function withinWindow(Message $message, int $seconds): bool
    {
        if (! $message->created_at) {
            return false;
        }

        return $message->created_at->gte(now()->subSeconds($seconds));
    }

    protected function isAuthor(User $user, Message $message): bool
    {
        return (int) $message->user_id === (int) $user->id;
    }

    protected function canModerate(User $user): bool
    {
        if (method_exists($user, 'isAdmin')) {
            return (bool) $user->isAdmin();
        }

        return false;
    }
}
