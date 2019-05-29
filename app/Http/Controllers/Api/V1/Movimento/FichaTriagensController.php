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
        'tipo_demanda:id,nome',
        'parte_contraria:id,nome_completo'];

    public function __construct(FichaTriagemRepository $repository)
    {
        $this->repository = $repository;
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
    
    public function imprimirFichaTriagem()
    {
        $this->nomeRelatorio = 'ficha_triagem';
        $this->nomeRelatorioJasper = 'ficha_triagem';
        $this->titulo = 'Ficha de Triagem';
        return $this->gerarImpressao();
    }

}
