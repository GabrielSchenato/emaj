<?php

use Emaj\Entities\Cadastro\ComposicaoFamiliar;
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

$factory->define(ComposicaoFamiliar::class, function (Faker $faker) {
    $casa = ['Alugada', 'Própria', 'Cedida'];
    return [
        'renda_familiar' => $faker->numberBetween(100, 2000),
        'casa' => $casa[random_int(0, 2)],
        'possui_carro' => $faker->boolean,
        'marca_carro' => $faker->company,
        'ano_carro' => $faker->year,
        'possui_moto' => $faker->boolean,
        'marca_moto' => $faker->company,
        'ano_moto' => $faker->year,
        'outros_bens' => $faker->sentence,
        'dividas' => $faker->sentence,
        'despesas' => $faker->sentence,
        'valor_patrimonio' => $faker->numberBetween(100, 2000),
        'observacoes' => $faker->sentence
    ];
});
