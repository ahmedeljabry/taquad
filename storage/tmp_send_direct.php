<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$conversation = \App\Models\Conversation::first();
$user = \App\Models\User::first();
$service = app(\App\Services\Messaging\MessageService::class);
$message = $service->send($conversation, $user, 'Test direct send ' . now()->toDateTimeString());

echo $message->id;
