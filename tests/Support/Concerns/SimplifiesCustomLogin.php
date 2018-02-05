<?php

namespace App\Tests\Support\Concerns;

use Laravel\Dusk\Browser;

trait SimplifiesCustomLogin
{
    /** @var bool|string Stores the currently logged in username */
    protected static $loggedIn;

    /**
     * Log in as default user.
     */
    public function login()
    {
        $this->loginAs(env('USERNAME', 'keoghan'), env('PASSWORD', 'secret'));
    }

    /**
     * Login using a username and password combination,
     * only if the user is not already logged in.
     *
     * @param $user
     * @param $pass
     */
    public function loginAs($user, $pass)
    {
        if (static::$loggedIn == $user) {
            return;
        }

        if (static::$loggedIn) {
            $this->logout();

            return;
        }

        $this->browse(function (Browser $browser) use ($user, $pass) {
            $browser->customLogin($user, $pass);
        });

        static::$loggedIn = $user;
    }

    /**
     * Log the user our
     */
    public function logout()
    {
        $this->browse(function (Browser $browser) {
            $browser->customLogout();
        });

        static::$loggedIn = null;
    }
}
