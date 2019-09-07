<?php

namespace Emaj\Entities\Cadastro;

use Emaj\Entities\Movimento\FichaTriagem;
use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade tipo de demandas
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
class TipoDemanda extends Model
{

    protected $appends = [
        'dados_tipo_demanda'
    ];
    protected $fillable = [
        'nome', 'descricao', 'ativo'
    ];

    /**
     * Pega todas as ficha de triagens associados a esse tipo de demanda.
     */
    public function ficha_triagens()
    {
        return $this->hasMany(FichaTriagem::class);
    }

    /**
     * Método responsável por montar os dados do Tipo de Demanda.
     * 
     * @return string
     */
    protected function getDadosTipoDemandaAttribute()
    {
        return "{$this->nome} ({$this->id})";
    }

}
