<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ICategoriasRepository;
use App\Repositories\CategoriasRepository;
use App\Repositories\IEmpleadoRepository;
use App\Repositories\EmpleadoRepository;
use App\Repositories\IProductosRepository;
use App\Repositories\ProductosRepository;

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
        $this->app->bind(IEmpleadoRepository::class, EmpleadoRepository::class);
        $this->app->bind(IProductosRepository::class, ProductosRepository::class);
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
