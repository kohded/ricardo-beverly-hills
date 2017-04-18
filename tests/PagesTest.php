<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PagesTest extends TestCase
{
    public function testHomePage()
    {
        $this->visit('/')
             ->see('Ricardo Beverly Hills');
    }

    public function testClaimPages()
    {
        $this->login();

        $this->visit('/claim')
            ->see('Claims');

        $this->click('create-claim')
            ->see('Create New Claim')
            ->seePageIs('/claim/create');

        $this->visit('/claim')
            ->click('claim-detail')
            ->see('Claim');

        // Test edit link once we have edit claims working
    }

    public function testCustomerPages()
    {
        $this->login();

        $this->visit('/customer')
            ->see('Customers');

        $this->click('Create New Customer')
            ->see('Create Customer')
            ->seePageIs('/customer/create');

        $this->visit('/customer')
            ->click('customer-edit')
            ->see('Edit Customer');
    }

    public function testProductPages()
    {
        $this->login();

        $this->visit('/product')
            ->see('Products');

        $this->click('Create New Product')
            ->see('Create Product')
            ->seePageIs('/product/create');

        $this->visit('/product')
            ->click('product-edit')
            ->see('Edit Product');
    }

    public function testRepairCenterPages()
    {
        $this->login();

        $this->visit('/repair-center')
            ->see('Repair Centers');

        $this->click('Create Repair Center')
            ->see('Create Repair Center')
            ->seePageIs('/repair-center/create');

        $this->visit('/repair-center')
            ->click('rc-edit')
            ->see('Edit Repair Center');
    }

    public function testDamageCodePages()
    {
        $this->login();

        $this->visit('/damage-code')
            ->see('Damage Codes');

        $this->click('New')
            ->see('Create Damage Code')
            ->seePageIs('/damage-code/create');

        $this->visit('/damage-code')
            ->click('dc-edit')
            ->see('Edit Damage Code');
    }

    public function login()
    {
        $this->visit('/login')
            ->type('acp@acp.com', 'email')
            ->type('acpacp', 'password')
            ->press('Login');
    }
}
