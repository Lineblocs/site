<?php

namespace App\Helpers\Sms;

final class Base {

    public function __construct($key, $secret) {
        $this->key = $key;
        $this->secret = $secret;
    }
    public function sendSMS($from='', $to='', $body='') {

    }
}