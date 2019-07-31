<?php

namespace Emaj\Util;

/**
 * Classe responsável por conter alguns métodos reutilizaveis.
 *
 * PHP Version 7.2
 *
 * @category Util
 * @package  Util
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.1.0
 */
class Functions
{

    /**
     * Método responsável por formatar o valor passado para a moeda
     * brasileira.
     * 
     * @param $value
     * @return string
     */
    public static function getMoedaFormatadaReal($value)
    {
        return number_format($value, 2, ',', '.');
    }

}
