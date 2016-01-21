<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationUserProfilesUsers extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('user_profiles', function ($table) {
            $table->integer('user_id')->after('phone_confirmed')->unsigned()->nullable()->index();
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
        Schema::table('user_profiles', function ($table) {
            $table->dropForeign('user_profiles_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }

}
