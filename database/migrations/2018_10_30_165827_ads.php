<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Ads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for examples user
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('post_code');
            $table->string('positon');
            $table->string('title');
            $table->string('type');
            $table->string('media');            
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
        //
    }
}
