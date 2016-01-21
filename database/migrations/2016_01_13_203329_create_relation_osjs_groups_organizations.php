<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationOsjsGroupsOrganizations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('osjs_groups', function ($table) {
            $table->integer('organization_id')->after('path')->unsigned()->nullable()->index();
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
        Schema::table('osjs_groups', function ($table) {
            $table->dropForeign('osjs_groups_organization_id_foreign');
            $table->dropColumn('organization_id');
        });
    }
}
