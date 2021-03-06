<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSerialNumberToLanguagesTable extends Migration
{
    public function up()
    {
        Schema::table('languages', function (Blueprint $table) {
            $table->unsignedTinyInteger('serial_number');
        });
    }

    public function down()
    {
        Schema::table('languages', function (Blueprint $table) {
            //
        });
    }
}