<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\ClienteRepository;
use Emaj\Repositories\Cadastro\ComposicaoFamiliarRepository;
use Emaj\Repositories\Cadastro\EnderecoRepository;
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
    protected $relationships = ['endereco', 'composicao_familiar', 'telefones'];

    public function __construct(ClienteRepository $repository, EnderecoRepository $enderecoRepository, ComposicaoFamiliarRepository $composicaoFamiliarRepository, TelefoneRepository $telefoneRepository)
    {
        $this->repository = $repository;
        $this->enderecoRepository = $enderecoRepository;
        $this->composicaoFamiliarRepository = $composicaoFamiliarRepository;
        $this->telefoneRepository = $telefoneRepository;
    }

    public function show($id)
    {
        $informacoesPessoais = $this->repository->find($id);
        $parteContraria = $informacoesPessoais->cpf == null && $informacoesPessoais->renda == null ? 1 : 0;
        $informacoesPessoais = array_merge($informacoesPessoais->toArray(), ['parte_contraria' => $parteContraria]);
        $this->registro = [
            'informacoesPessoais' => $informacoesPessoais,
            'endereco' => $this->enderecoRepository->findByField('cliente_id', $id)->first(),
            'composicaoFamiliar' => $this->composicaoFamiliarRepository->findByField('cliente_id', $id)->first(),
            'telefones' => $this->telefoneRepository->findByField('cliente_id', $id)
        ];
        return $this->registro;
    }

}
