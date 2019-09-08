<?php

namespace Emaj\Entities\Cadastro;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Avaliação
 *
 * PHP version 7.2
 *
 * @category   Entity
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.1.0
 */
class Avaliacao extends Model
{

    /**
     * O nome da tabela no banco de dados.
     *
     * @var string
     */
    protected $table = 'avaliacoes';

    /**
     * Armazena o nome das variáveis que seram enviadas na api.
     * 
     * @var array 
     */
    protected $appends = ['quantidade_anexos'];

    /**
     * Armazena os campos do banco de dados.
     * 
     * @var array 
     */
    protected $fillable = [
        'aluno_id',
        'protocolo_id',
        'avaliador_id',
        'data',
        'observacoes'
    ];

    /**
     * Pega o aluno associado a essa avaliação.
     */
    public function aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }

    /**
     * Pega a ficha de triagem associada a essa avaliação.
     */
    public function protocolo()
    {
        return $this->belongsTo(Protocolo::class, 'protocolo_id');
    }

    /**
     * Pega o avaliador associado a essa avaliação.
     */
    public function avaliador()
    {
        return $this->belongsTo(Usuario::class, 'avaliador_id');
    }

    /**
     * Pega todos os arquivos anexados a essa avaliação.
     */
    public function avaliacao_arquivos()
    {
        return $this->hasMany(AvaliacaoArquivo::class, 'avaliacao_id');
    }

    /**
     * Método responsável por verificar quantos anexos existem vinculados a essa
     * avaliação.
     * 
     * @return int
     */
    protected function getQuantidadeAnexosAttribute()
    {
        return $this->avaliacao_arquivos->count();
    }

}
