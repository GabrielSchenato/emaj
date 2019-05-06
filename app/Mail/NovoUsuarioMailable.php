<?php

namespace Emaj\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NovoUsuarioMailable extends Mailable implements ShouldQueue
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
        return $this->markdown('emails.novo_usuario')->subject('Conta criada no portal do EMAJ');
    }

}
