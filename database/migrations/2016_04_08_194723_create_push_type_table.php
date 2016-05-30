<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePushTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_notification_types', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('name',45);
            $table->string('title',255);
            $table->string('slug',255);
            $table->string('description',255)->nullable()->default('');
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
        Schema::drop('push_notification_types');
    }
}
