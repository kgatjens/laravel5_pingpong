<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengesLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges_likes', function (Blueprint $table) {
            $table->integer('challenge_id')->unsigned()->index('fk_challenge_likes_challenge_idx');
            $table->string('anonymous_id')->index('fk_challenge_anonymous_id_idx');
            $table->string('onesignal_id',255);
            $table->timestamps();

            $table->foreign('challenge_id', 'fk_challenge_likes_challenge')->references('id')->on('challenges')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('challenges_likes', function(Blueprint $table)
        {
            $table->dropForeign('fk_challenge_likes_challenge');
        });
        Schema::drop('challenges_likes');
    }
}
