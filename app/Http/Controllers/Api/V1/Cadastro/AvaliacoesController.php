<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\AvaliacaoRepository;

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
        'protocolo:id,cliente_id,parte_contraria_id,tipo_demanda_id,protocolo,numero_processo,created_at',
        'protocolo.cliente:id,nome_completo,representado_assistido,cpf,rg,renda',
        'avaliacao_arquivos:id,nome,mimetype,extensao,tamanho,avaliacao_id'];
    protected $repository;

    public function __construct(AvaliacaoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function avaliacoesAluno($idAluno)
    {
        return $this->repository->getAvaliacoesByAluno($idAluno, $this->relationships());
    }

}
