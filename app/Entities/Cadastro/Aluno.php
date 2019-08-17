<?php

namespace Emaj\Entities\Cadastro;

use Emaj\Entities\Movimento\FichaTriagem;
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

    protected $fillable = [
        'nome_completo',
        'fase',
        'matricula',
        'disciplina',
        'ano',
        'semestre',
        'turno',
        'telefone',
        'celular',
        'email',
        'observacoes',
        'ativo',
    ];

    /**
     * Pega todas Protocolos Alunos associados ao aluno.
     */
    public function protocolo_alunos()
    {
        return $this->hasMany(ProtocoloAluno::class, 'aluno_id')->orderBy('created_at', 'desc');
    }
    /**
     * Pega todas as Ficha de Triagens associados ao aluno.
     */
    public function ficha_triagens_aluno()
    {
        return $this->hasMany(FichaTriagem::class, 'aluno_id')->orderBy('created_at', 'desc');
    }

    /**
     * Pega todas as avaliações associadas ao aluno.
     */
    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class, 'aluno_id')->orderBy('created_at', 'desc');
    }

}
