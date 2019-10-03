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

    public static function compressImage(UploadedFile $imageUrl, $quality)
    {
        switch ($imageUrl->getMimeType()) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($imageUrl);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($imageUrl);
                break;
            case 'image/png':
                $image = imagecreatefrompng($imageUrl);
                break;
            default:
                break;
        }
        imagejpeg($image, $imageUrl->getRealPath(), $quality);
        return new UploadedFile($imageUrl->getRealPath(), $imageUrl->getClientOriginalName(), 'jpeg');
    }
    
    /**
     * Formata bytes para kb, mb, gb, tb
     *
     * @param  int $size
     * @param  int $precision
     * @return int
     */
    public static function formatBytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        }
        return $size;
    }

}
