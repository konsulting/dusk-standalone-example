<?php

namespace App\Tests\Browser\Andisio;

use App\Tests\LoggedInTestCase;
use Laravel\Dusk\Browser;

class ProtectedAreaTest extends LoggedInTestCase
{
    /** @test * */
    public function a_user_can_see_the_protected_area()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/protected')
                ->assertSee('Protected Area');
        });
    }
}
