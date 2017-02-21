<?php

use Illuminate\Database\Seeder;

class EntrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed roles table
        $roles = array(
            array(
                'id'           => 1,
                'name'         => 'ricardo-beverly-hills',
                'display_name' => 'Ricardo Beverly Hills',
                'description'  => 'Ricardo Beverly Hills Employee',
                'created_at'   => '2017-02-19 00:00:00',
                'updated_at'   => '2017-02-19 00:00:00'
            ),
            array(
                'id'           => 2,
                'name'         => 'part-company',
                'display_name' => 'Part Company',
                'description'  => 'Part Company Employee',
                'created_at'   => '2017-02-19 00:00:00',
                'updated_at'   => '2017-02-19 00:00:00'
            ),
            array(
                'id'           => 3,
                'name'         => 'repair-center',
                'display_name' => 'Repair Center',
                'description'  => 'Repair Center Employee',
                'created_at'   => '2017-02-19 00:00:00',
                'updated_at'   => '2017-02-19 00:00:00'
            )
        );

        DB::table('roles')->insert($roles);

        // Seed role_user table
        $roleUser = array(
            array(
                'user_id' => 1,
                'role_id' => 1
            ),
            array(
                'user_id' => 2,
                'role_id' => 2
            ),
            array(
                'user_id' => 3,
                'role_id' => 3
            )
        );

        DB::table('role_user')->insert($roleUser);
    }
}
