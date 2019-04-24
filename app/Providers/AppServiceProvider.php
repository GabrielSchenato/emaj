<?php

namespace Emaj\Providers;

use Emaj\Entities\Cadastro\Usuario;
use Emaj\Observers\Cadastro\UsuarioObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Usuario::observe(UsuarioObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
    }

}
