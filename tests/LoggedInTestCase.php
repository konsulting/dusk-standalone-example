<?php

namespace App\Tests;

use App\Tests\Support\Concerns\SimplifiesCustomLogin;

class LoggedInTestCase extends DuskTestCase
{
    use SimplifiesCustomLogin;

    /**
     * Make sure we are logged in before each test is run
     */
    protected function setUp()
    {
        parent::setUp();

        $this->login();
    }
}
