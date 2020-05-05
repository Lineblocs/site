<?php
//require_once('./vendor/autoload.php');
use \App\User;
use \App\Workspace;
use \App\WorkspaceUser;
//use \Config;
use \App\Helpers\PBXServerHelper;
use \App\Helpers\MainHelper;
use \App\Helpers\NamecheapHelper;
       //$user = User::findOrFail(139);
        $username =   'hello2';
        $user = User::where('email', '=', $username . '@infinitet3ch.com')->first();
        $workspace = Workspace::where('creator_id', $user->id)->firstOrFail();
        $attrs = []; 
        foreach (WorkspaceUser::$permissions as $permission) {
          $attrs[$permission] = true;
        }
        $current = WorkspaceUser::where('workspace_id', '=', $workspace->id)->where('user_id', '=', $user->id)->first();
        if (!$current) {
          $attrs['user_id'] = $user->id;
          $attrs['workspace_id'] = $workspace->id;
          WorkspaceUser::create($attrs);
        } else {
          $current->update($attrs);
      }

