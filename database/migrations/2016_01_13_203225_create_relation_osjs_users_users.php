<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationOsjsUsersUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('osjs_users', function ($table) {
            $table->integer('user_id')->after('organization_id')->unsigned()->nullable()->index();
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
        Schema::table('osjs_users', function ($table) {
            $table->dropForeign('osjs_users_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}
