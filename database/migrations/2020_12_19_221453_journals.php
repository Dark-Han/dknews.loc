<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Journals extends Migration
{
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedSmallInteger('journal_type_id');
            $table->date('release_date');
            $table->string('cover');
            $table->string('journal');
            $table->string('for_year_serial_number');
            $table->string('for_all_time_serial_number');
        });
    }

    public function down()
    {
        Schema::dropIfExists('');
    }
}
