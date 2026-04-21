<?php


namespace Intergo\SmsTo\Module\Sms\Message;


use Exception;

/**
 * @package Intergo\SmsTo\Module\Sms\Message
 * Class ViberMessage
 *
 * @method ViberMessage setSenderID(string $senderID)
 * @method ViberMessage setBypassOptout(bool $bypassOptout)
 * @method ViberMessage setCallbackURL(string $callbackURL)
 * @method ViberMessage setScheduledFor(string $scheduledFor)
 * @method ViberMessage setTimezone(string $timezone)
 */
class ViberMessage extends Message
{
    /**
     * @var string
     */
    public $to;

    /**
     * @var string
     */
    public $message;

    public $viber_image_url;

    public $viber_target_url;

    public $viber_caption;

    /**
     * @return mixed
     */
    public function getViberImageUrl()
    {
        return $this->viber_image_url;
    }

    /**
     * @param mixed $viber_image_url
     */
    public function setViberImageUrl($viber_image_url)
    {
        $this->viber_image_url = $viber_image_url;
    }

    /**
     * @return mixed
     */
    public function getViberTargetUrl()
    {
        return $this->viber_target_url;
    }

    /**
     * @param mixed $viber_target_url
     */
    public function setViberTargetUrl($viber_target_url)
    {
        $this->viber_target_url = $viber_target_url;
    }

    /**
     * @return mixed
     */
    public function getViberCaption()
    {
        return $this->viber_caption;
    }

    /**
     * @param mixed $viber_caption
     */
    public function setViberCaption($viber_caption)
    {
        $this->viber_caption = $viber_caption;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo(string $to)
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
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function prepare(): array
    {
        $data = parent::prepare();
        if(!isset($data['to'], $data['message'])) {
            throw new Exception('Recipient or Message is missing');
        }
        if(!isset($data['viber_image_url'], $data['viber_target_url'])) {
            throw new Exception('Viber Configuration is missing');
        }
        return $data;
    }
}