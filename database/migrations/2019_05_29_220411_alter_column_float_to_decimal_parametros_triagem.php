<?php

use Illuminate\Database\Migrations\Migration;

class AlterColumnFloatToDecimalParametrosTriagem extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE parametros_triagem MODIFY COLUMN renda DECIMAL(10,2);');
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
