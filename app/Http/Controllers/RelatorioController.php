<?php

namespace Emaj\Http\Controllers;

use Emaj\Http\Controllers\Controller;
use Emaj\Util\Report;

/**
 * Classe responsável por gerenciar as páginas de relatórios
 *
 * PHP version 7.2
 *
 * @category   Controller
 * @package    Util
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      2.1.0
 */
class RelatorioController extends Controller
{

    /**
     *
     * @var Report 
     */
    protected $report;

    /**
     * Método responsável por chamar a geração do relatório.
     * 
     * @return mixed
     */
    public function __invoke()
    {
        return $this->report->generateReport();
    }

}
