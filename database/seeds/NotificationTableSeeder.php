<?php

use App\Notification;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('notifications')->delete();


        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            Notification::create([
                'type' => $faker->word,
                'title' => $faker->title,
                'description' => $faker->text,
                'is_read' => $faker->boolean(50),
                'url' => $faker->url,
                'user_id' => $faker->numberBetween(1, 12)
            ]);
        }

    }
}