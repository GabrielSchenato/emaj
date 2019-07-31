<?php

namespace Emaj\Http\Controllers\Institucional;

use Emaj\Http\Controllers\Controller;

/**
 * Classe responsável por gerenciar a requisições das páginas
 *
 * PHP version 7.2
 *
 * @category   Controller
 * @package    Institucional
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class ComoFuncionaController extends Controller
{

    public function comoFunciona()
    {
        return view('institucional.como_funciona');
    }

    public function outrasInformacoes()
    {
        return view('institucional.outras_informacoes');
    }
    
    public function sobreEmaj()
    {
        return view('institucional.sobre_emaj');
    }
    
    public function requisitosUtilizarServicos()
    {
        return view('institucional.requisitos_utilizar_servicos');
    }
    
    public function simularTriagem()
    {
        return view('institucional.simular_triagem');
    }

}
