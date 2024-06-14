<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewslettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('newsletters', function (Blueprint $table) {
          $table->increments('id');
          $table->mediumText('title');
          $table->mediumText('link');
          $table->mediumText('file');
          $table->mediumText('image');
          $table->mediumText('pdf_file');
          $table->mediumText('alias');
          $table->boolean('status');
          $table->mediumText('meta_title')->nullable();
          $table->longText('meta_description')->nullable();
          $table->longText('meta_keywords')->nullable();
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
      Schema::dropIfExists('newsletters');
    }
}
