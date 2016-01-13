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
            $this->call('LicenceTableSeeder');
            $this->call('TvaTableSeeder');

        } else {
            $this->call('LicenceTableSeeder');

            $this->call('TvaTableSeeder');

            $this->call('OrganizationTableSeeder');

            $this->call('UserTableSeeder');

            $this->call('OutletTableSeeder');

            $this->call('ProductTableSeeder');

            $this->call('PriceTableSeeder');

            $this->call('LayoutTableSeeder');

            $this->call('NotificationTableSeeder');

        }


        Model::reguard();
    }
}
