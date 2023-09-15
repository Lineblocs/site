<?php


namespace Intergo\SmsTo\Module\Sms\Message;


use Exception;

/**
 * @package Intergo\SmsTo\Module\Sms\Message
 * Class CampaignMessage
 *
 * @method CampaignMessage setSenderID(string $senderID)
 * @method CampaignMessage setBypassOptout(bool $bypassOptout)
 * @method CampaignMessage setCallbackURL(string $callbackURL)
 * @method CampaignMessage setScheduledFor(string $scheduledFor)
 * @method CampaignMessage setTimezone(string $timezone)
 */
class CampaignMessage extends Message
{
    /**
     * @var array
     */
    public $to;

    /**
     * @var
     */
    public $message;

    /**
     * @return array
     * @throws Exception
     */
    public function prepare(): array
    {
        $data = parent::prepare();
        if(!isset($data['to'], $data['message'])) {
            throw new Exception('Recipient or Message is missing');
        }
        return $data;
    }

    /**
     * @return array
     */
    public function getTo(): array
    {
        return $this->to;
    }

    /**
     * @param array $to
     * @return CampaignMessage
     */
    public function setTo(array $to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param $message
     * @return CampaignMessage
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }
}