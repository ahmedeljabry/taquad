<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\ConversationParticipant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ConversationParticipant>
 */
class ConversationParticipantFactory extends Factory
{
    protected $model = ConversationParticipant::class;

    public function definition(): array
    {
        $timestamp = now();

        return [
            'conversation_id' => Conversation::factory(),
            'user_id' => User::factory(),
            'role' => $this->faker->randomElement(['client', 'freelancer']),
            'last_read_message_id' => null,
            'last_seen_at' => $timestamp,
            'last_read_at' => $timestamp,
            'joined_at' => $timestamp,
            'unread_count' => 0,
            'settings' => [],
        ];
    }
}
