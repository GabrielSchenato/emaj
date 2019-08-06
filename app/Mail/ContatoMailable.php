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
 * @since      1.1.0
 */
class ContatoMailable extends Mailable implements ShouldQueue
{

    use Queueable,
        SerializesModels;

    public $dados;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contato')
                        ->subject('Nova mensagem do portal do EMAJ')
                        ->from($this->dados['email'], $this->dados['nome'])
                        ->to(config('app.email'), config('app.name'));
    }

}
