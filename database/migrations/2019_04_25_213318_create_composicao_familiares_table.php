<?php

use Emaj\Util\TiposCasa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComposicaoFamiliaresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('composicao_familiares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('renda_familiar')->nullable();
            $table->enum('casa', TiposCasa::getTiposCasa())->nullable();
            $table->boolean('possui_carro')->nullable();
            $table->string('marca_carro', 50)->nullable();
            $table->integer('ano_carro')->nullable();
            $table->boolean('possui_moto')->nullable();
            $table->string('marca_moto', 50)->nullable();
            $table->integer('ano_moto')->nullable();
            $table->string('outros_bens')->nullable();
            $table->string('dividas')->nullable();
            $table->string('despesas')->nullable();
            $table->float('valor_patrimonio')->nullable();
            $table->string('observacoes', 300)->nullable();
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
        Schema::dropIfExists('composicao_familiares');
    }
}
