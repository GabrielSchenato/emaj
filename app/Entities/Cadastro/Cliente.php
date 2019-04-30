<?php

namespace Emaj\Entities\Cadastro;

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
     * Pega a nacionalidade que está associada a esse cliente.
     */
    public function nacionalidade()
    {
        return $this->belongsTo(Nacionalidade::class);
    }

}
