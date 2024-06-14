<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('title_first_line');
            $table->text('title_second_line');
            $table->mediumText('image');
            $table->mediumText('link');
            $table->boolean('link_status');
            $table->mediumText('file');
            $table->mediumText('alias');
            $table->boolean('status');
            $table->mediumText('category');
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
        Schema::dropIfExists('files');
    }
}
