<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\UsuarioRepository;
use Illuminate\Http\Request;

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
class UsuariosController extends CrudController
{

    /**
     * @var UsuarioRepository 
     */
    protected $repository;

    /**
     * Armazena os relacionamentos.
     * 
     * @var array 
     */
    protected $relationships = [
        'avatar:id,avatar'
    ];

    public function __construct(UsuarioRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Método responsável por retornar os registros para o front-end.
     * 
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $data = $request->all();

        $this->registro = $this->repository->with($this->relationships())->getDataIndex((int) $data['limit'], ['*'], $this->order($data), $data);

        return $this->registro;
    }

}
