<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnRepresentadoAssistidoCpfErepresentadoAssistidoRgClientes extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('representado_assistido_cpf', 15)->nullable();
            $table->string('representado_assistido_rg', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumn('representado_assistido_cpf');
        Schema::dropColumn('representado_assistido_rg');
    }

}
