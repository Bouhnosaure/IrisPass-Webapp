<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationOsjsUsersOrganizations extends Migration
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
            $table->integer('organization_id')->after('settings')->unsigned()->nullable()->index();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('set null');
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
            $table->dropForeign('osjs_users_organization_id_foreign');
            $table->dropColumn('organization_id');
        });
    }
}
