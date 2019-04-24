<?php

use Emaj\Entities\Cadastro\ParametroTriagem;
use Faker\Generator as Faker;

$factory->define(ParametroTriagem::class, function (Faker $faker) {
    return [
        'renda' => $faker->numberBetween(100, 2000)
    ];
});
