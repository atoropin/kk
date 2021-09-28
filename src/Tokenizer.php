<?php

namespace Toropin\KK;

use GuzzleHttp\Client;

class Tokenizer
{
    private ?string $accessToken = null;

    protected string $tokenUrl;
    protected string $clientId;
    protected string $clientSecret;

    public function __construct()
    {
        $this->tokenUrl = config('kk_test.token_url');
        $this->clientId = config('kk_test.client_id');
        $this->clientSecret = config('kk_test.client_secret');
    }

    public function getToken(): ?string
    {
        if ($this->accessToken === null) {
            $this->accessToken = $this->renewAccessToken($this->clientId, $this->clientSecret, $this->tokenUrl);
        }

        return $this->accessToken;
    }

    /**
     * Refresh access token.
     *
     * @param  $clientId
     * @param  $clientSecret
     * @param  $tokenUrl
     * @return string
     */
    protected function renewAccessToken($clientId, $clientSecret, $tokenUrl): string
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
