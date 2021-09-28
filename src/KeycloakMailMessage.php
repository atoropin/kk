<?php

namespace Toropin\KK;

class KeycloakMailMessage
{
    /**
     * @var mixed
     */
    public $to;

    public string $subject = '';

    public string $bodyText = '';

    public string $bodyHtml = '';

    public array $attachments = [];

    /**
     * Set the content of the notification.
     *
     * @param  mixed $to
     * @return $this
     */
    public function to(...$to): object
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string $subject
     * @return $this
     */
    public function subject(string $subject): object
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string $bodyText
     * @return $this
     */
    public function bodyText(string $bodyText): object
    {
        $this->bodyText = $bodyText;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string $bodyHtml
     * @return $this
     */
    public function bodyHtml(string $bodyHtml): object
    {
        $this->bodyHtml = $bodyHtml;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  array $attachments
     * @return $this
     */
    public function attachments(array $attachments): object
    {
        $this->attachments = $attachments;

        return $this;
    }
}
