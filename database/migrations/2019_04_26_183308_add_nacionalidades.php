<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddNacionalidades extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('nacionalidades')->insert([
            ['nome' => 'Antiguano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Argentino', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Bahamense', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Barbadiano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Belizenho', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Boliviano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Brasileiro', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Chileno', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Colombiano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Costarriquenho', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Cubano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Dominicano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Equatoriano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Salvadorenho', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Granadino', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Guatemalteco', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Guianês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Guianense', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Haitiano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Hondurenho', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Jamaicano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Mexicano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Nicaraguense', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Panomenho', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Paraguaio', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Peruano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Portorriquenho', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Dominicana', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'São-cristovense', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'São-vicentino', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Santa-lucense', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Surinamês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Trindadense', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Uruguaio', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Venezuelano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Alemão', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Austríaco', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Belga', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Croata', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Dinamarquês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Eslovaco', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Esloveno', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Espanhol', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Francês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Grego', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Húngaro', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Irlandês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Italiano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Noruego', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Holandês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Polonês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Português', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Britânico', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Inglês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Galês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Escocês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Romeno', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Russo', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Sérvio', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Sueco', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Suíço', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Turco', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Ucraniano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Americano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Canadense', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Angolano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Moçambicano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Sul-africano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Zimbabuense', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Argélia', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Comorense', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Egípcio', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Líbio', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Marroquino', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Ganés', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Queniano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Ruandês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Ugandense', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Bechuano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Marfinense', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Camaronense', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Nigeriano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Somali', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Australiano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Neozelandês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Afegão', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Saudita', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Armeno', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Bangladesh', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Chinês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Norte-coreano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Sul-coreano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Indiano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Indonésio', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Iraquiano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Iraniano', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Israelita', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Japonês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Malaio', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Nepalês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Omanense', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Paquistanês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Palestino', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Qatarense', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Sírio', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Cingalês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Tailandês', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Timorense', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Árabe', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Vietnamita', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['nome' => 'Iemenita', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ]
        );
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
