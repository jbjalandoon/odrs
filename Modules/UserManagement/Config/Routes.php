<?php
$routes->group('roles', ['namespace' => 'Modules\UserManagement\Controllers'], function($routes){
  $routes->get('/', 'Roles::index');
  $routes->match(['get', 'post'], 'add', 'Roles::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Roles::edit/$1');
  $routes->get('delete/(:num)', 'Roles::delete/$1');
  $routes->get('restore/(:num)', 'Roles::restore/$1');
});

$routes->group('role-permissions', ['namespace' => 'Modules\UserManagement\Controllers'], function($routes){
  $routes->get('/', 'RolePermissions::index');
  $routes->get('retrieve', 'RolePermissions::retrieve');
  $routes->match(['get', 'post'], 'add', 'RolePermissions::add');
  $routes->match(['get', 'post'], 'edit', 'RolePermissions::edit');
  $routes->get('delete/(:num)', 'RolePermissions::delete/$1');
  $routes->get('restore/(:num)', 'RolePermissions::restore/$1');
});

$routes->group('users', ['namespace' => 'Modules\UserManagement\Controllers'], function($routes){
  $routes->get('/', 'Users::index');
  $routes->match(['get', 'post'], 'add', 'Users::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Users::edit/$1');
  $routes->get('delete/(:num)', 'Users::delete/$1');
  $routes->get('restore/(:num)', 'Users::restore/$1');
  $routes->post('edit-password', 'Users::updatePassword');
  $routes->post('request-password', 'Users::requestPassword');
  $routes->get('retrieve', 'Users::retrieve');
});
