<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocolosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocolos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->string('protocolo')->nullable();
            $table->string('numero_processo')->nullable();

            $table->unsignedBigInteger('tipo_demanda_id')->nullable();
            $table->foreign('tipo_demanda_id')->references('id')->on('tipo_demandas');

            $table->unsignedBigInteger('parte_contraria_id')->nullable();
            $table->foreign('parte_contraria_id')->references('id')->on('clientes');

            $table->string('status');
            $table->string('observacoes')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protocolos');
    }
}
