<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateZahtevTable extends Migration
{
    public function up()
    {
        Schema::create('zahtevi', function (Blueprint $table) {
            $table->id();
            $table->string('Vrsta_proizvoda');
            $table->text('Opis')->nullable();
            $table->string('Lokacija');
            $table->string('Telefon');
            $table->foreignId('Klijent_id')->constrained('users')->onDelete('cascade');
            $table->timestamps(); // automatski dodaje created_at i updated_at
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
