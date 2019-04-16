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
            $table->string('bpm');
            $table->string('length');
            $table->string('store_price');
            $table->string('store_name');
            $table->string('store_path');
            $table->string('store_size');
            $table->string('store_type');
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
