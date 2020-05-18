<?php

namespace App\Http\Controllers\Api;
use \App\Http\Controllers\Controller;
use \JWTAuth;
use \Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Workspace;
use App\WorkspaceUser;
use App\Extension;
use App\DIDNumber;
use App\Flow;
use App\Call;
use App\Recording;
use App\User;
use App\ErrorUserTrace;
use Config;
// function to parse the http auth header
function http_digest_parse($txt)
{
    // protect against missing data
    $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
    $data = array();
    $keys = implode('|', array_keys($needed_parts));

    preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

    foreach ($matches as $m) {
        $data[$m[1]] = $m[3] ? $m[3] : $m[4];
        unset($needed_parts[$m[1]]);
    }

    return $needed_parts ? false : $data;
}
class ApiPublicController extends ApiController {
     use Helpers;
     public function __construct() {
     }

     public function performAuthentication() {
          $realm = 'Restricted area';

          //user => password
          $users = array('admin' => 'mypass', 'guest' => 'guest');


          if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
               header('HTTP/1.1 401 Unauthorized');
               header('WWW-Authenticate: Digest realm="'.$realm.
                         '",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"');

               die('You need to authenticate');
          }


          // analyze the PHP_AUTH_DIGEST variable
          $data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST']);
          if (!$data) {
               die('Wrong Credentials!');
          }
          $workspace = Workspace::where('api_token', $data['username'])->firstOrFail();
          $user = $workspace->api_token;
          $secret =  $workspace->api_secret;
          // generate the valid response
          $A1 = md5($user . ':' . $realm . ':' . $secret);
          $A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);
          $valid_response = md5($A1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2);

          if ($data['response'] != $valid_response) {
               die('Wrong Credentials!');
          }
          $this->workspace = $workspace;

     }
     public function getWorkspace(Request $request) {
          $this->performAuthentication();
          return $this->workspace;
     }
     public function getUser(Request $request) {
          $this->performAuthentication();
          $user = User::findOrFail($this->workspace->creator_id);
          return $user;
     }
}
