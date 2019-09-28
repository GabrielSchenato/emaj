<?php

namespace Emaj\Entities\Cadastro;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Disciplina
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
class Disciplina extends Model
{

    /**
     * Armazena o nome das variáveis que serão enviadas na api.
     * 
     * @var array 
     */
    protected $appends = ['dados_disciplina'];

    /**
     * Armazena os campos do banco de dados.
     * 
     * @var array 
     */
    protected $fillable = [
        'nome'
    ];

    /**
     * Pega todos os Alunos associados a essa Disciplina.
     */
    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }

    /**
     * Método responsável por retornar os dados da disciplina.
     * 
     * @return string
     */
    protected function getDadosDisciplinaAttribute()
    {
        return "$this->nome ({$this->id})";
    }

}
