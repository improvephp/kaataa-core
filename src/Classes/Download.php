<?php

namespace ImprovePhp\KaataaCore\Classes;

use GuzzleHttp\Client;

class Download
{
    public Client $client;

    public array $classes = [];
    public array $tests_pest = [];
    public array $tests_phpunit = [];

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

    public function getKata(string $id): Download
    {
        $instance = new static();

        $result = $instance->getJson($id);

        $files = $result['data']['files'];

        $this->classes = $files['classes'];
        $this->tests_pest = $files['tests_pest'];
        $this->tests_phpunit = $files['tests_phpunit'];

        return $this;
    }

    public static function kata(string $id): Download
    {
        $instance = new static();

        return $instance->getKata($id);
    }
}
