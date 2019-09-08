<?php

namespace Emaj\Entities\Cadastro;

use Carbon\Carbon;
use Emaj\Entities\Cadastro\Cliente;
use Emaj\Entities\Cadastro\TipoDemanda;
use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Protocolo
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
class Protocolo extends Model
{

    /**
     * Armazena o nome das variáveis que seram enviadas na api.
     * 
     * @var array 
     */
    protected $appends = [
        'dados_protocolo',
        'protocolo_alunos_professores_ativos'
    ];

    /**
     * Armazena os campos do banco de dados.
     * 
     * @var array 
     */
    protected $fillable = [
        'cliente_id',
        'protocolo',
        'numero_processo',
        'tipo_demanda_id',
        'parte_contraria_id',
        'status',
        'observacoes',
        'ativo'
    ];

    /**
     * Pega o Cliente associado a esse protocolo.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    /**
     * Pega a tipo de demanda associado a esse protocolo.
     */
    public function tipo_demanda()
    {
        return $this->belongsTo(TipoDemanda::class);
    }

    /**
     * Pega a parte contrária associado a esse protocolo.
     */
    public function parte_contraria()
    {
        return $this->belongsTo(Cliente::class, 'parte_contraria_id');
    }

    /**
     * Pega todos Protocolos Alunos Professores associados a esse protocolo.
     */
    public function protocolo_alunos_professores()
    {
        return $this->hasMany(ProtocoloAlunoProfessor::class, 'protocolo_id');
    }

    /**
     * Método responsável por pegar todos os protocolos aluno professor ativos deste
     * protocolo.
     * 
     * @return mixed
     */
    protected function getProtocoloAlunosProfessoresAtivosAttribute()
    {
        return $this->hasMany(ProtocoloAlunoProfessor::class, 'protocolo_id')
                        ->where('ativo', '=', true)
                        ->with([
                            'aluno:id,nome_completo',
                            'professor:id,nome_completo'
                        ])
                        ->get();
    }

    /**
     * Método responsável por retornar os dados do protocolo.
     * 
     * @return string
     */
    protected function getDadosProtocoloAttribute()
    {
        $string = "";
        if ($this->protocolo) {
            $string .= "Protocolo: {$this->protocolo}  - ";
        }
        if ($this->cliente) {
            $string .= "Cliente: {$this->cliente->nome_completo}";
            if ($this->cliente->representado_assistido) {
                $string .= " - Representado/Assistido: {$this->cliente->representado_assistido}";
            }
        }
        if ($this->parte_contraria) {
            $string .= " - Parte Contrária: {$this->parte_contraria->nome_completo}";
        }
        if ($this->numero_processo) {
            $string .= " - N.º Processo: {$this->numero_processo}";
        }
        if ($this->tipo_demanda) {
            $string .= " - Demanda: {$this->tipo_demanda->nome}";
        }
        if ($this->created_at) {
            $string .= ' - Data: ' . Carbon::parse($this->created_at)->format('d/m/Y');
        }
        return $string;
    }

}
