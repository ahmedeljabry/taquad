<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$messages = \App\Models\Message::orderByDesc('id')->take(5)->get(['id','body','created_at'])->toArray();
echo json_encode($messages, JSON_PRETTY_PRINT);
