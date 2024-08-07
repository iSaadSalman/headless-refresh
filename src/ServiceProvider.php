<?php

namespace Isaadsalman\HeadlessRefresh;

use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;
use Illuminate\Support\Facades\Event;
use Isaadsalman\HeadlessRefresh\Listeners\UnifiedEventHandler;
use Statamic\Facades\CP\Nav;
use Isaadsalman\HeadlessRefresh\Widgets\HeadlessRefresh as HeadlessRefreshWidget;

class ServiceProvider extends AddonServiceProvider
{

    protected $widgets = [
        HeadlessRefreshWidget::class,
    ];

    protected $scripts = [
        __DIR__.'/../resources/js/headless-refresh.js'
    ];

    protected $routes = [
        'cp' => __DIR__.'/../routes/cp.php',
    ];


    public function bootAddon()
    {

        $this
        ->bootConfig()
        ->registerEventListeners();


        Statamic::afterInstalled(function ($command) {
            $command->call('vendor:publish', ['--tag' => 'headless-refresh-config', '--force' => true]);
            $command->call('optimize');
        });
    }

    protected function bootConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/headless-refresh.php', 'statamic.headless-refresh');

        $this->publishes([
            __DIR__.'/../config/headless-refresh.php' => config_path('statamic/headless-refresh.php'),
        ], 'headless-refresh-config');

        Statamic::provideToScript(['headless-refresh' => config('statamic.headless-refresh')]);

        return $this;
    }


    protected function registerEventListeners()
    {
        // Register event listeners based on configuration
        if (config('statamic.headless-refresh.event_trigger')) {
            $events = config('statamic.headless-refresh.events');

            foreach ($events as $event) {
                Event::listen($event, UnifiedEventHandler::class);
            }
        }

        return $this;
    }
}
