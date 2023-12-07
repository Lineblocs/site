<?php


namespace Intergo\SmsTo\Module\Sms\Message;


use Exception;

/**
 * @package Intergo\SmsTo\Module\Sms\Message
 * Class PersonalizedMessage
 *
 * @method PersonalizedMessage setSenderID(string $senderID)
 * @method PersonalizedMessage setBypassOptout(bool $bypassOptout)
 * @method PersonalizedMessage setCallbackURL(string $callbackURL)
 * @method PersonalizedMessage setScheduledFor(string $scheduledFor)
 * @method PersonalizedMessage setTimezone(string $timezone)
 */
class PersonalizedMessage extends Message
{
    /**
     * @var array
     */
    public $messages;

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @param array $messages
     * @return PersonalizedMessage
     */
    public function setMessages(array $messages)
    {
        $this->messages = $messages;
        return $this;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function prepare(): array
    {
        $data = parent::prepare();
        if(!isset($data['messages'])) {
            throw new Exception('Recipient or Message is missing');
        }
        return $data;
    }
}