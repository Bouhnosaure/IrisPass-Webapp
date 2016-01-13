<?php

use Faker\Provider\fr_FR\Company;
use Illuminate\Database\Seeder;

use App\Organization;
use Faker\Factory as Faker;

class OrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->delete();

        $faker = Faker::create();
        $faker->addProvider(new Company($faker));

        foreach (range(1, 3) as $index) {
            Organization::create([
                'name' => $faker->company,
                'phone' => $faker->phoneNumber,
                'mail' => $faker->email,
                'website' => $faker->url,
                'address' => $faker->address,
                'status' => 'SARL',
                'owner' => $faker->firstName . ' ' . $faker->lastName,
                'siret_number' => $faker->siret,
                'siren_number' => $faker->siren,
                'tva_number' => $faker->sha1,
                'kbis_number' => $faker->sha1,
                'ape_number' => $faker->sha1,
                'licence_id' => $faker->numberBetween(1, 3),
            ]);
        }
    }
}