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

    /**
     * Armazena o nome das variáveis que serão enviadas na api.
     * 
     * @var array 
     */
    protected $appends = [
        'dados_tipo_demanda'
    ];

    /**
     * Armazena os campos do banco de dados.
     * 
     * @var array 
     */
    protected $fillable = [
        'nome',
        'descricao',
        'ativo'
    ];

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
