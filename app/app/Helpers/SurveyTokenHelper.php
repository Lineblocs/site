<?php

namespace App\Helpers;

final class SurveyTokenHelper
{
    public static function createSurveyToken($surveyType, $payload = [], $ttlMinutes = null)
    {
        return TokenHelper::createSurveyToken($surveyType, $payload, $ttlMinutes);
    }

    public static function validateSurveyToken($token, $expectedSurveyType = null, $expectedClaims = [])
    {
        return TokenHelper::validateSurveyToken($token, $expectedSurveyType, $expectedClaims);
    }
}
