<?php

namespace Emaj\Entities\Cadastro;

use Emaj\Entities\Movimento\FichaTriagem;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Classe da entidade usuário
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
class Usuario extends Authenticatable implements MustVerifyEmail, JWTSubject
{

    use Notifiable;

    /**
     * O nome da tabela no banco de dados.
     *
     * @var string
     */
    protected $table = 'usuarios';

    /**
     * Armazena o nome das variáveis que seram enviadas na api.
     * 
     * @var array 
     */
    protected $appends = ['dados_usuario'];

    /**
     * Armazena os campos do banco de dados.
     * 
     * @var array 
     */
    protected $fillable = [
        'nome_completo',
        'email',
        'password',
        'role',
        'avatar',
        'telefone',
        'professor',
        'ativo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Método responsável por retornar os dados do usuário.
     * 
     * @return string
     */
    protected function getDadosUsuarioAttribute()
    {
        return "{$this->nome_completo} ({$this->id})";
    }

}
