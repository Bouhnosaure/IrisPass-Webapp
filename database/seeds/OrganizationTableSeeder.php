<?php
use App\Organization;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrganizationTableSeeder extends Seeder
{
    /**
     * Run the users seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->delete();

        Organization::create([
            'name' => 'Gorilla LTD',
            'address' => '61 cours du médoc',
            'address_comp' => 'appt 22 bat B',
            'user_id' => 2
        ]);


    }
}