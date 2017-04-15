<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RepairCenterSeeder extends Seeder
{
    /**
     * Run the Repair Center seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        
        // Seed Repair Center Table
        foreach(range(1, 50) as $index) {
            DB::table('repair_center')->insert([
                'name'         => $faker->lastName . ' ' . $faker->city,
                'address'      => $faker->streetAddress,
                'city'         => $faker->city,
                'state'        => $faker->stateAbbr,
                'zip'          => substr($faker->postcode, 0, 5),
                'phone'        => $faker->numberBetween($min = 1000000000, $max = 9999999999),
                'email'        => $faker->email,
                'contact_name' => $faker->firstName,
                'preferred'    => $faker->boolean($chanceOfGettingTrue = 50)
            ]);
        }
        
        // Seed Repair Center Comment Table
        foreach(range(1, 50) as $index) {
            DB::table('repair_center_comment')->insert([
                'repair_center_id' => $faker->numberBetween($min = 1, $max = 15),
                'created_at'       => $faker->dateTime(),
                'author'           => $faker->lastName,
                'comment'          => $faker->sentence($nbWords = 15, $variableNbWords = true),
            ]);
        }
    }
}