<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the Product seeds.
     */
    public function run()
    {
        // Seed Product Table
        foreach(range(1, 50) as $index) {
            DB::table('product')->insert([
                'style'             => $faker->regexify('[A-Z0-9]{11}'),
                'description'       => $faker->sentence($nbWords = 5, $variableNbWords = true),
                'brand'             => 'Ricardo Beverly Hills',
                'warranty_years'    => $faker->randomDigit,
                'color'             => $faker->word,
                'collection'        => $faker->sentence($nbWords = 2, $variableNbWords = false),
                'launch_date'       => $faker->date($format = 'Y-m-d', $max = 'now')
            ]);
        }
    }
}