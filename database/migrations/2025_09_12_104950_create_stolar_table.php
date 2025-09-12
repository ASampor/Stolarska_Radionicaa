<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStolarTable extends Migration
{
    public function up()
    {
        Schema::create('Stolar', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('ID_Stolar');
            $table->string('Ime', 15);
            $table->string('Prezime', 25);
            $table->string('Email', 45)->unique();
            $table->string('Lozinka', 255);
            $table->string('Telefon', 10);
        });
    }

    public function down()
    {
        Schema::dropIfExists('Stolar');
    }
}
