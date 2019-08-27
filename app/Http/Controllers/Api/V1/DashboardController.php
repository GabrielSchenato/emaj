<?php

namespace Emaj\Http\Controllers\Api\V1;

use Emaj\Http\Controllers\Controller;
use Emaj\Repositories\Cadastro\AlunoRepository;
use Emaj\Repositories\Cadastro\ProtocoloRepository;
use Emaj\Repositories\Movimento\FichaTriagemRepository;
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
     * @var AlunoRepository
     */
    private $alunoRepository;

    /**
     * @var FichaTriagemRepository
     */
    private $fichaTriagemRepository;

    /**
     * Variável com as estatísticas
     * @var array 
     */
    protected $registro;

    public function __construct(AlunoRepository $alunoRepository, ProtocoloRepository $protocoloRepository)
    {
        $this->alunoRepository = $alunoRepository;
        $this->protocoloRepository = $protocoloRepository;
    }

    public function estatisticas()
    {
        $this->registro = [
            'alunos' => (string) $this->alunoRepository->count(),
            'clientes' => (string) $this->protocoloRepository->getNumeroClientes(),
            'parteContrarias' => (string) $this->protocoloRepository->getNumeroParteContrarias(),
            'atendimentosMes' => (string) $this->protocoloRepository->getAtendimentosMes(),
            'top5DemandasMaisAtendidas' => $this->protocoloRepository->getTop5DemandasMaisAtendidas()
        ];
        return response()->json([
                    'status' => 'success',
                    'data' => $this->registro
                        ], 200);
    }

}
