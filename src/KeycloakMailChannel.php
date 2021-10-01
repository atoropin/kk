<?php

namespace Toropin\KK;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class KeycloakMailChannel
{
    private Client $client;

    private Tokenizer $tokenizer;

    public function __construct(Client $client, Tokenizer $tokenizer)
    {
        $this->client = $client;

        $this->tokenizer = $tokenizer;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed $notifiable
     * @param  Notification $notification
     *
     * @return mixed
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toKeycloakMail($notifiable);

        $notifyUrl = config('kk_test.notify_url');

        return $this->client->request(
            'POST', $notifyUrl . 'send-email', [
                'json' => $message,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => "Bearer {$this->tokenizer->getToken()}",
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0'
                ]
            ]
        );
    }
}
