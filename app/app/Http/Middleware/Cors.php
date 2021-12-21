<?php
namespace App\Http\Middleware;
use Closure;
class Cors
{
  public function handle($request, Closure $next)
  {
    return $next($request)
      ->header('Access-Control-Allow-Origin', '*')
      ->header('Access-Control-Max-Age', '3600')
      ->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, DELETE, OPTIONS')
      ->header('Access-Control-Allow-Headers', 'X-Requested-With, X-Flow-ID, X-RouterFlow-ID, X-Extension-ID, X-GlobalSetting-ID, X-IndividualSetting-ID, Content-Type, X-Token-Auth, X-Workspace-ID, X-Admin-Token, X-ErrorCode-ID, Authorization, Sec-Fetch-Dest') 

      ->header('Access-Control-Expose-Headers', 'X-Flow-ID, X-RouterFlow-ID, X-Extension-ID, X-WorkspaceUser-ID, X-Number-ID, X-Card-ID, X-GlobalSetting-ID, X-IndividualSetting-ID, X-ErrorCode-ID, X-Goto-URL');
  }
}
