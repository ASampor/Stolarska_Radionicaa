<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Termin', function (Blueprint $table) {
            $table->id('ID_Termin'); // primarni ključ
            $table->dateTime('Datum_vreme'); // datum i vreme termina
            $table->unsignedBigInteger('Zahtev_id'); // veza sa zahtevom
            $table->unsignedBigInteger('Stolar_id'); // veza sa stolarom

            // Definišemo spoljne ključeve
            $table->foreign('Zahtev_id')->references('ID_Zahtev')->on('Zahtev')->onDelete('cascade');
            $table->foreign('Stolar_id')->references('ID_Stolar')->on('Stolar')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Termin');
    }
};
