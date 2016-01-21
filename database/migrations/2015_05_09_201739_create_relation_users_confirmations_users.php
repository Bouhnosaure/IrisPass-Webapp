<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationUsersConfirmationsUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::table('users_confirmations', function ($table) {
			$table->integer('user_id')->after('confirmation_code')->unsigned()->nullable()->index();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users_confirmations', function ($table) {
			$table->dropForeign('users_confirmations_user_id_foreign');
			$table->dropColumn('user_id');
		});
	}

}
