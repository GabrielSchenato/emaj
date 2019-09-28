<?php

namespace Emaj\Providers;

use Emaj\Repositories\Cadastro\{
    AlunoRepository,
    AlunoRepositoryEloquent,
    AvaliacaoArquivoRepository,
    AvaliacaoArquivoRepositoryEloquent,
    AvaliacaoRepository,
    AvaliacaoRepositoryEloquent,
    ClienteRepository,
    ClienteRepositoryEloquent,
    ComposicaoFamiliarRepository,
    ComposicaoFamiliarRepositoryEloquent,
    EnderecoRepository,
    EnderecoRepositoryEloquent,
    NacionalidadeRepository,
    NacionalidadeRepositoryEloquent,
    ParametroTriagemRepository,
    ParametroTriagemRepositoryEloquent,
    TelefoneRepository,
    TelefoneRepositoryEloquent,
    TipoDemandaRepository,
    TipoDemandaRepositoryEloquent,
    UsuarioRepository,
    UsuarioRepositoryEloquent,
    ProtocoloRepository,
    ProtocoloRepositoryEloquent,
    ProtocoloAlunoProfessorRepository,
    ProtocoloAlunoProfessorRepositoryEloquent,
    DiaPeriodoRepository,
    DiaPeriodoRepositoryEloquent,
    DiaPeriodoAlunoRepository,
    DiaPeriodoAlunoRepositoryEloquent,
    DisciplinaRepository,
    DisciplinaRepositoryEloquent
};
use Emaj\Repositories\Movimento\{
    FichaTriagemRepository,
    FichaTriagemRepositoryEloquent
};
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
        $this->app->bind(ClienteRepository::class, ClienteRepositoryEloquent::class);
        $this->app->bind(EnderecoRepository::class, EnderecoRepositoryEloquent::class);
        $this->app->bind(ComposicaoFamiliarRepository::class, ComposicaoFamiliarRepositoryEloquent::class);
        $this->app->bind(TelefoneRepository::class, TelefoneRepositoryEloquent::class);
        $this->app->bind(NacionalidadeRepository::class, NacionalidadeRepositoryEloquent::class);
        $this->app->bind(FichaTriagemRepository::class, FichaTriagemRepositoryEloquent::class);
        $this->app->bind(AlunoRepository::class, AlunoRepositoryEloquent::class);
        $this->app->bind(AvaliacaoRepository::class, AvaliacaoRepositoryEloquent::class);
        $this->app->bind(AvaliacaoArquivoRepository::class, AvaliacaoArquivoRepositoryEloquent::class);
        $this->app->bind(ProtocoloRepository::class, ProtocoloRepositoryEloquent::class);
        $this->app->bind(ProtocoloAlunoProfessorRepository::class, ProtocoloAlunoProfessorRepositoryEloquent::class);
        $this->app->bind(DiaPeriodoRepository::class, DiaPeriodoRepositoryEloquent::class);
        $this->app->bind(DiaPeriodoAlunoRepository::class, DiaPeriodoAlunoRepositoryEloquent::class);
        $this->app->bind(DisciplinaRepository::class, DisciplinaRepositoryEloquent::class);
    }

}
