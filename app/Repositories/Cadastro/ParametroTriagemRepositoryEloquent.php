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
    
    public static function getRules($data)
    {
        return [
            'renda' => 'required|numeric'
        ];
    }
}
