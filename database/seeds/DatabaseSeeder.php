<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Seed users table
        $users = array(
            array(
                'id'         => 1,
                'name'       => 'ACP',
                'email'      => 'acp@acp.com',
                'password'   => '$2y$10$qeSkJ/ubMrXtBn1vbGX9Fusf9R9O83.aRu813lbiPMFt4ZynBkDJK',
                'created_at' => '2017-02-19 00:00:00',
                'updated_at' => '2017-02-19 00:00:00'
            ),
            array(
                'id'         => 2,
                'name'       => 'Part Company',
                'email'      => 'pc@pc.com',
                'password'   => '$2y$10$qeSkJ/ubMrXtBn1vbGX9Fusf9R9O83.aRu813lbiPMFt4ZynBkDJK',
                'created_at' => '2017-02-19 00:00:00',
                'updated_at' => '2017-02-19 00:00:00'
            ),
            array(
                'id'         => 3,
                'name'       => 'Repair Center',
                'email'      => 'rc@rc.com',
                'password'   => '$2y$10$qeSkJ/ubMrXtBn1vbGX9Fusf9R9O83.aRu813lbiPMFt4ZynBkDJK',
                'created_at' => '2017-02-19 00:00:00',
                'updated_at' => '2017-02-19 00:00:00'
            ),
        );

        DB::table('users')->insert($users);

        // Entrust Roles and Permissions. Must be after insert users.
        $this->call(EntrustSeeder::class);

        // Seed Damage Code table
        $damage_codes = array(
            array('id' => '1', 'part' => 'Combo Lock'),
            array('id' => '2', 'part' => 'Wheels Broken'),
            array('id' => '3', 'part' => 'Plastic Buckles'),
            array('id' => '4', 'part' => 'Zipper Seams'),
            array('id' => '5', 'part' => 'Zipper Teeth'),
            array('id' => '6', 'part' => 'Zipper Slider/Puller'),
            array('id' => '7', 'part' => 'Tie Down Straps/Clips'),
            array('id' => '9', 'part' => 'Top/Side Handle'),
            array('id' => '10', 'part' => 'Retractable Handle'),
            array('id' => '11', 'part' => 'Retractable Handle Grip'),
            array('id' => '12', 'part' => 'Piping Worn/Damaged'),
            array('id' => '13', 'part' => 'Broken Frame/Crushed'),
            array('id' => '14', 'part' => 'Seams Ripping'),
            array('id' => '15', 'part' => 'Poly Shell Cracked'),
            array('id' => '16', 'part' => 'Miscellaneous')
        );

        DB::table('damage_code')->insert($damage_codes);

        // Seed Customer Table
        foreach(range(1, 50) as $index) {
            DB::table('customer')->insert([
                'first_name' => $faker->firstName,
                'last_name'  => $faker->lastName,
                'address'    => $faker->streetAddress,
                'city'       => $faker->city,
                'state'      => $faker->stateAbbr,
                'zip'        => substr($faker->postcode, 0, 5),
                'phone'      => $faker->numberBetween($min = 1000000000, $max = 9999999999),
                'email'      => $faker->email
            ]);
        }

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

        // Seed Product Table
        foreach(range(1, 50) as $index) {
            DB::table('product')->insert([
                'style'             => $faker->regexify('[A-Z0-9]{11}'),
                'description'       => $faker->sentence($nbWords = 5, $variableNbWords = true),
                'brand'             => 'Ricardo Beverly Hills',
                'warranty_years'    => $faker->randomDigit,
                'color'             => $faker->word,
                'collection' => $faker->sentence($nbWords = 2, $variableNbWords = false),
                'launch_date'       => $faker->date($format = 'Y-m-d', $max = 'now')
            ]);
        }

        // Seed Claim Table
        foreach(range(1, 50) as $index) {
            DB::table('claim')->insert([
                'created_at'       => $faker->dateTime(),
                'customer_id'      => $index,
                'product_style'    => DB::table('product')->inRandomOrder()->first()->style,
                'damage_code_id'   => DB::table('damage_code')->inRandomOrder()->first()->id,
                'repair_center_id' => DB::table('repair_center')->inRandomOrder()->first()->id,
                'replaced'         => $faker->boolean($chanceOfGettingTrue = 20),
                'ship_to'          => $faker->randomElement($array = array('Customer', 'Repair Center')),
                'part_needed'      => $faker->randomElement($array = array(0, 1)),
                'parts_needed'     => $faker->randomElement($array = array('None', 'Need 2 wheels', 'Need main bag zipper', 'Need one wheel and new zipper tag')),
            ]);
        }

        // Seed Claim Comment Table
        foreach(range(1, 200) as $index) {
            DB::table('claim_comment')->insert([
                'claim_id'   => $faker->numberBetween($min = 1, $max = 50),
                'created_at' => $faker->dateTime(),
                'author'     => $faker->lastName,
                'comment'    => $faker->sentence($nbWords = 15, $variableNbWords = true),
            ]);
        }

        DB::statement('insert into claim_customer (claim_id, customer_id) select a.id, b.id from claim as a join customer as b on a.customer_id = b.id');


    }
}
