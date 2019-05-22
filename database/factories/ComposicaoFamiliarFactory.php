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
    $possuiCarro = $faker->boolean;
    $possuiMoto = $faker->boolean;
    return [
        'renda_familiar' => $faker->numberBetween(500, 5000),
        'casa' => $casa[random_int(0, 2)],
        'possui_carro' => $possuiCarro,
        'marca_carro' => $possuiCarro ? $faker->name : null,
        'ano_carro' => $possuiCarro ? $faker->year : null,
        'possui_moto' => $possuiMoto,
        'marca_moto' => $possuiMoto ? $faker->name : null,
        'ano_moto' => $possuiMoto ? $faker->year : null,
        'outros_bens' => $faker->sentence,
        'dividas' => $faker->sentence,
        'despesas' => $faker->sentence,
        'valor_patrimonio' => $faker->numberBetween(1000, 10000),
        'observacoes' => $faker->sentence
    ];
});
