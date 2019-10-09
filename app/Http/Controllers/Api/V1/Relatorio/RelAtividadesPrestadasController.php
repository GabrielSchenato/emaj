<?php

namespace Emaj\Http\Controllers\Api\V1\Relatorio;

use Emaj\Http\Controllers\RelatorioController;
use Emaj\Repositories\Cadastro\TipoDemandaRepository;
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
class RelAtividadesPrestadasController extends RelatorioController
{

    /**
     * @var TipoDemandaRepository
     */
    private $tipoDemandaRepository;

    public function __construct(TipoDemandaRepository $tipoDemandaRepository)
    {
        $this->tipoDemandaRepository = $tipoDemandaRepository;
        if (request()->isMethod('POST')) {
            $values = request()->all();

            $this->report = new Report();
            $this->report
                    ->setTitulo('Relatório das Atividades Prestadas pelo Escritório Modelo')
                    ->setTipoRelatorio((int) $values['tipo_relatorio'])
                    ->setNomeRelatorioJasper('atividades_prestadas')
                    ->setFormato($values['formato'])
                    ->addParametros([
                        'data_inicial' => $values['data_inicial'],
                        'data_final' => $values['data_final'],
                        'tipo_demanda_id' => $this->report->formatArrayToString($values['tipo_demanda_id'] ?? null, 'id'),
                        'text_tipo_demanda_id' => $this->report->formatArrayToString($values['tipo_demanda_id'] ?? null, 'dados_tipo_demanda')
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
        if (strlen($ac = request()->get('tipo_demanda_id')) > 0) {
            $this->registro = $this->tipoDemandaRepository
                    ->getDataAutocomplete($ac);
        }

        return $this->registro;
    }

}
