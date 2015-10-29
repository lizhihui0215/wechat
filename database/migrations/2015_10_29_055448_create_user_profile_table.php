<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $small_profile_image = url('images/user/profile_small.jpg');
            $profile_image = url('images/user/profile.jpg');
            $big_profile_image = url('images/user/profile_big.jpg');
            $table->increments('id');
            $table->string('small_profile_image')->default($small_profile_image);
            $table->string('profile_image')->default($profile_image);
            $table->string('big_profile_image')->default($big_profile_image);
            $table->integer('user_id')->unsigned();
            $table->string('test');
            $table->timestamps();
        });

        Schema::table('user_profile', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profile', function(Blueprint $table){
          $table->dropForeign('user_profile_user_id_foreign');
        });

        Schema::drop('user_profile');
    }
}
