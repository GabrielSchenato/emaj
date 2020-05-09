<?php

namespace Emaj\Util;

/**
 * Classe responsável pelas regras de acesso da plataforma.
 *
 * PHP Version 7.2
 *
 * @category   Util
 * @package    Util
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.1.0
 */
class Roles
{

    const ADMIN = 'admin';
    const SECRETARIA = 'secretaria';

    /**
     * @var array
     */
    private static $valores = [
        self::ADMIN,
        self::SECRETARIA
    ];

    /**
     * Método responsável por retornar a lista de regras.
     * 
     * @return array
     */
    public static function getRoles()
    {
        return self::$valores;
    }
}
