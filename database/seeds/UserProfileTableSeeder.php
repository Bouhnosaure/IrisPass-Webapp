<?php

use App\UserProfile;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserProfileTableSeeder extends Seeder
{

    /**
     * Run the users seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_profiles')->delete();
        $statement = "ALTER TABLE users_profiles AUTO_INCREMENT = 1;";
        DB::unprepared($statement);

        UserProfile::create([
            'firstname' => 'Alexandre',
            'lastname' => 'xxxxxxx',
            'phone' => '0606060606',
            'user_id' => 1,
        ]);

        UserProfile::create([
            'firstname' => 'Alan',
            'lastname' => 'xxxxxxx',
            'phone' => '0606060606',
            'user_id' => 2,
        ]);

        UserProfile::create([
            'firstname' => 'Christophe',
            'lastname' => 'xxxxxxx',
            'phone' => '0606060606',
            'user_id' => 3,
        ]);

    }

}
