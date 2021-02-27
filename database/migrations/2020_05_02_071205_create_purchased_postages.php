<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasedPostages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchased_postages', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("document_id")->unsigned();
            $table->string("sender_place")->comment("送付元:地名");
            $table->string("destination_place")->comment("送付先:地名");
            $table->integer("postage_price")->comment("送料");
            $table->integer("quantity")->comment("購入個数");
            $table->float("tax")->comment("税(少数)");
            $table->string("size")->comment("送付サイズ");
            $table->string("unit")->comment("単位");
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
        Schema::dropIfExists('purchased_postages');
    }
}
