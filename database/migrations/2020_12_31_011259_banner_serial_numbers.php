<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BannerSerialNumbers extends Migration
{
    public function up()
    {
        Schema::create('banner_serial_numbers', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('');
    }
}
