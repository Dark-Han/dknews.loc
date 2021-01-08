<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BannerDispositions extends Migration
{
    public function up()
    {
        Schema::create('banner_dispositions', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('banner_dispositions');
    }
}
