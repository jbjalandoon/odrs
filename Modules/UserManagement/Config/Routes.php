<?php
$routes->group('roles', ['namespace' => 'Modules\UserManagement\Controllers'], function($routes){
  $routes->get('/', 'Roles::index');
  $routes->match(['get', 'post'], 'add', 'Roles::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Roles::edit/$1');
  $routes->delete('delete/(:num)', 'Roles::delete/$1');
});

$routes->group('role-permissions', ['namespace' => 'Modules\UserManagement\Controllers'], function($routes){
  $routes->get('/', 'RolePermissions::index');
  $routes->get('retrieve', 'RolePermissions::retrieve');
  $routes->match(['get', 'post'], 'add', 'RolePermissions::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'RolePermissions::edit/$1');
  $routes->delete('delete/(:num)', 'RolePermissions::delete/$1');
});

$routes->group('users', ['namespace' => 'Modules\UserManagement\Controllers'], function($routes){
  $routes->get('/', 'Users::index');
  $routes->match(['get', 'post'], 'add', 'Users::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Users::edit/$1');
  $routes->delete('delete/(:num)', 'Users::delete/$1');
});
