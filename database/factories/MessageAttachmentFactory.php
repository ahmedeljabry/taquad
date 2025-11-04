<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\MessageAttachment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MessageAttachment>
 */
class MessageAttachmentFactory extends Factory
{
    protected $model = MessageAttachment::class;

    public function definition(): array
    {
        $fileName = $this->faker->uuid() . '.txt';

        return [
            'message_id' => Message::factory(),
            'disk' => config('filesystems.default', 'public'),
            'path' => 'messages/' . $fileName,
            'original_name' => $fileName,
            'mime' => 'text/plain',
            'size' => $this->faker->numberBetween(100, 2048),
        ];
    }
}
