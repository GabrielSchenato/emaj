<?php

namespace Emaj\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface as RepositoryPrettusInterface;

/**
 * Repository interface responsável por gerenciar os contratos
 *
 * PHP version 7.2
 *
 * @category   Interface
 * @package    Repositories
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
interface RepositoryInterface extends RepositoryPrettusInterface
{

    /**
     * Método responsável por fazer a contagem de um model
     * @return int
     */
    public function count();

    /**
     * Método responsável por trazer todos os registros ativos
     * @param array $columns
     *
     * @return mixed
     */
    public function allAtivo($columns = ['*']);
}
