<?php

use App\Licence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LicenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('licences')->delete();

        Licence::create([
            'name' => 'Essai',
            'description' => "Licence d'essai",
            'price' => '50',
            'outlet_number' => '1',
        ]);

        Licence::create([
            'name' => 'Basic',
            'description' => 'Licence basique',
            'price' => '200',
            'outlet_number' => '3',
        ]);

        Licence::create([
            'name' => 'Pro',
            'description' => 'Licence pro',
            'price' => '1000',
            'outlet_number' => '5',
        ]);

    }
}
