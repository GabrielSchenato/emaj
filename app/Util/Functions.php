<?php

namespace Emaj\Util;

use Illuminate\Http\UploadedFile;

/**
 * Classe responsável por conter alguns métodos reutilizaveis.
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

    /**
     * Método responsável por convertar uma arquivo para binário
     * 
     * @param UploadedFile $file
     * @return string
     */
    public static function convertFileBinary($file)
    {
        $binary = file_get_contents($file->getRealPath());
        $binaryBase64Encode = base64_encode($binary);
        return $binaryBase64Encode;
    }

    /**
     * Método responsável por pegar o nome do arquivo sem extensão.
     * 
     * @param UploadedFile $file
     * @return string
     */
    public static function getNomeArquivoSemExtensao($file)
    {
        return basename($file->getClientOriginalName(), '.' . $file->getClientOriginalExtension());
    }

}
