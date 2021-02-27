<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_list', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name")->comment("商品名");
            $table->string("unit")->comment("単位");
            $table->integer("unit_price")->comment("単価");
            $table->float("tax")->comment("税(少数)");
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_list');
    }
}
