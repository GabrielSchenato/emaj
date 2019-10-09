<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AddDiaPeriodos extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('dia_periodos')->insert(
                [
                    ['nome' => 'SEGUNDA-FEIRA MATUTINO', 'hora_inicial' => '06:00', 'hora_final' => '11:59:59','created_at' => Carbon::now()],
                    ['nome' => 'SEGUNDA-FEIRA VESPERTINO', 'hora_inicial' => '12:00', 'hora_final' => '17:59:59','created_at' => Carbon::now()],
                    ['nome' => 'TERÇA-FEIRA MATUTINO', 'hora_inicial' => '06:00', 'hora_final' => '11:59:59','created_at' => Carbon::now()],
                    ['nome' => 'TERÇA-FEIRA VESPERTINO', 'hora_inicial' => '12:00', 'hora_final' => '17:59:59','created_at' => Carbon::now()],
                    ['nome' => 'QUARTA-FEIRA MATUTINO', 'hora_inicial' => '06:00', 'hora_final' => '11:59:59','created_at' => Carbon::now()],
                    ['nome' => 'QUARTA-FEIRA VESPERTINO', 'hora_inicial' => '12:00', 'hora_final' => '17:59:59','created_at' => Carbon::now()],
                    ['nome' => 'QUINTA-FEIRA MATUTINO', 'hora_inicial' => '06:00', 'hora_final' => '11:59:59','created_at' => Carbon::now()],
                    ['nome' => 'QUINTA-FEIRA VESPERTINO', 'hora_inicial' => '12:00', 'hora_final' => '17:59:59','created_at' => Carbon::now()],
                    ['nome' => 'SEXTA-FEIRA MATUTINO', 'hora_inicial' => '06:00', 'hora_final' => '11:59:59','created_at' => Carbon::now()],
                    ['nome' => 'SEXTA-FEIRA VESPERTINO', 'hora_inicial' => '12:00', 'hora_final' => '17:59:59','created_at' => Carbon::now()]
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
