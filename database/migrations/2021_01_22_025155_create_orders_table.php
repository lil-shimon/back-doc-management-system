<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('expected_start_date')->nullable();
            $table->string('expected_end_date')->nullable();
            $table->text('invoice_note')->nullable();
            $table->text('sale_note')->nullable();
            $table->text('maintainance_note')->nullable();
            $table->integer('sim_number')->nullable();
            $table->integer('signnage_id')->nullable();
            $table->integer('condition_id')->unsigned();
            $table->integer('user_id')->unsigned();
        $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
