<?php

namespace Emaj\Entities\Cadastro;

use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Composição Familiar
 *
 * PHP version 7.2
 *
 * @category   Entity
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class ComposicaoFamiliar extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'composicao_familiares';
    
    protected $fillable = [
        'renda_familiar',
        'casa',
        'possui_carro',
        'marca_carro',
        'ano_carro',
        'possui_moto',
        'marca_moto',
        'ano_moto',
        'outros_bens',
        'dividas',
        'despesas',
        'valor_patrimonio',
        'observacoes',
        'cliente_id',
    ];

    /**
     * Pega o cliente que é dono dessa Composição Familiar.
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

}
