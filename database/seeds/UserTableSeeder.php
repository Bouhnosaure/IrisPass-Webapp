<?php
use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

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
        $statement = "ALTER TABLE users AUTO_INCREMENT = 1;";
        DB::unprepared($statement);

        User::create([
            'id' => 1,
            'email' => 'alexandre.mangin@viacesi.fr',
            'password' => bcrypt('123123'),
            'max_users' => 50,
            'date_start' => '2016-01-01',
            'date_end' => '2016-12-31',
        ]);

        User::create([
            'id' => 2,
            'email' => 'alan.corbel@viacesi.fr',
            'password' => bcrypt('123123'),
            'max_users' => 50,
            'date_start' => '2016-01-01',
            'date_end' => '2016-12-31',
        ]);

        User::create([
            'id' => 3,
            'email' => 'romibeno@gmail.com',
            'password' => bcrypt('123123'),
            'max_users' => 5,
            'date_start' => '',
            'date_end' => '',
        ]);

        User::create([
            'id' => 4,
            'email' => 'wanpunman@gmail.com',
            'password' => bcrypt('123123'),
            'max_users' => 50,
            'date_start' => '2016-01-01',
            'date_end' => '2016-02-01',
        ]);

    }
}