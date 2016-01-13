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
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('mail')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->string('status');
            $table->string('owner')->nullable();

            $table->string('siret_number')->nullable()->unique();
            $table->string('siren_number')->nullable()->unique();
            $table->string('tva_number')->nullable()->unique();
            $table->string('kbis_number')->nullable()->unique();
            $table->string('ape_number')->nullable()->unique();

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
