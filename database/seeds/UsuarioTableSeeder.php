<?php

use Illuminate\Database\Seeder;

class UsuarioTableSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\Emaj\Entities\Cadastro\Usuario::class, 10)->create();
    }

}
