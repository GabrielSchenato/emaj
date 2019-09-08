<?php

namespace Emaj\Entities\Cadastro;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Protocolo Aluno Professor
 *
 * PHP version 7.2
 *
 * @category   Entity
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      2.0.0
 */
class ProtocoloAlunoProfessor extends Model
{

    /**
     * O nome da tabela no banco de dados.
     *
     * @var string
     */
    protected $table = 'protocolo_alunos_professores';

    /**
     * Armazena o nome das variáveis que seram enviadas na api.
     * 
     * @var array 
     */
    protected $appends = ['dados_protocolo_aluno_professor'];

    /**
     * Armazena os campos do banco de dados.
     * 
     * @var array 
     */
    protected $fillable = [
        'protocolo_id',
        'aluno_id',
        'professor_id',
        'data_vinculo',
        'ativo'
    ];

    /**
     * Pega o Protocolo associado a esse Protocolo Aluno.
     */
    public function protocolo()
    {
        return $this->belongsTo(Protocolo::class, 'protocolo_id');
    }

    /**
     * Pega o Aluno associado a esse Protocolo Aluno.
     */
    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    /**
     * Pega o Professor associado a esse Protocolo Aluno.
     */
    public function professor()
    {
        return $this->belongsTo(Usuario::class, 'professor_id');
    }

    /**
     * Método responsável por retornar os dados do protocolo aluno professor.
     * 
     * @return string
     */
    protected function getDadosProtocoloAlunoProfessorAttribute()
    {
        $aluno = "Aluno: {$this->aluno->dados_aluno} - ";
        $professor = "Professor: {$this->professor->dados_usuario} - ";
        $dataVinculo = 'Data Vínculo: ' . \Carbon\Carbon::parse($this->data_vinculo)->format('d/m/Y');
        return $aluno . $professor . $dataVinculo;
    }

}
