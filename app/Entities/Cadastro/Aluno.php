<?php

namespace Emaj\Entities\Cadastro;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Aluno
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
class Aluno extends Model
{

    /**
     * Armazena o nome das variáveis que serão enviadas na api.
     * 
     * @var array 
     */
    protected $appends = ['dados_aluno'];

    /**
     * Armazena os campos do banco de dados.
     * 
     * @var array 
     */
    protected $fillable = [
        'nome_completo',
        'matricula',
        'disciplina_id',
        'telefone',
        'celular',
        'email',
        'observacoes',
        'ativo',
    ];

    /**
     * Pega todos os Protocolos Alunos Professores associados ao aluno.
     */
    public function protocolo_alunos_professores()
    {
        return $this->hasMany(ProtocoloAlunoProfessor::class, 'aluno_id')->orderBy('created_at', 'desc');
    }

    /**
     * Pega todas as avaliações associadas ao aluno.
     */
    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class, 'aluno_id')->orderBy('created_at', 'desc');
    }

    /**
     * Os períodos que pertencem ao aluno.
     */
    public function dia_periodos()
    {
        return $this->belongsToMany(DiaPeriodo::class, 'dia_periodo_alunos');
    }

    /**
     * Pega a disciplina que está associada a esse aluno.
     */
    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }

    /**
     * Método responsável por retornar os dados do aluno.
     * 
     * @return string
     */
    protected function getDadosAlunoAttribute()
    {
        return "$this->nome_completo ({$this->id})";
    }

}
