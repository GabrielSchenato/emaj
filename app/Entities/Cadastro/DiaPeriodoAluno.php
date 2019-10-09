<?php

namespace Emaj\Entities\Cadastro;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Dia Período Aluno
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
class DiaPeriodoAluno extends Model
{

    /**
     * Armazena o nome das variáveis que serão enviadas na api.
     * 
     * @var array 
     */
    protected $appends = [
        'dados_dia_periodo_aluno'
    ];

    /**
     * Armazena os campos do banco de dados.
     * 
     * @var array 
     */
    protected $fillable = [
        'aluno_id',
        'dia_periodo_id'
    ];

    /**
     * Pega o aluno que está associado a esse Período Aluno.
     */
    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    /**
     * Pega o período que está associado a esse Período Aluno.
     */
    public function dia_periodo()
    {
        return $this->belongsTo(DiaPeriodo::class, 'dia_periodo_id');
    }

    /**
     * Método responsável por retornar os dados do dia período aluno.
     * 
     * @return string
     */
    protected function getDadosDiaPeriodoAlunoAttribute()
    {
        return $this->dia_periodo->dados_dia_periodo;
    }
}
