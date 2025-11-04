<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

\Livewire\Livewire::actingAs(\App\Models\User::first());
$conversation = \App\Models\Conversation::first();

$component = \Livewire\Livewire::test(\App\Livewire\Main\Conversations\WorkspaceComponent::class, ['conversation' => $conversation->uid]);
$component->set('messageBody', 'Hello from livewire test ' . now()->format('H:i:s'));
$component->call('sendMessage');
