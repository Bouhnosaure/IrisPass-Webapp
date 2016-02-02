<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationPivotOsjsGroupOsjsUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('osjs_group_osjs_user', function (Blueprint $table) {

            $table->integer('osjs_user_id')->after('id')->unsigned()->index();
            $table->foreign('osjs_user_id')->references('id')->on('osjs_users')->onDelete('cascade');

            $table->integer('osjs_group_id')->after('osjs_user_id')->unsigned()->index();
            $table->foreign('osjs_group_id')->references('id')->on('osjs_groups')->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //    Schema::table('osjs_group_osjs_user', function ($table) {
        //    $table->dropForeign('osjs_users_groups_osjs_group_id_foreign');
        //    $table->dropColumn('osjs_group_id');
        //    $table->dropForeign('osjs_users_groups_osjs_user_id_foreign');
        //    $table->dropColumn('osjs_user_id');
        //    });
    }
}
