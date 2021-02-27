<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToContractedCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contracted_companies', function (Blueprint $table) {
          $table->string('tel');
          $table->string('site_name');
          $table->string('site_representative');
          $table->string('site_representative_phone');
          $table->string('mail');
          $table->string('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contracted_companies', function (Blueprint $table) {
            //
        });
    }
}
