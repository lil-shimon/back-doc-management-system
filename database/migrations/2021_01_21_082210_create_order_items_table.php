<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->date('order_date')->nullable()->comment('受注日');
            $table->text('note')->nullable()->comment('メモ');
            $table->integer('sub_total')->nullable()->comment('税抜金額');
            $table->string('quotation')->nullable()->comment('見積書');
            $table->string('invoice')->nullable()->comment('注文書');
            $table->integer('total_price')->nullable()->comment('税込金額');
            $table->text('remarks')->nullable()->comment('備考');
            $table->integer('additional_invoice_id')->unsigned();
            $table->timestamps();

            $table->foreign('additional_invoice_id')
                ->references('id')->on('additional_invoices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
