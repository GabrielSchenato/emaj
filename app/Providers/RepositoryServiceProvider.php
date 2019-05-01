<?php

namespace Emaj\Providers;

use Emaj\Repositories\Cadastro\ClienteRepository;
use Emaj\Repositories\Cadastro\ClienteRepositoryEloquent;
use Emaj\Repositories\Cadastro\ComposicaoFamiliarRepository;
use Emaj\Repositories\Cadastro\ComposicaoFamiliarRepositoryEloquent;
use Emaj\Repositories\Cadastro\EnderecoRepository;
use Emaj\Repositories\Cadastro\EnderecoRepositoryEloquent;
use Emaj\Repositories\Cadastro\NacionalidadeRepository;
use Emaj\Repositories\Cadastro\NacionalidadeRepositoryEloquent;
use Emaj\Repositories\Cadastro\ParametroTriagemRepository;
use Emaj\Repositories\Cadastro\ParametroTriagemRepositoryEloquent;
use Emaj\Repositories\Cadastro\TelefoneRepository;
use Emaj\Repositories\Cadastro\TelefoneRepositoryEloquent;
use Emaj\Repositories\Cadastro\TipoDemandaRepository;
use Emaj\Repositories\Cadastro\TipoDemandaRepositoryEloquent;
use Emaj\Repositories\Cadastro\TipoStatusRepository;
use Emaj\Repositories\Cadastro\TipoStatusRepositoryEloquent;
use Emaj\Repositories\Cadastro\UsuarioRepository;
use Emaj\Repositories\Cadastro\UsuarioRepositoryEloquent;
use Emaj\Repositories\Movimento\FichaTriagemRepository;
use Emaj\Repositories\Movimento\FichaTriagemRepositoryEloquent;
use Emaj\Repositories\Movimento\NumeroProtocoloRepository;
use Emaj\Repositories\Movimento\NumeroProtocoloRepositoryEloquent;
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
        $this->app->bind(TipoStatusRepository::class, TipoStatusRepositoryEloquent::class);
        $this->app->bind(UsuarioRepository::class, UsuarioRepositoryEloquent::class);
        $this->app->bind(ParametroTriagemRepository::class, ParametroTriagemRepositoryEloquent::class);
        $this->app->bind(ClienteRepository::class, ClienteRepositoryEloquent::class);
        $this->app->bind(EnderecoRepository::class, EnderecoRepositoryEloquent::class);
        $this->app->bind(ComposicaoFamiliarRepository::class, ComposicaoFamiliarRepositoryEloquent::class);
        $this->app->bind(TelefoneRepository::class, TelefoneRepositoryEloquent::class);
        $this->app->bind(NacionalidadeRepository::class, NacionalidadeRepositoryEloquent::class);
        $this->app->bind(NumeroProtocoloRepository::class, NumeroProtocoloRepositoryEloquent::class);
        $this->app->bind(FichaTriagemRepository::class, FichaTriagemRepositoryEloquent::class);
    }

}
