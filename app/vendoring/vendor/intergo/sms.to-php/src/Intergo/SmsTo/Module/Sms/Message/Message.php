<?php


namespace Intergo\SmsTo\Module\Sms\Message;


class Message implements IMessage
{
    /**
     * @var string
     */
    public $sender_id;

    /**
     * @var string
     */
    public $callback_url;

    /**
     * @var string
     */
    public $scheduled_for;

    /**
     * @var string
     */
    public $timezone;

    /**
     * @var bool
     */
    public $bypass_optout;

    /**
     * @return string
     */
    public function getSenderID(): string
    {
        return $this->sender_id;
    }

    /**
     * @param string $senderID
     */
    public function setSenderID(string $senderID)
    {
        $this->sender_id = $senderID;
        return $this;
    }

    /**
     * @return string
     */
    public function getCallbackURL(): string
    {
        return $this->callback_url;
    }

    /**
     * @param string $callbackURL
     */
    public function setCallbackURL(string $callbackURL)
    {
        $this->callback_url = $callbackURL;
        return $this;
    }

    /**
     * @return string
     */
    public function getScheduledFor(): string
    {
        return $this->scheduled_for;
    }

    /**
     * @param string $scheduledFor
     */
    public function setScheduledFor(string $scheduledFor)
    {
        $this->scheduled_for = $scheduledFor;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimezone(): string
    {
        return $this->timezone;
    }

    /**
     * @param string $timezone
     */
    public function setTimezone(string $timezone)
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBypassOptout(): bool
    {
        return $this->bypass_optout;
    }

    /**
     * @param bool $bypassOptout
     */
    public function setBypassOptout(bool $bypassOptout)
    {
        $this->bypass_optout = $bypassOptout;
        return $this;
    }

    public function prepare(): array
    {
        return array_filter((array) $this, function ($val) {
            return !is_null($val) || (is_array($val) && !empty($val));
        });
    }
}