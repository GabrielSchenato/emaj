<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\ProtocoloAlunoProfessor;
use Emaj\Repositories\AbstractRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Protocolo Aluno Professor
 *
 * PHP version 7.2
 *
 * @category   Repository
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      2.0.0
 */
class ProtocoloAlunoProfessorRepositoryEloquent extends AbstractRepository implements ProtocoloAlunoProfessorRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProtocoloAlunoProfessor::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Método responsável por buscar os dados para a grid
     * 
     * @param int $limit
     * @param array $columns
     * @param array $order
     * @param array $data
     * 
     * @return mixed
     */
    public function getDataIndex(int $limit = 10, array $columns = ['*'], array $order = ['id', 'desc'], array $data = [])
    {
        $columns = [
            'protocolo_alunos_professores.id',
            'protocolo_alunos_professores.protocolo_id',
            'protocolo_alunos_professores.aluno_id',
            'alunos.nome_completo AS nome_aluno',
            'protocolo_alunos_professores.professor_id',
            'usuarios.nome_completo AS nome_professor',
            'protocolo_alunos_professores.data_vinculo',
            'protocolo_alunos_professores.ativo',
        ];
        return $this->getBySearch($data)
                        ->join('alunos', 'protocolo_alunos_professores.aluno_id', '=', 'alunos.id')
                        ->join('usuarios', 'protocolo_alunos_professores.professor_id', '=', 'usuarios.id')
                        ->orderBy($order[0], $order[1])
                        ->paginate($limit, $columns);
    }

    /**
     * Método responsável por realizar a busca pelo valor e campo passado
     * @param array $values
     * @return mixed
     */
    public function getBySearch(array $values)
    {
        $criteria = $this->model->newQuery();
        if (isset($values['aluno_id'])) {
            $criteria->whereHas('aluno', function ($criteria) use ($values) {
                $criteria->where('nome_completo', 'like', "%{$values['aluno_id']}%")
                        ->orWhere('id', '=', (int) $values['aluno_id']);
            });
        }
        if (isset($values['professor_id'])) {
            $criteria->whereHas('professor', function ($criteria) use ($values) {
                $criteria->where('nome_completo', 'like', "%{$values['professor_id']}%")
                        ->orWhere('id', '=', (int) $values['professor_id']);
            });
        }
        if (isset($values['data_vinculo'])) {
            $criteria->where('protocolo_alunos_professores.data_vinculo', '=', $values['data_vinculo']);
        }
        if (isset($values['protocolo_id'])) {
            $criteria->where('protocolo_alunos_professores.protocolo_id', '=', $values['protocolo_id']);
        }
        if (isset($values['ativo'])) {
            $criteria->where('protocolo_alunos_professores.ativo', '=', (boolean) $values['ativo']);
        }

        return $criteria;
    }

    /**
     * Método responsável por buscar os dados e retornar para o autocomplete
     * 
     * @param string $value
     * @param array $relationships
     */
    public function getDataAutocomplete($value, array $relationships = [])
    {
        $this->applyCriteria();
        $criteria = $this->model->newQuery();

        $criteria->where(function ($query) use ($value) {
            $query->whereHas('protocolo', function ($subquery ) use ($value) {
                $subquery->whereHas('cliente', function ($subquery ) use ($value) {
                            $subquery->where('nome_completo', 'like', "%{$value}%")
                            ->orWhere('representado_assistido', 'like', "%{$value}%");
                        })
                        ->orWhere('protocolo', 'like', "%{$value}%")
                        ->orWhere('numero_processo', 'like', "%{$value}%");
            });
        });

        return $criteria->orderBy('created_at', 'desc')
                        ->limit(10)
                        ->with($relationships)
                        ->get();
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
            'aluno_id' => 'required|numeric',
            'professor_id' => 'required|numeric',
            'data_vinculo' => 'required|date'
        ];
    }

}
