<?php

namespace Emaj\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Classe responsável por gerenciar o envio de email
 *
 * PHP version 7.2
 *
 * @category   Mail
 * @package    Mail
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class EdicaoUsuarioMailable extends Mailable implements ShouldQueue
{

    use Queueable,
        SerializesModels;

    public $usuario;
    public $plainPassword;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($usuario, $plainPassword)
    {
        $this->usuario = $usuario;
        $this->plainPassword = $plainPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.edicao_usuario')->subject('Redefinição de senha no portal do EMAJ');
    }

}
