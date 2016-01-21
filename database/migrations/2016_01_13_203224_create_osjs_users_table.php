<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOsjsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('osjs_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password', 60);
            $table->string('name');
            $table->text('groups');
            $table->text('settings');
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
        Schema::drop('osjs_users');
    }
}
