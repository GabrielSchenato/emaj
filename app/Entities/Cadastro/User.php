<?php

namespace Emaj\Entities\Cadastro;

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
class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{

    use Notifiable;

    public const ADMIN = 'admin';
    public const SECRETARIA = 'secretaria';
    public const ALUNO = 'aluno';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome_completo', 'email', 'password', 'role', 'avatar', 'telefone'
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

}
