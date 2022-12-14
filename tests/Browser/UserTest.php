<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{

    /** @test */
    public function loginTest(){

        $this->browse(function(Browser $browser){
            $browser->visit('/login')
                    ->type('email', 'gab-oliveira@hotmail.com')
                    ->type('password', '123456789')
                    ->press('Login')
                    ->assertPathIs('/home');
        });

    }

    /** @test */
    public function registerTest(){

        $this->browse(function(Browser $browser){
            $browser->visit('/register')
                    ->type('name', 'Gabriel')
                    ->type('email', 'gab-oliveira@hotmail.com')
                    ->type('password', '123456789')
                    ->type('password_confirmation', '123456789')
                    ->press('Register')
                    ->assertPathIs('/home');
        });

    }

}
