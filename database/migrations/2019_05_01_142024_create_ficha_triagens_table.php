<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFichaTriagensTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_triagens', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->boolean('ja_foi_atendido')->default(false);
            
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            
            $table->unsignedBigInteger('numero_protocolo_id');
            $table->foreign('numero_protocolo_id')->references('id')->on('numero_protocolos');
            
            $table->unsignedBigInteger('tipo_demanda_id');
            $table->foreign('tipo_demanda_id')->references('id')->on('tipo_demandas');
            
            $table->unsignedBigInteger('parte_contraria_id');
            $table->foreign('parte_contraria_id')->references('id')->on('clientes');
            
            $table->unsignedBigInteger('aluno_id')->nullable();
            $table->foreign('aluno_id')->references('id')->on('usuarios');
            
            $table->unsignedBigInteger('tipo_status_id');
            $table->foreign('tipo_status_id')->references('id')->on('tipo_status');
            
            $table->string('outras_informacoes')->nullable();
            
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
        Schema::dropIfExists('ficha_triagens');
    }

}
