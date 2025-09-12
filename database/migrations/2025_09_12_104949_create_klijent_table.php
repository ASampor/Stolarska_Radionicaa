<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Klijent', function (Blueprint $table) {
            $table->increments('ID_Klijent');
            $table->string('Ime', 15);
            $table->string('Prezime', 25);
            $table->string('Email', 45)->unique();
            $table->string('Lozinka', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Klijent');
    }
};
