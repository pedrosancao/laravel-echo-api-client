<?php

namespace PedroSancao\EchoClient;

class Client
{

    /**
     * Laravel Echo Server client credentials
     *
     * @var \stdClass
     */
    private $client;

    protected function getClient()
    {
        if (!is_null($this->client)) {
            return $this->client;
        }
        $jsonConfig = file_get_contents(base_path('laravel-echo-server.json'));
        return $this->client = data_get(json_decode($jsonConfig), 'clients.0');
    }

    protected function createHttpContext()
    {
        $client = $this->getClient();
        return stream_context_create(['http' => [
            'header' => 'Authorization: Bearer ' . $client->key,
        ]]);
    }

    protected function getBaseUrl()
    {
        $client = $this->getClient();
        return vsprintf('%s/apps/%s/', [
            config('echo-client.address', 'http://localhost:6001/'),
            $client->appId,
        ]);
    }

    public function get($endpoint)
    {
        $context = $this->createHttpContext();
        $baseUrl = $this->getBaseUrl();
        $jsonResponse = file_get_contents($baseUrl . $endpoint, false, $context);
        return json_decode($jsonResponse);
    }

    public function channels()
    {
        return $this->get('channels');
    }

}
