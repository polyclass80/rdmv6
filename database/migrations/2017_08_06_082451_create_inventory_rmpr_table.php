<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryRmprTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_rmpr', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rm_pr_id');
            $table->integer('inventory_id');
            $table->float('pr_qty');
            $table->float('actual_qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_rmpr');
    }
}
