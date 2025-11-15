<?php

namespace App\Services\Ai;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class OllamaClient
{
    /**
     * Send conversation messages to the Ollama chat endpoint.
     *
     * @param  array<int, array<string, mixed>>  $messages
     * @param  array<string, mixed>  $options
     */
    public function chat(array $messages, array $options = []): string
    {
        $config = config('ai.ollama');

        $payload = array_merge([
            'model'    => $config['model'],
            'messages' => $messages,
            'stream'   => false,
        ], $options);

        $endpoint = rtrim($config['host'], '/') . ':' . $config['port'] . '/api/chat';

        $response = Http::timeout((int) $config['timeout'])
            ->acceptJson()
            ->post($endpoint, $payload);

        if ($response->failed()) {
            throw new RuntimeException('Ollama error: ' . $response->body());
        }

        $data = $response->json();

        return (string) data_get($data, 'message.content', '');
    }
}

