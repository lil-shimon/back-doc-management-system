<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('company_id')->unsigned();
            // $table->integer('site_id')->unsigned()->nullable()->comment('現場を異動する時期に一時的にnullになる');
            $table->integer('parent_id')->unsigned()->nullable()->comment('nullなら総括or総括と紐ついてないユーザー(人事異動で異なる総括と紐つき直す場合、一時的に発生する)');
            $table->rememberToken();
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
    }
}
