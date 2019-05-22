<?php

use Emaj\Entities\Cadastro\Cliente;
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

$factory->define(Cliente::class, function (Faker $faker) {
    $sexo = ['F', 'M'];
    $estadoCivil = ['Solteiro', 'Casado', 'Separado', 'Divorciado', 'Viúvo'];
    return [
        'pre_atendimento' => $faker->boolean(),
        'nome_completo' => $faker->name,
        'representado_assistido' => $faker->name,
        'representado_assistido_cpf' => $faker->numerify('###.###.###-##'),
        'representado_assistido_rg' => $faker->numerify('#.###.###'),
        'cpf' => $faker->numerify('###.###.###-##'),
        'rg' => $faker->numerify('#.###.###'),
        'profissao' => $faker->jobTitle,
        'sexo' => $sexo[random_int(0, 1)],
        'estado_civil' => $estadoCivil[random_int(0, 4)],
        'email' => $faker->unique()->safeEmail,
        'renda' => $faker->numberBetween(500, 3000),
        'local_trabalho' => $faker->company,
        'nacionalidade_id' => random_int(1, 111),
        'ativo' => $faker->boolean
    ];
});
