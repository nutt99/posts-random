<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/search', 'Home::search');
$routes->get('/login', 'UserController::index');
$routes->post('/login', 'UserController::auth');
$routes->get('/register', 'UserController::registerView');
$routes->post('/register', 'UserController::register');

$routes->get('/page/detail', 'Home::detailPage');
$routes->get('/profile', 'ProfileController::profile');

$routes->get('/createpost', 'PostController::index');
$routes->post('/createpost', 'PostController::addPhoto');

$routes->get('post/(:num)', 'PostController::detail/$1');
$routes->post('/comment/add', 'CommentController::addComment');
$routes->post('/like/toggle', 'PostController::toggleLike');

$routes->get('/logout', 'UserController::logout');