<?php

namespace App\Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Konsulting\DuskStandalone\TestCase;
use App\ServesSite;

class DuskTestCase extends TestCase
{
    // This is used for testing the package, and will boot up a
    // local php test server during running the tests. Please
    // remove if you don't need it - which is very likely.
    use ServesSite;

    /**
     * Set the base url
     *
     * @return string
     */
    public function baseUrl()
    {
        return env('BASE_URL', 'http://127.0.0.1:8000');
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * We're manually stopping it being headless, because
     * sometimes, it's nice to watch the tests run.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments(array_merge(
            ['--disable-gpu'],
            env('HEADLESS', true) ? ['--headless'] : []
        ));

        return RemoteWebDriver::create(
            'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }
}
