<?php

namespace App\Tests\Browser\Andisio;

use App\Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AuthenticationTest extends DuskTestCase
{
    /** @test * */
    public function an_unauthenticated_user_is_given_a_login_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Login')
                ->assertSee('Username');
        });

        $this->browse(function (Browser $browser) {
            $browser->visit('/protected')
                ->assertSee('Login')
                ->assertSee('Username');
        });
    }

    /** @test * */
    public function a_user_can_login_and_logout()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Login')
                ->customLogin()
                ->assertSee('Protected Area')
                ->customLogout()
                ->assertSee('Login');
        });
    }
}
