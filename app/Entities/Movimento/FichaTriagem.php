<?php

namespace Emaj\Entities\Movimento;

use Emaj\Entities\Cadastro\Aluno;
use Emaj\Entities\Cadastro\Cliente;
use Emaj\Entities\Cadastro\TipoDemanda;
use Emaj\Entities\Cadastro\Usuario;
use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Ficha de Triagem
 *
 * PHP version 7.2
 *
 * @category   Entity
 * @package    Movimento
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class FichaTriagem extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ficha_triagens';
    protected $appends = ['dados_ficha_triagem'];
    protected $fillable = [
        'ja_foi_atendido',
        'cliente_id',
        'protocolo',
        'numero_processo',
        'tipo_demanda_id',
        'parte_contraria_id',
        'aluno_id',
        'professor_id',
        'status',
        'outras_informacoes',
        'ativo'
    ];

    /**
     * Pega o Cliente associado a essa ficha de triagem.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    /**
     * Pega o tipo de demanda associado a essa ficha de triagem.
     */
    public function tipo_demanda()
    {
        return $this->belongsTo(TipoDemanda::class);
    }

    /**
     * Pega a parte contrária associado a essa ficha de triagem.
     */
    public function parte_contraria()
    {
        return $this->belongsTo(Cliente::class, 'parte_contraria_id');
    }

    /**
     * Pega o aluno associado a essa ficha de triagem.
     */
    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    /**
     * Pega o professor associado a essa ficha de triagem.
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
