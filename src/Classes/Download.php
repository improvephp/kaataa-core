<?php

namespace ImprovePhp\KaataaCore\Classes;

use GuzzleHttp\Client;

class Download
{
    public $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://staging.kaataa.pro/v1/get/',
        ]);
    }

    public function getJson(string $relative_url = ''): array
    {
        $response = $this->client->request('GET', $relative_url);

        return json_decode($response->getBody()->getContents(), true);
    }

    public static function kata(string $id): array
    {
        $instance = new static();

        return $instance->getJson($id);
    }
}
