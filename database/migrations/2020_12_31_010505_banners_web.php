<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BannersWeb extends Migration
{
    public function up()
    {
        Schema::create('banners_web', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('link');
            $table->unsignedSmallInteger('disposition_id');
            $table->unsignedSmallInteger('serial_number_id');
            $table->unsignedSmallInteger('limit_id');
            $table->unsignedInteger('must_seen')->nullable();
            $table->unsignedInteger('seen')->default(0);
            $table->unsignedInteger('category_id');
            $table->date('date_st');
            $table->date('date_en');
            $table->string('cover');
        });
    }

    public function down()
    {
        Schema::dropIfExists('banners_web');
    }
}
