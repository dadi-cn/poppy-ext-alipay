<?php

namespace Poppy\Extension\Alipay;

use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {

    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return [
        ];
    }
}
