<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengeCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges_comments', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('challenge_id')->unsigned()->index('fk_challenge_comments_challenge_idx');
            $table->integer('comment_id')->unsigned()->index('fk_challenge_comments_comment_idx');
            $table->string('anonymous_id')->index('fk_challenge_comment_anonymous_id_idx');
            $table->string('onesignal_id',255);
            $table->timestamps();

            $table->foreign('challenge_id', 'fk_challenge_comments_challenge')->references('id')->on('challenges')->onUpdate('NO ACTION')->onDelete('cascade');
            $table->foreign('comment_id', 'fk_challenge_comments_comment')->references('id')->on('comments')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('challenge_comments', function(Blueprint $table)
        {
            $table->dropForeign('fk_challenge_comments_challenge');
            $table->dropForeign('fk_challenge_comments_comment');
        });
        Schema::drop('challenge_comments');
    }
}
