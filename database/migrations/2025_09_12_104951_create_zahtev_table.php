<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateZahtevTable extends Migration
{
    public function up()
    {
        Schema::create('Zahtev', function (Blueprint $table) {
            $table->increments('ID_Zahtev');
            $table->string('Vrsta_proizvoda', 20);
            $table->string('Opis', 200)->nullable();
            // default CURDATE()
            $table->date('Datum_kreiranja')->default(DB::raw('CURRENT_DATE'));
            $table->unsignedInteger('Klijent_id');
            $table->string('Lokacija', 255);
            $table->string('Telefon', 10);

            $table->index('Klijent_id', 'Klijent_id_idx');
            $table->foreign('Klijent_id','FK_Zahtev_Klijent')
                  ->references('ID_Klijent')->on('Klijent')
                  ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('Zahtev', function(Blueprint $table) {
            $table->dropForeign('FK_Zahtev_Klijent');
            $table->dropIndex('Klijent_id_idx');
        });
        Schema::dropIfExists('Zahtev');
    }
}
