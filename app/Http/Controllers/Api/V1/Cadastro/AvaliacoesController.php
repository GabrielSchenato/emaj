<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\AvaliacaoRepository;
use Illuminate\Http\Request;

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
 * @since      1.1.0
 */
class AvaliacoesController extends CrudController
{

    protected $relationships = [
        'avaliador:id,nome_completo',
        'ficha_triagem:id,cliente_id,parte_contraria_id,tipo_demanda_id,protocolo,numero_processo,created_at',
        'ficha_triagem.cliente:id,nome_completo,representado_assistido,cpf,rg,renda'];
    protected $repository;

    public function __construct(AvaliacaoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function avaliacoesAluno($id)
    {
        $this->registro = $this->repository->with($this->relationships())->orderBy('id', 'desc')->findByField('aluno_id', $id);

        return $this->registro;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['avaliador_id'] = auth()->user()->id;
        if ($errors = $this->hasErrors($data)) {
            return response()->json([
                        'status' => 'error',
                        'errors' => $errors
                            ], 422);
        }
        $this->registro = $this->repository->create($data);
        return $this->registro;
    }

}
