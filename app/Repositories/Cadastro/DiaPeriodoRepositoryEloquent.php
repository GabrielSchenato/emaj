<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\DiaPeriodo;
use Emaj\Repositories\AbstractRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Dia Período
 *
 * PHP version 7.2
 *
 * @category   Repository
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      2.1.0
 */
class DiaPeriodoRepositoryEloquent extends AbstractRepository implements DiaPeriodoRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DiaPeriodo::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Método responsável por buscar os dados e retornar para o autocomplete
     * 
     * @param string $value
     */
    public function getDataAutocomplete($value)
    {
        $this->applyCriteria();
        $this->applyScope();

        $model = $this->model->where(function ($query) use ($value) {
                    $query->where('nome', 'LIKE', "%{$value}%")
                    ->orWhere('id', '=', (int) $value);
                })
                ->orderBy('id', 'asc')
                ->limit(10)
                ->get(['id', 'nome']);

        $this->resetModel();

        return $model;
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
        ];
    }

}
