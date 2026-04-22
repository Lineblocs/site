<?php


namespace Intergo\SmsTo\Module\Sms\Message;


interface IMessage
{
    function prepare(): array;
}