<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\AvaliacaoArquivo;
use Emaj\Repositories\AbstractRepository;
use Emaj\Util\Functions;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Avaliação Arquivo
 *
 * PHP version 7.2
 *
 * @category   Repository
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.1.0
 */
class AvaliacaoArquivoRepositoryEloquent extends AbstractRepository implements AvaliacaoArquivoRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AvaliacaoArquivo::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $attributes)
    {
        $files = request()->file('attachments');

        if (!is_array($files)) {
            $files = [$files];
        }

        $stored = [];
        foreach ($files as $file) {
            $attributes['nome'] = Functions::getNomeArquivoSemExtensao($file);
            $attributes['arquivo'] = Functions::convertFileBinary($file);
            $attributes['mimetype'] = $file->getMimeType();
            $attributes['extensao'] = $file->getClientOriginalExtension();
            $attributes['tamanho'] = $file->getSize();
            $file = parent::create($attributes);
            $stored[] = $file;
        }
        return $stored;
    }

    /**
     * Método responsável por retornar as regras a serem aplicadas ao criar ou editar
     * um registro
     * 
     * @param array $data
     * @param int $id
     * 
     * @return array Regras para serem aplicadas
     */
    public function getRules(array $data, int $id = null)
    {
        return [
        ];
    }

}
