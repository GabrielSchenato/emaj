<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\TipoDemanda;
use Emaj\Repositories\AbstractRepository;
use Emaj\Repositories\Cadastro\TipoDemandaRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Tipo Demanda
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
class TipoDemandaRepositoryEloquent extends AbstractRepository implements TipoDemandaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoDemanda::class;
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
            'nome' => 'required|min:5|max:50'
        ];
    }
}