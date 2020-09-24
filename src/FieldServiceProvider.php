<?php

namespace Marshmallow\PrefillerField;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\Facades\Route;
use Laravel\Nova\Nova;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    	$this->app->booted(function () {
            $this->routes();
        });

        Nova::serving(function (ServingNova $event) {
            Nova::script('prefiller-field', __DIR__.'/../dist/js/field.js');
            Nova::style('prefiller-field', __DIR__.'/../dist/css/field.css');
        });
    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
                ->prefix('nova-vendor/prefiller-field')
                ->group(__DIR__.'/../routes/api.php');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
