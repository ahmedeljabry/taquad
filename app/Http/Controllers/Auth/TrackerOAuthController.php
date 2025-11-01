<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\TrackerOAuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class TrackerOAuthController extends Controller
{
    public function authorizeRequest(Request $request, TrackerOAuthService $service): RedirectResponse
    {
        $request->validate([
            'client_id' => ['required', 'string'],
            'redirect_uri' => ['required', 'url'],
            'response_type' => ['required', 'in:code'],
            'state' => ['required', 'string'],
            'code_challenge' => ['required', 'string'],
            'code_challenge_method' => ['required', 'in:S256'],
            'scope' => ['nullable', 'string'],
        ]);

        $clientId = $request->string('client_id')->toString();
        $expectedClientId = config('tracker.oauth_client_id');

        if ($clientId !== $expectedClientId) {
            abort(403, 'Client not allowed.');
        }

        $redirectUri = $request->string('redirect_uri')->toString();

        if (! $this->isAllowedRedirect($redirectUri)) {
            abort(400, 'Invalid redirect uri.');
        }

        if (! Auth::check()) {
            session()->put('url.intended', $request->fullUrl());

            return redirect()->route('login');
        }

        $user = Auth::user();

        Log::info('Tracker OAuth: authorization request approved.', [
            'user_id' => $user->id,
            'client_id' => $clientId,
            'redirect' => $redirectUri,
            'scope' => $request->string('scope')->toString(),
        ]);

        $state = $request->string('state')->toString();

        $code = $service->createAuthorizationCode($user, [
            'client_id' => $clientId,
            'code_challenge' => $request->string('code_challenge')->toString(),
            'code_challenge_method' => $request->string('code_challenge_method')->toString(),
            'redirect_uri' => $redirectUri,
            'scope' => $request->string('scope')->toString(),
            'state' => $state,
        ]);

        $separator = str_contains($redirectUri, '?') ? '&' : '?';

        Log::info('Tracker OAuth: redirecting to loopback callback with code.', [
            'user_id' => $user->id,
            'client_id' => $clientId,
            'code_prefix' => substr($code, 0, 8),
            'state' => $state,
        ]);

        return redirect()->away($redirectUri . $separator . http_build_query([
            'code' => $code,
            'state' => $state,
        ]));
    }

    private function isAllowedRedirect(string $uri): bool
    {
        $parsed = parse_url($uri);

        if (! $parsed || ! isset($parsed['scheme'], $parsed['host'])) {
            return false;
        }

        if (! in_array($parsed['scheme'], ['http', 'https'], true)) {
            return false;
        }

        return in_array($parsed['host'], ['127.0.0.1', 'localhost'], true);
    }
}
