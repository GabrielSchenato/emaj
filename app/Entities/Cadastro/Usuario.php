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

    public const ADMIN = 'admin';
    public const SECRETARIA = 'secretaria';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'usuarios';
    protected $appends = ['dados_usuario'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome_completo', 'email', 'password', 'role', 'avatar', 'telefone', 'professor', 'ativo'
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
     * Pega todas as Ficha de Triagens associados ao professor.
     */
    public function ficha_triagens_professor()
    {
        return $this->hasMany(FichaTriagem::class, 'professor_id');
    }

    protected function getDadosUsuarioAttribute()
    {
        $string = '';
        $string .= $this->attributes['nome_completo'];
        $string .= ' (' . $this->attributes['id'] . ')';
        return $string;
    }

}
