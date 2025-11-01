<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\TrackerRefreshToken;
use App\Models\User;
use App\Services\TrackerOAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TrackerOAuthTokenController extends Controller
{
    public function token(Request $request, TrackerOAuthService $service): JsonResponse
    {
        $grantType = $request->string('grant_type')->toString();

        return match ($grantType) {
            'authorization_code' => $this->handleAuthorizationCode($request, $service),
            'refresh_token' => $this->handleRefreshToken($request, $service),
            default => response()->json([
                'error' => 'unsupported_grant_type',
                'error_description' => 'Grant type is not supported.',
            ], 400),
        };
    }

    private function handleAuthorizationCode(Request $request, TrackerOAuthService $service): JsonResponse
    {
        $validated = $request->validate([
            'client_id' => ['required', 'string'],
            'code' => ['required', 'string'],
            'code_verifier' => ['required', 'string'],
            'redirect_uri' => ['required', 'url'],
        ]);

        $codePayload = $service->consumeAuthorizationCode($validated['code']);

        if (! $codePayload) {
            Log::warning('Tracker OAuth: authorization code not found or expired.', [
                'client_id' => $validated['client_id'],
            ]);
            return $this->invalidGrantResponse();
        }

        if ($validated['client_id'] !== $codePayload['client_id']) {
            Log::warning('Tracker OAuth: client mismatch during token exchange.', [
                'expected' => $codePayload['client_id'],
                'provided' => $validated['client_id'],
            ]);
            return $this->invalidGrantResponse();
        }

        if (! $service->validateCodeChallenge(
            $codePayload['code_challenge_method'],
            $codePayload['code_challenge'],
            $validated['code_verifier']
        )) {
            Log::warning('Tracker OAuth: PKCE validation failed.', [
                'client_id' => $validated['client_id'],
            ]);
            return $this->invalidGrantResponse();
        }

        $user = User::find($codePayload['user_id']);

        if (! $user) {
            Log::warning('Tracker OAuth: user not found for authorization code.', [
                'user_id' => $codePayload['user_id'] ?? null,
            ]);
            return $this->invalidGrantResponse();
        }

        $accessToken = $user->createToken(
            'tracker',
            config('tracker.access_token_abilities', ['tracker:use'])
        )->plainTextToken;

        $refreshToken = $service->createRefreshToken($user, $validated['client_id']);

        Log::info('Tracker OAuth: issued access + refresh tokens.', [
            'user_id' => $user->id,
            'client_id' => $validated['client_id'],
            'access_token' => $accessToken,
        ]);

        return response()->json([
            'access_token' => $accessToken,
            'token_type' => 'Bearer',
            'expires_in' => (int) config('tracker.access_token_expires_in', 3600),
            'refresh_token' => $refreshToken,
            'scope' => implode(' ', config('tracker.access_token_scopes', [])),
        ]);
    }

    private function handleRefreshToken(Request $request, TrackerOAuthService $service): JsonResponse
    {
        $validated = $request->validate([
            'client_id' => ['required', 'string'],
            'refresh_token' => ['required', 'string'],
        ]);

        $storedToken = $service->rotateRefreshToken($validated['refresh_token'], $validated['client_id']);

        if (! $storedToken) {
            Log::warning('Tracker OAuth: refresh token not found.', [
                'client_id' => $validated['client_id'],
            ]);
            return $this->invalidGrantResponse();
        }

        $user = $storedToken->user;

        if (! $user) {
            Log::warning('Tracker OAuth: user not found for refresh token.', [
                'token_id' => $storedToken->id,
            ]);
            return $this->invalidGrantResponse();
        }

        $accessToken = $user->createToken(
            'tracker',
            config('tracker.access_token_abilities', ['tracker:use'])
        )->plainTextToken;

        $refreshToken = $service->createRefreshToken($user, $validated['client_id']);

        Log::info('Tracker OAuth: rotated refresh token and issued new access token.', [
            'user_id' => $user->id,
            'client_id' => $validated['client_id'],
        ]);

        return response()->json([
            'access_token' => $accessToken,
            'token_type' => 'Bearer',
            'expires_in' => (int) config('tracker.access_token_expires_in', 3600),
            'refresh_token' => $refreshToken,
            'scope' => implode(' ', config('tracker.access_token_scopes', [])),
        ]);
    }

    private function invalidGrantResponse(): JsonResponse
    {
        return response()->json([
            'error' => 'invalid_grant',
            'error_description' => 'The provided authorization grant is invalid.',
        ], 400);
    }
}
