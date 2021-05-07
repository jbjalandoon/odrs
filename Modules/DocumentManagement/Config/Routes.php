<?php
$routes->group('offices', ['namespace' => 'Modules\SystemSettingx\Controllers'], function($routes){
  $routes->get('/', 'Offices::index');
  $routes->match(['get', 'post'], 'add', 'Offices::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Offices::edit/$1');
  $routes->delete('delete/(:num)', 'Offices::delete/$1');
});

$routes->group('program-type', ['namespace' => 'Modules\SystemSettingx\Controllers'], function($routes){
  $routes->get('/', 'ProgramTypes::index');
  $routes->match(['get', 'post'], 'add', 'ProgramTypes::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'ProgramTypes::edit/$1');
  $routes->delete('delete/(:num)', 'ProgramTypes::delete/$1');
});

$routes->group('programs', ['namespace' => 'Modules\SystemSettingx\Controllers'], function($routes){
  $routes->get('/', 'Programs::index');
  $routes->match(['get', 'post'], 'add', 'Programs::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Programs::edit/$1');
  $routes->delete('delete/(:num)', 'Programs::delete/$1');
});

$routes->group('academic-status', ['namespace' => 'Modules\SystemSettingx\Controllers'], function($routes){
  $routes->get('/', 'AcademicStatus::index');
  $routes->match(['get', 'post'], 'add', 'AcademicStatus::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'AcademicStatus::edit/$1');
  $routes->delete('delete/(:num)', 'AcademicStatus::delete/$1');
});

$routes->group('level', ['namespace' => 'Modules\SystemSettingx\Controllers'], function($routes){
  $routes->get('/', 'Level::index');
  $routes->match(['get', 'post'], 'add', 'Level::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Level::edit/$1');
  $routes->delete('delete/(:num)', 'Level::delete/$1');
});
