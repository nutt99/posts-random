<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/navbar', 'Home::navbar');

$routes->get('/login', 'UserController::index');

$routes->get('/page/detail', 'Home::detailPage');
$routes->get('/profile', 'Home::profile');
$routes->get('/createpost', 'Home::uploadForm');