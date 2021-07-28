<?php
$routes->group('course-types', ['namespace' => 'Modules\SystemSettings\Controllers'], function($routes){
  $routes->get('/', 'CourseTypes::index');
  $routes->match(['get', 'post'], 'add', 'CourseTypes::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'CourseTypes::edit/$1');
  $routes->get('delete/(:num)', 'CourseTypes::delete/$1');
});

$routes->group('courses', ['namespace' => 'Modules\SystemSettings\Controllers'], function($routes){
  $routes->get('/', 'Courses::index');
  $routes->match(['get', 'post'], 'add', 'Courses::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Courses::edit/$1');
  $routes->get('delete/(:num)', 'Courses::delete/$1');
});

$routes->group('academic-status', ['namespace' => 'Modules\SystemSettings\Controllers'], function($routes){
  $routes->get('/', 'AcademicStatus::index');
  $routes->match(['get', 'post'], 'add', 'AcademicStatus::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'AcademicStatus::edit/$1');
  $routes->get('delete/(:num)', 'AcademicStatus::delete/$1');
});

$routes->group('offices', ['namespace' => 'Modules\SystemSettings\Controllers'], function($routes){
  $routes->get('/', 'Offices::index');
  $routes->match(['get', 'post'], 'add', 'Offices::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Offices::edit/$1');
  $routes->get('delete/(:num)', 'Offices::delete/$1');
});
$routes->group('dashboard', ['namespace' => 'Modules\SystemSettings\Controllers'], function($routes){
  $routes->get('/', 'Dashboard::index');
});
