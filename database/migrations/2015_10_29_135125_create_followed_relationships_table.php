<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowedRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followed_relationships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('followed_id');
            $table->integer('follower_id');
            $table->timestamps();
        });

        Schema::table('followed_relationships', function(Blueprint $table){
            $table->foreign('followed_id')->references('id')->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');

            $table->foreign('follower_id')->references('id')->on('users')
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
        Schema::table('followed_relationships', function(Blueprint $table){
          $table->dropForeign('follower_relationships_followed_id_foreign');
          $table->dropForeign('follower_relationships_follower_id_foreign');
        });
        Schema::drop('followed_relationships');
    }
}
