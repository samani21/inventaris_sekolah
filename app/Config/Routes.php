<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//dashboard
$routes->get('/dashboard','Dashboard::index');
//login dan logout
$routes->get('/login', 'Login::index');
$routes->get('/logout', 'Login::logout');
$routes->post('/login', 'Login::doLogin');

//User
$routes->get('/user','User::index');
$routes->get('/user/tambah', 'User::tambah');
$routes->post('user/store', 'User::store');
$routes->get('/user/edit/(:any)', 'User::edit/$1');
$routes->post('/user/update/(:any)', 'User::update/$1');
$routes->get('/user/delete/(:any)', 'User::delete/$1');

//Guru
$routes->get('/guru','Guru::index');
$routes->get('/guru/tambah','Guru::tambah');
$routes->post('guru/store', 'Guru::store');
$routes->get('/guru/edit/(:any)', 'Guru::edit/$1');
$routes->post('/guru/update/(:any)', 'Guru::update/$1');
$routes->get('/guru/delete/(:any)', 'Guru::delete/$1');