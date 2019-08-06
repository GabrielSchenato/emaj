<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\ClienteRepository;
use Emaj\Repositories\Cadastro\NacionalidadeRepository;

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
class ClientesController extends CrudController
{

    protected $relationships = [
        'nacionalidade:id,nome',
        'endereco',
        'composicao_familiar',
        'telefones'
    ];

    /**
     * @var NacionalidadeRepository
     */
    private $nacionalidadeRepository;

    /**
     * @var ClienteRepository
     */
    protected $repository;

    public function __construct(ClienteRepository $repository, NacionalidadeRepository $nacionalidadeRepository)
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
        $this->registro = [];
        if (strlen($ac = request()->get('nacionalidade')) > 0) {
            $this->registro = $this->nacionalidadeRepository
                    ->getDataAutocomplete($ac);
        }
        return $this->registro;
    }

}
