<?php

namespace App;

trait ServesSite
{
    /** @var \App\Server */
    protected static $server;

    public static function serveSite($host = null, $port = null, $script = null)
    {
        if (static::$server) {
            static::stopServingSite();
        }

        static::$server = new Server($host ?: '127.0.0.1', $port ?: 8000);
        static::$server->setFrontController($script);
        static::$server->start();
    }

    public static function stopServingSite()
    {
        if (static::$server) {
            static::$server->stop();
            static::$server = null;
        }
    }

    public static function setupBeforeClass()
    {
        parent::setUpBeforeClass();

        if (self::usingTestSite()) {
            static::serveSite();
        }
    }

    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();

        if (self::usingTestSite()) {
            static::stopServingSite();
        }
    }

    protected static function usingTestSite()
    {
        return ! file_exists(__DIR__.'/../.env');
    }
}
