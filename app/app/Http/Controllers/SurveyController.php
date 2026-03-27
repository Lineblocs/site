<?php

namespace App\Http\Controllers;

use App\Survey;
use App\Helpers\EmailHelper;
use App\Helpers\MainHelper;
use App\Helpers\RabbitMQHelper;
use App\Helpers\TokenHelper;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function callQuality(Request $request)
    {
        $workspaceId = $request->query('workspaceid');
        $userId = $request->query('userId');
        $email = $request->query('email');
        $token = $request->query('token');

        $isValidToken = TokenHelper::validateSurveyToken($token, 'call_quality', [
            'workspace_id' => $workspaceId,
            'user_id' => $userId,
            'email' => $email
        ]);

        if (!$isValidToken) {
            return response('Invalid or expired survey token.', 403);
        }

        Survey::create([
            'workspace_id' => $workspaceId,
            'user_id' => $userId,
            'type' => 'periodic_call_quality',
            'rating' => $request->query('ratings'),
            'token' => $token,
            'email' => $email
        ]);

        return view('pages.call_quality_thank_you');
    }

    public function queueCallQualitySurveyEmail(Request $request)
    {
        $payload = $request->all();
        if (empty($payload)) {
            $payload = $request->json()->all();
        }

        $data = (isset($payload['data']) && is_array($payload['data'])) ? $payload['data'] : $payload;
        $surveyTypes = (isset($data['survey_type']) && is_array($data['survey_type'])) ? $data['survey_type'] : [];

        if (empty($surveyTypes)) {
            $surveyTypes = [
                'call_quality' => [
                    'workspace_id' => isset($data['workspaceid']) ? (int) $data['workspaceid'] : 1,
                    'user_id' => isset($data['userId']) ? (int) $data['userId'] : 1
                ]
            ];
        }

        RabbitMQHelper::dispatchSurveyEmail(
            isset($data['email']) ? $data['email'] : '',
            $surveyTypes,
            isset($data['name']) ? $data['name'] : ''
        );

        return response()->json([
            'success' => true,
            'queue' => 'periodic_call_quality'
        ]);
    }

    public function sendCallQualityTemplateToTestUser(Request $request)
    {
        $email = 'gaurav.g1807@gmail.com';
        $workspaceId = 1;
        $userId = 1;
        $surveyBaseUrl = MainHelper::createUrl('survey/callquality');

        $surveyLinks = [];
        for ($rating = 1; $rating <= 5; $rating++) {
            $token = TokenHelper::createSurveyToken('call_quality', [
                'workspace_id' => $workspaceId,
                'user_id' => $userId,
                'email' => $email,
                'rating' => $rating
            ]);

            $surveyLinks[$rating] = $surveyBaseUrl . '?' . http_build_query([
                'workspaceid' => $workspaceId,
                'userId' => $userId,
                'ratings' => $rating,
                'token' => $token,
                'email' => $email
            ]);
        }

        $result = EmailHelper::sendEmail(
            'How was your call quality experience?',
            $email,
            'call_quality_survey',
            [
                'recipient_name' => 'Gaurav',
                'workspace_id' => $workspaceId,
                'user_id' => $userId,
                'token' => '',
                'survey_links' => $surveyLinks
            ]
        );

        return response()->json([
            'success' => $result === TRUE,
            'email' => $email,
            'template' => 'call_quality_survey',
            'result' => $result
        ]);
    }
}
