<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Repositories\RepositoryInterface;

/**
 * Repository interface responsável por gerenciar a entidade Protocolo Aluno
 *
 * PHP version 7.2
 *
 * @category   Interface
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      2.0.0
 */
interface ProtocoloAlunoRepository extends RepositoryInterface
{

    /**
     * Método responsável por buscar os dados e retornar para o autocomplete
     * 
     * @param string $value
     * @param array $relationships
     */
    public function getDataAutocomplete($value, array $relationships = []);
}
