<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\ClienteRepository;
use Emaj\Repositories\Cadastro\NacionalidadeRepository;
use Emaj\Repositories\Cadastro\ProtocoloRepository;

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

    /**
     * @var ProtocoloRepository
     */
    private $protocoloRepository;
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

    public function __construct(ClienteRepository $repository, NacionalidadeRepository $nacionalidadeRepository, ProtocoloRepository $protocoloRepository)
    {
        $this->repository = $repository;
        $this->nacionalidadeRepository = $nacionalidadeRepository;
        $this->protocoloRepository = $protocoloRepository;
    }

    /**
     * Método responsável por retornar os dados se o cliente já foi uma parte contrária
     * 
     * @param int $idCliente
     * @return mixed
     */
    public function isParteContraria(int $idCliente)
    {
        return $this->protocoloRepository->findByField('parte_contraria_id', $idCliente);
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
