<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostagesList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postages_list', function (Blueprint $table) {
            $table->increments("id");
            $table->string("sender_place")->comment("送付元");
            $table->string("destination_place")->comment("送付先");
            $table->integer("postage_price")->comment("送料");
            $table->float("tax")->comment("税(少数)");
            $table->string("size")->comment("送付サイズ");
            $table->string("unit")->comment("単位");
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
        Schema::dropIfExists('postages_list');
    }
}
