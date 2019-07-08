<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\AlunoRepository;

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
class AlunosController extends CrudController
{

    /**
     * @var \Emaj\Repositories\Cadastro\ClienteRepository
     */
    private $clienteRepository;
    protected $repository;

    public function __construct(AlunoRepository $repository, \Emaj\Repositories\Cadastro\ClienteRepository $clienteRepository)
    {
        $this->repository = $repository;
        $this->clienteRepository = $clienteRepository;
    }

    public function show($id)
    {
        $this->registro = $this->repository->find($id);
        $this->registro['clientes'] = $this->clienteRepository
                ->getClientesByAluno($id, ['clientes.*', 'ficha_triagens.created_at as data_vinculo']);
        return $this->registro;
    }

}
