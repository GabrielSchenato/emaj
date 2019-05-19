<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Criteria\AtivoCriteria;
use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\TipoDemandaRepository;
use Illuminate\Support\Facades\Input;

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
 * @since      1.0.0
 */
class TipoDemandasController extends CrudController
{

    protected $repository;

    public function __construct(TipoDemandaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Retorna todos os dados para os autocomplete
     * 
     * @return array
     */
    public function autocomplete()
    {
        $query = Input::get('query');
        $this->registro = $this->repository->pushCriteria(AtivoCriteria::class)
                ->whereLike('nome', $query, ['id', 'nome']);
        return $this->registro;
    }

}
