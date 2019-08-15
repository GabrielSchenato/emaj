<?php

namespace Emaj\Http\Controllers\Api\V1\Movimento;

use Emaj\Criteria\AtivoCriteria;
use Emaj\Criteria\ProfessorCriteria;
use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\AlunoRepository;
use Emaj\Repositories\Cadastro\ClienteRepository;
use Emaj\Repositories\Cadastro\TipoDemandaRepository;
use Emaj\Repositories\Cadastro\UsuarioRepository;
use Emaj\Repositories\Movimento\FichaTriagemRepository;
use Emaj\Util\Traits\Report;
use function request;

/**
 * Classe responsável por gerenciar a requisições das páginas
 *
 * PHP version 7.2
 *
 * @category   Controller
 * @package    Movimento
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class FichaTriagensController extends CrudController
{

    use Report;

    /**
     * @var UsuarioRepository
     */
    private $usuarioRepository;

    /**
     * @var AlunoRepository
     */
    private $alunoRepository;

    /**
     * @var TipoDemandaRepository
     */
    private $tipoDemandaRepository;

    /**
     * @var ClienteRepository
     */
    private $clienteRepository;
    /**
     *
     * @var FichaTriagemRepository
     */
    protected $repository;
    protected $relationships = [
        'cliente:id,nome_completo',
        'tipo_demanda:id,nome',
        'parte_contraria:id,nome_completo',
        'aluno:id,nome_completo',
        'professor:id,nome_completo'];

    public function __construct(FichaTriagemRepository $repository, ClienteRepository $clienteRepository, TipoDemandaRepository $tipoDemandaRepository, AlunoRepository $alunoRepository, UsuarioRepository $usuarioRepository)
    {
        $this->repository = $repository;
        $this->clienteRepository = $clienteRepository;
        $this->tipoDemandaRepository = $tipoDemandaRepository;
        $this->alunoRepository = $alunoRepository;
        $this->usuarioRepository = $usuarioRepository;
    }

    public function imprimirFichaTriagem()
    {
        $this->nomeRelatorio = 'ficha_triagem';
        $this->nomeRelatorioJasper = 'ficha_triagem';
        $this->titulo = 'Ficha de Triagem';
        return $this->gerarImpressao();
    }

    /**
     * Retorna todos os dados para os autocomplete
     * 
     * @return array
     */
    public function autocomplete()
    {
        $this->registro = [];
        if ((strlen($ac = request()->get('cliente_id')) > 0) || (strlen($ac = request()->get('parte_contraria_id')) > 0)) {
            $this->registro = $this->clienteRepository->pushCriteria(AtivoCriteria::class)
                    ->getDataAutocomplete($ac);
        }
        if (strlen($ac = request()->get('tipo_demanda_id')) > 0) {
            $this->registro = $this->tipoDemandaRepository->pushCriteria(AtivoCriteria::class)
                    ->getDataAutocomplete($ac);
        }
        if (strlen($ac = request()->get('aluno_id')) > 0) {
            $this->registro = $this->alunoRepository->pushCriteria(AtivoCriteria::class)
                    ->getDataAutocomplete($ac);
        }
        if (strlen($ac = request()->get('professor_id')) > 0) {
            $this->registro = $this->usuarioRepository->pushCriteria(ProfessorCriteria::class)
                    ->pushCriteria(AtivoCriteria::class)
                    ->getDataAutocomplete($ac);
        }
        return $this->registro;
    }

}
