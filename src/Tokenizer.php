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
        $this->accessToken = Cache::get('keycloak_notify_access_token');

        $this->tokenUrl = config('keycloak_notify.token_url');
        $this->clientId = config('keycloak_notify.client_id');
        $this->clientSecret = config('keycloak_notify.client_secret');
    }

    public function getToken(): string
    {
        if ($this->accessToken === null) {
            $response = $this->refreshToken($this->clientId, $this->clientSecret, $this->tokenUrl);

            Cache::put('keycloak_notify_access_token', $response->access_token, ($response->expires_in - 300));
        }

        return $this->accessToken;
    }

    /**
     * Send access token request.
     *
     * @param  $clientId
     * @param  $clientSecret
     * @param  $tokenUrl
     * @return object
     */
    protected function refreshToken($clientId, $clientSecret, $tokenUrl): object
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

        return json_decode((string) $response, false);
    }
}
