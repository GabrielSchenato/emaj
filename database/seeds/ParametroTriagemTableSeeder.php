<?php

use Illuminate\Database\Seeder;

class ParametroTriagemTableSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Emaj\Entities\Cadastro\ParametroTriagem::class, 1)->create();
    }

}
