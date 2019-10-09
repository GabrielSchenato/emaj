<?php

namespace Emaj\Util;

/**
 * Classe responsável pelos Formatos Relatório.
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
class FormatoRelatorio
{

    const PDF = 'pdf';
    const PDF_DESC = 'PDF';
    //
    const XLSX = 'xlsx';
    const XLSX_DESC = 'XLSX';
    //
    const DOCX = 'docx';
    const DOCX_DESC = 'DOCX';
    //
    const PPTX = 'pptx';
    const PPTX_DESC = 'PPTX';
    //
    const XHTML = 'xhtml';
    const XHTML_DESC = 'XHTML';
    //
    const RTF = 'rtf';
    const RTF_DESC = 'RTF';
    //
    const ODT = 'odt';
    const ODT_DESC = 'ODT';
    //
    const HTML = 'html';
    const HTML_DESC = 'HTML';
    //
    const XLS = 'xls';
    const XLS_DESC = 'XLS';
    //
    const XML = 'xml';
    const XML_DESC = 'XML';
    //
    const JRPRINT = 'jrprint';
    const JRPRINT_DESC = 'JRPRINT';
    //
    const CSV = 'csv';
    const CSV_DESC = 'CSV';

    /**
     * @var array
     */
    private static $valores = [
        self::PDF => self::PDF_DESC,
        self::XLSX => self::XLSX_DESC,
        self::DOCX => self::DOCX_DESC,
        self::PPTX => self::PPTX_DESC,
        self::XHTML => self::XHTML_DESC,
        self::RTF => self::RTF_DESC,
        self::ODT => self::ODT_DESC,
        self::HTML => self::HTML_DESC,
        self::XLS => self::XLS_DESC,
        self::XML => self::XML_DESC,
        self::JRPRINT => self::JRPRINT_DESC,
        self::CSV => self::CSV_DESC
    ];

    /**
     * Método responsável por retornar a lista de formatos.
     * 
     * @return string
     */
    public static function getFormatosRelatorios()
    {
        return self::$valores;
    }

    /**
     * Método responsável por retornar a string correspondente ao ID.
     * 
     * @param string $key id
     * @return string
     */
    public static function getFormatoStr($key)
    {
        if (isset(self::$valores[$key])) {
            return self::$valores[$key];
        }
    }

}
