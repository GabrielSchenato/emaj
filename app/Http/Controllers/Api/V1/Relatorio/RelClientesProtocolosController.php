<?php

namespace Emaj\Http\Controllers\Api\V1\Relatorio;

use Emaj\Http\Controllers\RelatorioController;
use Emaj\Repositories\Cadastro\ClienteRepository;
use Emaj\Util\Report;

/**
 * Classe responsável por gerenciar a requisições das páginas
 *
 * PHP version 7.2
 *
 * @category   Controller
 * @package    Relatorio
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      2.1.0
 */
class RelClientesProtocolosController extends RelatorioController
{

    /**
     * @var ClienteRepository
     */
    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
        if (request()->isMethod('POST')) {
            $values = request()->all();

            $this->report = new Report();
            $this->report
                    ->setTitulo('Relatório de Clientes e Protocolos')
                    ->setNomeRelatorioJasper('clientes_protocolos')
                    ->setFormato($values['formato'])
                    ->addParametros([
                        'data_inicial' => $values['data_inicial'] ?? null,
                        'data_final' => $values['data_final'] ?? null,
                        'ativo' => (int) $values['ativo'],
                        'cliente_id' => $this->report->formatArrayToString($values['cliente_id'] ?? null, 'id'),
                        'text_cliente_id' => $this->report->formatArrayToString($values['cliente_id'] ?? null, 'dados_cliente')
            ]);
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

        if (strlen($ac = request()->get('cliente_id')) > 0) {
            $this->registro = $this->clienteRepository
                    ->getDataAutocomplete($ac);
        }
        return $this->registro;
    }

}
