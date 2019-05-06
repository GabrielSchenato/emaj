<?php

namespace Emaj\Repositories\Movimento;

use Emaj\Entities\Movimento\NumeroProtocolo;
use Emaj\Repositories\AbstractRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Número Protocolo
 *
 * PHP version 7.2
 *
 * @category   Repository
 * @package    Movimento
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class NumeroProtocoloRepositoryEloquent extends AbstractRepository implements NumeroProtocoloRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return NumeroProtocolo::class;
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
        ];
    }

}
