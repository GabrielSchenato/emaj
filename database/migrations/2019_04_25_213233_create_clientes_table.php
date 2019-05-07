<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('pre_atendimento')->default(false);
            $table->string('nome_completo')->nullable(false);
            $table->string('representado_assistido')->nullable();
            $table->string('cpf', 12)->nullable();
            $table->string('rg', 7)->nullable();
            $table->string('profissao', 100)->nullable();
            $table->enum('sexo', ['M', 'F'])->nullable();
            $table->enum('estado_civil', ['solteiro', 'casado', 'separado', 'divorciado', 'viuvo'])->nullable();
            $table->string('email')->nullable();
            $table->float('renda')->nullable();
            $table->string('local_trabalho')->nullable();
            $table->unsignedBigInteger('nacionalidade_id')->nullable();
            $table->foreign('nacionalidade_id')->references('id')->on('nacionalidades');
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
        Schema::dropIfExists('clientes');
    }
}
