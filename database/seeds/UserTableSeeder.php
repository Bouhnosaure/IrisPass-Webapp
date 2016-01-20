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
            'email' => 'alexandre.mangin@viacesi.fr',
            'password' => bcrypt('123123'),
        ]);

        User::create([
            'email' => 'alan.corbel@viacesi.fr',
            'password' => bcrypt('123123'),
        ]);

    }
}