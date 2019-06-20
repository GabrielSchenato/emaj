<?php

namespace Emaj\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Classe AlunoCriteria
 *
 * PHP version 7.2
 *
 * @category   Criteria
 * @package    Criteria
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class MesCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->whereRaw('EXTRACT(YEAR_MONTH  FROM created_at) = EXTRACT(YEAR_MONTH  FROM now())' );
        return $model;
    }
}
