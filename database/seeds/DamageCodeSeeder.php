<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class DamageCodeSeeder extends Seeder
{
    /**
     * Run the Damage Code seeds.
     */
    public function run()
    {
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
    }
}