<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tips', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('title');
            $table->string('subtitle');
            $table->string('link');
            $table->text('description', 65535)->nullable();
            $table->string('media_path', 1024);
            $table->tinyInteger('access');
            $table->integer('categories_id')->unsigned()->index('fk_tips_category_idx');
            $table->timestamps();

            $table->foreign('categories_id', 'fk_tips_category')->references('id')->on('categories_tips')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tips');
    }
}
