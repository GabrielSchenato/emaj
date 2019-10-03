<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\Avatar;
use Emaj\Repositories\AbstractRepository;
use Emaj\Util\Functions;
use Illuminate\Http\UploadedFile;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Repository responsável por gerenciar a entidade Avatar
 *
 * PHP version 7.2
 *
 * @category   Repository
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      2.1.0
 */
class AvatarRepositoryEloquent extends AbstractRepository implements AvatarRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Avatar::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Método responsável por criar ou atualizar o registro de um avatar.
     * 
     * @param UploadedFile $imageUrl
     * @param int | null $id
     * @return array
     */
    private function save($imageUrl, $id = null)
    {
        $avatar = Functions::compressImage($imageUrl, 20);
        $attributes = [];
        $attributes['image_url'] = $avatar;
        $attributes['nome'] = Functions::getNomeArquivoSemExtensao($avatar);
        $attributes['avatar'] = Functions::convertFileBinary($avatar);
        $attributes['mimetype'] = $avatar->getMimeType();
        $attributes['extensao'] = $avatar->getClientOriginalExtension();
        $attributes['tamanho'] = $avatar->getSize();
        return parent::updateOrCreate(['id' => $id], $attributes);
    }

    /**
     * Método responsável por verificar se é para criar ou atualizar um avatar.
     * 
     * @param array $attributes
     * @return void
     */
    public function saveOrUpdateAvatar(array &$attributes)
    {
        if (isset($attributes['avatar_id']) && isset($attributes['image_url'])) {
            $this->save($attributes['image_url'], (int) $attributes['avatar_id']);
        }
        if (isset($attributes['image_url']) && !isset($attributes['avatar_id'])) {
            $avatar = $this->save($attributes['image_url']);
            $attributes['avatar_id'] = $avatar->id;
        }
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
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
        ];
    }

}
