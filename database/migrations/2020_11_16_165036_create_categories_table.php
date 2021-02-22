<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('cover',255);
            $table->unsignedTinyInteger('serial_number_web')->default(0);
            $table->unsignedTinyInteger('serial_number_mob')->default(0);
            $table->string("name_ru",255);
            $table->string("slug_ru",255)->nullable();
            $table->string("name_kz",255);
            $table->string("slug_kz",255)->nullable();
            $table->string("name_en",255);
            $table->string("slug_en",255)->nullable();
            $table->string("name_cn",255);
            $table->string("slug_cn",255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
