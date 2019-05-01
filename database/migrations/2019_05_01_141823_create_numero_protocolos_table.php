<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateNumeroProtocolosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('numero_protocolos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE numero_protocolos AUTO_INCREMENT = 19000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('numero_protocolos');
    }

}
