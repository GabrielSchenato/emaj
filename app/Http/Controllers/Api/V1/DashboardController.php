<?php

namespace Emaj\Http\Controllers\Api\V1;

use Emaj\Http\Controllers\Controller;
use Emaj\Repositories\Cadastro\ClienteRepositoryEloquent;
use Emaj\Repositories\Cadastro\UsuarioRepositoryEloquent;
use Emaj\Repositories\Movimento\FichaTriagemRepositoryEloquent;
use function response;

/**
 * Classe responsável por gerenciar a requisições das páginas
 *
 * PHP version 7.2
 *
 * @category   Controller
 * @package    V1
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class DashboardController extends Controller
{

    /**
     * @var \Emaj\Repositories\Cadastro\AlunoRepository
     */
    private $alunoRepository;

    /**
     * @var FichaTriagemRepositoryEloquent
     */
    private $fichaTriagemRepository;

    /**
     * Variável com as estatísticas
     * @var array 
     */
    private $registro;

    public function __construct(\Emaj\Repositories\Cadastro\AlunoRepository $alunoRepository, FichaTriagemRepositoryEloquent $fichaTriagemRepository)
    {
        $this->fichaTriagemRepository = $fichaTriagemRepository;
        $this->alunoRepository = $alunoRepository;
    }

    public function estatisticas()
    {
        $this->registro = [
            'alunos' => (string) $this->alunoRepository->count(),
            'clientes' => (string) $this->fichaTriagemRepository->getNumeroClientes(),
            'parteContrarias' => (string) $this->fichaTriagemRepository->getNumeroParteContrarias(),
            'atendimentosMes' => (string) $this->fichaTriagemRepository->getAtendimentosMes(),
            'top5DemandasMaisAtendidas' => $this->fichaTriagemRepository->getTop5DemandasMaisAtendidas()
        ];
        return response()->json([
                    'status' => 'success',
                    'data' => $this->registro
                        ], 200);
    }

}
