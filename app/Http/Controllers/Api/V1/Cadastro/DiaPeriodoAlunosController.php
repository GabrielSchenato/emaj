<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\DiaPeriodoAlunoRepository;
use Emaj\Repositories\Cadastro\DiaPeriodoRepository;

/**
 * Classe responsável por gerenciar a requisições das páginas
 *
 * PHP version 7.2
 *
 * @category   Controller
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      2.1.0
 */
class DiaPeriodoAlunosController extends CrudController
{

    /**
     * @var DiaPeriodoRepository
     */
    private $diaPeriodoRepository;

    /**
     * Armazena os relacionamentos.
     * 
     * @var array 
     */
    protected $relationships = [
        'dia_periodo'
    ];

    /**
     * @var DiaPeriodoAlunoRepository 
     */
    protected $repository;

    public function __construct(DiaPeriodoAlunoRepository $repository, DiaPeriodoRepository $diaPeriodoRepository)
    {
        $this->repository = $repository;
        $this->diaPeriodoRepository = $diaPeriodoRepository;
    }

    /**
     * Retorna todos os dados para os autocomplete
     * 
     * @return array
     */
    public function autocomplete()
    {
        $this->registro = [];
        if (strlen($ac = request()->get('dia_periodo_id')) > 0) {
            $this->registro = $this->diaPeriodoRepository
                    ->getDataAutocomplete($ac);
        }
        return $this->registro;
    }

}
