<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\Aluno;
use Emaj\Exceptions\ValidationException;
use Emaj\Repositories\AbstractRepository;
use Exception;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Aluno
 *
 * PHP version 7.2
 *
 * @category   Repository
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class AlunoRepositoryEloquent extends AbstractRepository implements AlunoRepository
{

    /**
     * @var ProtocoloAlunoProfessorRepository
     */
    private $protocoloAlunoProfessorRepository;

    public function __construct(Container $app, ProtocoloAlunoProfessorRepository $protocoloAlunoProfessorRepository)
    {
        parent::__construct($app);
        $this->protocoloAlunoProfessorRepository = $protocoloAlunoProfessorRepository;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Aluno::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @override
     * Update a entity in repository by id
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        try {
            $this->inativaProtocoloAlunosProfessores($attributes, $id);
            $aluno = parent::update($attributes, $id);
            DB::commit();
            return $aluno;
        } catch (ValidationException $ex) {
            DB::rollback();
            throw $ex;
        } catch (Exception $ex) {
            DB::rollback();
            throw $ex;
        }
    }

    /**
     * Método responsável por retornar as regras a serem aplicadas ao criar ou editar
     * um registro
     * 
     * @param array $data
     * @param int $id
     * 
     * @return array Regras para serem aplicadas
     */
    public function getRules(array $data, int $id = null)
    {
        return [
            'nome_completo' => 'required|min:5',
            'email' => ['nullable', 'email', Rule::unique('alunos')->ignore($id)]
        ];
    }

    /**
     * Método responsável por realizar a busca pelo valor e campo passado
     * @param array $values
     * @return mixed
     */
    public function getBySearch(array $values)
    {
        $criteria = $this->model->newQuery();
        if (isset($values['id'])) {
            $criteria->where('id', '=', (int) $values['id']);
        }
        if (isset($values['nome_completo'])) {
            $criteria->where('nome_completo', 'like', "%{$values['nome_completo']}%");
        }
        if (isset($values['email'])) {
            $criteria->where('email', 'like', "%{$values['email']}%");
        }
        if (isset($values['celular'])) {
            $criteria->where('celular', 'like', "%{$values['celular']}%");
        }
        if (isset($values['matricula'])) {
            $criteria->where('matricula', 'like', "%{$values['matricula']}%");
        }
        if (isset($values['ativo'])) {
            $criteria->where('ativo', '=', (boolean) $values['ativo']);
        }

        return $criteria;
    }

    /**
     * Método responsável por buscar os dados e retornar para o autocomplete
     * 
     * @param string $value
     */
    public function getDataAutocomplete($value)
    {
        return $this->whereLike('nome_completo', $value)
                        ->orderBy('nome_completo', 'asc')
                        ->limit(10)
                        ->get(['id', 'nome_completo']);
    }

    /**
     * Método responsável por inativar os protocolos alunos professores quando o protocolo
     * está sendo inativado
     *
     * @param array $attributes
     * @param       $id
     *
     * @return void
     */
    private function inativaProtocoloAlunosProfessores(array $attributes, $id)
    {
        $ativo = isset($attributes['ativo']) ? $attributes['ativo'] : null;

        if (!$ativo) {
            $protocoloAlunosProfessores = $this->protocoloAlunoProfessorRepository->findByField('aluno_id', (int) $id);
            foreach ($protocoloAlunosProfessores as $protocoloAlunoProfessor) {
                $protocoloAlunoProfessor->ativo = false;
                $this->protocoloAlunoProfessorRepository->update($protocoloAlunoProfessor->toArray(), $protocoloAlunoProfessor->id);
            }
        }
    }

}
