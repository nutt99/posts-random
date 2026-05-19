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
$routes->get('post/edit/(:num)', 'PostController::edit/$1');
$routes->post('post/update/(:num)', 'PostController::update/$1');
$routes->get('post/delete/(:num)', 'PostController::delete/$1');

$routes->post('/comment/add', 'CommentController::addComment');
$routes->post('/like/toggle', 'PostController::toggleLike');
$routes->post('post/toggle-save', 'PostController::toggleSave');
$routes->get('/load-more', 'Home::loadMore');

$routes->get('/profile/edit', 'ProfileController::edit');
$routes->post('/profile/update', 'ProfileController::update');
$routes->get('/user/(:num)', 'ProfileController::viewProfile/$1');

$routes->get('/logout', 'UserController::logout');