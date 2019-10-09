<?php

namespace Emaj\Entities\Cadastro;

use Emaj\Util\Functions;
use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Avaliação Arquivo
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
class AvaliacaoArquivo extends Model
{

    /**
     * O nome da tabela no banco de dados.
     *
     * @var string
     */
    protected $table = 'avaliacao_arquivos';

    /**
     * Armazena o nome das variáveis que serão enviadas na api.
     * 
     * @var array 
     */
    protected $appends = ['nome_arquivo_extensao', 'tamanho_arquivo'];

    /**
     * Armazena os campos do banco de dados.
     * 
     * @var array 
     */
    protected $fillable = [
        'nome',
        'arquivo',
        'mimetype',
        'extensao',
        'tamanho',
        'avaliacao_id'
    ];

    /**
     * Pega a avaliação associado a esse arquivo.
     */
    public function avaliacao()
    {
        return $this->belongsTo(Avaliacao::class, 'avaliacao_id');
    }

    protected function getNomeArquivoExtensaoAttribute()
    {
        return $this->attributes['nome'] . '.' . $this->attributes['extensao'];
    }

    protected function getTamanhoArquivoAttribute()
    {
        return Functions::formatBytes($this->attributes['tamanho']);
    }

}
