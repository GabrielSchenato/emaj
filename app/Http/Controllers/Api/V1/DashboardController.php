<?php

namespace Emaj\Http\Controllers\Api\V1;

use Emaj\Http\Controllers\Controller;
use Emaj\Repositories\Cadastro\ClienteRepositoryEloquent;
use Emaj\Repositories\Cadastro\UsuarioRepositoryEloquent;
use Emaj\Repositories\Movimento\FichaTriagemRepositoryEloquent;

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
     * @var FichaTriagemRepositoryEloquent
     */
    private $fichaTriagemRepository;

    /**
     * @var ClienteRepositoryEloquent
     */
    private $clienteRepository;

    /**
     * @var UsuarioRepositoryEloquent
     */
    private $usuarioRepository;

    /**
     * Variável com as estatísticas
     * @var array 
     */
    private $registro;

    public function __construct(UsuarioRepositoryEloquent $usuarioRepository, ClienteRepositoryEloquent $clienteRepository, FichaTriagemRepositoryEloquent $fichaTriagemRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
        $this->clienteRepository = $clienteRepository;
        $this->fichaTriagemRepository = $fichaTriagemRepository;
    }

    public function estatisticas()
    {
        $this->registro = [
            'usuarios' => (string) $this->usuarioRepository->count(),
            'clientes' => (string) $this->clienteRepository->count(),
            'triagens' => (string) $this->fichaTriagemRepository->count(),
            'triagensAtendimentoMes' => (string) $this->fichaTriagemRepository->pushCriteria(\Emaj\Criteria\MesCriteria::class)->count(),
            'top5DemandasMaisAtendidas' => $this->fichaTriagemRepository->top5DemandasMaisAtendidas()
        ];
        return response()->json([
                        'status' => 'success',
                        'data' => $this->registro
                            ], 200);
    }

}
