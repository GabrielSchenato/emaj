<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Criteria\AtivoCriteria;
use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\ClienteRepository;
use Emaj\Repositories\Cadastro\ProtocoloRepository;
use Emaj\Repositories\Cadastro\TipoDemandaRepository;
use Emaj\Util\Report;

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
 * @since      2.0.0
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

    /**
     * @var ProtocoloRepository 
     */
    protected $repository;

    /**
     * Armazena os relacionamentos.
     * 
     * @var array 
     */
    protected $relationships = [
        'tipo_demanda:id,nome',
        'parte_contraria:id,nome_completo,representado_assistido,cpf,rg,renda'
    ];

    public function __construct(ProtocoloRepository $repository, TipoDemandaRepository $tipoDemandaRepository, ClienteRepository $clienteRepository)
    {
        $this->repository = $repository;
        $this->tipoDemandaRepository = $tipoDemandaRepository;
        $this->clienteRepository = $clienteRepository;
    }

    /**
     * Método responsável por gerar a impressão da Ficha de Triagem
     * 
     * @return mixed
     */
    public function imprimirFichaTriagem()
    {
        if (request()->isMethod('POST')) {
            $values = request()->all();
            return (new Report())->setTitulo('Ficha de Triagem')
                            ->setNomeRelatorioJasper('ficha_triagem')
                            ->addParametros([
                                'cliente_id' => $values['cliente_id'],
                                'parte_contraria_id' => $values['parte_contraria_id'],
                                'protocolo_id' => $values['protocolo_id']
                            ])->generateReport();
        }
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
