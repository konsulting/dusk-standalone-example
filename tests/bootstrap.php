<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Load up the environment file, if it exists.
if (file_exists(__DIR__.'/../.env')) {
    (new Dotenv\Dotenv(__DIR__ . '/..'))->load();
}

// Register Macros: this adds custom login/logout methods
(new App\Tests\Support\BrowserMacros)->register();
