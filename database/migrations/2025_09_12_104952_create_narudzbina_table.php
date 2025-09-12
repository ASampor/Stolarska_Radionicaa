<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNarudzbinaTable extends Migration
{
    public function up()
    {
        Schema::create('Narudzbina', function (Blueprint $table) {
            $table->increments('ID_Narudzbina');
            $table->string('Specifikacija', 255);
            $table->date('Rok');
            $table->unsignedInteger('Klijent_id');
            $table->unsignedInteger('Stolar_id');
            $table->decimal('Cena', 10, 2);
            $table->unsignedInteger('Status_id');
            
            $table->index('Status_id', 'Status_id_idx');
            $table->index('Stolar_id', 'Stolar_id_idx');
            $table->index('Klijent_id', 'Klijent_id_idx');

            $table->foreign('Stolar_id','FK_Narudzbina_Stolar')
                  ->references('ID_Stolar')->on('Stolar')
                  ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('Status_id','FK_Narudzbina_Status')
                  ->references('ID_Status')->on('Status')
                  ->onDelete('restrict')->onUpdate('cascade');

            $table->foreign('Klijent_id','FK_Narudzbina_Klijent')
                  ->references('ID_Klijent')->on('Klijent')
                  ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('Narudzbina', function(Blueprint $table) {
            $table->dropForeign('FK_Narudzbina_Stolar');
            $table->dropForeign('FK_Narudzbina_Status');
            $table->dropForeign('FK_Narudzbina_Klijent');
            $table->dropIndex('Status_id_idx');
            $table->dropIndex('Stolar_id_idx');
            $table->dropIndex('Klijent_id_idx');
        });
        Schema::dropIfExists('Narudzbina');
    }
}
