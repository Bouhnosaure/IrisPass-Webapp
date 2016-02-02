<?php
use App\OsjsUser;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class OsjsUserTableSeeder extends Seeder
{
    /**
     * Run the users seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('osjs_users')->delete();
        $statement = "ALTER TABLE osjs_users AUTO_INCREMENT = 1;";
        DB::unprepared($statement);

        OsjsUser::create([
            'username' => 'ci_trex',
            'name' => 'Alexandre',
            'password' => bcrypt('123123'),
            'groups' => '["admin"]',
            'organization_id' => 1,
        ]);

        OsjsUser::create([
            'username' => 'mnky_c',
            'name' => 'Alan',
            'password' => bcrypt('123123'),
            'groups' => '["admin"]',
            'organization_id' => 1,
        ]);

    }
}