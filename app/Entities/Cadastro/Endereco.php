<?php

namespace Emaj\Entities\Cadastro;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Endereço
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
class Endereco extends Model
{

    protected $fillable = [
        'cep',
        'logradouro',
        'complemento',
        'gia',
        'ibge',
        'bairro',
        'localidade',
        'uf',
        'unidade',
        'endereco_local_trabalho',
        'cliente_id'
    ];

    /**
     * Pega o cliente que é dono desse Endereço.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    
}
