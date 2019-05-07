<?php

namespace Emaj\Entities\Cadastro;

use Emaj\Entities\Movimento\FichaTriagem;
use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Cliente
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
class Cliente extends Model
{

    protected $fillable = [
        'pre_atendimento',
        'nome_completo',
        'representado_assistido',
        'cpf',
        'rg',
        'profissao',
        'sexo',
        'estado_civil',
        'email',
        'renda',
        'local_trabalho',
        'nacionalidade_id',
        'ativo',
    ];

    /**
     * Pega o Endereço associado ao cliente.
     */
    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }

    /**
     * Pega a Composição Familiar associada ao cliente.
     */
    public function composicao_familiar()
    {
        return $this->hasOne(ComposicaoFamiliar::class);
    }

    /**
     * Pega todos os Telefones associados ao cliente.
     */
    public function telefones()
    {
        return $this->hasMany(Telefone::class);
    }
    
    /**
     * Pega todas as Ficha de Triagens associados ao cliente.
     */
    public function ficha_triagens_cliente()
    {
        return $this->hasMany(FichaTriagem::class, 'cliente_id');
    }
    
    /**
     * Pega todas as Ficha de Triagens associados ao cliente parte contrária.
     */
    public function ficha_triagens_parte_contraria()
    {
        return $this->hasMany(FichaTriagem::class, 'parte_contraria_id');
    }

    /**
     * Pega a nacionalidade que está associada a esse cliente.
     */
    public function nacionalidade()
    {
        return $this->belongsTo(Nacionalidade::class);
    }

}
