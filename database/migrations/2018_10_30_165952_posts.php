<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // Create table for examples user
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('slug');
            $table->string('phone_area');
            $table->string('phone');
            $table->string('facebook')->nullable();
            $table->string('gmail')->nullable();
            $table->string('location')->nullable();
            $table->string('address')->nullable();
            $table->string('post_title');
            $table->string('post_content');
            $table->string('post_type');
            $table->string('post_media')->nullable();
            $table->string('customer_code');
            $table->string('status');
            $table->rememberToken();
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
