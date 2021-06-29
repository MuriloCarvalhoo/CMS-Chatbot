<?php

namespace Litecms\Chatbox\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Litecms\Chatbox\Models\Chatbox;
use Request;
use Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Litecms\Chatbox\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot()
    {
        parent::boot();

        if (Request::is('*/chatbox/chatbox/*')) {
            Route::bind('chatbox', function ($id) {
                $chatbox = $this->app->make(\Litecms\Chatbox\Interfaces\ChatboxRepositoryInterface::class);
                return $chatbox->findOrNew($id);
            });
        }

    }

    /**
     * Define the routes for the package.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();

        $this->mapApiRoutes();

        //
    }

    /**
     * Define the "web" routes for the package.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {

        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require (__DIR__ . '/../../routes/web.php');
        });

    }

    /**
     * Define the "api" routes for the package.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {

        Route::group([
            'middleware' => 'api',
            'prefix' => 'api',
            'namespace' => $this->namespace,
        ], function ($router) {
            require (__DIR__ . '/../../routes/api.php');
        });
    }

}
