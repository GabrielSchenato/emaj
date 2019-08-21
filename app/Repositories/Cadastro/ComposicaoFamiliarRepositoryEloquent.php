<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\ComposicaoFamiliar;
use Emaj\Repositories\AbstractRepository;
use Emaj\Util\TiposCasa;
use Illuminate\Container\Container;
use Illuminate\Validation\Rule;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Composição Familiar
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
class ComposicaoFamiliarRepositoryEloquent extends AbstractRepository implements ComposicaoFamiliarRepository
{

    public function __construct(Container $app)
    {
        parent::__construct($app);
        $this->setWrapNameException('composicao_familiar');
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ComposicaoFamiliar::class;
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
        $this->limpaCamposCarro($attributes);
        $this->limpaCamposMoto($attributes);
        return parent::updateOrCreate($attributes, $values);
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
            'renda_familiar' => 'required|numeric',
            'casa' => ['required', Rule::in(TiposCasa::getTiposCasa())],
            'outros_bens' => 'required|max:255',
            'dividas' => 'required|max:255',
            'despesas' => 'required|max:255',
            'valor_patrimonio' => 'required|max:255'
        ];
    }

    /**
     * Método responsável por limpar os campos relacionados ao carro do cliente
     * quando desmarcado parametro possui_carro
     * 
     * @param array $attributes
     */
    private function limpaCamposCarro(&$attributes)
    {
        if (isset($attributes['possui_carro']) && $attributes['possui_carro'] == false) {
            $attributes['possui_carro'] = null;
            $attributes['marca_carro'] = null;
            $attributes['ano_carro'] = null;
        }
    }

    /**
     * Método responsável por limpar os campos relacionados a moto do cliente
     * quando desmarcado parametro possui_moto
     * 
     * @param array $attributes
     */
    private function limpaCamposMoto(&$attributes)
    {
        if (isset($attributes['possui_moto']) && $attributes['possui_moto'] == false) {
            $attributes['possui_moto'] = null;
            $attributes['marca_moto'] = null;
            $attributes['ano_moto'] = null;
        }
    }

}
