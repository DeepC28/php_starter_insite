<?php

require_once __DIR__ . '/../core/Route.php';
require_once __DIR__ . '/../core/RouteCollection.php';

$routes = new RouteCollection();

$routes->add('/', 'MainController', 'index');
$routes->add('/about', 'MainController', 'about');
$routes->add('/greet', 'MainController', 'greet');
$routes->add('/contact', 'MainController', 'contact');
$routes->add('/services', 'MainController', 'services');
$routes->add('/profile', 'MainController', 'profile');
$routes->add('/profile/update', 'MainController', 'updateProfile');

$routes->add('/login', 'AuthController', 'login');
$routes->add('/logout', 'AuthController', 'logout');

$routes->add('/access', 'AuthController', 'register');

return $routes;
