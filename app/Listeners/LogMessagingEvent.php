<?php

namespace App\Listeners;

use App\Events\MessageDelivered;
use App\Events\MessageRead;
use App\Events\MessageSent;
use App\Events\TypingStarted;
use App\Events\TypingStopped;
use Illuminate\Support\Facades\Log;

class LogMessagingEvent
{
    public function handle(MessageSent|MessageDelivered|MessageRead|TypingStarted|TypingStopped $event): void
    {
        $payload = match (true) {
            $event instanceof MessageSent => [
                'event' => 'message.sent',
                'conversation_id' => $event->message->conversation_id,
                'message_id' => $event->message->id,
                'user_id' => $event->message->user_id,
            ],
            $event instanceof MessageDelivered => [
                'event' => 'message.delivered',
                'conversation_id' => $event->message->conversation_id,
                'message_id' => $event->message->id,
                'user_id' => $event->message->user_id,
            ],
            $event instanceof MessageRead => [
                'event' => 'message.read',
                'conversation_id' => $event->conversationId,
                'message_id' => $event->messageId,
                'user_id' => $event->readerId,
            ],
            $event instanceof TypingStarted => [
                'event' => 'typing.started',
                'conversation_id' => $event->conversationId,
                'user_id' => $event->userId,
            ],
            $event instanceof TypingStopped => [
                'event' => 'typing.stopped',
                'conversation_id' => $event->conversationId,
                'user_id' => $event->userId,
            ],
        };

        Log::channel(config('logging.default'))->info('messaging.event', $payload);
    }
}
