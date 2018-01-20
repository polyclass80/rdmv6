<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatInventoryScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('schedule_id');
            $table->integer('inventory_id');
            $table->integer('block_qty')->default(0);
            $table->integer('actual_qty')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
