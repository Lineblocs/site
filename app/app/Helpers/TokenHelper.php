<?php

namespace App\Helpers;

use Exception;
use JWTAuth;
use JWTFactory;
use Log;

final class TokenHelper
{
    private static function resolveSigningKey()
    {
        $key = (string) config('app.key', '');
        if (strpos($key, 'base64:') === 0) {
            $decoded = base64_decode(substr($key, 7), true);
            if ($decoded !== false && $decoded !== '') {
                return $decoded;
            }
        }

        if ($key === '') {
            $key = (string) env('APP_KEY', '');
        }

        return $key;
    }

    private static function normalizeLinkParams($params)
    {
        if (!is_array($params)) {
            return [];
        }

        if (array_key_exists('sig', $params)) {
            unset($params['sig']);
        }

        ksort($params);
        return $params;
    }

    public static function signLinkParams($params)
    {
        $normalized = self::normalizeLinkParams($params);
        $data = http_build_query($normalized, '', '&', PHP_QUERY_RFC3986);
        return hash_hmac('sha256', $data, self::resolveSigningKey());
    }

    public static function validateLinkSignature($params, $signature)
    {
        if (empty($signature)) {
            return false;
        }

        $expected = self::signLinkParams($params);
        return hash_equals($expected, (string) $signature);
    }

    public static function createToken($tokenType, $payload = [], $ttlMinutes = null, $typeClaim = 'token_type')
    {
        try {
            if (!is_array($payload)) {
                $payload = [];
            }

            if (is_null($ttlMinutes)) {
                $ttlMinutes = (int) env('TOKEN_TTL', 10080);
            }

            $claims = array_merge($payload, [
                $typeClaim => (string) $tokenType
            ]);

            if (!array_key_exists('sub', $claims)) {
                $claims['sub'] = sprintf('%s:%s:%s', $typeClaim, $tokenType, uniqid('', true));
            }

            $claims['token_iat'] = time();

            $jwtPayload = JWTFactory::setTTL((int) $ttlMinutes)->make($claims);
            return JWTAuth::encode($jwtPayload)->get();
        } catch (Exception $e) {
            Log::error('Could not create token: ' . $e->getMessage());
            return null;
        }
    }

    public static function validateToken($token, $expectedType = null, $expectedClaims = [], $typeClaim = 'token_type')
    {
        try {
            if (empty($token)) {
                return false;
            }

            if (!is_array($expectedClaims)) {
                $expectedClaims = [];
            }

            $payload = JWTAuth::setToken($token)->getPayload()->toArray();

            if (!is_null($expectedType)) {
                if (!array_key_exists($typeClaim, $payload) || (string) $payload[$typeClaim] !== (string) $expectedType) {
                    return false;
                }
            }

            foreach ($expectedClaims as $claim => $expectedValue) {
                if (!array_key_exists($claim, $payload)) {
                    return false;
                }

                if ((string) $payload[$claim] !== (string) $expectedValue) {
                    return false;
                }
            }

            return true;
        } catch (Exception $e) {
            Log::warning('Token validation failed: ' . $e->getMessage());
            return false;
        }
    }

    public static function getPayload($token)
    {
        try {
            if (empty($token)) {
                return null;
            }

            return JWTAuth::setToken($token)->getPayload()->toArray();
        } catch (Exception $e) {
            Log::warning('Could not decode token payload: ' . $e->getMessage());
            return null;
        }
    }

    public static function createSurveyToken($surveyType, $payload = [], $ttlMinutes = null)
    {
        if (is_null($ttlMinutes)) {
            $ttlMinutes = (int) env('SURVEY_TOKEN_TTL', 10080);
        }

        return self::createToken($surveyType, $payload, $ttlMinutes, 'survey_type');
    }

    public static function validateSurveyToken($token, $expectedSurveyType = null, $expectedClaims = [])
    {
        return self::validateToken($token, $expectedSurveyType, $expectedClaims, 'survey_type');
    }
}
