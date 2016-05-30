<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('challenge_id')->unsigned()->index('fk_feeds_challenge_idx');
            $table->string('onesignal_id',255);
            $table->timestamps();

            $table->foreign('challenge_id', 'fk_feeds_challenge')->references('id')->on('challenges')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feeds', function(Blueprint $table)
        {
            $table->dropForeign('fk_feeds_challenge');
        });
        Schema::drop('feeds');
    }
}
