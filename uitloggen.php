<?php
session_start();

$_SESSION = [];

// Verwijdert de sessiecookie als deze bestaat
if (ini_get('session.use_cookies')) {
    $cookie_parameters = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $cookie_parameters['path'],
        $cookie_parameters['domain'],
        $cookie_parameters['secure'],
        $cookie_parameters['httponly']
    );
}

session_destroy();

// Je wordt naar de homepagina gestuurd na het uitloggen
header('Location: index.php');
exit;
