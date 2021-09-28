<?php

namespace Toropin\KK;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class Tokenizer
{
    private ?string $accessToken = null;

    protected string $tokenUrl;
    protected string $clientId;
    protected string $clientSecret;

    public function __construct()
    {
        $this->tokenUrl = config('keycloak_notify.token_url');
        $this->clientId = config('keycloak_notify.client_id');
        $this->clientSecret = config('keycloak_notify.client_secret');
    }

    public function getToken(): ?string
    {
        $this->accessToken = Cache::get('keycloak_notify_access_token');

        if ($this->accessToken === null) {
            $this->accessToken = $this->sendTokenRequest($this->clientId, $this->clientSecret, $this->tokenUrl);

            Cache::put('keycloak_notify_access_token', $this->accessToken, (3600 - 300));
        }

        return $this->accessToken;
    }

    /**
     * Send access token request.
     *
     * @param  $clientId
     * @param  $clientSecret
     * @param  $tokenUrl
     * @return string
     */
    protected function sendTokenRequest($clientId, $clientSecret, $tokenUrl): string
    {
        $client = new Client(['verify' => false]);

        $response = $client->request(
            'POST', $tokenUrl, [
            'form_params' => [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'grant_type' => 'client_credentials'
            ],
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:59.0) Gecko/20100101 Firefox/59.0',
            ]
        ])
            ->getBody()
            ->getContents();

        return json_decode($response)->access_token;
    }
}
