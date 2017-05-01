<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    /**
     * Run Customer seeds
     */
    public function run()
    {
        $faker = Faker::create();

        // Seed Customer Table
        foreach(range(1, 101) as $index) {
            DB::table('customer')->insert([
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'address'    => $faker->streetAddress,
                'city'       => $faker->city,
                'state'      => $faker->stateAbbr,
                'zip'        => substr($faker->postcode, 0, 5),
                'phone'      => numerify($string = '##########'),
                'email'      => $faker->email
            ]);
        }
    }
}