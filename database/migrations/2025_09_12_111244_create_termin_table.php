<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerminTable extends Migration
{
    public function up()
    {
        Schema::create('Termin', function (Blueprint $table) {
            $table->increments('ID_Termin');
            $table->dateTime('Datum_vreme');
            $table->unsignedInteger('Zahtev_id');
            $table->unsignedInteger('Stolar_id');

            $table->index('Zahtev_id', 'Zahtev_id_idx');
            $table->index('Stolar_id', 'Stolar_id_idx');

            $table->foreign('Zahtev_id','FK_Termin_Zahtev')
                  ->references('ID_Zahtev')->on('Zahtev')
                  ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('Stolar_id','FK_Termin_Stolar')
                  ->references('ID_Stolar')->on('Stolar')
                  ->onDelete('restrict')->onUpdate('cascade');

        });
    }

    public function down()
    {
        Schema::table('Termin', function(Blueprint $table) {
            $table->dropForeign('FK_Termin_Zahtev');
            $table->dropForeign('FK_Termin_Stolar');
            $table->dropIndex('Zahtev_id_idx');
            $table->dropIndex('Stolar_id_idx');
        });
        Schema::dropIfExists('Termin');
    }
}
