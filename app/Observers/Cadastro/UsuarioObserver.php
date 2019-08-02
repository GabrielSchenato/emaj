<?php

namespace Emaj\Observers\Cadastro;

use Emaj\Entities\Cadastro\Usuario;

/**
 * Classe responsável por modificar a entidade usuário quando necessário
 *
 * PHP version 7.2
 *
 * @category   Observer
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class UsuarioObserver
{

    public function saving(Usuario $usuario)
    {
        if (!empty(request()->get('password'))) {
            $usuario->password = bcrypt(request()->get('password'));
        }
    }

}
