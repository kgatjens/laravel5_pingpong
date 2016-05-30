<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePushNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_notifications', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('device_id')->unsigned();
            $table->integer('push_notification_type_id')->unsigned();
            $table->integer('pushable_id')->unsigned();
            $table->string('pushable_type')->default('');
            $table->string('title',255)->nullable()->default('');
            $table->string('message',255);
            $table->boolean('sent')->nullable()->default(false);
            $table->timestamps();
            
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
            $table->foreign('push_notification_type_id')->references('id')->on('push_notification_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('push_notifications');
    }
}
