<?php

namespace Emaj\Util;

/**
 * Classe responsável pelos Tipos de Relatórios.
 *
 * PHP Version 7.2
 *
 * @category   Util
 * @package    Util
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      2.1.0
 */
class TipoRelatorio
{

    const SINTETICO = 1;
    const SINTETICO_DESC = 'Sintético';
    //
    const ANALITICO = 2;
    const ANALITICO_DESC = 'Analítico';

    /**
     * @var array
     */
    private static $valores = [
        self::SINTETICO => self::SINTETICO_DESC,
        self::ANALITICO => self::ANALITICO_DESC
    ];

    /**
     * Método responsável por retornar a lista de tipos de relatórios.
     * 
     * @return string
     */
    public static function getTiposRelatorios()
    {
        return self::$valores;
    }

    /**
     * Método responsável por retornar a string correspondente ao ID.
     * 
     * @param int $key id
     * @return string
     */
    public static function getTipoStr($key)
    {
        if (isset(self::$valores[$key])) {
            return self::$valores[$key];
        }
    }

}
