<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPartnerCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_partner_companies', function (Blueprint $table) {
            $table->increments("id");
            $table->string("name")->comment("会社名");
            $table->string("furigana")->nullable()->comment("ふりがな");
            $table->string("department")->nullable()->comment("部署名");
            $table->string("person_in_charge")->nullable()->comment("担当者名");
            $table->string("mail_address")->nullable()->comment("メールアドレス");
            $table->string("post_code")->nullable()->comment("郵便番号");
            $table->string("address")->nullable()->comment("住所");
            $table->string("telephone_number")->nullable()->comment("電話番号");
            $table->string("honorific_title")->comment("敬称");
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
        Schema::dropIfExists('business_partner_companies');
    }
}
