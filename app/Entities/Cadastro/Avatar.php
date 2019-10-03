<?php

namespace Emaj\Entities\Cadastro;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Avatar
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
class Avatar extends Model
{

    /**
     * O nome da tabela no banco de dados.
     *
     * @var string
     */
    protected $table = 'avatares';

    /**
     * Armazena o nome das variáveis que serão enviadas na api.
     * 
     * @var array 
     */
    protected $appends = ['avatar_url'];

    /**
     * Armazena os campos do banco de dados.
     * 
     * @var array 
     */
    protected $fillable = [
        'nome',
        'avatar',
        'mimetype',
        'extensao',
        'tamanho'
    ];

    /**
     * Método responsável por retornar os dados do avatar.
     * 
     * @return string
     */
    protected function getAvatarUrlAttribute()
    {
        return "data:{$this->mimetype};base64,{$this->avatar}";
    }

}
