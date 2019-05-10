<?php

namespace Emaj\Http\Controllers\Api\V1\Movimento;

use Emaj\Criteria\AlunoCriteria;
use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Movimento\FichaTriagemRepository;
use Emaj\Util\Traits\Report;
use Illuminate\Http\Request;

/**
 * Classe responsável por gerenciar a requisições das páginas
 *
 * PHP version 7.2
 *
 * @category   Controller
 * @package    Movimento
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class FichaTriagensController extends CrudController
{

    use Report;

    protected $repository;
    protected $relationships = [
        'cliente:id,nome_completo',
        'numero_protocolo:id,created_at',
        'tipo_demanda:id,nome',
        'parte_contraria:id,nome_completo',
        'aluno:id,nome_completo',
        'tipo_status:id,nome'];

    public function __construct(FichaTriagemRepository $repository)
    {
        $this->repository = $repository;
        $this->nomeRelatorio = 'protocolo';
        $this->nomeRelatorioJasper = 'protocolo';
        $this->titulo = 'Protocolo da Ficha de Triagem';
    }

    public function index(Request $request)
    {
        $data = $request->all();
        $limit = $data['limit'] ?? 20;
        $columns = $data['columns'] ?? ['*'];
        $order = $data['order'] ?? null;

        if ($order) {
            $order = explode(',', $order);
        }
        $order[0] = $order[0] ?? 'id';
        $order[1] = $order[1] ?? 'asc';

        if (auth()->user()->role != 'aluno') {
            $this->registro = $this->repository->with($this->relationships())
                    ->orderBy($order[0], $order[1])
                    ->paginate($limit, $columns);
        } else {
            $this->registro = $this->repository
                    ->pushCriteria(AlunoCriteria::class)
                    ->with($this->relationships())
                    ->orderBy($order[0], $order[1])
                    ->paginate($limit, $columns);
        }


        return $this->registro;
    }

    public function impressaoProtocolo()
    {
        return $this->gerarImpressao();
    }
    
    public function impressaoDadosPartes()
    {
        $this->nomeRelatorio = 'dados_das_partes';
        $this->nomeRelatorioJasper = 'dados_partes';
        $this->titulo = 'Dados das Partes';
        return $this->gerarImpressao();
    }

}
