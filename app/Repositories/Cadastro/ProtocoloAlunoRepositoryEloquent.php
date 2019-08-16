<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\ProtocoloAluno;
use Emaj\Repositories\AbstractRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Protocolo Aluno
 *
 * PHP version 7.2
 *
 * @category   Repository
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.1.1
 */
class ProtocoloAlunoRepositoryEloquent extends AbstractRepository implements ProtocoloAlunoRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProtocoloAluno::class;
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
            'protocolo_alunos.id',
            'protocolo_alunos.protocolo_id',
            'protocolo_alunos.aluno_id',
            'alunos.nome_completo AS nome_aluno',
            'protocolo_alunos.professor_id',
            'usuarios.nome_completo AS nome_professor',
            'protocolo_alunos.data_vinculo',
            'protocolo_alunos.ativo',
        ];
        return $this->getBySearch($data)
                        ->join('alunos', 'protocolo_alunos.aluno_id', '=', 'alunos.id')
                        ->join('usuarios', 'protocolo_alunos.professor_id', '=', 'usuarios.id')
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
        if (isset($values['nome_aluno'])) {
            $criteria->whereHas('aluno', function ($criteria) use ($values) {
                $criteria->where('nome_completo', 'like', "%{$values['nome_aluno']}%");
            });
        }
        if (isset($values['nome_professor'])) {
            $criteria->whereHas('professor', function ($criteria) use ($values) {
                $criteria->where('nome_completo', 'like', "%{$values['nome_professor']}%");
            });
        }
        if (isset($values['data_vinculo'])) {
            $criteria->where('protocolo_alunos.data_vinculo', '=', $values['data_vinculo']);
        }
        if (isset($values['protocolo_id'])) {
            $criteria->where('protocolo_alunos.protocolo_id', '=', $values['protocolo_id']);
        }
        if (isset($values['ativo'])) {
            $criteria->where('protocolo_alunos.ativo', '=', (boolean) $values['ativo']);
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
            'aluno_id' => 'required|numeric',
            'professor_id' => 'required|numeric',
            'data_vinculo' => 'required|date'
        ];
    }

}
