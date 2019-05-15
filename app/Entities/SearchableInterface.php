<?php

namespace Emaj\Entities;

/**
 * Searchable interface responsável por gerenciar os contratos de busca do model
 *
 * PHP version 7.2
 *
 * @category   Interface
 * @package    Entities
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
interface SearchableInterface
{

    /**
     * Método responsável por retornar os campos que poderam ser
     * buscados na pesquisa
     * 
     * @return array
     */
    public function searchableArray();
}
