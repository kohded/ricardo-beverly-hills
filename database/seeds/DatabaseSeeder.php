<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        // Entrust Roles and Permissions. Must be after insert users.
        $this->call(EntrustSeeder::class);
        $this->call(DamageCodeSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(RepairCenterSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ClaimSeeder::class);

        DB::statement('insert into claim_customer (claim_id, customer_id) select a.id, b.id from claim as a join customer as b on a.customer_id = b.id');
    }
}
