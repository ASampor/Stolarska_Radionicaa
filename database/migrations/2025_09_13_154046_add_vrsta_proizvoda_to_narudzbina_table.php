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
        Schema::table('Narudzbina', function (Blueprint $table) {
            $table->string('Vrsta_proizvoda')->nullable(); // nullable jer već postoje podaci
        });
    }

    public function down(): void
    {
        Schema::table('Narudzbina', function (Blueprint $table) {
            $table->dropColumn('Vrsta_proizvoda');
        });
    }

};
