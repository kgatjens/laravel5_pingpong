<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedsLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds_likes', function (Blueprint $table) {
            $table->integer('feed_id')->unsigned()->index('fk_feed_likes_feed_idx');
            $table->string('anonymous_id')->index('fk_feed_anonymous_id_idx');
            $table->string('onesignal_id',255);
            $table->timestamps();

            $table->foreign('feed_id', 'fk_feed_likes_feed')->references('id')->on('feeds')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feeds_likes', function(Blueprint $table)
        {
            $table->dropForeign('fk_feed_likes_feed');
        });
        Schema::drop('feeds_likes');
    }
}
