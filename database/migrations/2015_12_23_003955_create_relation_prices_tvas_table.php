<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationPricesTvasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prices', function ($table) {
            $table->integer('tva_id')->after('product_id')->unsigned()->nullable()->index();
            $table->foreign('tva_id')->references('id')->on('tvas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prices', function ($table) {
            $table->dropForeign('prices_tva_id_foreign');
            $table->dropColumn('tva_id');
        });
    }
}
