<?php
$routes->group('students', ['namespace' => 'Modules\StudentManagement\Controllers'], function($routes){
  $routes->get('/', 'Students::index');
  $routes->post('insert-spreadsheet', 'Students::insertSpreadsheet');
  $routes->match(['get', 'post'], 'add', 'Students::add');
  $routes->match(['get', 'post'], 'edit', 'Students::editOwn');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Students::edit/$1');
  $routes->get('delete/(:num)', 'Students::delete/$1');
  $routes->match(['get', 'post'], 'setup', 'Students::setup');
});
