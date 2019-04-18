<?php

namespace Emaj\Http\Controllers\Api\V1;

use Emaj\Entity\Cadastro\TipoDemanda;
use Emaj\Http\Controllers\Controller;
use Emaj\Util\Traits\ApiController;

/**
 * Classe responsável por gerenciar a requisições das páginas
 *
 * PHP version 7.2
 *
 * @category   Controller
 * @package    Api\V1
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class TipoDemandasController extends Controller
{

    use ApiController;

    protected $model;

    public function __construct(TipoDemanda $model)
    {
        $this->model = $model;
    }

}
