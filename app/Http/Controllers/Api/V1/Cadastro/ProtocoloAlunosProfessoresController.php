<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Criteria\AtivoCriteria;
use Emaj\Criteria\ProfessorCriteria;
use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\AlunoRepository;
use Emaj\Repositories\Cadastro\ProtocoloAlunoProfessorRepository;
use Emaj\Repositories\Cadastro\UsuarioRepository;

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
class ProtocoloAlunosProfessoresController extends CrudController
{

    /**
     * @var UsuarioRepository
     */
    private $usuarioRepository;

    /**
     * @var AlunoRepository
     */
    private $alunoRepository;
    protected $repository;
    protected $relationships = [
        'aluno:id,nome_completo',
        'professor:id,nome_completo'];

    public function __construct(ProtocoloAlunoProfessorRepository $repository, AlunoRepository $alunoRepository, UsuarioRepository $usuarioRepository)
    {
        $this->repository = $repository;
        $this->alunoRepository = $alunoRepository;
        $this->usuarioRepository = $usuarioRepository;
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
        if (strlen($ac = request()->get('professor_id')) > 0) {
            $this->registro = $this->usuarioRepository->pushCriteria(ProfessorCriteria::class)
                    ->pushCriteria(AtivoCriteria::class)
                    ->getDataAutocomplete($ac);
        }
        return $this->registro;
    }

}
