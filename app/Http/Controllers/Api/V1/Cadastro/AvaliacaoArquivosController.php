<?php

namespace Emaj\Http\Controllers\Api\V1\Cadastro;

use Emaj\Http\Controllers\CrudController;
use Emaj\Repositories\Cadastro\AvaliacaoArquivoRepository;

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
class AvaliacaoArquivosController extends CrudController
{

    protected $repository;

    public function __construct(AvaliacaoArquivoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function download($id)
    {
        $this->registro = $this->repository->find($id);

        $headers = [
            'Content-Type' => $this->registro->mimetype,
            'Content-length' => $this->registro->tamanho,
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'attachment; filename="' . rawurlencode($this->registro->nome_arquivo_extensao) . '"',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Transfer-Encoding' => 'binary',
            'Pragma' => 'public',
            'Expires' => '0'
        ];
        
        ob_end_clean();        
        
        return response()->make(base64_decode($this->registro->arquivo), 200, $headers);
    }

}
