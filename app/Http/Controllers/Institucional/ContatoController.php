<?php

namespace Emaj\Http\Controllers\Institucional;

use Emaj\Http\Controllers\Controller;
use Emaj\Mail\ContatoMailable;
use Illuminate\Support\Facades\Mail;

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
class ContatoController extends Controller
{

    public function __invoke()
    {
        return view('institucional.contato');
    }

    public function contatoEnviar()
    {
        $this->validate(request(), [
            'nome' => 'required',
            'email' => 'required|email',
            'assunto' => 'required',
            'mensagem' => 'required'
        ]);
        
        Mail::send(new ContatoMailable(request()->all()));
        return back()->with('success', 'Obrigado por nos contatar!');
    }

}
