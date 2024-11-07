<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Frontend işlemleri
$routes->get('/', 'Front\HomeController::index');
$routes->get('/rooms', 'Front\RoomController::index');

// Admin işlemleri (view döndürme işlemleri)
$routes->get('admin', 'Admin\DashboardController::index');


//API işlemleri
$routes->get('admin/rooms', 'Api\RoomsController::index');
$routes->get('admin/login', 'Api\AuthController::login');

//--Kullalnıcı işlemleri
$routes->get('admin/user-list', 'Api\UserController::index');
$routes->get('admin/users','Api\UserController::user_list');

$routes->post('admin/user-add', 'Api\UserController::user_add');
$routes->post('admin/user-update', 'Api\UserController::user_update');

//--Oda tipi işlemleri
$routes->get('admin/room-type-list', 'Api\RoomsController::room_types_show'); //sadece view dönderir
$routes->get('admin/room-type','Api\RoomsController::room_types');
$routes->post('admin/save-room-type', 'Api\RoomsController::save_room_type');
$routes->get('admin/edit-room-type/(:num)', 'Api\RoomsController::edit_room_type/$1');


//--Giriş İşlemleri
$routes->get('login','Api/AuthController::login');
$routes->get('register','Api/AuthController::register');

