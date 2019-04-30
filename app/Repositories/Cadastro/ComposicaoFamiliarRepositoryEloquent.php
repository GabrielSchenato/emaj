<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\ComposicaoFamiliar;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Repository responsável por gerenciar a entidade Composição Familiar
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
class ComposicaoFamiliarRepositoryEloquent extends BaseRepository implements ComposicaoFamiliarRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ComposicaoFamiliar::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

//    public static function getRules($data)
//    {
//        return [
//            'renda' => 'required|numeric'
//        ];
//    }
}
