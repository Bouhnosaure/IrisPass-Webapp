<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersConfirmationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_confirmations', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('type')->nullable();
            $table->string('confirmation_code')->nullable();
            $table->integer('user_id')->unsigned();
			$table->timestamps();
		});

        Schema::table('users_confirmations', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_confirmations');
	}

}
