<?php

namespace Emaj\Util;

/**
 * Classe responsável pelos tipos de casas cadastraveis na plataforma.
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
class TiposCasa
{

    const ALUGADA = 'Alugada';
    const PROPRIA = 'Própria';
    const CEDIDA = 'Cedida';

    /**
     * @var array
     */
    private static $valores = [
        self::ALUGADA,
        self::PROPRIA,
        self::CEDIDA
    ];

    /**
     * Método responsável por retornar a lista de casas.
     * 
     * @return string
     */
    public static function getTiposCasa()
    {
        return self::$valores;
    }

}
