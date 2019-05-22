<?php

use Illuminate\Database\Migrations\Migration;

class AddNullableTipoStatusIdETipoStatusIdFichaTriagens extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE ficha_triagens MODIFY COLUMN tipo_demanda_id bigint(20) unsigned NULL;');
        DB::statement('ALTER TABLE ficha_triagens MODIFY COLUMN tipo_status_id bigint(20) unsigned NULL;');
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
