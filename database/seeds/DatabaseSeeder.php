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

        // Set up ACP Login
    	DB::table('users')->insert([
    		'name'	   => 'ACP',
    		'email'    => 'acp@acp.com',
    		'password' => '$2y$10$qeSkJ/ubMrXtBn1vbGX9Fusf9R9O83.aRu813lbiPMFt4ZynBkDJK'
    	]);

        // Seed Customer Table
        foreach (range(1,50) as $index) {
        	DB::table('customer')->insert([
        		'claim_id'   => $index,
        		'first_name' => $faker->firstName,
        		'last_name'	 => $faker->lastName,
        		'address'    => $faker->streetAddress,
        		'city'       => $faker->city,
        		'state'      => $faker->stateAbbr,
        		'zip'        => substr($faker->postcode, 0, 5),
        		'phone'      => $faker->numberBetween($min = 1000000000, $max = 9999999999),
        		'email'      => $faker->email
        	]);
        }

        // Seed Repair Center Table
        foreach (range(1,15) as $index) {
	    	DB::table('repair_center')->insert([
	    		'name'		 => $faker->lastName . ' ' . $faker->city,
	    		'address'    => $faker->streetAddress,
	    		'city'       => $faker->city,
	    		'state'      => $faker->stateAbbr,
	    		'zip'        => substr($faker->postcode, 0, 5),
	    		'phone'      => $faker->numberBetween($min = 1000000000, $max = 9999999999),
	    		'email'      => $faker->email
	    	]);
    	}

    	// Seed Product Table
        foreach (range(1,50) as $index) {
	    	DB::table('product')->insert([
	    		'style'		 		=> $faker->regexify('[A-Z0-9]{11}'),
	    		'description'    	=> $faker->sentence($nbWords = 6,$variableNbWords = true),
	    		'brand'       		=> 'Ricardo Beverly Hills',
	    		'warranty_years'    => $faker->randomDigit,
	    		'color'        		=> $faker->word,
	    		'class'      		=> $faker->regexify('[0-9]{3}'),
	    		'class_description' => $faker->sentence($nbWords = 6,$variableNbWords = true),
	    		'launch_date'		=> $faker->date($format = 'Y-m-d', $max = 'now')
	    	]);
    	}   	
    }
}
