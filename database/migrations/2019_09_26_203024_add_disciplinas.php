<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AddDisciplinas extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('disciplinas')->insert(
            [
                ['nome' => 'ESTÁGIO II', 'created_at' => Carbon::now()],
                ['nome' => 'ESTÁGIO III', 'created_at' => Carbon::now()],
                ['nome' => 'ESTÁGIO IV', 'created_at' => Carbon::now()]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
