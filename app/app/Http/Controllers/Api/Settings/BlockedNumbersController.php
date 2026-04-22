<?php

namespace App\Http\Controllers\Api\Settings;

use \App\Http\Controllers\Api\ApiAuthController;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use \Illuminate\Http\Request;
use \App\User;
use \App\BlockedNumber;
use \App\Jobs\ImportBlockedNumbers;
use \App\Transformers\VerifiedCallerIdTransformer;
use \App\Helpers\MainHelper;
use \Validator;



class BlockedNumbersController extends ApiAuthController
{
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
        $reason = null;

        if (isset($data['reason'])) {
            $reason = $data['reason'];
        }

        BlockedNumber::create([
            'user_id' => $user->id,
            'workspace_id' => $workspace->id,
            'number' => $data['number'],
            'reason' => $reason
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
    private function parseUploadedFile($user, $file)
    {
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
                $reason = null;

                if (isset($number['reason'])) {
                    $reason = $number['reason'];
                }

                BlockedNumber::create([
                    'user_id' => $user->id,
                    'workspace_id' => $workspace->id,
                    'number' => $number['number'],
                    'reason' => $reason
                ]);
            }
        }

        return $this->response->noContent();
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt|max:10240'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'The uploaded file must be a csv or txt file and may not be greater than 10MB.',
                'errors' => $validator->errors()
            ], 422);
        }

        $file = $request->file('file');
        $extension = strtolower($file->getClientOriginalExtension());

        if ($extension != 'csv' && $extension != 'txt') {
            return response()->json([
                'status' => 'error',
                'message' => 'The uploaded file must be a csv or txt file.'
            ], 422);
        }

        $countryCodeErrors = $this->validateUploadedCsvCountryCodes($file->getRealPath());
        if (count($countryCodeErrors) > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Country code is required for blocked number imports. Use numbers in E.164 format, for example +11012023030.',
                'errors' => [
                    'country_code' => $countryCodeErrors
                ]
            ], 422);
        }

        $user = $this->getUser($request);
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Authentication required.'
            ], 401);
        }

        $workspace = $this->getWorkspace($request);
        $workspaceUser = \App\WorkspaceUser::where('workspace_id', $workspace->id)
            ->where('user_id', $user->id)
            ->first();

        if ($workspace->creator_id != $user->id) {
            if (!$workspaceUser || !$workspaceUser->manage_blocked_numbers) {
                return $this->response->errorForbidden();
            }
        }

        $directory = storage_path('app/imports/blocked_numbers');
        if (!is_dir($directory)) {
            mkdir($directory, 0775, true);
        }

        $fileName = uniqid('blocked_numbers_', true) . '.' . $extension;
        $file->move($directory, $fileName);
        $storedPath = $directory . DIRECTORY_SEPARATOR . $fileName;

        if (!file_exists($storedPath)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Could not store the uploaded file.'
            ], 422);
        }

        $this->dispatch(new ImportBlockedNumbers($storedPath, $user->id, $workspace->id));

        return response()->json([
            'status' => 'queued',
            'message' => 'Import has been queued for processing.'
        ], 202);
    }

    private function validateUploadedCsvCountryCodes($filePath)
    {
        $errors = [];
        $handle = fopen($filePath, 'r');

        if (!$handle) {
            return ['Could not read the uploaded file.'];
        }

        $rowNumber = 0;
        while (($row = fgetcsv($handle)) !== false) {
            $rowNumber++;

            if (!isset($row[0])) {
                continue;
            }

            $number = trim($row[0]);
            if ($number == '' || strtolower($number) == 'number') {
                continue;
            }

            if (substr($number, 0, 1) != '+') {
                $errors[] = 'Row ' . $rowNumber . ' must include country code with a leading +.';
            }

            if (count($errors) >= 10) {
                $errors[] = 'Additional rows were not checked.';
                break;
            }
        }

        fclose($handle);

        return $errors;
    }

    public function importTemplate(Request $request)
    {
        $csv = "number,reason\n";
        $csv .= "+11012023030,spam calls\n";
        $csv .= "+1012024040,\n";

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="blocked_numbers_template.csv"'
        ]);
    }

}
