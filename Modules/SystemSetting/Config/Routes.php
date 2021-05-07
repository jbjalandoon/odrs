<?php
$routes->group('documents', ['namespace' => 'Modules\UserManagement\Controllers'], function($routes){
  $routes->get('/', 'Documents::index');
  $routes->match(['get', 'post'], 'add', 'Documents::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Documents::edit/$1');
  $routes->delete('delete/(:num)', 'Documents::delete/$1');
});

$routes->group('notes', ['namespace' => 'Modules\UserManagement\Controllers'], function($routes){
  $routes->get('/', 'Notes::index');
  $routes->match(['get', 'post'], 'add', 'Notes::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Notes::edit/$1');
  $routes->delete('delete/(:num)', 'Notes::delete/$1');
});
