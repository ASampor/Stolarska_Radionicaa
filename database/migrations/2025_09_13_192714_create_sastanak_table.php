<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sastanak', function (Blueprint $table) {
            $table->id('ID_Sastanak'); // primarni ključ
            $table->dateTime('Datum_vreme');

            // Veze sa zahtevom i stolarom
            $table->foreignId('Zahtev_id')->constrained('zahtevi')->onDelete('cascade'); // bigint unsigned
            $table->unsignedInteger('Stolar_id'); 
            $table->foreign('Stolar_id')->references('ID_Stolar')->on('stolar')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sastanak');
    }
};
