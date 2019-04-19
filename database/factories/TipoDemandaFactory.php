<?php

use Emaj\Entities\Cadastro\TipoDemanda;
use Faker\Generator as Faker;

$factory->define(TipoDemanda::class, function (Faker $faker) {
    return [
        'nome' => $faker->firstName,
        'descricao' => $faker->sentence
    ];
});
