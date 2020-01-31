<?php

namespace PedroSancao\EchoClient;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    const NAME = 'echo-client';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/echo-client.php', 'echo-client');

        $this->app->singleton('echo-client', function ($app) {
            return new Client;
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/echo-client.php' => config_path('echo-client.php'),
        ], self::NAME);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [self::NAME];
    }

}
