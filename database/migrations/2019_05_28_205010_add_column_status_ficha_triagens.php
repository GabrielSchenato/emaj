<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStatusFichaTriagens extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ficha_triagens', function (Blueprint $table) {
            $table->string('status')->after('nome_professor');
        });
        DB::statement('UPDATE ficha_triagens
                       SET status =
                          (SELECT nome
                           FROM tipo_status
                           WHERE id = tipo_status_id);');
        Schema::table('ficha_triagens', function (Blueprint $table) {
            $table->dropForeign('ficha_triagens_tipo_status_id_foreign');
            $table->dropColumn('tipo_status_id');
        });
        Schema::dropIfExists('tipo_status');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumn('status');
    }

}
