<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\Endereco;
use Emaj\Repositories\AbstractRepository;
use Illuminate\Container\Container;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Endereço
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
class EnderecoRepositoryEloquent extends AbstractRepository implements EnderecoRepository
{

    public function __construct(Container $app)
    {
        parent::__construct($app);
        $this->setWrapNameException('endereco');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Endereco::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
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
            'cep' => 'required',
            'logradouro' => 'required|max:100',
            'bairro' => 'required|max:255',
            'numero' => 'required|numeric',
            'localidade' => 'required|max:50',
            'uf' => 'required|max:2',
            'cliente_id' => 'required|numeric'
        ];
    }

}
