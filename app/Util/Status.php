<?php

namespace Emaj\Util;

/**
 * Classe responsável pelos Status.
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
class Status
{

    const AJUIZADO = 'Ajuizado';
    const NAO_AJUIZADO = 'Não Ajuizado';

    /**
     * @var array
     */
    private static $valores = [
        self::AJUIZADO,
        self::NAO_AJUIZADO
    ];

    /**
     * Método responsável por retornar a lista de status.
     * 
     * @return string
     */
    public static function getTiposStatus()
    {
        return self::$valores;
    }

}
