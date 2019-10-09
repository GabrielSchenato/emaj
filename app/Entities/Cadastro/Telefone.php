<?php

namespace Emaj\Entities\Cadastro;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Telefone
 *
 * PHP version 7.2
 *
 * @category   Entity
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class Telefone extends Model
{

    /**
     * Armazena os campos do banco de dados.
     * 
     * @var array 
     */
    protected $fillable = [
        'tipo',
        'descricao',
        'telefone',
        'cliente_id'
    ];

    /**
     * Pega o cliente que é dono desse Telefone.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

}
