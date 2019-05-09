<?php

use Emaj\Entities\Movimento\FichaTriagem;
use Faker\Generator as Faker;

/*
  |--------------------------------------------------------------------------
  | Model Factories
  |--------------------------------------------------------------------------
  |
  | This directory should contain each of the model factory definitions for
  | your application. Factories provide a convenient way to generate new
  | model instances for testing / seeding your application's database.
  |
 */

$factory->define(FichaTriagem::class, function (Faker $faker) {
    $cliente_id = \Emaj\Entities\Cadastro\Cliente::inRandomOrder()->first();
    $parte_contraria_id = \Emaj\Entities\Cadastro\Cliente::where('id', '<>', $cliente_id)->inRandomOrder()->first();
    if(!$faker->boolean){
        $parte_contraria_id = null;
    }
    return [
        'ja_foi_atendido' => $faker->boolean,
        'cliente_id' => $cliente_id,
        'numero_protocolo_id' => \Emaj\Entities\Movimento\NumeroProtocolo::create([]),
        'tipo_demanda_id' => \Emaj\Entities\Cadastro\TipoDemanda::inRandomOrder()->first(),
        'parte_contraria_id' => $parte_contraria_id,
        'aluno_id' => \Emaj\Entities\Cadastro\Usuario::where('role', '=', 'aluno')->inRandomOrder()->first(),
        'tipo_status_id' => \Emaj\Entities\Cadastro\TipoStatus::inRandomOrder()->first(),
        'outras_informacoes' => $faker->sentence
    ];
});
