<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required','string','min:6'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $user->tokens()->where('name', 'tracker')->delete();

        $abilities = ['tracker:use'];
        $token = $user->createToken('tracker', $abilities)->plainTextToken;


        return response()->json([
            'token'      => $token,
            'token_type' => 'Bearer',
            'abilities'  => $abilities,
            'user'       => [
                'id'          => $user->id,
                'name'        => $user->fullname ?? $user->username ?? $user->name,
                'email'       => $user->email,
                'avatar_url'  => $user->avatar ? $user->avatar->url : null,
                'role'        => $user->account_type ?? null,
            ],
        ], 200);
    }
}
