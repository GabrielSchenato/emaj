<?php

namespace Emaj\Entities\Movimento;

use Emaj\Entities\Cadastro\Aluno;
use Emaj\Entities\Cadastro\Cliente;
use Emaj\Entities\Cadastro\TipoDemanda;
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
    
    public const AJUIZADO = 'Ajuizado';
    public const NAO_AJUIZADO = 'Não Ajuizado';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ficha_triagens';
    
    protected $fillable = [
        'ja_foi_atendido',
        'cliente_id',
        'protocolo',
        'numero_processo',
        'tipo_demanda_id',
        'parte_contraria_id',
        'aluno_id',
        'nome_professor',
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

}
