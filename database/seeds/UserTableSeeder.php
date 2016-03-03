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
            'organization_id' => 1,
        ]);

        User::create([
            'id' => 2,
            'email' => 'alan.corbel@viacesi.fr',
            'password' => bcrypt('123123'),
            'organization_id' => 1,
        ]);

        User::create([
            'id' => 3,
            'email' => 'clarquey@irisit.fr',
            'password' => bcrypt('123123'),
            'organization_id' => 1,
        ]);

    }
}