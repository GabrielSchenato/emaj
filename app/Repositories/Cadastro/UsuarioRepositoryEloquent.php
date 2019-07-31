<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\Usuario;
use Emaj\Mail\EdicaoUsuarioMailable;
use Emaj\Mail\NovoUsuarioMailable;
use Emaj\Repositories\AbstractRepository;
use Emaj\Util\Roles;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Exceptions\ValidatorException;
use function app;

/**
 * Repository responsável por gerenciar a entidade User
 *
 * PHP version 7.2
 *
 * @category   Repository
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class UsuarioRepositoryEloquent extends AbstractRepository implements UsuarioRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Usuario::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @override
     * Save a new entity in repository
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {
        $usuario = parent::create($attributes);
        Mail::to($usuario->email)
                ->send(new NovoUsuarioMailable($usuario, $attributes['password']));
        return $usuario;
    }

    /**
     * @override
     * Update a entity in repository by id
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        $usuario = parent::update($attributes, $id);
        if (isset($attributes['password'])) {
            Mail::to($usuario->email)->send(new EdicaoUsuarioMailable($usuario, $attributes['password']));
        }
        return $usuario;
    }

    /**
     * Método responsável por retornar as regras a serem aplicadas ao criar ou editar
     * um registro
     * 
     * @param array $data
     * @param int $id
     * 
     * @return array Regras para serem aplicadas
     */
    public function getRules(array $data, int $id = null)
    {
        return [
            'nome_completo' => 'required|min:5',
            'email' => ['required', 'email', Rule::unique('usuarios')->ignore($id)],
            'password' => [$id ? '' : 'required', 'min:6', 'confirmed'],
            'role' => ['required', Rule::in(Roles::getRoles())],
            'avatar' => 'nullable',
            'telefone' => 'required|min:8',
        ];
    }

    /**
     * Método responsável por realizar a busca pelo valor e campo passado
     * @param array $values
     * @return mixed
     */
    public function getBySearch(array $values)
    {
        $criteria = $this->model->newQuery();
        if (isset($values['id'])) {
            $criteria->where('id', '=', (int) $values['id']);
        }
        if (isset($values['nome_completo'])) {
            $criteria->where('nome_completo', 'like', "%{$values['nome_completo']}%");
        }
        if (isset($values['email'])) {
            $criteria->where('email', 'like', "%{$values['email']}%");
        }
        if (isset($values['telefone'])) {
            $criteria->where('telefone', 'like', "%{$values['telefone']}%");
        }
        if (isset($values['role'])) {
            $criteria->where('role', 'like', "%{$values['role']}%");
        }
        if (isset($values['professor'])) {
            $criteria->where('professor', '=', (boolean) $values['professor']);
        }
        if (isset($values['ativo'])) {
            $criteria->where('ativo', '=', (boolean) $values['ativo']);
        }

        return $criteria;
    }

    /**
     * Método responsável por buscar os dados e retornar para o autocomplete
     * 
     * @param string $value
     */
    public function getDataAutocomplete($value)
    {
        return $this->whereLike('nome_completo', $value)
                        ->orderBy('nome_completo', 'asc')
                        ->limit(10)
                        ->get(['id', 'nome_completo']);
    }

}
