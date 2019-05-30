<?php

use Emaj\Entities\Cadastro\Cliente;
use Emaj\Entities\Cadastro\ComposicaoFamiliar;
use Emaj\Entities\Cadastro\Endereco;
use Emaj\Entities\Cadastro\Telefone;
use Illuminate\Database\Seeder;

class ClienteTableSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Cliente::class, 100)->create()->each(function ($cliente) {
            $cliente->endereco()->create(factory(Endereco::class)->raw());
            $cliente->composicao_familiar()->create(factory(ComposicaoFamiliar::class)->raw());
            $cliente->telefones()->saveMany(factory(Telefone::class, 5)->make());
        });
    }

}
