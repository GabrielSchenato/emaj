<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AddTipoStatus extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('tipo_status')->insert(
                [
                    ['nome' => 'Ajuizado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                    ['nome' => 'Não Ajuizado', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
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
