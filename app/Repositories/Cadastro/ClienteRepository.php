<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Repositories\RepositoryInterface;

/**
 * Repository interface responsável por gerenciar a entidade Cliente
 *
 * PHP version 7.2
 *
 * @category   Interface
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
interface ClienteRepository extends RepositoryInterface
{

    /**
     * Método responsável por o número de pré atendimentos no mês
     * 
     * @return int
     */
    public function getPreAtendimentosMes();

    /**
     * Método responsável por buscar os dados e retornar para o autocomplete
     * 
     * @param string $value
     */
    public function getDataAutocomplete($value);

    /**
     * Método responsável por buscar os clientes vinculados a um determinado aluno.
     * 
     * @param int $IdAluno
     * @param array $columns
     * @return array
     */
    public function getClientesByAluno(int $IdAluno, array $columns = ['*']);
}
