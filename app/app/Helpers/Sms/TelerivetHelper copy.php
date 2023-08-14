<?php

namespace App\Helpers\Sms;

use App\ApiCredential;

require_once(__DIR__.'/include/telerivet/telerivet.php');

final class TelerivetHelper extends Base {

    public static function getProviderName() {
        return 'telerivet';
    }
    public function sendSMS($from='', $to='', $body='') {
        $creds = ApiCredential::getRecord();
        $apiKey = $creds->telerivet_api_key;
        $projectId =$creds->telerivet_project_id;
        $tr = new \Telerivet_API($apiKey);
        $project = $tr->initProjectById($projectId);
        
        $sent_msg = $project->sendMessage(array(
            'content' => $body,
            'to_number' => $to
        ));
    }

}