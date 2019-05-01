<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\TipoStatus;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Repository responsável por gerenciar a entidade Tipo Status
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
class TipoStatusRepositoryEloquent extends BaseRepository implements TipoStatusRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoStatus::class;
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
            'nome' => 'required|min:5|max:30'
        ];
    }
}
