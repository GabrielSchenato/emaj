<?php

namespace Emaj\Repositories;

use Emaj\Criteria\AtivoCriteria;
use Emaj\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * AbstractRepository responsável por gerenciar a camada de banco de dados
 *
 * PHP version 7.2
 *
 * @category   Abstract
 * @package    Repositories
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
abstract class AbstractRepository extends BaseRepository
{

    /**
     * Váriavel responsável por armazenar o valor se será necessário
     * realizar as validações
     * 
     * @var boolean 
     */
    private $needToValidate = true;

    /**
     * Váriavel responsável por armazenar a chave do array para
     * envolver as mensagens de erro de validação da exception
     * 
     * @var string
     */
    private $wrapNameException = null;

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
        $this->validate($attributes);
        return parent::create($attributes);
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
        $this->validate($attributes, $id);
        return parent::update($attributes, $id);
    }

    /**
     * @override
     * Update or Create an entity in repository
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     * @param array $values
     *
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = array())
    {
        $id = isset($attributes['id']) ? $attributes['id'] : null;
        $this->validate(array_merge($attributes, $values), $id);
        return parent::updateOrCreate($attributes, $values);
    }

    /**
     * Método responsável por trazer todos os registros ativos
     * 
     * @param array $columns
     *
     * @return mixed
     */
    public function allAtivo($columns = ['*'])
    {
        return $this->pushCriteria(AtivoCriteria::class)->all($columns);
    }

    /**
     * Método responsável por buscar os registros filtrando pela palavra chave
     * utilizando a condição like.
     *
     * @param       $field
     * @param       $value
     *
     * @return mixed
     */
    public function whereLike($field, $value = null)
    {
        $this->applyCriteria();
        $this->applyScope();
        
        $model = $this->model->where($field, 'LIKE', "%{$value}%");
        
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Método responsável por realizar a busca pelo valor e campo passado
     * @param array $values
     * @return mixed
     */
    public function getBySearch(array $values)
    {
        return $this->model;
    }

    /**
     * Método responsável por buscar os dados para a grid
     * 
     * @param int $limit
     * @param array $columns
     * @param array $order
     * @param array $data
     * 
     * @return mixed
     */
    public function getDataIndex(int $limit = 10, array $columns = ['*'], array $order = ['id', 'desc'], array $data = [])
    {
        return $this->getBySearch($data)
                        ->orderBy($order[0], $order[1])
                        ->paginate($limit, $columns);
    }

    /**
     * Método responsável por realizar as validações
     * 
     * @param array $attributes
     * @param int $id
     * 
     * @throws ValidationException
     */
    protected function validate(array $attributes, int $id = null)
    {
        if ($this->getNeedToValidate()) {
            $validator = Validator::make($attributes, $this->getRules($attributes, $id));
            if ($validator->fails()) {
                $validationException = new ValidationException($validator);
                $validationException->setWrapName($this->getWrapNameException());
                throw $validationException;
            }
        }
    }

    public function getNeedToValidate()
    {
        return $this->needToValidate;
    }

    public function setNeedToValidate($needToValidate)
    {
        $this->needToValidate = $needToValidate;
        return $this;
    }

    public function getWrapNameException()
    {
        return $this->wrapNameException;
    }

    /**
     * Utilizado para setar a chave de um array para enviar os 
     * erros de validação para o front-end
     * 
     * @param string $wrapNameException
     * @return $this
     */
    public function setWrapNameException($wrapNameException)
    {
        $this->wrapNameException = $wrapNameException;
        return $this;
    }

}
