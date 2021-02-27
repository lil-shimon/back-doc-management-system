<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductTypesIdToProductsList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('products_list', 'product_types_id')) {
            return;
        }
        Schema::table('products_list', function (Blueprint $table) {
            //add product_types_id into products_list
            $table->integer('product_types_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_list', function (Blueprint $table) {
            //
        });
    }
}
