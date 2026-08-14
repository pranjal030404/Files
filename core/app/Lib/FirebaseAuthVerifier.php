<?php

namespace App\Lib;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Cache;

class FirebaseAuthVerifier
{
    const CERTS_URL = 'https://www.googleapis.com/robot/v1/metadata/x509/securetoken@system.gserviceaccount.com';

    /**
     * Verify a Firebase Auth ID token and return its decoded claims.
     *
     * @return array
     */
    public static function verify(string $idToken, string $projectId)
    {
        $parts = explode('.', $idToken);
        if (count($parts) !== 3) {
            throw new \Exception('Malformed Firebase ID token');
        }

        $header = json_decode(base64_decode(strtr($parts[0], '-_', '+/')), true);
        $kid = $header['kid'] ?? null;
        if (!$kid) {
            throw new \Exception('Firebase ID token is missing a key id');
        }

        $certs = self::getCerts();
        if (!isset($certs[$kid])) {
            throw new \Exception('Firebase ID token signed with an unrecognized key');
        }

        $decoded = JWT::decode($idToken, new Key($certs[$kid], 'RS256'));
        $claims = (array) $decoded;

        if (($claims['aud'] ?? null) !== $projectId) {
            throw new \Exception('Firebase ID token audience mismatch');
        }
        if (($claims['iss'] ?? null) !== 'https://securetoken.google.com/' . $projectId) {
            throw new \Exception('Firebase ID token issuer mismatch');
        }
        if (empty($claims['sub'])) {
            throw new \Exception('Firebase ID token is missing a subject');
        }
        if (empty($claims['phone_number'])) {
            throw new \Exception('Firebase ID token does not contain a verified phone number');
        }

        return $claims;
    }

    private static function getCerts()
    {
        return Cache::remember('firebase_auth_certs', 3600, function () {
            $response = CurlRequest::curlContent(self::CERTS_URL);
            $certs = json_decode($response, true);
            if (!is_array($certs) || empty($certs)) {
                throw new \Exception('Could not fetch Firebase public certificates');
            }
            return $certs;
        });
    }
}
