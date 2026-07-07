<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class SsoTokenIssuer
{
    public function issueFor($user): string
    {
        $privateKey = file_get_contents(config('sso.private_key_path'));

        $jti = (string) Str::uuid();
        $now = time();

        $payload = [
            'iss' => config('sso.issuer'),
            'aud' => config('sso.audience'),
            'iat' => $now,
            'exp' => $now + config('sso.ttl'),
            'jti' => $jti,
            'sub' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'role' => $user->role ?? 'user',
        ];

        // Track issued jti so Hospital-side replay is also blocked if needed later
        Cache::put('sso_issued_' . $jti, true, config('sso.ttl') + 5);

        return JWT::encode($payload, $privateKey, 'RS256');
    }
}
