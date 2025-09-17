<?php


namespace Intergo\SmsTo\Module\Sms\Message;


use Exception;

/**
 * @package Intergo\SmsTo\Module\Sms\Message
 * Class ListMessage
 *
 * @method ListMessage setSenderID(string $senderID)
 * @method ListMessage setBypassOptout(bool $bypassOptout)
 * @method ListMessage setCallbackURL(string $callbackURL)
 * @method ListMessage setScheduledFor(string $scheduledFor)
 * @method ListMessage setTimezone(string $timezone)
 */
class ListMessage extends Message
{
    public $list_id;

    /**
     * @return array
     */
    public function getListId(): array
    {
        return $this->list_id;
    }

    /**
     * @param $listId
     * @return ListMessage
     */
    public function setListId($listId)
    {
        $this->list_id = $listId;
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
     * @param mixed $message
     * @return ListMessage
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @var
     */
    public $message;

    public function prepare(): array
    {
        $data = parent::prepare();
        if(!isset($data['list_id'], $data['message'])) {
            throw new Exception('Recipient or Message is missing');
        }
        return $data;
    }
}