<?php

namespace Emaj\Providers;

use Emaj\Repositories\Cadastro\ParametroTriagemRepository;
use Emaj\Repositories\Cadastro\ParametroTriagemRepositoryEloquent;
use Emaj\Repositories\Cadastro\TipoDemandaRepository;
use Emaj\Repositories\Cadastro\TipoDemandaRepositoryEloquent;
use Emaj\Repositories\Cadastro\UsuarioRepository;
use Emaj\Repositories\Cadastro\UsuarioRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(TipoDemandaRepository::class, TipoDemandaRepositoryEloquent::class);
        $this->app->bind(UsuarioRepository::class, UsuarioRepositoryEloquent::class);
        $this->app->bind(ParametroTriagemRepository::class, ParametroTriagemRepositoryEloquent::class);
    }
}
