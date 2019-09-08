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

    /**
     * Método responsável por buscar os registros filtrando pela palavra chave
     *
     * @param       $field
     * @param       $value
     *
     * @return mixed
     */
    public function whereLike($field, $value = null);

    /**
     * Método responsável por realizar a busca pelo valor e campo passado
     * @param array $values
     * @return mixed
     */
    public function getBySearch(array $values);

    /**
     * Método responsável por buscar os dados para a grid
     * 
     * @param int $limit
     * @param array $columns
     * @param array $order
     * @param array $data
     * 
     * @return mixed
     */
    public function getDataIndex(int $limit = 10, array $columns = ['*'], array $order = ['id', 'DESC'], array $data = []);

    /**
     * Método responsável por retornar as regras a serem aplicadas ao criar ou editar
     * um registro
     * 
     * @param array $data
     * @param int $id
     * 
     * @return array Regras para serem aplicadas
     */
    public function getRules(array $data, int $id = null);
}
