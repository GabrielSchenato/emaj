<?php

namespace Emaj\Http\Controllers\Portal;

use Emaj\Http\Controllers\Controller;

/**
 * Classe responsável por gerenciar a requisições das páginas
 *
 * 
 *
 * PHP version 7.1
 *
 * @category   Controller
 * @package    Portal
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */

class PortalController extends Controller
{

    /**
     * Mostra a página login do portal
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('portal.home');
    }
}
