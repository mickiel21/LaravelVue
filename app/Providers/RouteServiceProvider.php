<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    //API
    protected $api_auth_namespace = 'App\Http\Controllers\Auth';
    protected $api_user_namespace = 'App\Http\Controllers\User';
    protected $api_register_namespace = 'App\Http\Controllers\Auth';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        // $this->mapApiRoutes();

        $this->mapWebRoutes();
        $this->mapApiAuthRoutes();
        $this->mapApiUserRoutes();
        $this->mapApiRegisterRoutes();


        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

      // AUTH
      protected function mapApiAuthRoutes()
      {
          Route::prefix('api/v1')
              ->middleware('api')
              ->namespace($this->api_auth_namespace)
              ->group(base_path('routes/api/v1/auth/auth.php'));
      }

       // USER
       protected function mapApiUserRoutes()
       {
           Route::prefix('api/v1')
               ->middleware('api')
               ->namespace($this->api_user_namespace)
               ->group(base_path('routes/api/v1/user/user.php'));
       }

       // REGISTER
       protected function mapApiRegisterRoutes()
       {
           Route::prefix('api/v1')
               ->middleware('api')
               ->namespace($this->api_register_namespace)
               ->group(base_path('routes/api/v1/auth/register.php'));
       }
}
