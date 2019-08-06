<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\ParametroTriagem;
use Emaj\Repositories\AbstractRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Parametro Triagem
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
class ParametroTriagemRepositoryEloquent extends AbstractRepository implements ParametroTriagemRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ParametroTriagem::class;
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
     * Save a new entity in repository
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        $parametrosTriagem = $this->first() ? $this->first()->toArray() : $attributes;
        return $this->updateOrCreate($parametrosTriagem, $attributes);
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
            'renda' => 'required|numeric'
        ];
    }

}
