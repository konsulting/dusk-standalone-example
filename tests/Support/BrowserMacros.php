<?php

namespace App\Tests\Support;

use Laravel\Dusk\Browser;

class BrowserMacros
{
    public function register()
    {
        Browser::macro('customLogin', function ($user = null, $password = null) {
            $this->visit('/login')
                ->type('username', $user ?: env('USERNAME', 'keoghan'))
                ->type('password', $password ?: env('PASSWORD', 'secret'))
                ->press('Login');

            return $this;
        });

        Browser::macro('customLogout', function () {
            $this->visit('/logout');

            return $this;
        });
    }
}
