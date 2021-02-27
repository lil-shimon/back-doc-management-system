<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("sell_part_id")->unsigned();
            $table->integer("see_part_id")->unsigned();
            $table->integer("customer_part_id")->unsigned();
            $table->integer("document_type_id")->unsigned();
            // $table->string("payment_type");
            $table->integer("user_id")->unsigned()->comment("書類作成ユーザー");
            $table->string("document_title")->comment("件名");
            // $table->string("payment_terms");
            // $table->string("use_period");
            // $table->string("contract_terms");
            $table->text("remarks")->nullable()->comment("備考");
            $table->string("logo_img_path")->comment("クエスタ(書類作成会社)のロゴ画像のパス");
            $table->integer("status")->default(0)->comment("0:未,1:済");
            // $table->boolean("is_delete")->default(false);
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
        Schema::dropIfExists('documents');
    }
}
