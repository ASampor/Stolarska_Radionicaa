<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusTable extends Migration
{
    public function up()
    {
        Schema::create('Status', function (Blueprint $table) {
            $table->increments('ID_Status');
            $table->string('Naziv', 45)->unique();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Status');
    }
}
