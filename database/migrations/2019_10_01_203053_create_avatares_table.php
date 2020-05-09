<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAvataresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avatares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('mimetype');
            $table->string('extensao', 10);
            $table->unsignedBigInteger('tamanho');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE avatares ADD avatar LONGBLOB AFTER nome");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('avatares');
    }
}
