<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cep', 9)->nullable();
            $table->string('logradouro', 100)->nullable();
            $table->string('complemento', 50)->nullable();
            $table->string('gia')->nullable();
            $table->string('ibge')->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('localidade', 50)->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('unidade')->nullable();
            $table->string('endereco_local_trabalho')->nullable();
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
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
        Schema::dropIfExists('enderecos');
    }

}
