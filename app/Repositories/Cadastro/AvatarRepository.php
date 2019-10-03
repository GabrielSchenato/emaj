<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Repositories\RepositoryInterface;

/**
 * Repository interface responsável por gerenciar a entidade Avatar
 *
 * PHP version 7.2
 *
 * @category   Interface
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      2.1.0
 */
interface AvatarRepository extends RepositoryInterface
{

    /**
     * Método responsável por verificar se é para criar ou atualizar um avatar.
     * 
     * @param array $attributes
     * @return array
     */
    public function saveOrUpdateAvatar(array &$attributes);
}
