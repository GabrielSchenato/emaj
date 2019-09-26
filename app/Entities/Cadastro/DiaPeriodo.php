<?php

namespace Emaj\Entities\Cadastro;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Dia Período
 *
 * PHP version 7.2
 *
 * @category   Entity
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      2.1.0
 */
class DiaPeriodo extends Model
{

    /**
     * Armazena o nome das variáveis que serão enviadas na api.
     * 
     * @var array 
     */
    protected $appends = ['dados_dia_periodo'];

    /**
     * Armazena os campos do banco de dados.
     * 
     * @var array 
     */
    protected $fillable = [
        'nome',
        'hora_inicial',
        'hora_final'
    ];

    /**
     * Os alunos que o período pertence.
     */
    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'dia_periodo_alunos');
    }

    /**
     * Método responsável por retornar os dados do período.
     * 
     * @return string
     */
    protected function getDadosDiaPeriodoAttribute()
    {
        return "$this->nome ({$this->id})";
    }

}
