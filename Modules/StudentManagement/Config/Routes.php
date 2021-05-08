<?php
$routes->group('students', ['namespace' => 'Modules\StudentManagement\Controllers'], function($routes){
  $routes->get('/', 'Students::index');
  $routes->match(['get', 'post'], 'add', 'Students::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Students::edit/$1');
  $routes->delete('delete/(:num)', 'Students::delete/$1');
});
