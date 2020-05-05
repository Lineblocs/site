<?php
namespace App\Classes;
class VoIPms{

    /*******************************************\
     *  VoIPms - API Credentials
    \*******************************************/
    var $api_username   = 'john.doe@mydomain.com';
    var $api_password   = 'johnspassword';



    /*******************************************\
     *  VoIPms - SoapClient / SoapCall
    \*******************************************/
    var $soap_client;
    function soapClient(){
        $this->soap_client = new \SoapClient(null, array(
                'location'      => "https://voip.ms/api/v1/server.php",
                'uri'           => "urn://voip.ms",
                'soap_version'  => SOAP_1_2,
                'trace'         => 1
            )
        );
    }

    function soapCall($function, $params){
        if(!$this->soap_client){$this->soapClient();}
        try { return $this->soap_client->__soapCall($function, $params);}
        catch (\SoapFault $e) { trigger_error("SOAP Fault: [{$e->faultcode}] {$e->faultstring}", E_USER_ERROR); }
    }



    /*******************************************\
     *  VoIPms - API Functions
    \*******************************************/

    function addCharge($client, $charge, $description, $test=0){
        $function = "addCharge";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "client"        => $client,
                "charge"        => $charge,
                "description"   => $description,
                "test"          => $test

            )
        );
        return $this->soapCall($function,$params);
    }

    function addPayment($client, $payment, $description, $test=0){
        $function = "addPayment";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "client"        => $client,
                "payment"       => $payment,
                "description"   => $description,
                "test"          => $test

            )
        );
        return $this->soapCall($function,$params);
    }

    function backOrderDIDUSA(
        $quantity, $state, $ratecenter, $routing, $failover_busy, $failover_unreachable, $failover_noanswer,
        $voicemail, $pop, $dialtime, $cnam, $callerid_prefix, $note, $billing_type, $test = 0
    ){
        $function = "backOrderDIDUSA";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "quantity"              => $quantity,
                "state"                 => $state,
                "ratecenter"            => $ratecenter,
                "routing"               => $routing,
                "failover_busy"         => $failover_busy,
                "failover_unreachable"  => $failover_unreachable,
                "failover_noanswer"     => $failover_noanswer,
                "voicemail"             => $voicemail,
                "pop"                   => $pop,
                "dialtime"              => $dialtime,
                "cnam"                  => $cnam,
                "callerid_prefix"       => $callerid_prefix,
                "note"                  => $note,
                "billing_type"          => $billing_type,
                "test"                  => $test
            )
        );
        return $this->soapCall($function,$params);
    }

     function backOrderDIDCAN(
        $quantity, $province, $ratecenter, $routing, $failover_busy, $failover_unreachable, $failover_noanswer,
        $voicemail, $pop, $dialtime, $cnam, $callerid_prefix, $note, $billing_type, $test = 0
    ){
        $function = "backOrderDIDCAN";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "quantity"              => $quantity,
                "province"              => $province,
                "ratecenter"            => $ratecenter,
                "routing"               => $routing,
                "failover_busy"         => $failover_busy,
                "failover_unreachable"  => $failover_unreachable,
                "failover_noanswer"     => $failover_noanswer,
                "voicemail"             => $voicemail,
                "pop"                   => $pop,
                "dialtime"              => $dialtime,
                "cnam"                  => $cnam,
                "callerid_prefix"       => $callerid_prefix,
                "note"                  => $note,
                "billing_type"          => $billing_type,
                "test"                  => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function cancelDID($did, $cancelcomment, $portout, $test = 0){
        $function = "cancelDID";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "did"           => $did,
                "cancelcomment" => $cancelcomment,
                "portout"       => $portout,
                "test"          => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function connectDID($did, $account, $monthly, $setup, $minute, $next_billing = '', $dont_charge_setup = 0, $dont_charge_monthly = 0){
        $function = "connectDID";
        $params = array(
            "params" => array(
                "api_username"        => $this->api_username,
                "api_password"        => $this->api_password,
                "did"                 => $did,
                "account"             => $account,
                "monthly"             => $monthly,
                "setup"               => $setup,
                "minute"              => $minute,
                "next_billing"        => $next_billing,
                "dont_charge_setup"   => $dont_charge_setup,
                "dont_charge_monthly" => $dont_charge_monthly
            )
        );
        return $this->soapCall($function,$params);
    }

    function createSubAccount(
        $username, $protocol, $description, $auth_type, $password, $ip, $device_type, $callerid_number, $canada_routing,
        $lock_international, $international_route, $music_on_hold, $allowed_codecs, $dtmf_mode, $nat,
        $internal_extension, $internal_voicemail, $internal_dialtime,
        $reseller_client, $reseller_package, $reseller_nextbilling, $reseller_chargesetup
    ){
        $function = "createSubAccount";
        $params = array(
            "params" => array(
                "api_username"          => $this->api_username,
                "api_password"          => $this->api_password,
                "username"              => $username,
                "protocol"              => $protocol,
                "description"           => $description,
                "auth_type"             => $auth_type,
                "password"              => $password,
                "ip"                    => $ip,
                "device_type"           => $device_type,
                "callerid_number"       => $callerid_number,
                "canada_routing"        => $canada_routing,
                "lock_international"    => $lock_international,
                "international_route"   => $international_route,
                "music_on_hold"         => $music_on_hold,
                "allowed_codecs"        => $allowed_codecs,
                "dtmf_mode"             => $dtmf_mode,
                "nat"                   => $nat,
                "internal_extension"    => $internal_extension,
                "internal_voicemail"    => $internal_voicemail,
                "internal_dialtime"     => $internal_dialtime,
                "reseller_client"       => $reseller_client,
                "reseller_package"      => $reseller_package,
                "reseller_nextbilling"  => $reseller_nextbilling,
                "reseller_chargesetup"  => $reseller_chargesetup
            )
        );
        return $this->soapCall($function,$params);
    }

    function createVoicemail(
        $digits, $name, $password, $skip_password, $email, $attach_message, $delete_message,
        $say_time, $timezone, $say_callerid, $play_instructions, $language, $email_attachment_format="",$unavailable_message_recording=""
    ){
        $function = "createVoicemail";
        $params = array(
            "params" => array(
                "api_username"      => $this->api_username,
                "api_password"      => $this->api_password,
                "digits"            => $digits,
                "name"              => $name,
                "password"          => $password,
                "skip_password"     => $skip_password,
                "email"             => $email,
                "attach_message"    => $attach_message,
                "delete_message"    => $delete_message,
                "say_time"          => $say_time,
                "timezone"          => $timezone,
                "say_callerid"      => $say_callerid,
                "play_instructions" => $play_instructions,
                "language"          => $language,
                "email_attachment_format" => $email_attachment_format,
                "unavailable_message_recording"=>$unavailable_message_recording
            )
        );
        return $this->soapCall($function,$params);
    }

    function delCallback($callback){
        $function = "delCallback";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "callback"      => $callback
            )
        );
        return $this->soapCall($function,$params);
    }

    function delCallHunting($callhunting){
        $function = "delCallHunting";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "callhunting"   => $callhunting
            )
        );
        return $this->soapCall($function,$params);
    }

    function delCallerIDFiltering($callhunting){
        $function = "delCallerIDFiltering";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "filtering"   => $callhunting
            )
        );
        return $this->soapCall($function,$params);
    }


    function delConference($conference){
        $function = "delConference";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "conference"    => $conference
            )
        );
        return $this->soapCall($function,$params);
    }
    function delConferenceMember($member){
        $function = "delConferenceMember";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "member"        => $member
            )
        );
        return $this->soapCall($function,$params);
    }
    function delMemberFromConference($member,$conference){
        $function = "delMemberFromConference";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "member"        => $member,
                "conference"    => $conference
            )
        );
        return $this->soapCall($function,$params);
    }

    function delClient($client){
        $function = "delClient";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "client"     => $client
            )
        );
        return $this->soapCall($function,$params);
    }

    function delDISA($disa){
        $function = "delDISA";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "disa"          => $disa
            )
        );
        return $this->soapCall($function,$params);
    }

    function delForwarding($forwarding){
        $function = "delForwarding";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "forwarding"    => $forwarding
            )
        );
        return $this->soapCall($function,$params);
    }

    function delIVR($ivr){
        $function = "delIVR";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "ivr"           => $ivr
            )
        );
        return $this->soapCall($function,$params);
    }

    function delMessages($mailbox,$folder,$message_num){
        $function = "delMessages";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "mailbox"       => $mailbox,
                "folder"        => $folder,
                "message_num"   => $message_num
            )
        );
        return $this->soapCall($function,$params);
    }

    function delPhonebook($phonebook){
        $function = "delPhonebook";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "phonebook"     => $phonebook
            )
        );
        return $this->soapCall($function,$params);
    }

    function delQueue($queue){
        $function = "delQueue";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "queue"     => $queue
            )
        );
        return $this->soapCall($function,$params);
    }

    function delRecording($recording){
        $function = "delRecording";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "recording"     => $recording
            )
        );
        return $this->soapCall($function,$params);
    }

    function delRingGroup($ringgroup){
        $function = "delRingGroup";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "ringgroup"     => $ringgroup
            )
        );
        return $this->soapCall($function,$params);
    }

    function delSIPURI($sipuri){
        $function = "delSIPURI";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "sipuri"        => $sipuri
            )
        );
        return $this->soapCall($function,$params);
    }

     function deleteSMS($id){
        $function = "deleteSMS";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "id"            => $id
            )
        );
        return $this->soapCall($function,$params);
    }

    function delStaticMember($member,$queue){
        $function = "delStaticMember";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "member"        => $member,
                "queue"         => $queue
            )
        );
        return $this->soapCall($function,$params);
    }

    function delSubAccount($id){
        $function = "delSubAccount";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "id"            => $id
            )
        );
        return $this->soapCall($function,$params);
    }

    function delTimeCondition($timecondition){
        $function = "delTimeCondition";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "timecondition" => $timecondition

            )
        );
        return $this->soapCall($function,$params);
    }

    function delVoicemail($mailbox){
        $function = "delVoicemail";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "mailbox"       => $mailbox
            )
        );
        return $this->soapCall($function,$params);
    }

    function getAllowedCodecs($codec){
        $function = "getAllowedCodecs";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "codec"         => $codec
            )
        );
        return $this->soapCall($function,$params);
    }

    function getAuthTypes($type){
        $function = "getAuthTypes";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "type"          => $type
            )
        );
        return $this->soapCall($function,$params);
    }

    function getBalance($advanced){
        $function = "getBalance";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "advanced"      => $advanced
            )
        );
        return $this->soapCall($function,$params);
    }

    function getBalanceManagement($balance_management){
        $function = "getBalanceManagement";
        $params = array(
            "params" => array(
                "api_username"          => $this->api_username,
                "api_password"          => $this->api_password,
                "balance_management"    => $balance_management
            )
        );
        return $this->soapCall($function,$params);
    }

    function getCallAccounts($client){
        $function = "getCallAccounts";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "client"        => $client
            )
        );
        return $this->soapCall($function,$params);
    }

    function getCallbacks($callback){
        $function = "getCallbacks";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "callback"      => $callback
            )
        );
        return $this->soapCall($function,$params);
    }

    function getCallBilling(){
        $function = "getCallBilling";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password
            )
        );
        return $this->soapCall($function,$params);
    }

    function getCallerIDFiltering($filtering){
        $function = "getCallerIDFiltering";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "filtering"     => $filtering
            )
        );
        return $this->soapCall($function,$params);
    }

    function getCallHuntings($callhunting=''){
        $function = "getCallHuntings";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "callhunting"     => $callhunting
            )
        );
        return $this->soapCall($function,$params);
    }

    function getCallTypes($client){
        $function = "getCallTypes";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "client"        => $client
            )
        );
        return $this->soapCall($function,$params);
    }

    function getCarriers($carrier){
        $function = "getCarriers";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "carrier"       => $carrier
            )
        );
        return $this->soapCall($function,$params);
    }

    function getCDR(
        $date_from, $date_to, $answered, $noanswer, $busy,
        $failed, $timezone, $calltype, $callbilling, $account
    ){
        $function = "getCDR";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "date_from"     => $date_from,
                "date_to"       => $date_to,
                "answered"      => $answered,
                "noanswer"      => $noanswer,
                "busy"          => $busy,
                "failed"        => $failed,
                "timezone"      => $timezone,
                "calltype"      => $calltype,
                "callbilling"   => $callbilling,
                "account"       => $account
            )
        );
        return $this->soapCall($function,$params);
    }

    function getCharges($client){
        $function = "getCharges";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "client"        => $client
            )
        );
        return $this->soapCall($function,$params);
    }

    function getClientPackages($client){
        $function = "getClientPackages";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "client"        => $client
            )
        );
        return $this->soapCall($function,$params);
    }

    function getClients($client){
        $function = "getClients";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "client"        => $client
            )
        );
        return $this->soapCall($function,$params);
    }

    function getClientThreshold($client=""){
        $function = "getClientThreshold";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "client"        => $client
            )
        );
        return $this->soapCall($function,$params);
    }

    function getCountries($country){
        $function = "getCountries";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "country"       => $country
            )
        );
        return $this->soapCall($function,$params);
    }

    function getConference($conference=''){
        $function = "getConference";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "conference"       => $conference
            )
        );
        return $this->soapCall($function,$params);
    }


    function getConferenceMembers($member){
        $function = "getConferenceMembers";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "member"        => $member
            )
        );
        return $this->soapCall($function,$params);
    }

    function getConferenceRecordings($conference) {
        $function = "getConferenceRecordings";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "conference"    => $conference
            )
        );
        return $this->soapCall($function,$params);
    }

    function getConferenceRecordingFiles($conference, $recording) {
        $function = "getConferenceRecordingFiles";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "conference"    => $conference,
                "recording"    => $recording
            )
        );
        return $this->soapCall($function,$params);
    }

    function getDeposits($client){
        $function = "getDeposits";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "client"        => $client
            )
        );
        return $this->soapCall($function,$params);
    }

    function getDeviceTypes($device_type){
        $function = "getDeviceTypes";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "device_type"   => $device_type
            )
        );
        return $this->soapCall($function,$params);
    }

    function getDIDCountries($country_id,$type){
        $function = "getDIDCountries";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "country_id"    => $country_id,
                "type"          => $type
            )
        );
        return $this->soapCall($function,$params);
    }

    function getDIDsCAN($province, $ratecenter){
        $function = "getDIDsCAN";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "province"      => $province,
                "ratecenter"    => $ratecenter
            )
        );
        return $this->soapCall($function,$params);
    }

    function getDIDsInfo($client, $did){
        $function = "getDIDsInfo";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "client"        => $client,
                "did"           => $did
            )
        );
        return $this->soapCall($function,$params);
    }

    function getPortability($did){
        $function = "getPortability";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "did"           => $did
            )
        );
        return $this->soapCall($function,$params);
    }

    function getDIDsInternationalGeographic($country_id){
        $function = "getDIDsInternationalGeographic";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "country_id"    => $country_id
            )
        );
        return $this->soapCall($function,$params);
    }

    function getDIDsInternationalNational($country_id){
        $function = "getDIDsInternationalNational";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "country_id"       => $country_id
            )
        );
        return $this->soapCall($function,$params);
    }

    function getDIDsInternationalTollFree($country_id){
        $function = "getDIDsInternationalTollFree";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "country_id"    => $country_id
            )
        );
        return $this->soapCall($function,$params);
    }

    function orderDIDVirtual(
        $digits, $routing, $failover_busy, $failover_unreachable, $failover_noanswer,
        $voicemail, $pop, $dialtime, $cnam, $callerid_prefix, $note, $account, $monthly, $setup, $minute, $test
    ){
        $function = "orderDIDVirtual";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "digits"                => $digits,
                "routing"               => $routing,
                "failover_busy"         => $failover_busy,
                "failover_unreachable"  => $failover_unreachable,
                "failover_noanswer"     => $failover_noanswer,
                "voicemail"             => $voicemail,
                "pop"                   => $pop,
                "dialtime"              => $dialtime,
                "cnam"                  => $cnam,
                "callerid_prefix"       => $callerid_prefix,
                "note"                  => $note,
                "account"               => $account,
                "monthly"               => $monthly,
                "setup"                 => $setup,
                "minute"                => $minute,
                "test"                  => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function getDIDsUSA($state, $ratecenter){
        $function = "getDIDsUSA";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "state"         => $state,
                "ratecenter"    => $ratecenter
            )
        );
        return $this->soapCall($function,$params);
    }

    function getDISAs($disa){
        $function = "getDISAs";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "disa"          => $disa
            )
        );
        return $this->soapCall($function,$params);
    }

    function getDTMFModes($dtmf_mode){
        $function = "getDTMFModes";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "dtmf_mode"     => $dtmf_mode
            )
        );
        return $this->soapCall($function,$params);
    }

    function getForwardings($forwarding){
        $function = "getForwardings";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "forwarding"    => $forwarding
            )
        );
        return $this->soapCall($function,$params);
    }

        function getInternationalTypes($type){
        $function = "getInternationalTypes";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "type"          => $type
            )
        );
        return $this->soapCall($function,$params);
    }

    function getIP(){
        $function = "getIP";
        $params = array(
            "params" => array(
                "api_username"      => $this->api_username,
                "api_password"      => $this->api_password
            )
        );
        return $this->soapCall($function,$params);
    }

    function getIVRs($ivr){
        $function = "getIVRs";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "ivr"           => $ivr
            )
        );
        return $this->soapCall($function,$params);
    }

    function getJoinWhenEmptyTypes($type){
        $function = "getJoinWhenEmptyTypes";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "type"          => $type
            )
        );
        return $this->soapCall($function,$params);
    }

    function getLanguages($language=''){
        $function = "getLanguages";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "language"      => $language
            )
        );
        return $this->soapCall($function,$params);
    }

    function getLockInternational($lock_international){
        $function = "getLockInternational";
        $params = array(
            "params" => array(
                "api_username"          => $this->api_username,
                "api_password"          => $this->api_password,
                "lock_international"    => $lock_international
            )
        );
        return $this->soapCall($function,$params);
    }

    function getMusicOnHold($music_on_hold){
        $function = "getMusicOnHold";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "music_on_hold" => $music_on_hold
            )
        );
        return $this->soapCall($function,$params);
    }

    function getNAT($nat){
        $function = "getNAT";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "nat"           => $nat
            )
        );
        return $this->soapCall($function,$params);
    }

    function getPackages($package){
        $function = "getPackages";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "package"       => $package
            )
        );
        return $this->soapCall($function,$params);
    }

    function getPhonebook($phonebook,$name){
        $function = "getPhonebook";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "phonebook"     => $phonebook,
                "name"          => $name
            )
        );
        return $this->soapCall($function,$params);
    }

    function getPlayInstructions($play_instructions){
        $function = "getPlayInstructions";
        $params = array(
            "params" => array(
                "api_username"      => $this->api_username,
                "api_password"      => $this->api_password,
                "play_instructions" => $play_instructions
            )
        );
        return $this->soapCall($function,$params);
    }

    function getProtocols($protocol){
        $function = "getProtocols";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "protocol"      => $protocol
            )
        );
        return $this->soapCall($function,$params);
    }

    function getProvinces(){
        $function = "getProvinces";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password
            )
        );
        return $this->soapCall($function,$params);
    }

    function getQueues($queue){
        $function = "getQueues";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "queue"         => $queue
            )
        );
        return $this->soapCall($function,$params);
    }

    function getRateCentersCAN($province){
        $function = "getRateCentersCAN";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "province"      => $province
            )
        );
        return $this->soapCall($function,$params);
    }

    function getRateCentersUSA($state){
        $function = "getRateCentersUSA";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "state"         => $state
            )
        );
        return $this->soapCall($function,$params);
    }

    function getRates($package, $query){
        $function = "getRates";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "package"       => $package,
                "query"         => $query
            )
        );
        return $this->soapCall($function,$params);
    }

    function getRecordings($recording){
        $function = "getRecordings";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "recording"     => $recording
            )
        );
        return $this->soapCall($function,$params);
    }

    function getRecordingFile($recording){
        $function = "getRecordingFile";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "recording"     => $recording
            )
        );
        return $this->soapCall($function,$params);
    }

    function getRegistrationStatus($account){
        $function = "getRegistrationStatus";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "account"       => $account
            )
        );
        return $this->soapCall($function,$params);
    }

    function getReportEstimatedHoldTime($type){
        $function = "getReportEstimatedHoldTime";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "type"          => $type
            )
        );
        return $this->soapCall($function,$params);
    }

    function getResellerBalance($client){
        $function = "getResellerBalance";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "client"        => $client
            )
        );
        return $this->soapCall($function,$params);
    }

    function getResellerCDR(
        $date_from, $date_to, $client, $answered, $noanswer, $busy,
        $failed, $timezone, $calltype, $callbilling, $account
    ){
        $function = "getResellerCDR";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "date_from"     => $date_from,
                "date_to"       => $date_to,
                "client"        => $client,
                "answered"      => $answered,
                "noanswer"      => $noanswer,
                "busy"          => $busy,
                "failed"        => $failed,
                "timezone"      => $timezone,
                "calltype"      => $calltype,
                "callbilling"   => $callbilling,
                "account"       => $account
            )
        );
        return $this->soapCall($function,$params);
    }

    function getRingGroups($ring_group){
        $function = "getRingGroups";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "ring_group"    => $ring_group
            )
        );
        return $this->soapCall($function,$params);
    }

    function getRingStrategies($strategy){
        $function = "getRingStrategies";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "strategy"      => $strategy
            )
        );
        return $this->soapCall($function,$params);
    }

    function getRoutes($route){
        $function = "getRoutes";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "route"         => $route
            )
        );
        return $this->soapCall($function,$params);
    }

    function getServersInfo($server_pop){
        $function = "getServersInfo";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "server_pop"    => $server_pop
            )
        );
        return $this->soapCall($function,$params);
    }

    function getSIPURIs($sipuri){
        $function = "getSIPURIs";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "sipuri"        => $sipuri
            )
        );
        return $this->soapCall($function,$params);
    }

    function getSMS($from,$to,$type,$did,$contact,$limit,$timezone="",$sms){
        $function = "getSMS";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "sms"           => $sms,
                "from"          => $from,
                "to"            => $to,
                "type"          => $type,
                "did"           => $did,
                "contact"       => $contact,
                "limit"         => $limit,
                "timezone"      => $timezone
            )
        );
        return $this->soapCall($function,$params);
    }

    function getStates(){
        $function = "getStates";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password
            )
        );
        return $this->soapCall($function,$params);
    }

    function getStaticMembers($queue,$member){
        $function = "getStaticMembers";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "queue"         => $queue,
                "member"        => $member
            )
        );
        return $this->soapCall($function,$params);
    }

    function getSubAccounts($account){
        $function = "getSubAccounts";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "account"       => $account
            )
        );
        return $this->soapCall($function,$params);
    }

    function getTerminationRates($route,$query){
        $function = "getTerminationRates";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "route"       => $route,
                "query"       => $query
            )
        );
        return $this->soapCall($function,$params);
    }

    function getTimeConditions($timecondition){
        $function = "getTimeConditions";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "timecondition" => $timecondition

            )
        );
        return $this->soapCall($function,$params);
    }


    function getTimezones($timezone){
        $function = "getTimezones";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "timezone"      => $timezone
            )
        );
        return $this->soapCall($function,$params);
    }

    function getTransactionHistory($date_from, $date_to){
        $function = "getTransactionHistory";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "date_from"     => $date_from,
                "date_to"       => $date_to
            )
        );
        return $this->soapCall($function,$params);
    }

    function getVoicemailAttachmentFormats($email_attachment_format){
        $function = "getVoicemailAttachmentFormats";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "email_attachment_format" => $email_attachment_format
            )
        );
        return $this->soapCall($function,$params);
    }

    function getVoicemails($mailbox=''){
        $function = "getVoicemails";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "mailbox"       => $mailbox
            )
        );
        return $this->soapCall($function,$params);
    }

    function getVoicemailFolders($folder=''){
        $function = "getVoicemailFolders";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "folder"       => $folder
            )
        );
        return $this->soapCall($function,$params);
    }

    function getVoicemailMessages($mailbox,$folder,$date_from="",$date_to=""){
        $function = "getVoicemailMessages";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "mailbox"       => $mailbox,
                "folder"        => $folder,
                "date_from"     => $date_from,
                "date_to"       => $date_to
            )
        );
        return $this->soapCall($function,$params);
    }

    function getVoicemailMessageFile($mailbox,$folder,$message_num){
        $function = "getVoicemailMessageFile";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "mailbox"       => $mailbox,
                "folder"        => $folder,
                "message_num"    => $message_num
            )
        );
        return $this->soapCall($function,$params);
    }


    function getVoicemailSetups($voicemailsetup){
        $function = "getVoicemailSetups";
        $params = array(
            "params" => array(
                "api_username"   => $this->api_username,
                "api_password"   => $this->api_password,
                "voicemailsetup" => $voicemailsetup
            )
        );
        return $this->soapCall($function,$params);
    }

    function orderDID(
        $did, $routing, $failover_busy, $failover_unreachable, $failover_noanswer,
        $voicemail, $pop, $dialtime, $cnam, $callerid_prefix, $note, $billing_type,
        $account, $monthly, $setup, $minute, $test = 0
    ){
        $function = "orderDID";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "did"                   => $did,
                "routing"               => $routing,
                "failover_busy"         => $failover_busy,
                "failover_unreachable"  => $failover_unreachable,
                "failover_noanswer"     => $failover_noanswer,
                "voicemail"             => $voicemail,
                "pop"                   => $pop,
                "dialtime"              => $dialtime,
                "cnam"                  => $cnam,
                "callerid_prefix"       => $callerid_prefix,
                "note"                  => $note,
                "billing_type"          => $billing_type,
                "account"               => $account,
                "monthly"               => $monthly,
                "setup"                 => $setup,
                "minute"                => $minute,
                "test"                  => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function orderDIDInternationalGeographic(
        $location_id, $quantity, $routing, $failover_busy, $failover_unreachable, $failover_noanswer,
        $voicemail, $pop, $dialtime, $cnam, $callerid_prefix, $note, $account, $monthly, $setup, $minute, $test
    ){
        $function = "orderDIDInternationalGeographic";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "location_id"           => $location_id,
                "quantity"              => $quantity,
                "routing"               => $routing,
                "failover_busy"         => $failover_busy,
                "failover_unreachable"  => $failover_unreachable,
                "failover_noanswer"     => $failover_noanswer,
                "voicemail"             => $voicemail,
                "pop"                   => $pop,
                "dialtime"              => $dialtime,
                "cnam"                  => $cnam,
                "callerid_prefix"       => $callerid_prefix,
                "note"                  => $note,
                "account"               => $account,
                "monthly"               => $monthly,
                "setup"                 => $setup,
                "minute"                => $minute,
                "test"                  => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function orderDIDInternationalNational(
        $location_id, $quantity, $routing, $failover_busy, $failover_unreachable, $failover_noanswer,
        $voicemail, $pop, $dialtime, $cnam, $callerid_prefix, $note, $account, $monthly, $setup, $minute, $test
    ){
        $function = "orderDIDInternationalNational";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "location_id"           => $location_id,
                "quantity"              => $quantity,
                "routing"               => $routing,
                "failover_busy"         => $failover_busy,
                "failover_unreachable"  => $failover_unreachable,
                "failover_noanswer"     => $failover_noanswer,
                "voicemail"             => $voicemail,
                "pop"                   => $pop,
                "dialtime"              => $dialtime,
                "cnam"                  => $cnam,
                "callerid_prefix"       => $callerid_prefix,
                "note"                  => $note,
                "account"               => $account,
                "monthly"               => $monthly,
                "setup"                 => $setup,
                "minute"                => $minute,
                "test"                  => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function orderDIDInterntionalTollFree(
        $location_id, $quantity, $routing, $failover_busy, $failover_unreachable, $failover_noanswer,
        $voicemail, $pop, $dialtime, $cnam, $callerid_prefix, $note, $account, $monthly, $setup, $minute, $test
    ){
        $function = "orderDIDInterntionalTollFree";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "location_id"           => $location_id,
                "quantity"              => $quantity,
                "routing"               => $routing,
                "failover_busy"         => $failover_busy,
                "failover_unreachable"  => $failover_unreachable,
                "failover_noanswer"     => $failover_noanswer,
                "voicemail"             => $voicemail,
                "pop"                   => $pop,
                "dialtime"              => $dialtime,
                "cnam"                  => $cnam,
                "callerid_prefix"       => $callerid_prefix,
                "note"                  => $note,
                "account"               => $account,
                "monthly"               => $monthly,
                "setup"                 => $setup,
                "minute"                => $minute,
                "test"                  => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function orderTollFree(
        $did, $routing, $failover_busy, $failover_unreachable, $failover_noanswer,
        $voicemail, $pop, $dialtime, $cnam, $callerid_prefix, $note,
        $account, $monthly, $setup, $minute, $test = 0
    ){
        $function = "orderTollFree";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "did"                   => $did,
                "routing"               => $routing,
                "failover_busy"         => $failover_busy,
                "failover_unreachable"  => $failover_unreachable,
                "failover_noanswer"     => $failover_noanswer,
                "voicemail"             => $voicemail,
                "pop"                   => $pop,
                "dialtime"              => $dialtime,
                "cnam"                  => $cnam,
                "callerid_prefix"       => $callerid_prefix,
                "note"                  => $note,
                "account"               => $account,
                "monthly"               => $monthly,
                "setup"                 => $setup,
                "minute"                => $minute,
                "test"                  => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function orderVanity(
        $did, $routing, $failover_busy, $failover_unreachable, $failover_noanswer,
        $voicemail, $pop, $dialtime, $cnam, $callerid_prefix, $note, $carrier,
        $account, $monthly, $setup, $minute, $test = 0
    ){
        $function = "orderVanity";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "did"                   => $did,
                "routing"               => $routing,
                "failover_busy"         => $failover_busy,
                "failover_unreachable"  => $failover_unreachable,
                "failover_noanswer"     => $failover_noanswer,
                "voicemail"             => $voicemail,
                "pop"                   => $pop,
                "dialtime"              => $dialtime,
                "cnam"                  => $cnam,
                "callerid_prefix"       => $callerid_prefix,
                "note"                  => $note,
                "carrier"               => $carrier,
                "account"               => $account,
                "monthly"               => $monthly,
                "setup"                 => $setup,
                "minute"                => $minute,
                "test"                  => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function searchDIDsCAN($type, $query, $province){
        $function = "searchDIDsCAN";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "province"      => $province,
                "type"          => $type,
                "query"         => $query
            )
        );
        return $this->soapCall($function,$params);
    }

    function searchDIDsUSA($type, $query, $state){
        $function = "searchDIDsUSA";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "state"         => $state,
                "type"          => $type,
                "query"         => $query
            )
        );
        return $this->soapCall($function,$params);
    }

    function searchTollFreeCanUS($type,$query){
        $function = "searchTollFreeCanUS";
        $params = array(
            "params" => array(
                "api_username"      => $this->api_username,
                "api_password"      => $this->api_password,
                "type"              => $type,
                "query"             => $query
            )
        );
        return $this->soapCall($function,$params);
    }

    function searchTollFreeUSA($type,$query){
        $function = "searchTollFreeUSA";
        $params = array(
            "params" => array(
                "api_username"      => $this->api_username,
                "api_password"      => $this->api_password,
                "type"              => $type,
                "query"             => $query
            )
        );
        return $this->soapCall($function,$params);
    }

    function searchVanity($type,$query){
        $function = "searchVanity";
        $params = array(
            "params" => array(
                "api_username"      => $this->api_username,
                "api_password"      => $this->api_password,
                "type"              => $type,
                "query"             => $query
            )
        );
        return $this->soapCall($function,$params);
    }

    function sendSMS($did,$dst,$message) {
        $function = "sendSMS";
        $params = array(
            "params" => array(
                "api_username"      => $this->api_username,
                "api_password"      => $this->api_password,
                "did"               => $did,
                "dst"               => $dst,
                "message"           => $message
            )
        );
        return $this->soapCall($function,$params);
    }

     function sendVoicemailEmail($mailbox,$folder,$message_num,$email_address){
        $function = "sendVoicemailEmail";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "mailbox"       => $mailbox,
                "folder"        => $folder,
                "message_num"   => $message_num,
                "email_address" => $email_address
            )
        );
        return $this->soapCall($function,$params);
    }

    function setCallback($callback,$description,$number,$delay_before,$response_timeout,$digit_timeout,$callerid_number){
        $function = "setCallback";
        $params = array(
            "params" => array(
                "api_username"    => $this->api_username,
                "api_password"    => $this->api_password,
                "callback"        => $callback,
                "description"     => $description,
                "number"          => $number,
                "delay_before"    => $delay_before,
                "response_timeout"=> $response_timeout,
                "digit_timeout"   => $digit_timeout,
                "callerid_number" => $callerid_number
            )
        );
        return $this->soapCall($function,$params);
    }

    function setCallerIDFiltering($filter,$callerid,$did,$routing,$failover_unreachable,$failover_busy,$failover_noanswer,$note){
        $function = "setCallerIDFiltering";
        $params = array(
            "params" => array(
                "api_username"        => $this->api_username,
                "api_password"        => $this->api_password,
                "filter"              => $filter,
                "callerid"            => $callerid,
                "did"                 => $did,
                "routing"             => $routing,
                "failover_unreachable"=> $failover_unreachable,
                "failover_busy"       => $failover_busy,
                "failover_noanswer"   => $failover_noanswer,
                "note"                => $note

            )
        );
        return $this->soapCall($function,$params);
    }

    function setCallhunting($callhunting,$description,$music,$recording,$language,$col_order,$members,$ring_time,$col_press){
        $function = "setCallhunting";
        $params = array(
            "params" => array(
                "api_username"    => $this->api_username,
                "api_password"    => $this->api_password,
                "callhunting"     => $callhunting,
                "description"     => $description,
                "music"           => $music,
                "recording"       => $recording,
                "language"        => $language,
                "col_order"       => $col_order,
                "members"         => $members,
                "ring_time"       => $ring_time,
                "col_press"       => $col_press,
            )
        );
        return $this->soapCall($function,$params);
    }

    function setClient(
        $client, $email, $password, $company, $firstname, $lastname, $address,
        $city, $state, $country, $zip, $phone_number, $balance_management
    ){
        $function = "setClient";
        $params = array(
            "params" => array(
                "api_username"          => $this->api_username,
                "api_password"          => $this->api_password,
                "client"                => $client,
                "email"                 => $email,
                "password"              => $password,
                "company"               => $company,
                "firstname"             => $firstname,
                "lastname"              => $lastname,
                "address"               => $address,
                "city"                  => $city,
                "state"                 => $state,
                "country"               => $country,
                "zip"                   => $zip,
                "phone_number"          => $phone_number,
                "balance_management"    => $balance_management
            )
        );
        return $this->soapCall($function,$params);
    }

    function setClientThreshold($client='', $email='', $threshold='1')
    {
        $function = "setClientThreshold";
        $params = array(
            "params" => array(
                "api_username"          => $this->api_username,
                "api_password"          => $this->api_password,
                "client"                => $client,
                "email"                 => $email,
                "threshold"             => $threshold
            )
        );
        return $this->soapCall($function,$params);
    }

    function setConference(


        $conference='',
        $name='',
        $description='',
        $members='',
        $max_members='',
        $sound_join='',
        $sound_leave='',
        $sound_has_joined='',
        $sound_has_left='',
        $sound_kicked='',
        $sound_muted='',
        $sound_unmuted='',
        $sound_only_person='',
        $sound_only_one='',
        $sound_there_are='',
        $sound_other_in_party='',
        $sound_place_into_conference='',
        $sound_get_pin='',
        $sound_invalid_pin='',
        $sound_locked='',
        $sound_locked_now='',
        $sound_unlocked_now='',
        $sound_error_menu='',
        $sound_participants_muted='',
        $sound_participants_unmuted='',
        $language='en'


    )
    {
        $function = "setConference";
        $params = array(
            "params" => array(
                "api_username"          => $this->api_username,
                "api_password"          => $this->api_password,
                "conference"            => $conference,
                "name"                  => $name,
                "description"           => $description,
                "members"               => $members,
                "max_members"           => $max_members,
                "sound_join"            => $sound_join,
                "sound_leave"           => $sound_leave,
                "sound_has_joined"      => $sound_has_joined,
                "sound_has_left"        => $sound_has_left,
                "sound_kicked"          => $sound_kicked,
                "sound_muted"           => $sound_muted,
                "sound_unmuted"         => $sound_unmuted,
                "sound_only_person"     => $sound_only_person,
                "sound_only_one"        => $sound_only_one,
                "sound_there_are"       => $sound_there_are,
                "sound_other_in_party"         => $sound_other_in_party,
                "sound_place_into_conference"  => $sound_place_into_conference,
                "sound_get_pin"         => $sound_get_pin,
                "sound_invalid_pin"     => $sound_invalid_pin,
                "sound_locked"          => $sound_locked,
                "sound_locked_now"      => $sound_locked_now,
                "sound_unlocked_now"    => $sound_unlocked_now,
                "sound_error_menu"      => $sound_error_menu,
                "sound_participants_muted"     => $sound_participants_muted,
                "sound_participants_unmuted"   => $sound_participants_unmuted,
                "language"          => $language

            )
        );
        return $this->soapCall($function,$params);
    }

    function setConferenceMember(

        $member='',
        $conference='',
        $name='',
        $description='',
        $pin='',
        $announce_join_leave='',
        $admin='',
        $start_muted='',
        $announce_user_count='',
        $announce_only_user='',
        $moh_when_empty='',
        $quiet='',
        $announcement='',
        $drop_silence='',
        $talking_threshold='',
        $silence_threshold='',
        $talk_detection='',
        $jitter_buffer=''

    )
    {
        $function = "setConferenceMember";
        $params = array(
            "params" => array(
                "api_username"          => $this->api_username,
                "api_password"          => $this->api_password,
                "member"                => $member,
                "conference"            => $conference,
                "name"                  => $name,
                "description"           => $description,
                "pin"                   => $pin,
                "announce_join_leave"   => $announce_join_leave,
                "admin"                 => $admin,
                "start_muted"           => $start_muted,
                "announce_user_count"   => $announce_user_count,
                "announce_only_user"    => $announce_only_user,
                "moh_when_empty"        => $moh_when_empty,
                "quiet"                 => $quiet,
                "announcement"          => $announcement,
                "drop_silence"          => $drop_silence,
                "talking_threshold"     => $talking_threshold,
                "silence_threshold"     => $silence_threshold,
                "talk_detection"        => $talk_detection,
                "jitter_buffer"         => $jitter_buffer


            )
        );
        return $this->soapCall($function,$params);
    }

    function setDIDBillingType(
        $did, $billing_type
    ){
        $function = "setDIDBillingType";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "did"                   => $did,
                "billing_type"          => $billing_type
            )
        );
        return $this->soapCall($function,$params);
    }

    function setDIDInfo(
        $did, $routing, $failover_busy, $failover_unreachable, $failover_noanswer,
        $voicemail, $pop, $dialtime, $cnam, $callerid_prefix, $note, $billing_type
    ){
        $function = "setDIDInfo";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "did"                   => $did,
                "routing"               => $routing,
                "failover_busy"         => $failover_busy,
                "failover_unreachable"  => $failover_unreachable,
                "failover_noanswer"     => $failover_noanswer,
                "voicemail"             => $voicemail,
                "pop"                   => $pop,
                "dialtime"              => $dialtime,
                "cnam"                  => $cnam,
                "callerid_prefix"       => $callerid_prefix,
                "note"                  => $note,
                "billing_type"          => $billing_type
            )
        );
        return $this->soapCall($function,$params);
    }

    function setDIDPOP($did, $pop){
        $function = "setDIDPOP";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "did"           => $did,
                "pop"    => $pop
            )
        );
        return $this->soapCall($function,$params);
    }

    function setDIDRouting($did, $routing){
        $function = "setDIDRouting";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "did"           => $did,
                "routing"       => $routing
            )
        );
        return $this->soapCall($function,$params);
    }

    function setDIDVoicemail($did, $voicemail){
        $function = "setDIDVoicemail";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "did"           => $did,
                "voicemail"     => $voicemail
            )
        );
        return $this->soapCall($function,$params);
    }

    function setDISA($disa,$name,$pin,$digit_timeout,$callerid_override){
        $function = "setDISA";
        $params = array(
            "params" => array(
                "api_username"     => $this->api_username,
                "api_password"     => $this->api_password,
                "disa"             => $disa,
                "name"             => $name,
                "pin"              => $pin,
                "digit_timeout"    => $digit_timeout,
                "callerid_override"=> $callerid_override,
            )
        );
        return $this->soapCall($function,$params);
    }

    function setForwarding($forwarding, $phone_number, $callerid_override, $description,$dtmf_digits,$pause){
        $function = "setForwarding";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "forwarding"        => $forwarding,
                "phone_number"      => $phone_number,
                "callerid_override" => $callerid_override,
                "description"       => $description,
                "dtmf_digits"       => $dtmf_digits,
                "pause"             => $pause
            )
        );
        return $this->soapCall($function,$params);
    }

    function setIVR($ivr,$name,$recording,$timeout,$language,$voicemailsetup,$choices){
        $function = "setIVR";
        $params = array(
            "params" => array(
                "api_username"   => $this->api_username,
                "api_password"   => $this->api_password,
                "ivr"            => $ivr,
                "name"           => $name,
                "recording"      => $recording,
                "timeout"        => $timeout,
                "language"       => $language,
                "voicemailsetup" => $voicemailsetup,
                "choices"        => $choices
            )
        );
        return $this->soapCall($function,$params);
    }

    function setPhonebook($phonebook, $speed_dial, $name, $number, $callerid, $note){
        $function = "setPhonebook";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "phonebook"     => $phonebook,
                "speed_dial"    => $speed_dial,
                "name"          => $name,
                "number"        => $number,
                "callerid"      => $callerid,
                "note"          => $note

            )
        );
        return $this->soapCall($function,$params);
    }

    function setQueue($queue,$queue_name,$queue_number,$queue_language,$queue_password,$callerid_prefix,$join_announcement,$priority_weight,$agent_announcement,$report_hold_time_agent,$member_delay,$maximum_wait_time,$maximum_callers,$join_when_empty,$leave_when_empty,$ring_strategy,$ring_inuse,$agent_ring_timeout,$retry_timer,$wrapup_time,$voice_announcement,$frequency_announcement,$announce_position_frecuency,$announce_round_seconds,$if_announce_position_enabled_report_estimated_hold_time,$thankyou_for_your_patience,$fail_over_routing_timeout,$fail_over_routing_full,$fail_over_routing_join_empty,$fail_over_routing_leave_empty,$fail_over_routing_join_unavail,$fail_over_routing_leave_unavail,$music_on_hold){
        $function = "setQueue";
        $params = array(
            "params" => array(
                "api_username"                      => $this->api_username,
                "api_password"                      => $this->api_password,
                "queue"                             => $queue,
                "queue_name"                        => $queue_name,
                "queue_number"                      => $queue_number,
                "queue_language"                    => $queue_language,
                "queue_password"                    => $queue_password,
                "callerid_prefix"                   => $callerid_prefix,
                "join_announcement"                 => $join_announcement,
                "priority_weight"                   => $priority_weight,
                "agent_announcement"                => $agent_announcement,
                "report_hold_time_agent"            => $report_hold_time_agent,
                "member_delay"                      => $member_delay,
                "maximum_wait_time"                 => $maximum_wait_time,
                "maximum_callers"                   => $maximum_callers,
                "join_when_empty"                   => $join_when_empty,
                "leave_when_empty"                  => $leave_when_empty,
                "ring_strategy"                     => $ring_strategy,
                "ring_inuse"                        => $ring_inuse,
                "agent_ring_timeout"                =>$agent_ring_timeout,
                "retry_timer"                       => $retry_timer,
                "wrapup_time"                       => $wrapup_time,
                "voice_announcement"                => $voice_announcement,
                "frequency_announcement"            =>$frequency_announcement,
                "announce_position_frecuency"       =>$announce_position_frecuency,
                "announce_round_seconds"            =>$announce_round_seconds,
                "if_announce_position_enabled_report_estimated_hold_time"=> $if_announce_position_enabled_report_estimated_hold_time,
                "thankyou_for_your_patience"        => $thankyou_for_your_patience,
                "music_on_hold"                     => $music_on_hold,
                "fail_over_routing_timeout"         => $fail_over_routing_timeout,
                "fail_over_routing_full"            => $fail_over_routing_full,
                "fail_over_routing_join_empty"      => $fail_over_routing_join_empty,
                "fail_over_routing_leave_empty"     => $fail_over_routing_leave_empty,
                "fail_over_routing_join_unavail"    =>$fail_over_routing_join_unavail,
                "fail_over_routing_leave_unavail"   =>$fail_over_routing_leave_unavail
            )
        );
        return $this->soapCall($function,$params);
    }

    function setRecording($recording,$file,$name){
        $function = "setRecording";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "recording"     => $recording,
                "file"          => $file,
                "name"          => $name
            )
        );
        return $this->soapCall($function,$params);
    }

     function setRingGroup($ring_group,$name,$members,$voicemail,$caller_announcement,$music_on_hold,$language){
        $function = "setRingGroup";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "ring_group"    => $ring_group,
                "name"          => $name,
                "members"       => $members,
                "voicemail"     => $voicemail,
                "caller_announcement" => $caller_announcement,
                "music_on_hold" => $music_on_hold,
                "language"      => $language
            )
        );
        return $this->soapCall($function,$params);
    }

    function setSIPURI($sipuri,$uri,$description){
        $function = "setSIPURI";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "sipuri"        => $sipuri,
                "uri"           => $uri,
                "description"   => $description

            )
        );
        return $this->soapCall($function,$params);
    }

    function setSMS($did,$enable,$email_enabled,$email_address,$sms_forward_enable,$sms_forward,$url_callback_enable,$url_callback,$url_callback_retry,$sms_sipaccount,$sms_sipaccount_enabled){
        $function = "setSMS";
        $params = array(
            "params" => array(
                "api_username"          => $this->api_username,
                "api_password"          => $this->api_password,
                "did"                   => $did,
                "enable"                => $enable,
                "email_enabled"         => $email_enabled,
                "email_address"         => $email_address,
                "sms_forward_enable"    => $sms_forward_enable,
                "sms_forward"           => $sms_forward,
                "url_callback_enable"   => $url_callback_enable,
                "url_callback"          => $url_callback,
                "url_callback_retry"    => $url_callback_retry,
                "sms_sipaccount"        => $sms_sipaccount,
                "sms_sipaccount_enabled"=> $sms_sipaccount_enabled


            )
        );
        return $this->soapCall($function,$params);
    }

    function setStaticMember($member,$queue,$member_name,$account,$priority){
        $function = "setStaticMember";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "member"        => $member,
                "queue"         => $queue,
                "member_name"   => $member_name,
                "account"       => $account,
                "priority"      => $priority
            )
        );
        return $this->soapCall($function,$params);
    }

    function setSubAccount(
        $id, $description, $auth_type, $password, $ip, $device_type, $callerid_number, $canada_routing, $lock_international,
        $international_route, $music_on_hold, $allowed_codecs, $dtmf_mode, $nat, $internal_extension, $internal_voicemail,
        $internal_dialtime, $reseller_client, $reseller_package, $reseller_nextbilling, $reseller_chargesetup
    ){
        $function = "setSubAccount";
        $params = array(
            "params" => array(
                "api_username"          => $this->api_username,
                "api_password"          => $this->api_password,
                "id"                    => $id,
                "description"           => $description,
                "auth_type"             => $auth_type,
                "password"              => $password,
                "ip"                    => $ip,
                "device_type"           => $device_type,
                "callerid_number"       => $callerid_number,
                "canada_routing"        => $canada_routing,
                "lock_international"    => $lock_international,
                "international_route"   => $international_route,
                "music_on_hold"         => $music_on_hold,
                "allowed_codecs"        => $allowed_codecs,
                "dtmf_mode"             => $dtmf_mode,
                "nat"                   => $nat,
                "internal_extension"    => $internal_extension,
                "internal_voicemail"    => $internal_voicemail,
                "internal_dialtime"     => $internal_dialtime,
                "reseller_client"       => $reseller_client,
                "reseller_package"      => $reseller_package,
                "reseller_nextbilling"  => $reseller_nextbilling,
                "reseller_chargesetup"  => $reseller_chargesetup
            )
        );
        return $this->soapCall($function,$params);
    }

    function setTimeCondition(
        $timecondition, $name, $routing_match, $routing_nomatch,
        $starthour, $startminute, $endhour, $endminute, $weekdaystart, $weekdayend
    ){
        $function = "setTimeCondition";
        $params = array(
            "params" => array(
                "api_username"      => $this->api_username,
                "api_password"      => $this->api_password,
                "timecondition"     => $timecondition,
                "name"              => $name,
                "routing_match"     => $routing_match,
                "routing_nomatch"   => $routing_nomatch,
                "starthour"         => $starthour,
                "startminute"       => $startminute,
                "endhour"           => $endhour,
                "endminute"         => $endminute,
                "weekdaystart"      => $weekdaystart,
                "weekdayend"        => $weekdayend
            )
        );
        return $this->soapCall($function,$params);
    }

    function setVoicemail(
        $mailbox, $name, $password, $skip_password, $email, $attach_message, $delete_message,
        $say_time, $timezone, $say_callerid, $play_instructions, $language, $email_attachment_format="", $unavailable_message_recording=""
    ){
        $function = "setVoicemail";
        $params = array(
            "params" => array(
                "api_username"      => $this->api_username,
                "api_password"      => $this->api_password,
                "mailbox"           => $mailbox,
                "name"              => $name,
                "password"          => $password,
                "skip_password"     => $skip_password,
                "email"             => $email,
                "attach_message"    => $attach_message,
                "delete_message"    => $delete_message,
                "say_time"          => $say_time,
                "timezone"          => $timezone,
                "say_callerid"      => $say_callerid,
                "play_instructions" => $play_instructions,
                "language"          => $language,
                "email_attachment_format" =>$email_attachment_format,
                "unavailable_message_recording"=>$unavailable_message_recording
            )
        );
        return $this->soapCall($function,$params);
    }

    function signupClient(
        $firstname, $lastname, $company, $address, $city, $state, $country, $zip, $phone_number,
        $email, $confirm_email, $password, $confirm_password, $activate, $balance_management
    ){
        $function = "signupClient";
        $params = array(
            "params" => array(
                "api_username"      => $this->api_username,
                "api_password"      => $this->api_password,
                "firstname"         => $firstname,
                "lastname"          => $lastname,
                "company"           => $company,
                "address"           => $address,
                "city"              => $city,
                "state"             => $state,
                "country"           => $country,
                "zip"               => $zip,
                "phone_number"      => $phone_number,
                "email"             => $email,
                "confirm_email"     => $confirm_email,
                "password"          => $password,
                "confirm_password"  => $confirm_password,
                "activate"          => $activate,
                "balance_management"=> $balance_management
            )
        );
        return $this->soapCall($function,$params);
    }

    function unconnectDID($did, $routing){
        $function = "unconnectDID";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "did"           => $did
            )
        );
        return $this->soapCall($function,$params);
    }

    function getFaxProvinces($province){
        $function = "getFaxProvinces";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "province"      => $province
            )
        );
        return $this->soapCall($function,$params);
    }

    function getFaxStates($state){
        $function = "getFaxStates";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "state"         => $state
            )
        );
        return $this->soapCall($function,$params);
    }

    function getFaxRateCentersCAN($province){
        $function = "getFaxRateCentersCAN";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "province"      => $province
            )
        );
        return $this->soapCall($function,$params);
    }

    function getFaxRateCentersUSA($state){
        $function = "getFaxRateCentersUSA";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "xRateCentersCAN(state"         => $state
            )
        );
        return $this->soapCall($function,$params);
    }

    function getFaxNumbersInfo($did){
        $function = "getFaxNumbersInfo";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "did"           => $did
            )
        );
        return $this->soapCall($function,$params);
    }

    function setFaxNumberInfo($did, $email, $email_enable, $email_attach_file, $url_callback, $url_callback_enable, $url_callback_retry, $test){
        $function = "setFaxNumberInfo";
        $params = array(
            "params" => array(
                "api_username"          => $this->api_username,
                "api_password"          => $this->api_password,
                "did"                   => $did,
                "email"                 => $email,
                "email_enable"          => $email_enable,
                "email_attach_file"     => $email_attach_file,
                "url_callback"          => $url_callback,
                "url_callback_enable"   => $url_callback_enable,
                "url_callback_retry"    => $url_callback_retry,
                "test"                  => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function setFaxNumberEmail($did, $email, $email_enable, $email_attach_file, $test){
        $function = "setFaxNumberEmail";
        $params = array(
            "params" => array(
                "api_username"      => $this->api_username,
                "api_password"      => $this->api_password,
                "did"               => $did,
                "email"             => $email,
                "email_enable"      => $email_enable,
                "email_attach_file" => $email_attach_file,
                "test"              => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function setFaxNumberURLCallback($did, $url_callback, $url_callback_enable, $url_callback_retry, $test){
        $function = "setFaxNumberURLCallback";
        $params = array(
            "params" => array(
                "api_username"          => $this->api_username,
                "api_password"          => $this->api_password,
                "did"                   => $did,
                "url_callback"          => $url_callback,
                "url_callback_enable"   => $url_callback_enable,
                "url_callback_retry"    => $url_callback_retry,
                "test"                  => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function searchFaxAreaCodeCAN($area_code){
        $function = "searchFaxAreaCodeCAN";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "area_code"     => $area_code
            )
        );
        return $this->soapCall($function,$params);
    }

    function searchFaxAreaCodeUSA($area_code){
        $function = "searchFaxAreaCodeUSA";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "area_code"     => $area_code
            )
        );
        return $this->soapCall($function,$params);
    }

    function getFaxNumbersPortability($did){
        $function = "getFaxNumbersPortability";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "did"           => $did
            )
        );
        return $this->soapCall($function,$params);
    }

    function orderFaxNumber($location, $quantity, $email, $email_enable, $email_attach_file, $url_callback, $url_callback_enable, $url_callback_retry, $test){
        $function = "orderFaxNumber";
        $params = array(
            "params" => array(
                "api_username"          => $this->api_username,
                "api_password"          => $this->api_password,
                "location"              => $location,
                "quantity"              => $quantity,
                "email"                 => $email,
                "email_enable"          => $email_enable,
                "email_attach_file"     => $email_attach_file,
                "url_callback"          => $url_callback,
                "url_callback_enable"   => $url_callback_enable,
                "url_callback_retry"    => $url_callback_retry,
                "test"                  => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function cancelFaxNumber($id, $test){
        $function = "cancelFaxNumber";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "id"            => $id,
                "test"          => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function sendFaxMessage($to_number, $from_name, $from_number, $send_email_enabled, $send_email, $station_id, $file, $test){
        $function = "sendFaxMessage";
        $params = array(
            "params" => array(
                "api_username"      => $this->api_username,
                "api_password"      => $this->api_password,
                "to_number"         => $to_number,
                "from_name"         => $from_name,
                "from_number"       => $from_number,
                "send_email_enabled"=> $send_email_enabled,
                "send_email"        => $send_email,
                "station_id"        => $station_id,
                "file"              => $file,
                "test"              => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function getFaxMessages($from, $to, $folder){
        $function = "getFaxMessages";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "from"          => $from,
                "to"            => $to,
                "folder"        => $folder,
                "id"            => $id
            )
        );
        return $this->soapCall($function,$params);
    }

    function getFaxMessagePDF($id){
        $function = "getFaxMessagePDF";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "id"            => $id
            )
        );
        return $this->soapCall($function,$params);
    }

    function mailFaxMessagePDF($id, $email){
        $function = "mailFaxMessagePDF";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "id"            => $id,
                "email"         => $email
            )
        );
        return $this->soapCall($function,$params);
    }

    function markListenedVoicemailMessage($mailbox,$folder,$message_num,$listened){
        $function = "markListenedVoicemailMessage";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "mailbox"       => $mailbox,
                "folder"        => $folder,
                "message_num"   => $message_num,
                "listened"      => $listened
            )
        );
        return $this->soapCall($function,$params);
    }

    function markUrgentVoicemailMessage($mailbox,$folder,$message_num,$urgent){
        $function = "markUrgentVoicemailMessage";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "mailbox"       => $mailbox,
                "folder"        => $folder,
                "message_num"   => $message_num,
                "urgent"        => $urgent
            )
        );
        return $this->soapCall($function,$params);
    }

    function moveFaxMessage($fax_id, $folder_id, $test){
        $function = "moveFaxMessage";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "fax_id"        => $fax_id,
                "folder_id"     => $folder_id,
                "test"          => $test
            )
        );
        return $this->soapCall($function,$params);
    }

     function moveFolderVoicemailMessage($mailbox,$folder,$message_num,$new_folder){
        $function = "moveFolderVoicemailMessage";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "mailbox"       => $mailbox,
                "folder"        => $folder,
                "message_num"   => $message_num,
                "new_folder"    => $new_folder
            )
        );
        return $this->soapCall($function,$params);
    }

    function deleteFaxMessage($id, $test){
        $function = "deleteFaxMessage";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "id"            => $id,
                "test"          => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function setFaxFolder($id, $name, $test){
        $function = "setFaxFolder";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "id"            => $id,
                "name"          => $name,
                "test"          => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function getFaxFolders($id){
        $function = "getFaxFolders";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "id"            => $id
            )
        );
        return $this->soapCall($function,$params);
    }

    function delFaxFolder($id, $test){
        $function = "delFaxFolder";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "id"            => $id,
                "test"          => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function setEmailToFax($id, $enabled, $auth_email, $from_number_id, $security_code_enabled, $security_code, $test){
        $function = "setEmailToFax";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "id"            => $id,
                "enabled"       => $enabled,
                "auth_email"    => $auth_email,
                "from_number_id"   => $from_number_id,
                "security_code_enabled" => $security_code_enabled,
                "security_code" => $security_code,
                "test"          => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function getEmailToFax($id){
        $function = "getEmailToFax";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "id"            => $id
            )
        );
        return $this->soapCall($function,$params);
    }

    function delEmailToFax($id, $test){
        $function = "delEmailToFax";
        $params = array(
            "params" => array(
                "api_username"  => $this->api_username,
                "api_password"  => $this->api_password,
                "id"            => $id,
                "test"          => $test
            )
        );
        return $this->soapCall($function,$params);
    }

    function addLNPPort($portType, $numbers, $isPartial, $locationType, $isMobile, $snn, $pin, $btn, $services, $tfType, $statementName, $firstName, $lastName, $address1, $address2, $city, $zip, $state, $country, $providerName, $providerAccount, $notes){
        $function = "addLNPPort";
        $params = array(
            "params" => array(
                "api_username"    => $this->api_username,
                "api_password"    => $this->api_password,
                "portType"        => $portType,
                "numbers"         => $numbers,
                "isPartial"       => $isPartial,
                "locationType"    => $locationType,
                "isMobile"        => $isMobile,
                "snn"             => $snn,
                "pin"             => $pin,
                "btn"             => $btn,
                "services"        => $services,
                "tfType"          => $tfType,
                "statementName"   => $statementName,
                "firstName"       => $firstName,
                "lastName"        => $lastName,
                "address1"        => $address1,
                "address2"        => $address2,
                "city"            => $city,
                "zip"             => $zip,
                "state"           => $state,
                "country"         => $country,
                "providerName"    => $providerName,
                "providerAccount" => $providerAccount,
                "notes"           => $notes,
            )
        );
        return $this->soapCall($function,$params);
    }

    function addLNPFile($portid, $file){
        $function = "addLNPFile";
        $params = array(
            "params" => array(
                "api_username"    => $this->api_username,
                "api_password"    => $this->api_password,
                "portid"          => $portid,
                "file"            => $file
            )
        );
        return $this->soapCall($function,$params);
    }

    function getLNPAttach($portid, $attachid){
        $function = "getLNPAttach";
        $params = array(
            "params" => array(
                "api_username"    => $this->api_username,
                "api_password"    => $this->api_password,
                "portid"          => $portid,
                "attachid"        => $attachid
            )
        );
        return $this->soapCall($function,$params);
    }

    function getLNPStatus($portid){
        $function = "getLNPStatus";
        $params = array(
            "params" => array(
                "api_username"    => $this->api_username,
                "api_password"    => $this->api_password,
                "portid"          => $portid
            )
        );
        return $this->soapCall($function,$params);
    }

    function getLNPNotes($portid){
        $function = "getLNPNotes";
        $params = array(
            "params" => array(
                "api_username"    => $this->api_username,
                "api_password"    => $this->api_password,
                "portid"          => $portid
            )
        );
        return $this->soapCall($function,$params);
    }

    function getLNPDetails($portid){
        $function = "getLNPDetails";
        $params = array(
            "params" => array(
                "api_username"    => $this->api_username,
                "api_password"    => $this->api_password,
                "portid"          => $portid
            )
        );
        return $this->soapCall($function,$params);
    }

    function getLNPAttachList($portid){
        $function = "getLNPAttachList";
        $params = array(
            "params" => array(
                "api_username"    => $this->api_username,
                "api_password"    => $this->api_password,
                "portid"          => $portid
            )
        );
        return $this->soapCall($function,$params);
    }

    function getLNPListStatus(){
        $function = "getLNPListStatus";
        $params = array(
            "params" => array(
                "api_username"    => $this->api_username,
                "api_password"    => $this->api_password,
            )
        );
        return $this->soapCall($function,$params);
    }

    function getLNPList($portid, $portStatus, $startDate, $endDate){
        $function = "getLNPList";
        $params = array(
            "params" => array(
                "api_username"    => $this->api_username,
                "api_password"    => $this->api_password,
                "portid"          => $portid,
                "portStatus"      => $portStatus,
                "startDate"       => $startDate,
                "endDate"         => $endDate
            )
        );
        return $this->soapCall($function,$params);
    }

    function getBackOrders($id='')
    {
         $function = "getBackOrders";
                $params = array(
                    "params" => array(
                    "api_username"  => $this->api_username,
                    "api_password"  => $this->api_password,
                    "id"   => $id
                    )
                );

                return $this->soapCall($function,$params);
    }

        function orderDIDInternationalTollFree($location_id,$quantity,$routing,$pop,$dialtime,$cnam,$failover_busy,$failover_unreachable,$failover_noanswer,$voicemail,$callerid_prefix,$note,$account,$monthly,$setup,$minute,$test)
    {
        $function = "orderDIDInternationalTollFree";
        $params = array(
            "params" => array(
                "api_username"         => $this->api_username,
                "api_password"         => $this->api_password,
                "location_id"          => $location_id,
                "quantity"             => $quantity,
                "routing"              => $routing,
                "pop"                  => $pop,
                "dialtime"             => $dialtime,
                "cnam"                 => $cnam,
                "failover_busy"        => $failover_busy,
                "failover_unreachable" => $failover_unreachable,
                "failover_noanswer"    => $failover_noanswer,
                "voicemail"            => $voicemail,
                "callerid_prefix"      => $callerid_prefix,
                "note"                 => $note,
                "account"              => $account,
                "monthly"              => $monthly,
                "setup"                => $setup,
                "minute"               => $minute,
                "test"                 => $test
            )
        );
        return $this->soapCall($function,$params);
    }

#**LASTFUNCTION**#

}
?>
