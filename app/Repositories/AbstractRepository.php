<?php

namespace Emaj\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

/**
 * AbstractRepository responsável por gerenciar a camada de banco de dados
 *
 * PHP version 7.2
 *
 * @category   Abstract
 * @package    Repositories
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
abstract class AbstractRepository extends BaseRepository
{
    /**
     * Método responsável por fazer a contagem de um model
     * @return int
     */
    public function count()
    {
        $this->applyCriteria();
        return $this->model->count();
    }
}
