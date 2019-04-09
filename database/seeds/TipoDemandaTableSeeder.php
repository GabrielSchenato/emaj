<?php

use Illuminate\Database\Seeder;

class TipoDemandaTableSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Emaj\Entity\Cadastro\TipoDemanda::class, 30)->create();
    }

}
