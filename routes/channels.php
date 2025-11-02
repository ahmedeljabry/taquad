<?php

use App\Models\Contract;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('contract.{contractId}', function ($user, $contractId) {
    return Contract::query()
        ->where('id', $contractId)
        ->where(function ($query) use ($user) {
            $query->where('client_id', $user->id)
                ->orWhere('freelancer_id', $user->id);
        })
        ->exists();
});
