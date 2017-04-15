<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the User seeds.
     */
    public function run()
    {
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
    }
}
