<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category')->nullable();
            $table->string('price_base')->nullable();
            $table->string('price_current')->nullable();
            $table->string('values')->nullable();
            $table->string('last_billing_uuid')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamp('date_end');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subscriptions');
    }
}
