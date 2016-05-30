<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_likes', function (Blueprint $table) {
            $table->integer('post_id')->unsigned()->index('fk_post_likes_post_idx');
            $table->string('anonymous_id')->index('fk_post_anonymous_id_idx');
            $table->string('onesignal_id',255);
            $table->timestamps();

            $table->foreign('post_id', 'fk_post_likes_post')->references('id')->on('posts')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts_likes', function(Blueprint $table)
        {
            $table->dropForeign('fk_post_likes_post');
        });
        Schema::drop('posts_likes');
    }
}
