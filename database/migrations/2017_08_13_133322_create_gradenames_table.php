<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradenamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gradenames', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maincode',15);
            $table->string('gradename',35);
            $table->string('sr',10);
            $table->string('user',10);
            $table->string('comment',40);
            $table->integer('serialnum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gradenames');
    }
}
