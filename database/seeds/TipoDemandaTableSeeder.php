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
        factory(Emaj\Entities\Cadastro\TipoDemanda::class, 1000)->create();
    }

}
