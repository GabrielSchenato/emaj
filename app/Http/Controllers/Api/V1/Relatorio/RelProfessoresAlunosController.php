<?php

namespace Emaj\Http\Controllers\Api\V1\Relatorio;

use Emaj\Criteria\ProfessorCriteria;
use Emaj\Http\Controllers\RelatorioController;
use Emaj\Repositories\Cadastro\AlunoRepository;
use Emaj\Repositories\Cadastro\UsuarioRepository;
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
class RelProfessoresAlunosController extends RelatorioController
{

    /**
     * @var AlunoRepository
     */
    private $alunoRepository;

    /**
     * @var UsuarioRepository
     */
    private $usuarioRepository;

    public function __construct(AlunoRepository $alunoRepository, UsuarioRepository $usuarioRepository)
    {
        $this->alunoRepository = $alunoRepository;
        $this->usuarioRepository = $usuarioRepository;

        if (request()->isMethod('POST')) {
            $values = request()->all();

            $this->report = new Report();
            $this->report
                    ->setTitulo('Relatório do Vínculo entre Professores e Alunos')
                    ->setNomeRelatorioJasper('vinculo_professores_alunos')
                    ->setFormato($values['formato'])
                    ->addParametros([
                        'data_inicial' => $values['data_inicial'],
                        'data_final' => $values['data_final'],
                        'ativo' => (int) $values['ativo'],
                        'professor_id' => $this->report->formatArrayToString($values['professor_id'] ?? null, 'id'),
                        'text_professor_id' => $this->report->formatArrayToString($values['professor_id'] ?? null, 'dados_usuario'),
                        'aluno_id' => $this->report->formatArrayToString($values['aluno_id'] ?? null, 'id'),
                        'text_aluno_id' => $this->report->formatArrayToString($values['aluno_id'] ?? null, 'dados_aluno')
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

        if (strlen($ac = request()->get('aluno_id')) > 0) {
            $this->registro = $this->alunoRepository
                    ->getDataAutocomplete($ac);
        }
        if (strlen($ac = request()->get('professor_id')) > 0) {
            $this->registro = $this->usuarioRepository->pushCriteria(ProfessorCriteria::class)
                    ->getDataAutocomplete($ac);
        }
        return $this->registro;
    }

}
