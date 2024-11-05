<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//front
$routes->get('/', 'Front\HomeController::index');
$routes->get('/rooms','Front\RoomController::index');

//admin
$routes->get('admin','Admin\DashboardController::index');
$routes->get('admin/rooms','API\RoomsController::room_list');
$routes->get('admin/login','API\AuthController::login');

$routes->get('admin/users','API\UserController::index');
$routes->post('admin/user-add','API\UserController::user_add');
$routes->post('admni/user-update','API\UserController::user_update');


//oda tipi işlemleri
$routes->get('admin/room-type','API\RoomsController::room_types');
$routes->post('/api/add/save_room_type', 'API\RoomsController::save_room_type');
$routes->get('/api/edit/room_type/(:num)', 'API\RoomsController::edit_room_type/$1');

