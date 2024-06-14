<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('office_title')->nullable(false);
            $table->longText('address')->nullable(false);
            $table->mediumText('alias')->nullable(false);
            $table->text('category')->nullable(false);
            $table->text('city')->nullable(false);
            $table->mediumText('telephone_1')->nullable();
            $table->mediumText('telephone_2')->nullable();
            $table->mediumText('telephone_3')->nullable();
            $table->mediumText('telephone_4')->nullable();
            $table->mediumText('email_1')->nullable();
            $table->mediumText('email_2')->nullable();
            $table->mediumText('fax_number')->nullable();
            $table->mediumText('uan_number')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('offices');
    }
}
