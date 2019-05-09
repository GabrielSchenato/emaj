<?php

use Illuminate\Database\Seeder;

class FichaTriagemTableSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Emaj\Entities\Movimento\FichaTriagem::class, 1000)->create();
    }

}
