<?php

use App\UserProfile;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserProfileTableSeeder extends Seeder
{

    /**
     * Run the users seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_profiles')->delete();

        UserProfile::create([
            'firstname' => 'Alexandre',
            'lastname' => 'Mangin',
            'phone' => '0616391876',
            'user_id' => 1,
        ]);

        UserProfile::create([
            'firstname' => 'Alan',
            'lastname' => 'Corbel',
            'phone' => '0626381876',
            'user_id' => 2,
        ]);

    }

}
