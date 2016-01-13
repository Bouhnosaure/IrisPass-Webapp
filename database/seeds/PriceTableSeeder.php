<?php

use App\Price;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class PriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prices')->delete();


        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            Price::create([
                'name' => $faker->title,
                'description' => $faker->text,
                'value' => $faker->numberBetween(1, 50),
                'product_id' => $faker->numberBetween(1, 30),
                'tva_id' => $faker->numberBetween(1, 4)
            ]);
        }
    }
}
