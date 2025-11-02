<?php

namespace App\Services\Tracker;

use App\Models\TrackerClient;
use Illuminate\Support\Facades\DB;

class ClientService
{
    public function create(array $attributes): TrackerClient
    {
        return DB::transaction(fn () => TrackerClient::create($attributes));
    }

    public function update(TrackerClient $client, array $attributes): TrackerClient
    {
        return DB::transaction(function () use ($client, $attributes) {
            $client->fill($attributes);
            $client->save();

            return $client;
        });
    }

    public function delete(TrackerClient $client): void
    {
        DB::transaction(fn () => $client->delete());
    }
}

