<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Criteria\AlunoCriteria;
use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\AlunoRepository;
use Emaj\Repositories\Cadastro\ProtocoloAlunoRepository;

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
     * @var ProtocoloAlunoRepository
     */
    private $protocoloAlunoRepository;
    protected $relationships = [
        'avaliacoes.avaliador:id,nome_completo',
        'ficha_triagens_aluno.cliente:id,nome_completo,representado_assistido',
        'ficha_triagens_aluno.professor:id,nome_completo',
        'ficha_triagens_aluno:id,aluno_id,cliente_id,professor_id,protocolo,numero_processo,ativo,outras_informacoes,created_at',
        'avaliacoes.ficha_triagem:id,cliente_id,parte_contraria_id,tipo_demanda_id,protocolo,numero_processo,created_at',
        'avaliacoes.ficha_triagem.cliente:id,nome_completo,representado_assistido,cpf,rg,renda'
    ];
    protected $repository;

    public function __construct(AlunoRepository $repository, ProtocoloAlunoRepository $protocoloAlunoRepository)
    {
        $this->repository = $repository;
        $this->protocoloAlunoRepository = $protocoloAlunoRepository;
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
            $this->registro = $this->protocoloAlunoRepository
                    ->pushCriteria(new AlunoCriteria($idAluno))
                    ->getDataAutocomplete($ac, [
                        'protocolo',
                        'protocolo.cliente',
                    ]);
        }
        return $this->registro;
    }

}
