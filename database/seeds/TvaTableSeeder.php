<?php

use App\Tva;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TvaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tvas')->delete();

        Tva::create([
            'name' => 'Taux normal',
            'rate' => '20'
        ]);

        Tva::create([
            'name' => 'Taux réduit',
            'rate' => '10'
        ]);

        Tva::create([
            'name' => 'Taux réduit',
            'rate' => '5.5'
        ]);

        Tva::create([
            'name' => 'Taux particulier',
            'rate' => '2.1'
        ]);
    }
}
