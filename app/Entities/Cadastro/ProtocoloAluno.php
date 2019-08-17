<?php

namespace Emaj\Entities\Cadastro;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Protocolo Aluno
 *
 * PHP version 7.2
 *
 * @category   Entity
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      2.0.0
 */
class ProtocoloAluno extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'protocolo_alunos';
    //protected $appends = ['dados_ficha_triagem'];
    protected $fillable = [
        'protocolo_id',
        'aluno_id',
        'professor_id',
        'data_vinculo',
        'ativo'
    ];

    /**
     * Pega o Protocolo associado a esse Protocolo Aluno.
     */
    public function protocolo()
    {
        return $this->belongsTo(Protocolo::class, 'protocolo_id');
    }

    /**
     * Pega o Aluno associado a esse Protocolo Aluno.
     */
    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    /**
     * Pega o Professor associado a esse Protocolo Aluno.
     */
    public function professor()
    {
        return $this->belongsTo(Usuario::class, 'professor_id');
    }

    protected function getDadosFichaTriagemAttribute()
    {
        $string = '';

        $cliente = $this->cliente;
        $parteContraria = $this->parte_contraria;
        $tipoDemanda = $this->tipo_demanda;


        if ($cliente) {
            $string .= 'Cliente: ' . $cliente->nome_completo;
            $string .= ' (' . $cliente->id . ')';
        }
        if ($parteContraria) {
            $string .= ' - Parte Contrária: ' . $parteContraria->nome_completo;
        }
        if (isset($this->attributes['protocolo'])) {
            $string .= ' - Protocolo: ' . $this->attributes['protocolo'];
        }
        if (isset($this->attributes['numero_processo'])) {
            $string .= ' - N.º Processo: ' . $this->attributes['numero_processo'];
        }
        if ($tipoDemanda) {
            $string .= ' - Demanda: ' . $tipoDemanda->nome;
        }
        if (isset($this->attributes['created_at'])) {
            $string .= ' - Data: ' . \Carbon\Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
        }
        return $string;
    }

}
