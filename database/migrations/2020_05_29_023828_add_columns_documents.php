<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->string("business_partner_company_name");
            $table->string("honorific_title");
            $table->string("payment_terms");
            $table->string("usage_period");
            $table->string("term_and_conditions");
            $table->string("quotation_expiration_date")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('documents', function (Blueprint $table) {
        //     $table->dropColumn('summary');
        // });
    }
}
