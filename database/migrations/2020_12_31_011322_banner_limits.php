<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BannerLimits extends Migration
{
    public function up()
    {
        Schema::create('banner_limits', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('');
    }
}
