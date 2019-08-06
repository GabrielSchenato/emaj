<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Repositories\RepositoryInterface;

/**
 * Repository interface responsável por gerenciar a entidade Avaliação
 *
 * PHP version 7.2
 *
 * @category   Interface
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.1.0
 */
interface AvaliacaoRepository extends RepositoryInterface
{

    /**
     * Método responsável por pegar todas as avaliações por aluno
     * 
     * @param int $idAluno
     * @param array $relationships
     * @return mixed
     */
    public function getAvaliacoesByAluno(int $idAluno, array $relationships = []);
}
