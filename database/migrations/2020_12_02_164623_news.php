<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class News extends Migration
{
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->unsignedSmallInteger('category_id');
            $table->text('text');
            $table->unsignedSmallInteger('disposition_id');
            $table->dateTime('date_st');
            $table->dateTime('date_en');
            $table->unsignedInteger('seen');
            $table->integer('must_seen')->default(-1);
            $table->unsignedSmallInteger('limit_id');
            $table->boolean('forever');
            $table->string('cover');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('');
    }
}
