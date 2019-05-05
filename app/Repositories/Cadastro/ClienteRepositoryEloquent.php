<?php

namespace Emaj\Repositories\Cadastro;

use Emaj\Entities\Cadastro\Cliente;
use Emaj\Entities\Cadastro\ComposicaoFamiliar;
use Illuminate\Validation\Rule;
use Emaj\Entities\Cadastro\Endereco;
use Emaj\Entities\Cadastro\Telefone;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Repository responsável por gerenciar a entidade Cliente
 *
 * PHP version 7.2
 *
 * @category   Repository
 * @package    Cadastro
 * @author     Gabriel Schenato <gabriel@uniplaclages.edu.br>
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link       https://www.uniplaclages.edu.br/
 * @since      1.0.0
 */
class ClienteRepositoryEloquent extends BaseRepository implements ClienteRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Cliente::class;
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
        try {
            DB::beginTransaction();

            $validator = Validator::make($attributes['informacoesPessoais'], $this->getRules($attributes['informacoesPessoais']));
            if ($validator->fails()) {
                return response()->json([
                            'status' => 'error',
                            'errors' => ['informacoesPessoais' => $validator->errors()]
                                ], 422);
            }

            if (isset($attributes['informacoesPessoais']['parte_contraria']) && !$attributes['informacoesPessoais']['parte_contraria']) {
                $validator = Validator::make($attributes['endereco'], EnderecoRepositoryEloquent::getRules($attributes['endereco']));
                if ($validator->fails()) {
                    return response()->json([
                                'status' => 'error',
                                'errors' => ['endereco' => $validator->errors()]
                                    ], 422);
                }
            }
            
            if (isset($attributes['informacoesPessoais']['parte_contraria']) && !$attributes['informacoesPessoais']['parte_contraria']) {
                $validator = Validator::make($attributes['composicaoFamiliar'], ComposicaoFamiliarRepositoryEloquent::getRules($attributes['composicaoFamiliar']));
                if ($validator->fails()) {
                    return response()->json([
                                'status' => 'error',
                                'errors' => ['composicaoFamiliar' => $validator->errors()]
                                    ], 422);
                }
            }

            $cliente = parent::create($attributes['informacoesPessoais']);
            $cliente->endereco()->create($attributes['endereco']);
            $cliente->composicao_familiar()->create($attributes['composicaoFamiliar']);
            $cliente->telefones()->createMany($attributes['telefones']);
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
            return response()->json([
                        'status' => 'error',
                        'errors' => $ex->getMessage()
                            ], 422);
        }
    }

    public function update(array $attributes, $id)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($attributes['informacoesPessoais'], $this->getRules($attributes['informacoesPessoais']));
            if ($validator->fails()) {
                return response()->json([
                            'status' => 'error',
                            'errors' => ['informacoesPessoais' => $validator->errors()]
                                ], 422);
            }

            if (isset($attributes['informacoesPessoais']['parte_contraria']) && !$attributes['informacoesPessoais']['parte_contraria']) {
                $validator = Validator::make($attributes['endereco'], EnderecoRepositoryEloquent::getRules($attributes['endereco']));
                if ($validator->fails()) {
                    return response()->json([
                                'status' => 'error',
                                'errors' => ['endereco' => $validator->errors()]
                                    ], 422);
                }
            }
            
            if (isset($attributes['informacoesPessoais']['parte_contraria']) && !$attributes['informacoesPessoais']['parte_contraria']) {
                $validator = Validator::make($attributes['composicaoFamiliar'], ComposicaoFamiliarRepositoryEloquent::getRules($attributes['composicaoFamiliar']));
                if ($validator->fails()) {
                    return response()->json([
                                'status' => 'error',
                                'errors' => ['composicaoFamiliar' => $validator->errors()]
                                    ], 422);
                }
            }
            
            $cliente = parent::update($attributes['informacoesPessoais'], $id);
            $cliente->endereco()->update($attributes['endereco'], $attributes['endereco']['id']);
            $cliente->composicao_familiar()->update($attributes['composicaoFamiliar'], $attributes['composicaoFamiliar']['id']);
            $telefoneRepository = new TelefoneRepositoryEloquent($this->app);
            foreach ($attributes['telefones'] as $telefone) {
                if(isset($telefone['id'])){
                    $telefoneRepository->update($telefone, $telefone['id']);
                }else{
                    $telefone = array_merge($telefone, ['cliente_id' => $id]);
                    $telefoneRepository->create($telefone);
                }
                
            }
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
            return response()->json([
                        'status' => 'error',
                        'errors' => $ex->getMessage()
                            ], 422);
        }
    }

    public static function getRules($data)
    {
        $id = isset($data['id']) ? $data['id'] : null;
        if (isset($data['parte_contraria']) && !$data['parte_contraria']) {
            return [
                'nome_completo' => ['required', 'min:6', 'max:255', Rule::unique('clientes')->ignore($id)],
                'cpf' => 'required|numeric',
                'rg' => 'required|numeric',
                'profissao' => 'required|max:100',
                'sexo' => ['required', Rule::in(['M', 'F'])],
                'estado_civil' => ['required', Rule::in(['solteiro', 'casado', 'separado', 'divorciado', 'viuvo'])],
                'email' => ['nullable', 'email', Rule::unique('clientes')->ignore($id)],
                'renda' => 'required|numeric',
                'local_trabalho' => 'required|max:255',
                'nacionalidade_id' => 'required|numeric'
            ];
        } else {
            return [
                'nome_completo' => ['required', 'min:6', 'max:255', Rule::unique('clientes')->ignore($id)],
                'sexo' => ['required', Rule::in(['M', 'F'])],
                'nacionalidade_id' => 'required|numeric'
            ];
        }
    }

}
