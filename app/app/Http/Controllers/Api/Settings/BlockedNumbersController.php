<?php

namespace App\Http\Controllers\Api\Settings;
use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\BlockedNumber;
use \App\Transformers\VerifiedCallerIdTransformer;
use \App\Helpers\MainHelper;



class BlockedNumbersController extends ApiAuthController {
    public function getNumbers(Request $request)
    {
        $user = $this->getUser($request);
        $numbers = BlockedNumber::where('user_id', '=', $user->id)->get()->toArray();
        return $this->response->array($numbers);
    }
    public function postNumber(Request $request)
    {
        $user = $this->getUser($request);
        $workspace = $this->getWorkspace($request);
        $data = $request->all();
        BlockedNumber::create([
            'user_id' => $user->id,
            'workspace_id' => $workspace->id,
            'number' => $data['number']
        ]);
        return $this->response->noContent();
    }
    public function deleteNumber(Request $request, $numberId)
    {
        $data = $request->json()->all();
        $number = BlockedNumber::where('public_id', '=', $numberId)->firstOrFail();
        if (!$this->hasPermissions($request, $number, 'manage_blocked_numbers')) {
            return $this->response->errorForbidden();
        }
        $number->delete();
        return $this->response->noContent();
    }

    // parse CSV file
    // and return a data structure including all the processed
    // numbers
    private function parseUploadedFile($user, $file) {
        return [];
    }

    public function uploadList(Request $request)
    {
        $data = $request->json()->all();
        if (!$this->hasPermissions($request, $number, 'manage_blocked_numbers')) {
            return $this->response->errorForbidden();
        }

        $workspace = $this->getWorkspace($request);
        $files = \Input::file("file");
        $amountFailed = 0;
        $user = $this->getUser($request);

        foreach ($files as $file) {
            $csvData = $this->parseUploadedFile($user, $file);
            foreach ($csvData as $number) {
                BlockedNumber::create([
                    'user_id' => $user->id,
                    'workspace_id' => $workspace->id,
                    'number' => $number['number']
                ]);
            }
        }

        return $this->response->noContent();
    }



}

