<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("type")->comment('100:クェスタ,200:代理店,300:一般企業');
            $table->string("name")->comment('会社名');
            $table->string("post_code")->comment('郵便番号');
            $table->string("pref")->comment('都道府県');
            $table->string("address")->comment('住所');
            $table->string("tel")->unique()->comment("電話");
            $table->string("fax")->nullable()->comment("FAX");
            $table->integer("parent_id")->unsigned()->nullable()->comment("一般企業の場合のみ必要");
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('companies');
    }
}
