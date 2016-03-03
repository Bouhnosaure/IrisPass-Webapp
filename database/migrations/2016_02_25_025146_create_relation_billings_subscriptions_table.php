<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationBillingsSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billings', function ($table) {
            $table->integer('subscription_id')->after('is_billed')->unsigned()->nullable()->index();
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billings', function ($table) {
            $table->dropForeign('billings_subscription_id_foreign');
            $table->dropColumn('subscription_id');
        });
    }
}
