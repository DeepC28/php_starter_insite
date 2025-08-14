<?php
require_once 'core/Env.php';
require_once 'core/Router.php';

Env::load(__DIR__ . '/.env');

$router = new Router();
$router->handleRequest();
