<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Criteria\AtivoCriteria;
use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\ClienteRepository;
use Emaj\Repositories\Cadastro\ProtocoloRepository;
use Emaj\Repositories\Cadastro\TipoDemandaRepository;

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
 * @since      1.1.1
 */
class ProtocolosController extends CrudController
{

    /**
     * @var ClienteRepository
     */
    private $clienteRepository;

    /**
     * @var TipoDemandaRepository
     */
    private $tipoDemandaRepository;
    protected $repository;
    protected $relationships = [
        'tipo_demanda:id,nome',
        'parte_contraria:id,nome_completo'
    ];

    public function __construct(ProtocoloRepository $repository, TipoDemandaRepository $tipoDemandaRepository, ClienteRepository $clienteRepository)
    {
        $this->repository = $repository;
        $this->tipoDemandaRepository = $tipoDemandaRepository;
        $this->clienteRepository = $clienteRepository;
    }

    /**
     * Retorna todos os dados para os autocomplete
     * 
     * @return array
     */
    public function autocomplete()
    {
        $this->registro = [];
        if (strlen($ac = request()->get('parte_contraria_id')) > 0) {
            $this->registro = $this->clienteRepository->pushCriteria(AtivoCriteria::class)
                    ->getDataAutocomplete($ac);
        }
        if (strlen($ac = request()->get('tipo_demanda_id')) > 0) {
            $this->registro = $this->tipoDemandaRepository->pushCriteria(AtivoCriteria::class)
                    ->getDataAutocomplete($ac);
        }

        return $this->registro;
    }

}
