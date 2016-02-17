<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('address_comp')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();


            $table->boolean('is_active')->default(false);
            $table->integer('max_users')->default(false);

            $table->integer('is_active_cms')->default(false);
            $table->integer('cms_url')->default(false);

            $table->integer('is_active_crm')->default(false);
            $table->integer('crm_url')->default(false);

            $table->date('date_start');
            $table->date('date_end');
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
        Schema::drop('organizations');
    }
}
