<?php

// A simple server script which allows us to check the utility of this library.

session_start();

$route = ($_SERVER['REQUEST_METHOD'] ?? 'GET').'::'.trim($_SERVER['REQUEST_URI'], '/');

switch ($route) {

    case 'POST::login':
        if (
            in_array($_REQUEST['username'] ?? '', ['keoghan', 'roger'])
            && $_REQUEST['password'] ?? '' === 'secret'
        ) {
            $_SESSION['logged_in'] = true;
            header('Location: /protected');
        }
        header('Location: /');
        break;

    case 'GET::logout':
        $_SESSION['logged_in'] = false;
        header('Location: /');
        break;

    case 'GET::protected':
        if ($_SESSION['logged_in'] ?? false) {
            ?>
            <h1>Protected Area</h1>
            <p>Logged In!</p>
            <?php
        } else {
            header('Location: /');
        }
        break;

    default:
        if ($_SESSION['logged_in'] ?? false) {
            header('Location: /protected');
        } else {
            ?>
                <h1>Login</h1>
                <form method="post" action="login">
                    <label>Username</label>
                    <input type="text" name="username" id="username">
                    <label>Password</label>
                    <input type="password" name="password" id="password">
                    <button>Login</button>
                </form>
            <?php
        }
}
