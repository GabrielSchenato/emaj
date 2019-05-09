<?php

namespace Emaj\Entities\Movimento;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Número Protocolo
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
class NumeroProtocolo extends Model
{

    protected $appends = ['protocolo'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'numero_protocolos';

    /**
     * Pega a Ficha de Triagem associado a esse número protocolo.
     */
    public function ficha_triagem()
    {
        return $this->belongsTo(FichaTriagem::class);
    }

    protected function getProtocoloAttribute()
    {
        $ano = (int) \Carbon\Carbon::parse($this->attributes['created_at'])->format('y');
        return $this->attributes['id'] . '/' . $ano;
    }

}
