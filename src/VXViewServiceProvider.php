<?php

namespace TNM\VXView;

use Illuminate\Support\ServiceProvider;
use TNM\VXView\Commands\GenerateAccessTokenCommand;
use TNM\VXView\Services\Authentication\AccessTokenGenerationService;
use TNM\VXView\Services\Authentication\IAccessTokenGenerationService;
use TNM\VXView\Services\SpeedBundles\BundleSubscription\BundleSubscriptionService;
use TNM\VXView\Services\SpeedBundles\BundleSubscription\IBundleSubscriptionService;


class VXViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__. '/config.php' => config_path('vx_view.php'),
            ], 'config');

            $this->commands([
               GenerateAccessTokenCommand::class
            ]);

        }

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__. '/config.php', 'vx_view');

        $this->app->bind(IBundleSubscriptionService::class, BundleSubscriptionService::class);
        $this->app->bind(IAccessTokenGenerationService::class, AccessTokenGenerationService::class);
    }
}
