<?php

use Emaj\Entities\Cadastro\Usuario;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

$factory->define(Usuario::class, function (Faker $faker) {
    $roles = ['admin', 'secretaria'];
    return [
        'nome_completo' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('123456'),
        'role' => $roles[random_int(0, 1)],
        'avatar' => null,
        'telefone' => $faker->numerify('(##) #####-####'),
        'ativo' => $faker->boolean,
        'remember_token' => Str::random(10),
    ];
});
