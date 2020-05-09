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
        DB::table('nacionalidades')->insert(
            [
                ['nome' => 'ANTIGUANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'ARGENTINO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'BAHAMENSE', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'BARBADIANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'BELIZENHO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'BOLIVIANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'BRASILEIRO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'CHILENO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'COLOMBIANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'COSTARRIQUENHO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'CUBANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'DOMINICANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'EQUATORIANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'SALVADORENHO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'GRANADINO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'GUATEMALTECO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'GUIANÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'GUIANENSE', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'HAITIANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'HONDURENHO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'JAMAICANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'MEXICANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'NICARAGUENSE', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'PANOMENHO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'PARAGUAIO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'PERUANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'PORTORRIQUENHO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'DOMINICANA', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'SÃO-CRISTOVENSE', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'SÃO-VICENTINO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'SANTA-LUCENSE', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'SURINAMÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'TRINDADENSE', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'URUGUAIO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'VENEZUELANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'ALEMÃO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'AUSTRÍACO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'BELGA', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'CROATA', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'DINAMARQUÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'ESLOVACO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'ESLOVENO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'ESPANHOL', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'FRANCÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'GREGO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'HÚNGARO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'IRLANDÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'ITALIANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'NORUEGO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'HOLANDÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'POLONÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'PORTUGUÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'BRITÂNICO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'INGLÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'GALÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'ESCOCÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'ROMENO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'RUSSO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'SÉRVIO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'SUECO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'SUÍÇO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'TURCO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'UCRANIANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'AMERICANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'CANADENSE', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'ANGOLANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'MOÇAMBICANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'SUL-AFRICANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'ZIMBABUENSE', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'ARGÉLIA', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'COMORENSE', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'EGÍPCIO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'LÍBIO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'MARROQUINO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'GANÉS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'QUENIANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'RUANDÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'UGANDENSE', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'BECHUANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'MARFINENSE', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'CAMARONENSE', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'NIGERIANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'SOMALI', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'AUSTRALIANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'NEOZELANDÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'AFEGÃO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'SAUDITA', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'ARMENO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'BANGLADESH', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'CHINÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'NORTE-COREANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'SUL-COREANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'INDIANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'INDONÉSIO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'IRAQUIANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'IRANIANO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'ISRAELITA', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'JAPONÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'MALAIO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'NEPALÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'OMANENSE', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'PAQUISTANÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'PALESTINO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'QATARENSE', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'SÍRIO', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'CINGALÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'TAILANDÊS', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'TIMORENSE', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'ÁRABE', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'VIETNAMITA', 'created_at' => Carbon::now(), 'updated_at' => null],
                ['nome' => 'IEMENITA', 'created_at' => Carbon::now(), 'updated_at' => null],
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
