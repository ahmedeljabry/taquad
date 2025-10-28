<?php

namespace App\Http\Controllers\Theme;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class PreferenceController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'theme' => ['required', 'in:light,dark,system'],
        ]);

        $theme = $validated['theme'];

        if ($theme === 'system') {
            $cookieResponse = Cookie::forget('default_theme');
        } else {
            $cookieResponse = cookie()->make(
                'default_theme',
                $theme,
                60 * 24 * 365,
                '/',
                null,
                request()->isSecure(),
                false,
                false,
                'Lax'
            );
        }

        if (Auth::check()) {
            Auth::user()->forceFill([
                'dark_mode' => $theme === 'dark' ? 1 : 0,
            ])->save();
        }

        return response()->json([
            'theme' => $theme,
        ])->withCookie($cookieResponse);
    }
}
