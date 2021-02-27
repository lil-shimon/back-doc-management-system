<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateContractedCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracted_companies', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("document_id")->unsigned();
            $table->string("name")->comment("会社名");
            $table->string("person_in_charge")->nullable()->comment("担当者名");
            $table->string("honorific_title")->comment("敬称");
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
        Schema::dropIfExists('contracted_companies');
    }
}
