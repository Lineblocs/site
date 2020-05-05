<<?php
use App\User;
use App\UserDebit;
use App\ThirdParty\VoIPMSNumberService;
use App\PhoneIndividualSetting;
    $settingId = "pis-0e7f70a4-e62b-41d6-914c-c3ffdac2b067";
    $phoneSetting = PhoneIndividualSetting::select(DB::raw("phones_individual_settings.public_id, phones_individual_settings.id, phones_definitions.model, phones_definitions.manufacturer,phones_groups.name AS `group`, phones.phone_type"));
    $phoneSetting->leftJoin('phones', 'phones.id', '=', 'phones_individual_settings.phone_id');
    $phoneSetting->leftJoin('phones_definitions', 'phones_definitions.phone_type', '=', 'phones.phone_type');
    $phoneSetting->leftJoin('phones_groups', 'phones_groups.id', '=', 'phones.group_id');
    $phoneSetting = $phoneSetting->where('phones_individual_settings.public_id', $settingId)->firstOrFail();
echo var_dump($phoneSetting);

