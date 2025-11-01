<?php

namespace App\Services;

use App\Models\TrackerRefreshToken;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class TrackerOAuthService
{
    public function createAuthorizationCode(User $user, array $payload): string
    {
        $code = Str::random(64);
        $ttl = (int) config('tracker.authorization_code_ttl', 600);

        Cache::put($this->codeCacheKey($code), [
            'user_id' => $user->id,
            'client_id' => $payload['client_id'],
            'code_challenge' => $payload['code_challenge'],
            'code_challenge_method' => $payload['code_challenge_method'] ?? 'S256',
            'redirect_uri' => $payload['redirect_uri'],
            'scope' => $payload['scope'] ?? '',
            'created_at' => now(),
        ], $ttl);

        Log::debug('Tracker OAuth: authorization code issued.', [
            'user_id' => $user->id,
            'client_id' => $payload['client_id'],
            'state' => $payload['state'] ?? null,
            'ttl' => $ttl,
        ]);

        return $code;
    }

    public function consumeAuthorizationCode(string $code): ?array
    {
        $key = $this->codeCacheKey($code);
        $data = Cache::pull($key);

        if (! $data) {
            Log::warning('Tracker OAuth: attempted to consume unknown/expired code.', [
                'code_prefix' => substr($code, 0, 8),
            ]);
        }

        return $data ?: null;
    }

    public function createRefreshToken(User $user, string $clientId): string
    {
        $plain = Str::random(64);
        $hashed = $this->hashToken($plain);

        TrackerRefreshToken::create([
            'user_id' => $user->id,
            'client_id' => $clientId,
            'token' => $hashed,
            'expires_at' => now()->addDays((int) config('tracker.refresh_token_ttl_days', 30)),
        ]);

        return $plain;
    }

    public function rotateRefreshToken(string $plainToken, string $clientId): ?TrackerRefreshToken
    {
        $hashed = $this->hashToken($plainToken);

        $stored = TrackerRefreshToken::where('token', $hashed)
            ->where('client_id', $clientId)
            ->where('revoked', false)
            ->first();

        if (! $stored) {
            return null;
        }

        if ($stored->expires_at && $stored->expires_at->isPast()) {
            $stored->revoked = true;
            $stored->save();

            return null;
        }

        $stored->revoked = true;
        $stored->save();

        return $stored;
    }

    public function validateCodeChallenge(string $codeChallengeMethod, string $codeChallenge, string $codeVerifier): bool
    {
        if ($codeChallengeMethod !== 'S256') {
            return false;
        }

        $computed = $this->generateCodeChallenge($codeVerifier);

        return hash_equals($codeChallenge, $computed);
    }

    public function generateCodeChallenge(string $verifier): string
    {
        $binaryHash = hash('sha256', $verifier, true);
        return rtrim(strtr(base64_encode($binaryHash), '+/', '-_'), '=');
    }

    private function codeCacheKey(string $code): string
    {
        return 'tracker_oauth_code:' . $code;
    }

    private function hashToken(string $token): string
    {
        return hash('sha256', $token);
    }
}
