<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Medias extends Migration
{
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedSmallInteger('size_id');
            $table->unsignedSmallInteger('link_count_id');
            $table->string('link_name1');
            $table->string('link1');
            $table->string('link_name2')->nullable();
            $table->string('link2')->nullable();
            $table->string('link_name3')->nullable();
            $table->string('link3')->nullable();
            $table->string('cover');
        });
    }

    public function down()
    {
        Schema::dropIfExists('');
    }
}
