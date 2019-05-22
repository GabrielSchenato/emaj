<?php

use Emaj\Entities\Cadastro\Endereco;
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

$factory->define(Endereco::class, function (Faker $faker) {
    return [
        'cep' => $faker->numerify('########'),
        'logradouro' => $faker->streetName,
        'complemento' => $faker->streetSuffix,
        'numero' => $faker->numberBetween(1, 1000),
        'bairro' => $faker->streetName,
        'localidade' => $faker->city,
        'uf' => strtoupper($faker->lexify('??')),
        'endereco_local_trabalho' => $faker->streetAddress
    ];
});
