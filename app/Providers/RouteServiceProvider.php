<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Registra as rotas da aplicação.
     */
    public function boot(): void
    {
        parent::boot();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/customers.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/users.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            
        });
    }
}
