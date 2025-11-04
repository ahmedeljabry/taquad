<?php

use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\Contract;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('contract.{contractId}', function ($user, $contractId) {
    return Contract::query()
        ->where('id', $contractId)
        ->where(function ($query) use ($user) {
            $query->where('client_id', $user->id)
                ->orWhere('freelancer_id', $user->id);
        })
        ->exists();
});

Broadcast::channel('presence.conversation.{conversationId}', function ($user, $conversationId) {
    $participant = ConversationParticipant::query()
        ->where('conversation_id', $conversationId)
        ->where('user_id', $user->id)
        ->first();

    if (! $participant) {
        return false;
    }

    return [
        'id' => $user->id,
        'name' => $user->fullname ?? $user->username,
        'role' => $participant->role,
        'avatar' => method_exists($user, 'avatar') && $user->avatar && function_exists('src')
            ? src($user->avatar)
            : null,
    ];
});

Broadcast::channel('private.typing.conversation.{conversationId}', function ($user, $conversationId) {
    return ConversationParticipant::query()
        ->where('conversation_id', $conversationId)
        ->where('user_id', $user->id)
        ->exists();
});

Broadcast::channel('private.reads.conversation.{conversationId}', function ($user, $conversationId) {
    return ConversationParticipant::query()
        ->where('conversation_id', $conversationId)
        ->where('user_id', $user->id)
        ->exists();
});

Broadcast::channel('private.deliveries.user.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});

Broadcast::channel('conversation.{conversationUid}', function ($user, $conversationUid) {
    return Conversation::query()
        ->where('uid', $conversationUid)
        ->whereHas('participants', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->exists();
});
