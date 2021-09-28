<?php

namespace Toropin\KK;

class KeycloakMessage
{
    public ?string $content = null;

    public string $htmlContent = '';

    public string $icon = '';

    public string $link = '';

    public string $notificationTypeCode = '';

    public ?string $organizationId = null;

    public ?string $senderId = null;

    public string $shortContent = '';

    public string $title = '';

    public ?string $userId = null;

    /**
     * Set the content of the notification.
     *
     * @param  string|null $content
     * @return $this
     */
    public function content(?string $content): object
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string $htmlContent
     * @return $this
     */
    public function htmlContent(string $htmlContent): object
    {
        $this->htmlContent = $htmlContent;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string $icon
     * @return $this
     */
    public function icon(string $icon): object
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string $link
     * @return $this
     */
    public function link(string $link): object
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string $notificationTypeCode
     * @return $this
     */
    public function notificationTypeCode(string $notificationTypeCode): object
    {
        $this->notificationTypeCode = $notificationTypeCode;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string|null $organizationId
     * @return $this
     */
    public function organizationId(?string $organizationId): object
    {
        $this->organizationId = $organizationId;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string|null $senderId
     * @return $this
     */
    public function senderId(?string $senderId): object
    {
        $this->senderId = $senderId;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string $shortContent
     * @return $this
     */
    public function shortContent(string $shortContent): object
    {
        $this->shortContent = $shortContent;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string $title
     * @return $this
     */
    public function title(string $title): object
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set the content of the notification.
     *
     * @param  string|null $userId
     * @return $this
     */
    public function userId(?string $userId): object
    {
        $this->userId = $userId;

        return $this;
    }
}
