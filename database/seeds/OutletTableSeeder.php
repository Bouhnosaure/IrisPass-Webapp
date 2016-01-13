<?php

use App\Outlet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class OutletTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('outlets')->delete();


        $faker = Faker::create();
        foreach (range(1, 9) as $index) {
            Outlet::create([
                'name' => $faker->streetName,
                'description' => $faker->text,
                'organization_id' => $faker->numberBetween(1, 3)
            ]);
        }

    }
}
