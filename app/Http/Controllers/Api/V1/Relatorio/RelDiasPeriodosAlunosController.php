<?php

namespace Emaj\Http\Controllers\Api\V1\Relatorio;

use Emaj\Criteria\AtivoCriteria;
use Emaj\Http\Controllers\RelatorioController;
use Emaj\Repositories\Cadastro\AlunoRepository;
use Emaj\Repositories\Cadastro\DiaPeriodoRepository;
use Emaj\Repositories\Cadastro\DisciplinaRepository;
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
class RelDiasPeriodosAlunosController extends RelatorioController
{

    /**
     * @var DisciplinaRepository
     */
    private $disciplinaRepository;

    /**
     * @var DiaPeriodoRepository
     */
    private $diaPeriodoRepositoy;

    /**
     * @var AlunoRepository
     */
    private $alunoRepository;

    public function __construct(AlunoRepository $alunoRepository, DiaPeriodoRepository $diaPeriodoRepositoy, DisciplinaRepository $disciplinaRepository)
    {
        $this->alunoRepository = $alunoRepository;
        $this->diaPeriodoRepositoy = $diaPeriodoRepositoy;

        if (request()->isMethod('POST')) {
            $values = request()->all();

            $this->report = new Report();
            $this->report
                    ->setTitulo('Relatório de Dias e Períodos dos Alunos')
                    ->setNomeRelatorioJasper('dia_periodo_alunos')
                    ->setFormato($values['formato'])
                    ->addParametros([
                        'text_disciplina_id' => $this->report->formatArrayToString($values['disciplina_id'] ?? null, 'dados_disciplina'),
                        'disciplina_id' => $this->report->formatArrayToString($values['disciplina_id'] ?? null, 'id'),
                        'dia_periodo_id' => $this->report->formatArrayToString($values['dia_periodo_id'] ?? null, 'id'),
                        'text_dia_periodo_id' => $this->report->formatArrayToString($values['dia_periodo_id'] ?? null, 'dados_dia_periodo'),
                        'aluno_id' => $this->report->formatArrayToString($values['aluno_id'] ?? null, 'id'),
                        'text_aluno_id' => $this->report->formatArrayToString($values['aluno_id'] ?? null, 'dados_aluno')
            ]);
        }
        $this->disciplinaRepository = $disciplinaRepository;
    }

    /**
     * Retorna todos os dados para os autocomplete
     * 
     * @return array
     */
    public function autocomplete()
    {
        $this->registro = [];

        if (strlen($ac = request()->get('aluno_id')) > 0) {
            $this->registro = $this->alunoRepository->pushCriteria(AtivoCriteria::class)
                    ->getDataAutocomplete($ac);
        }
        if (strlen($ac = request()->get('dia_periodo_id')) > 0) {
            $this->registro = $this->diaPeriodoRepositoy
                    ->getDataAutocomplete($ac);
        }
        if (strlen($ac = request()->get('disciplina_id')) > 0) {
            $this->registro = $this->disciplinaRepository
                    ->getDataAutocomplete($ac);
        }
        return $this->registro;
    }

}
