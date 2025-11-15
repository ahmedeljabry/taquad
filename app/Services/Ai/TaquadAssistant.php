<?php

namespace App\Services\Ai;

use App\Models\User;

class TaquadAssistant
{
    public function __construct(
        protected OllamaClient $client,
    ) {
    }

    /**
     * Generate a reply from the assistant.
     *
     * @param  array<int, array{role:string, content:string}>  $history
     */
    public function reply(?User $user, string $userMessage, array $history = []): string
    {
        $messages = [
            ['role' => 'system', 'content' => $this->systemPrompt()],
            ['role' => 'system', 'content' => $this->userContext($user)],
        ];

        foreach ($this->normalizeHistory($history) as $message) {
            $messages[] = $message;
        }

        $messages[] = [
            'role'    => 'user',
            'content' => $this->formatUserQuestion($user, $userMessage),
        ];

        return $this->client->chat($messages);
    }

    protected function systemPrompt(): string
    {
        return (string) config('ai.assistant.system_prompt');
    }

    protected function userContext(?User $user): string
    {
        if ($user instanceof User) {
            return "بيانات المستخدم المسجّل في منصة تعاقد:\nالاسم: {$user->name}\nID: {$user->id}";
        }

        return 'المستخدم الحالي غير مسجّل (ضيف) على منصة تعاقد.';
    }

    protected function formatUserQuestion(?User $user, string $message): string
    {
        $label = $user instanceof User ? 'رسالة المستخدم المسجّل:' : 'رسالة الضيف:';

        return $label . "\n" . trim($message);
    }

    /**
     * @param  array<int, mixed>  $history
     * @return array<int, array{role:string, content:string}>
     */
    protected function normalizeHistory(array $history): array
    {
        $allowedRoles = ['user', 'assistant'];
        $normalized = [];

        foreach ($history as $message) {
            if (! is_array($message)) {
                continue;
            }

            $role = $message['role'] ?? null;
            $content = isset($message['content']) ? trim((string) $message['content']) : '';

            if (! in_array($role, $allowedRoles, true) || $content === '') {
                continue;
            }

            $normalized[] = [
                'role'    => $role,
                'content' => $content,
            ];
        }

        $limit = (int) config('ai.assistant.history_limit', 8);
        if ($limit > 0 && count($normalized) > $limit) {
            $normalized = array_slice($normalized, -$limit);
        }

        return $normalized;
    }
}
