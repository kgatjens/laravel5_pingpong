<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds_comments', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('feed_id')->unsigned()->index('fk_feed_comments_feed_idx');
            $table->integer('comment_id')->unsigned()->index('fk_feed_comments_comment_idx');
            $table->string('anonymous_id')->index('fk_feed_comment_anonymous_id_idx');
            $table->string('onesignal_id',255);
            $table->timestamps();

            $table->foreign('feed_id', 'fk_feed_comments_feed')->references('id')->on('feeds')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('comment_id', 'fk_feed_comments_comment')->references('id')->on('comments')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feeds_comments', function(Blueprint $table)
        {
            $table->dropForeign('fk_feed_comments_feed');
            $table->dropForeign('fk_feed_comments_comment');
        });
        Schema::drop('feeds_comments');
    }
}
