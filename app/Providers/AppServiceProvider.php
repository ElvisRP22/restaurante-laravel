<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ICategoriasRepository;
use App\Repositories\CategoriasRepository;
use App\Repositories\IEmpleadosRepository;
use App\Repositories\EmpleadosRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(ICategoriasRepository::class, CategoriasRepository::class);
        $this->app->bind(IEmpleadosRepository::class, EmpleadosRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
