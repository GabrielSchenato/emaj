<?php

namespace Emaj\Http\Controllers\Institucional;

use Emaj\Http\Controllers\Controller;
use Emaj\Repositories\Cadastro\AlunoRepository;
use Emaj\Repositories\Cadastro\ProtocoloRepository;
use Emaj\Repositories\Cadastro\TipoDemandaRepository;

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
     * @var ProtocoloRepository
     */
    private $protocoloRepository;

    /**
     * @var TipoDemandaRepository
     */
    private $tipoDemandaRepository;

    /**
     * @var AlunoRepository
     */
    private $alunoRepository;

    public function __construct(AlunoRepository $alunoRepository, ProtocoloRepository $protocoloRepository, TipoDemandaRepository $tipoDemandaRepository)
    {
        $this->alunoRepository = $alunoRepository;
        $this->tipoDemandaRepository = $tipoDemandaRepository;
        $this->protocoloRepository = $protocoloRepository;
    }

    public function __invoke()
    {
        $estatistica = [
            'alunos' => (string) $this->alunoRepository->count(),
            'clientes' => (string) $this->protocoloRepository->getNumeroClientes(),
            'atendimentosMes' => (string) $this->protocoloRepository->getAtendimentosMes(),
            'tipoDemandasAtendidas' => $this->tipoDemandaRepository->count()
        ];
        return view('institucional.home', compact("estatistica"));
    }

}
