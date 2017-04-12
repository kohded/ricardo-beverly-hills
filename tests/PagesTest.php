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
            ->see('All Claims');

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
            ->see('All Customers');

        $this->click('Create New Customer')
            ->see('Create New Customer')
            ->seePageIs('/customer/create');

        $this->visit('/customer')
            ->click('customer-edit')
            ->see('Edit Customer');
    }

    public function testProductPages()
    {
        $this->login();

        $this->visit('/product')
            ->see('All Products');

        $this->click('Create New Product')
            ->see('New Product')
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

    public function login()
    {
        $this->visit('/login')
            ->type('acp@acp.com', 'email')
            ->type('acpacp', 'password')
            ->press('Login');
    }
}
