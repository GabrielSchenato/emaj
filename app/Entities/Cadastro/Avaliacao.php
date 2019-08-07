<?php

namespace Emaj\Entities\Cadastro;

use Emaj\Entities\Movimento\FichaTriagem;
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
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'avaliacoes';
    protected $appends = ['quantidade_anexos'];
    protected $fillable = [
        'aluno_id',
        'ficha_triagem_id',
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
    public function ficha_triagem()
    {
        return $this->belongsTo(FichaTriagem::class, 'ficha_triagem_id');
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
