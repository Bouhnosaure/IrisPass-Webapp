<?php

use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();


        $faker = Faker::create();
        foreach (range(1, 30) as $index) {
            Product::create([
                'name' => $faker->title,
                'description' => $faker->text,
                'outlet_id' => $faker->numberBetween(1, 6)
            ]);
        }
    }
}
