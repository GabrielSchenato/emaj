<?php

use Illuminate\Database\Migrations\Migration;

class AlterColumnFloatToDecimal extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE clientes MODIFY COLUMN renda DECIMAL(10,2);');
        DB::statement('ALTER TABLE composicao_familiares MODIFY COLUMN renda_familiar DECIMAL(10,2);');
        DB::statement('ALTER TABLE composicao_familiares MODIFY COLUMN valor_patrimonio DECIMAL(10,2);');
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
