<?php

namespace Emaj\Entities\Cadastro;

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
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'avaliacao_arquivos';
    protected $appends = ['nome_arquivo_extensao', 'tamanho_arquivo'];
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
        return $this->formatBytes($this->attributes['tamanho']);
    }

    /**
     * Format bytes to kb, mb, gb, tb
     *
     * @param  integer $size
     * @param  integer $precision
     * @return integer
     */
    private function formatBytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        }
        return $size;
    }

}
