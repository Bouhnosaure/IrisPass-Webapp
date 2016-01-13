<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRelationLayoutsOutletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('layouts', function ($table) {
            $table->integer('outlet_id')->after('value')->unsigned()->nullable()->index();
            $table->foreign('outlet_id')->references('id')->on('outlets')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('layouts', function ($table) {
            $table->dropForeign('layouts_outlet_id_foreign');
            $table->dropColumn('outlet_id');
        });
    }
}
