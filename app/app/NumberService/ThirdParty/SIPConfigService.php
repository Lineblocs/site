<?php namespace App\ThirdParty;
use App\Extension;

final class SIPConfigService {
    public static function provision($userId)
    {
        $extensions = Extension::where('user_id',$userId)->get();
        return TRUE;
    }
}
