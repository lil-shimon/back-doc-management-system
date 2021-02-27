<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasedProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchased_products', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("document_id")->unsigned();
            $table->string("name")->comment("商品名");
            $table->integer("number")->comment("購入個数")->nullable();
            $table->string("unit")->comment("単位")->nullable();
            $table->integer("unit_price")->comment("単価")->nullable();
            $table->float("tax")->comment("税(少数)")->nullable();
            $table->softDeletes();

            $table->foreign("document_id")->references("id")->on("documents");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchased_products');
    }
}
