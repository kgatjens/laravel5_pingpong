<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('posts_comments', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('post_id')->unsigned()->index('fk_post_comments_post_idx');
            $table->integer('comment_id')->unsigned()->index('fk_post_comments_comment_idx');
            $table->string('anonymous_id')->index('fk_post_comment_anonymous_id_idx');
            $table->string('onesignal_id',255);
            $table->timestamps();

            $table->foreign('post_id', 'fk_post_comments_post')->references('id')->on('posts')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('comment_id', 'fk_post_comments_comment')->references('id')->on('comments')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts_comments', function(Blueprint $table)
        {
            $table->dropForeign('fk_post_comments_post');
            $table->dropForeign('fk_post_comments_comment');
        });
        Schema::drop('posts_comments');
    }
}
