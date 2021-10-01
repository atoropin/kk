<?php

namespace Toropin\KK;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class Tokenizer
{
    /**
     * Return the access token from cache or request a fresh one
     *
     * @return string
     */
    public function getToken(): string
    {
        if (Cache::has('keycloak_notify_access_token')) {
            return Cache::get('keycloak_notify_access_token');
        }

        $tokenResponse = $this->refreshToken();

        Cache::put('keycloak_notify_access_token', $tokenResponse->access_token, ($tokenResponse->expires_in - 300));

        return $tokenResponse->access_token;
    }

    /**
     * Send access token request.
     *
     * @return object
     */
    protected function refreshToken(): object
    {
        $client = new Client(['verify' => false]);

        $tokenUrl = config('keycloak_notify.token_url');
        $clientId = config('keycloak_notify.client_id');
        $clientSecret = config('keycloak_notify.client_secret');

        return json_decode(
            (string) $client->request(
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
                ->getContents()
            , false
        );
    }
}
