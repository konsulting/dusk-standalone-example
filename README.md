# Dusk Standalone Example

This is an example of how we set up a repo to test a non-Laravel site using Laravel Dusk.

It uses the `konsulting/dusk-standalone` package to set up Dusk for us, and allows some basic controls when running the tests.

It also demonstrates one way to perform authentication actions with the codebase.

## Test Server

The package include some light scripts used for testing the package itself, which will boot a php server process.  It will only do this when there is no `.env` file present.

This capability is added with the `App\ServesSite` trait in the `DuskTestCase`. You can remove the trait if you end up using this repo.

## Installation

Clone this repo: `git clone git@github.com:konsulting/dusk-standalone-example`

## Simple Usage

There are a few simple `.env` file variables which we use to control things.

 - BASE_URL - the base url for the tests
 - USERNAME - the default username to use for logging in
 - PASSWORD - the default password for logging in
 - HEADLESS - true/false, whether to show the browser or not when running the tests
 
 ## Authentication
 
 This is primarily put together to show one approach for authenticating with a legacy app. Another alternative is to set up the Dusk routes that it uses for it's own authentication methods (not covered here). 
 Here we will follow the login flow for the app, and fill in forms etc. 
 
 This is accomplished by adding customLogin and customLogout macros to the Brower, in `Support/BrowserMacros`.
 
 We also have a trait to simplify logging in, or out in the test cases - `Support/Concerns/SimplifiesCustomLogin`. 
 These allow us to simply login with `$this->login()` or logout with `$this->logout()` in a test.
 
 Finally for test where we need to log in, we have a simple base test case that will automatically log in a user before each test. 
 It tries to limit the time taken by caching whether you logged in before, so it can skip that step if possible. See `LoggedInTestCase`.
 
 ## Contributing
 
 Contributions are welcome and will be fully credited. We will accept contributions by Pull Request.
 
 Please:
 
 * Use the PSR-2 Coding Standard
 * Add tests, if you’re not sure how, please ask.
 * Document changes in behaviour, including readme.md.
 
 ## Testing
 We use [PHPUnit](https://phpunit.de)
 
 Run tests using PHPUnit: `vendor/bin/phpunit`

