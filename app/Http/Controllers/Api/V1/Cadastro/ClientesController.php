<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\ClienteRepository;
use Emaj\Repositories\Cadastro\ComposicaoFamiliarRepository;
use Emaj\Repositories\Cadastro\EnderecoRepository;
use Emaj\Repositories\Cadastro\NacionalidadeRepository;
use Emaj\Repositories\Cadastro\TelefoneRepository;

/**
 * Classe responsável por gerenciar a requisições das páginas
 *
 * PHP version 7.2
 *
 * @category   Controller
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class ClientesController extends CrudController
{

    /**
     * @var NacionalidadeRepository
     */
    private $nacionalidadeRepository;

    /**
     * @var TelefoneRepository
     */
    private $telefoneRepository;

    /**
     * @var ComposicaoFamiliarRepository
     */
    private $composicaoFamiliarRepository;

    /**
     * @var EnderecoRepository
     */
    private $enderecoRepository;

    /**
     * @var ClienteRepository
     */
    protected $repository;

    public function __construct(ClienteRepository $repository, EnderecoRepository $enderecoRepository, ComposicaoFamiliarRepository $composicaoFamiliarRepository, TelefoneRepository $telefoneRepository, NacionalidadeRepository $nacionalidadeRepository)
    {
        $this->repository = $repository;
        $this->enderecoRepository = $enderecoRepository;
        $this->composicaoFamiliarRepository = $composicaoFamiliarRepository;
        $this->telefoneRepository = $telefoneRepository;
        $this->nacionalidadeRepository = $nacionalidadeRepository;
    }

    public function show($id)
    {
        $informacoesPessoais = $this->repository->with('nacionalidade:id,nome')->find($id);
        $parteContraria = $informacoesPessoais->cpf == null && $informacoesPessoais->renda == null && $informacoesPessoais->pre_atendimento != 1 ? 1 : 0;
        $informacoesPessoais = array_merge($informacoesPessoais->toArray(), ['parte_contraria' => $parteContraria]);
        $this->registro = [
            'informacoesPessoais' => $informacoesPessoais,
            'endereco' => $this->enderecoRepository->findByField('cliente_id', $id)->first(),
            'composicaoFamiliar' => $this->composicaoFamiliarRepository->findByField('cliente_id', $id)->first(),
            'telefones' => $this->telefoneRepository->findByField('cliente_id', $id)
        ];
        return $this->registro;
    }

    /**
     * Sobrescrito para não ser chamado pelo controller, e sim pelo repository
     * @param array $data
     */
    protected function hasErrors($data)
    {
        
    }

    /**
     * Retorna todos os dados para os autocomplete
     * 
     * @return array
     */
    public function autocomplete()
    {
        $this->registro = [];
        if (strlen($ac = request()->get('nacionalidade')) > 0) {
            $this->registro = $this->nacionalidadeRepository
                    ->getDataAutocomplete($ac);
        }
        return $this->registro;
    }

}
