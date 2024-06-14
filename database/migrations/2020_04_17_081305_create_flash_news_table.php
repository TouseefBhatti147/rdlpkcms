<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlashNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flash_news', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('title')->nullable();
            $table->mediumText('description')->nullable();
            $table->mediumText('link')->nullable();
            $table->mediumText('image')->nullable();
            $table->date('start_date')->nullable(false);
            $table->date('end_date')->nullable(false);
            $table->tinyInteger('status')->nullable(false);
            $table->bigInteger('ordering');
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
        Schema::dropIfExists('flash_news');
    }
}
