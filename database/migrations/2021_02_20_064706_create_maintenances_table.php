<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date')->nullable()->comment('メンテ作業日');
            $table->string('title')->nullable()->comment('メンテ件名');
            $table->string('address')->nullable()->comment('メンテ作業現場');
            $table->text('note')->nullable()->comment('メンテの詳細記入欄');
            $table->float('working_hours')->nullable()->comment('メンテ作業時間');
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
        Schema::dropIfExists('maintenances');
    }
}
