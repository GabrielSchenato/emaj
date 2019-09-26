<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\DiaPeriodoAluno;
use Emaj\Repositories\AbstractRepository;
use Illuminate\Validation\Rule;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Dia Período Aluno
 *
 * PHP version 7.2
 *
 * @category   Repository
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      2.1.0
 */
class DiaPeriodoAlunoRepositoryEloquent extends AbstractRepository implements DiaPeriodoAlunoRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DiaPeriodoAluno::class;
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
            'dia_periodo_alunos.id',
            'dia_periodo_alunos.aluno_id',
            'dia_periodo_alunos.dia_periodo_id',
            'dia_periodo_alunos.created_at',
            'dia_periodos.nome'
        ];
        return $this->getBySearch($data)
                        ->join('dia_periodos', 'dia_periodo_alunos.dia_periodo_id', '=', 'dia_periodos.id')
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
        if (isset($values['dia_periodo_id'])) {
            $criteria->whereHas('dia_periodo', function ($criteria) use ($values) {
                $criteria->where('nome', 'like', "%{$values['dia_periodo_id']}%")
                        ->orWhere('id', '=', (int) $values['dia_periodo_id']);
            });
        }
        if (isset($values['created_at'])) {
            $criteria->where('dia_periodo_alunos.created_at', '=', $values['created_at']);
        }

        if (isset($values['aluno_id'])) {
            $criteria->where('aluno_id', '=', (int) $values['aluno_id']);
        }

        return $criteria;
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
            'dia_periodo_id' => ['required', 'numeric', Rule::unique('dia_periodo_alunos')->where(function ($query) use($data) {
                            return $query->where('dia_periodo_id', $data['dia_periodo_id'])
                                            ->where('aluno_id', $data['aluno_id']);
                        })],
            'aluno_id' => ['required', 'numeric']
        ];
    }

}
