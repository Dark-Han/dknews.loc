<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Links extends Migration
{
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('link_type_id')->unique();
            $table->string('link');
        });
    }

    public function down()
    {
        Schema::dropIfExists('links');
    }
}
