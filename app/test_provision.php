<?php
use \App\User;
use \App\Helpers\MainHelper;
use \App\CallSystemTemplate;

$userId = 26;
$user = User::findOrFail($userId);
        $workspace = Workspace::where('creator_id', '=', $userId)->first();
        $template = CallSystemTemplate::findOrFail($data['templateId']);
        MainHelper::provisionCallSystem($user, $workspace, $template);

