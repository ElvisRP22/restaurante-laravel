<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ICategoriasRepository;
use App\Repositories\CategoriasRepository;
use App\Repositories\IEmpleadoRepository;
use App\Repositories\EmpleadoRepository;
use App\Repositories\IMediosDePagoRepository;
use App\Repositories\IMesaRepository;
use App\Repositories\IPedidosCarritoRepository;
use App\Repositories\IProductosRepository;
use App\Repositories\MesaRepository;
use App\Repositories\ProductosRepository;
use App\Repositories\IPedidosRepositorio;
use App\Repositories\MediosDePagoRepository;
use App\Repositories\PedidosRepositorio;
use Illuminate\Pagination\Paginator;

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
        $this->app->bind(IMesaRepository::class, MesaRepository::class);
        $this->app->bind(IPedidosRepositorio::class, PedidosRepositorio::class);
        $this->app->bind(IMediosDePagoRepository::class, MediosDePagoRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrapFour();
    }
}
