<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\Avaliacao;
use Emaj\Repositories\AbstractRepository;
use Illuminate\Validation\Rule;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Avaliação
 *
 * PHP version 7.2
 *
 * @category   Repository
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.1.0
 */
class AvaliacaoRepositoryEloquent extends AbstractRepository implements AvaliacaoRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Avaliacao::class;
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
            'aluno_id' => 'required|numeric',
            'ficha_triagem_id' => 'required|numeric',
            'avaliador_id' => 'required|numeric',
            'data' => 'required|date',
            'observacoes' => 'required'
        ];
    }

}
