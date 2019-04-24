<?php

namespace Emaj\Observers\Cadastro;

use Emaj\Entities\Cadastro\Usuario;
use Illuminate\Support\Facades\Hash;

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
    public function saving(Usuario $user)
    {
        if (request()->hasFile('image_url')) {
            $data = request()->all();
            $user->avatar = $this->convertImageBinary($data['image_url']);
        }
        $user->password = Hash::make(request()->get('password'));
    }

    protected function convertImageBinary($image)
    {
        $binary = file_get_contents($image);
        $avatar = base64_encode($binary);
        return $avatar;
    }

}
