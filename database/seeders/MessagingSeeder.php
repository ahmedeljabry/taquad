<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessagingSeeder extends Seeder
{
    public function run(): void
    {
        $clients = User::factory()->count(3)->create();
        $freelancers = User::factory()->count(3)->create();

        $clients->each(function (User $client, int $index) use ($freelancers): void {
            $freelancer = $freelancers[$index] ?? $freelancers->random();

            $conversation = Conversation::factory()->create([
                'created_by' => $client->id,
            ]);

            ConversationParticipant::factory()->create([
                'conversation_id' => $conversation->id,
                'user_id' => $client->id,
                'role' => 'client',
            ]);

            ConversationParticipant::factory()->create([
                'conversation_id' => $conversation->id,
                'user_id' => $freelancer->id,
                'role' => 'freelancer',
            ]);

            Message::factory()->count(5)->create([
                'conversation_id' => $conversation->id,
                'user_id' => $client->id,
            ]);

            $lastMessage = Message::factory()->create([
                'conversation_id' => $conversation->id,
                'user_id' => $freelancer->id,
                'delivered_at' => now(),
            ]);

            $conversation->forceFill([
                'last_message_id' => $lastMessage->id,
                'last_message_at' => $lastMessage->created_at,
            ])->save();
        });
    }
}
