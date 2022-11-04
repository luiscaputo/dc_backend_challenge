<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Interfaces\ICategoriesRepository', 'App\Repositories\CategoryRepository');
        $this->app->bind('App\Interfaces\IProductsRepository', 'App\Repositories\ProductRepository');

        $this->app->bind('App\Interfaces\IProvidersRepository', 'App\Repositories\ProviderRepository');
        $this->app->bind('App\Interfaces\ISalesRepository', 'App\Repositories\SaleRepository');
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
