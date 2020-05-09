<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterColumnsParaImportacaoLegadoDb extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE clientes MODIFY COLUMN rg VARCHAR(255);');
        DB::statement('ALTER TABLE clientes MODIFY COLUMN representado_assistido_rg VARCHAR(255);');
        DB::statement('ALTER TABLE enderecos MODIFY COLUMN bairro VARCHAR(255);');
        DB::statement('ALTER TABLE tipo_demandas MODIFY COLUMN nome VARCHAR(255);');
        DB::statement('ALTER TABLE ficha_triagens MODIFY COLUMN protocolo VARCHAR(255);');
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
