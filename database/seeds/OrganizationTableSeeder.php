<?php
use App\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
        $statement = "ALTER TABLE organizations AUTO_INCREMENT = 1;";
        DB::unprepared($statement);

        Organization::create([
            'uuid' => uniqid(),
            'name' => 'Gorilla LTD',
            'address' => '61 cours du médoc',
            'address_comp' => 'appt 22 bat B',
            'user_id' => 1
        ]);


    }
}