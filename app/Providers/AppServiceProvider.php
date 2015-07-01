<?php

namespace App\Providers;

use App\Resolver;
use App\Steps;
use Illuminate\Support\ServiceProvider;
use League\Url\Url;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( 'League\Url\Url', function ( $app, $parameters ) {
            return Url::createFromUrl( array_values( $parameters )[0] );
        } );
        $this->app->singleton( 'resolver', function ( $app ) {
            return new Resolver( new Steps() );
        } );
    }
}
