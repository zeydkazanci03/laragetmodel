<?php
namespace Laragetmodel\GetModel\Providers;

use Illuminate\Support\ServiceProvider;
use Laragetmodel\GetModel\GetModel as GetModelService;

class GetModelServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/getmodel.php', 'getmodel');

        $this->app->singleton('getmodel', function ($app) {
            return new GetModelService($app);
        });
    }

    public function boot()
    {
        // publish config
        $this->publishes([
            __DIR__ . '/../../config/getmodel.php' => config_path('getmodel.php'),
        ], 'config');
    }
}
