<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TestLogins extends TestCase
{
    public function testRicardoLogin()
    {
        $this->visit('/login')
            ->type('acp@acp.com', 'email')
            ->type('acpacp', 'password')
            ->press('Login')
            ->see('Claims')
            ->seePageIs('/claim');
    }

    public function testPartCompanyLogin()
    {
        $this->visit('/login')
            ->type('pc@pc.com', 'email')
            ->type('acpacp', 'password')
            ->press('Login')
            ->see('Claims')
            ->seePageIs('/part-company-claim');
    }

    public function testRepairCenterLogin()
    {
        $this->visit('/login')
            ->type('rc@rc.com', 'email')
            ->type('acpacp', 'password')
            ->press('Login')
            ->see('Claims')
            ->seePageIs('/repair-center-claim');
    }
}
