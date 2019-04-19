<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\Emaj\Entities\Cadastro\User::class, 5)->create();
    }

}
