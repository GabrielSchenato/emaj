<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Criteria\AlunoCriteria;
use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\AlunoRepository;
use Emaj\Repositories\Cadastro\DisciplinaRepository;
use Emaj\Repositories\Cadastro\ProtocoloAlunoProfessorRepository;

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
     * @var DisciplinaRepository
     */
    private $disciplinaRepository;

    /**
     * @var ProtocoloAlunoProfessorRepository
     */
    private $protocoloAlunoProfessorRepository;

    /**
     * Armazena os relacionamentos.
     * 
     * @var array 
     */
    protected $relationships = [
        'avaliacoes.avaliador:id,nome_completo',
        'protocolo_alunos_professores.protocolo:id,cliente_id,protocolo,numero_processo,observacoes,ativo',
        'protocolo_alunos_professores.protocolo.cliente:id,nome_completo,representado_assistido,cpf,rg,renda',
        'protocolo_alunos_professores.professor:id,nome_completo',
        'avaliacoes.protocolo:id,cliente_id,parte_contraria_id,tipo_demanda_id,protocolo,numero_processo,created_at',
        'avaliacoes.protocolo.cliente:id,nome_completo,representado_assistido,cpf,rg,renda',
        'disciplina:id,nome'
    ];

    /**
     * @var AlunoRepository 
     */
    protected $repository;

    public function __construct(AlunoRepository $repository, ProtocoloAlunoProfessorRepository $protocoloAlunoProfessorRepository, DisciplinaRepository $disciplinaRepository)
    {
        $this->repository = $repository;
        $this->protocoloAlunoProfessorRepository = $protocoloAlunoProfessorRepository;
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
        if (strlen($ac = request()->get('protocolo_id')) > 0) {
            $idAluno = request()->get('aluno_id');
            $this->registro = $this->protocoloAlunoProfessorRepository
                    ->pushCriteria(new AlunoCriteria($idAluno))
                    ->getDataAutocomplete($ac, [
                'protocolo',
                'protocolo.cliente',
            ]);
        }
        if (strlen($ac = request()->get('disciplina_id')) > 0) {
            $this->registro = $this->disciplinaRepository
                    ->getDataAutocomplete($ac);
        }
        return $this->registro;
    }

}
