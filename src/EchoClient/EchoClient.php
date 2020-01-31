<?php

namespace PedroSancao\EchoClient;

/**
 * @method static get(string $endpoint) : \stdClass
 * @method static channels() : \stdClass
 *
 * @see \PedroSancao\EchoApiClient\Client
 */
class EchoClient extends \Illuminate\Support\Facades\Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return ServiceProvider::NAME;
    }

}
