<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        if (App::environment() === 'production') {

        } else {

            $this->call('UserTableSeeder');
            $this->call('OsjsUserTableSeeder');

        }


        Model::reguard();
    }
}
