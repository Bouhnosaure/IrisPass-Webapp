<?php
use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the users seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'username' => 'ci_trex',
            'firstname' => 'Alexandre',
            'lastname' => 'Mangin',
            'phone' => '0616391876',
            'email' => 'alexandre.mangin@viacesi.fr',
            'password' => bcrypt('123123'),
        ]);

        User::create([
            'username' => 'mnky_c',
            'firstname' => 'Alan',
            'lastname' => 'Corbel',
            'phone' => '0616391876',
            'email' => 'alan.corbel@viacesi.fr',
            'password' => bcrypt('123123'),
        ]);

    }
}