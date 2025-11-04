<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Conversation>
 */
class ConversationFactory extends Factory
{
    protected $model = Conversation::class;

    public function definition(): array
    {
        return [
            'uid' => Str::ulid()->toBase32(),
            'project_id' => null,
            'created_by' => User::factory(),
            'last_message_id' => null,
            'last_message_at' => null,
        ];
    }
}
