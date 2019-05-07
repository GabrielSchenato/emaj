<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\TipoStatusRepository;

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
class TipoStatusController extends CrudController
{

    protected $repository;

    public function __construct(TipoStatusRepository $repository)
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
        $this->registro = $this->repository->allAtivo();
        return $this->registro;
    }

}
