<?php

namespace Litecms\Chatbox;

use Illuminate\Support\ServiceProvider;
use Litecms\Chatbox\Models\Chatbox;

class ChatboxServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        // Load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'chatbox');

        // Load translation
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'chatbox');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishResources();
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'litecms.chatbox');

        $this->app->bind('chatbox', function ($app) {
            return $this->app->make('Litecms\Chatbox\Chatbox');
        });

        $this->app->bind(
            'Litecms\Chatbox\Interfaces\ChatboxRepositoryInterface',
            \Litecms\Chatbox\Repositories\Eloquent\ChatboxRepository::class
        );

        $this->app->register(\Litecms\Chatbox\Providers\AuthServiceProvider::class);
        $this->app->register(\Litecms\Chatbox\Providers\EventServiceProvider::class);
        $this->app->register(\Litecms\Chatbox\Providers\RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['chatbox'];
    }

    /**
     * Publish configuration file.
     */
    private function publishResources()
    {
        // Publish configuration file
        $this->publishes([__DIR__.'/../config/config.php' => config_path('litecms/chatbox.php')], 'config');

        // Publish admin view
        $this->publishes([__DIR__.'/../resources/views' => base_path('resources/views/vendor/chatbox')], 'view');

        // Publish language files
        $this->publishes([__DIR__.'/../resources/lang' => base_path('resources/lang/vendor/chatbox')], 'lang');

        // Publish language files
        $this->publishes([__DIR__.'/../public' => base_path('public')], 'public');
    }

}
