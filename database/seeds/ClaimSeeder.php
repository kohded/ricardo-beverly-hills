<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ClaimSeeder extends Seeder
{
    /**
     * Run seeds for claims and comments associated to claims
     */
    public function run()
    {
        $faker = Faker::create();

        // Seed Claim Table
        foreach(range(1, 101) as $index) {
            DB::table('claim')->insert([
                'created_at'       => date_sub(new DateTime(), date_interval_create_from_date_string(102 - $index . ' days')),
                'customer_id'      => $index,
                'product_style'    => DB::table('product')->inRandomOrder()->first()->style,
                'damage_code_id'   => DB::table('damage_code')->inRandomOrder()->first()->id,
                'repair_center_id' => DB::table('repair_center')->inRandomOrder()->first()->id,
                'replace_order'    => $faker->boolean($chanceOfGettingTrue = 20),
                'ship_to'          => $faker->randomElement($array = array('Customer', 'Repair Center')),
                'part_needed'      => $faker->randomElement($array = array(0, 1)),
                'parts_needed'     => $faker->randomElement($array = array('None', 'Need 2 wheels', 'Need main bag zipper', 'Need one wheel and new zipper tag')),
                'parts_available'  => $faker->randomElement($array = array(NULL, 0, 1)),
                'purchase_order'   => $faker->randomElement($array = array(NULL, 'PO123456789123456789'))
            ]);
        }

        // Seed Claim Comment Table
        foreach(range(1, 300) as $index) {
            DB::table('claim_comment')->insert([
                'claim_id'   => $faker->numberBetween($min = 1000, $max = 1099),
                'created_at' => $faker->dateTime(),
                'author'     => $faker->lastName,
                'comment'    => $faker->sentence($nbWords = 15, $variableNbWords = true),
            ]);
        }
    }
}