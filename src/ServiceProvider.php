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
        ->bootAddonConfig()
        ->registerEventListeners();
    }

    protected function bootAddonConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/headless-refresh.php', 'statamic.headless-refresh');

        $this->publishes([
            __DIR__.'/../config/headless-refresh.php' => config_path('statamic/headless-refresh.php'),
        ], 'headless-refresh-config');

        return $this;
    }


    protected function registerEventListeners()
    {
        // Register event listeners based on configuration
        if (config('headless-refresh.trigger_option')) {
            $events = config('headless-refresh.events');

            foreach ($events as $event) {
                Event::listen($event, UnifiedEventHandler::class);
            }
        }

        return $this;
    }
}
