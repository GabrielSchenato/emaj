<?php

namespace Emaj\Entities\Movimento;

use Emaj\Entities\Cadastro\Cliente;
use Emaj\Entities\Cadastro\TipoDemanda;
use Emaj\Entities\Cadastro\TipoStatus;
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
    
    protected $fillable = [
        'ja_foi_atendido',
        'cliente_id',
        'protocolo',
        'tipo_demanda_id',
        'parte_contraria_id',
        'nome_aluno',
        'nome_professor',
        'tipo_status_id',
        'outras_informacoes'
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
     * Pega o tipo de status associado a essa ficha de triagem.
     */
    public function tipo_status()
    {
        return $this->belongsTo(TipoStatus::class);
    }

}
