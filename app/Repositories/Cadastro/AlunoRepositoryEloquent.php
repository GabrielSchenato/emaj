<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\Aluno;
use Emaj\Repositories\AbstractRepository;
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

    public static function getRules($data)
    {
        $id = isset($data['id']) ? $data['id'] : null;
        return [
            'nome_completo' => 'required|min:5',
            'email' => ['nullable', 'email', Rule::unique('alunos')->ignore($id)]
        ];
    }

}
