<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('cover');
            $table->string('music_genre');
            $table->string('name');
            $table->integer('bpm');
            $table->integer('length');
            $table->integer('beat_price');
            //$table->string('store_name');
            $table->string('path');
            $table->integer('size');
            $table->string('type');
            $table->string('promoted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beats');
    }
}
