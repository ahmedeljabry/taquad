<?php

namespace App\Http\Controllers\Api\Tracker;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $user = $request->user();
        Log::info('Tracker API: profile requested', ['user_id' => $user?->id]);

        return response()->json([
            'id' => $user->id,
            'name' => $user->fullname ?? $user->username ?? $user->name,
            'email' => $user->email,
            'avatar_url' => $user->avatar_url ?? null,
            'role' => $user->role ?? null,
        ]);
    }
}
