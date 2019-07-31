<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\Nacionalidade;
use Emaj\Repositories\AbstractRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Nacionalidade
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
class NacionalidadeRepositoryEloquent extends AbstractRepository implements NacionalidadeRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Nacionalidade::class;
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
        return $this->whereLike('nome', $value)
                        ->orderBy('nome', 'asc')
                        ->limit(10)
                        ->get(['id', 'nome']);
    }

    public function getRules(array $data, int $id = null)
    {
        return [];
    }

}
