<?php
use App\OsjsUser;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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