<?php

namespace Emaj\Http\Controllers\Institucional;

use Emaj\Http\Controllers\Controller;
use Emaj\Repositories\Cadastro\AlunoRepository;
use Emaj\Repositories\Cadastro\TipoDemandaRepository;
use Emaj\Repositories\Movimento\FichaTriagemRepository;
use Emaj\Repositories\Movimento\FichaTriagemRepositoryEloquent;

/**
 * Classe responsável por gerenciar a requisições das páginas
 *
 * PHP version 7.2
 *
 * @category   Controller
 * @package    Institucional
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class HomeController extends Controller
{

    /**
     * @var TipoDemandaRepository
     */
    private $tipoDemandaRepository;

    /**
     * @var FichaTriagemRepository
     */
    private $fichaTriagemRepository;

    /**
     * @var AlunoRepository
     */
    private $alunoRepository;

    public function __construct(AlunoRepository $alunoRepository, FichaTriagemRepository $fichaTriagemRepository, TipoDemandaRepository $tipoDemandaRepository)
    {
        $this->alunoRepository = $alunoRepository;
        $this->fichaTriagemRepository = $fichaTriagemRepository;
        $this->tipoDemandaRepository = $tipoDemandaRepository;
    }

    public function __invoke()
    {
        $estatistica = [
            'alunos' => (string) $this->alunoRepository->count(),
            'clientes' => (string) $this->fichaTriagemRepository->getNumeroClientes(),
            'parteContrarias' => (string) $this->fichaTriagemRepository->getNumeroParteContrarias(),
            'atendimentosMes' => (string) $this->fichaTriagemRepository->getAtendimentosMes(),
            'tipoDemandasAtendidas' => $this->tipoDemandaRepository->count()
        ];
        return view('institucional.home', compact("estatistica"));
    }

}
