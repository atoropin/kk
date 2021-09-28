<?php

namespace Toropin\KK;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

abstract class AbstractKeycloakChannel
{
    protected Client $client;

    protected Tokenizer $tokenizer;

    protected string $notifyUrl;

    public function __construct()
    {
        $this->client = new Client(['verify' => false]);

        $this->tokenizer = new Tokenizer();

        $this->notifyUrl = config('kk_test.notify_url');
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  Notification $notification
     *
     * @return mixed
     */
    abstract public function send($notifiable, Notification $notification);
}
