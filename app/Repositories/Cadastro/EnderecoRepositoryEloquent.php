<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\Endereco;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

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
class EnderecoRepositoryEloquent extends BaseRepository implements EnderecoRepository
{

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

    public static function getRules($data)
    {
        return [
            'cep' => 'required|numeric|digits:8',
            'logradouro' => 'required|max:100',
            'bairro' => 'required|max:50',
            'localidade' => 'required|max:50',
            'uf' => 'required|max:2',
        ];
    }

}
