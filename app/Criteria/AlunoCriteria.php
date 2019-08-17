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
 * @since      2.0.0
 */
class AlunoCriteria implements CriteriaInterface
{

    /**
     * @var int
     */
    private $idAluno;

    public function __construct(int $idAluno)
    {
        $this->idAluno = $idAluno;
    }

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
        $model = $model->where('aluno_id', '=', $this->idAluno);
        return $model;
    }

}
