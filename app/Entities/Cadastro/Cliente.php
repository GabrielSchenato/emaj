<?php

namespace Emaj\Entities\Cadastro;

use Emaj\Entities\Movimento\FichaTriagem;
use Emaj\Util\Functions;
use Illuminate\Database\Eloquent\Model;

/**
 * Classe da entidade Cliente
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
class Cliente extends Model
{

    protected $appends = ['parte_contraria', 'dados_cliente'];
    protected $fillable = [
        'pre_atendimento',
        'nome_completo',
        'representado_assistido',
        'representado_assistido_cpf',
        'representado_assistido_rg',
        'cpf',
        'rg',
        'profissao',
        'sexo',
        'estado_civil',
        'email',
        'renda',
        'local_trabalho',
        'nacionalidade_id',
        'ativo',
    ];

    /**
     * Pega o Endereço associado ao cliente.
     */
    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }

    /**
     * Pega a Composição Familiar associada ao cliente.
     */
    public function composicao_familiar()
    {
        return $this->hasOne(ComposicaoFamiliar::class);
    }

    /**
     * Pega todos os Telefones associados ao cliente.
     */
    public function telefones()
    {
        return $this->hasMany(Telefone::class);
    }
    
    /**
     * Pega todos os Protocolos associados ao cliente.
     */
    public function protocolos()
    {
        return $this->hasMany(Protocolo::class);
    }

    /**
     * Pega todas as Ficha de Triagens associados ao cliente.
     */
    public function ficha_triagens_cliente()
    {
        return $this->hasMany(FichaTriagem::class, 'cliente_id');
    }

    /**
     * Pega todas as Ficha de Triagens associados ao cliente parte contrária.
     */
    public function ficha_triagens_parte_contraria()
    {
        return $this->hasMany(FichaTriagem::class, 'parte_contraria_id');
    }

    /**
     * Pega a nacionalidade que está associada a esse cliente.
     */
    public function nacionalidade()
    {
        return $this->belongsTo(Nacionalidade::class);
    }

    /**
     * Método responsável por montar os dados do cliente.
     * 
     * @return string
     */
    protected function getDadosClienteAttribute()
    {
        $string = $this->nome_completo . " ({$this->id})";
        if ($this->representado_assistido) {
            $string .= " - Representado/Assistido: {$this->representado_assistido}";
        }
        if ($this->cpf) {
            $string .= " - CPF: {$this->cpf}";
        }
        if ($this->rg) {
            $string .= " - RG: {$this->rg}";
        }
        if ($this->renda) {
            $string .= " - Renda: R$ " . Functions::getMoedaFormatadaReal($this->renda);
        }
        return $string;        
    }

    /**
     * Método responsável por verificar e retornar se o é parte contraria
     * ou não.
     * 
     * @return boolean
     */
    protected function getParteContrariaAttribute()
    {
        if ($this->isEmptyCliente() || $this->isEmptyEndereco() || $this->isEmptyComposicaoFamiliar() || count($this->telefones) == 0) {
            return true;
        }
        return false;
    }

    /**
     * Método responsável por verificar se existem os dados do cliente.
     * 
     * @return boolean
     */
    private function isEmptyCliente()
    {
        if (!$this->cpf || !$this->rg
                || !$this->profissao || !$this->sexo
                || !$this->estado_civil || !$this->renda
                && (bool) $this->pre_atendimento == false) {
            return true;
        }
        return false;
    }

    /**
     * Método responsável por verificar se o cliente possui os dados
     * obrigatorios do endereço.
     * 
     * @return boolean
     */
    private function isEmptyEndereco()
    {
        if (!$this->endereco->cep || !$this->endereco->logradouro 
                || !$this->endereco->bairro || !$this->endereco->numero 
                || !$this->endereco->localidade || !$this->endereco->uf) {
            return true;
        }
        return false;
    }
    
    /**
     * Método responsável por verificar se o cliente possui os dados
     * obrigatorios da composição familiar.
     * 
     * @return boolean
     */
    private function isEmptyComposicaoFamiliar()
    {
        if (!$this->composicao_familiar->renda_familiar || !$this->composicao_familiar->casa
                || !$this->composicao_familiar->outros_bens || !$this->composicao_familiar->dividas
                || !$this->composicao_familiar->despesas || !$this->composicao_familiar->valor_patrimonio) {
            return true;
        }
        return false;
    }
}
