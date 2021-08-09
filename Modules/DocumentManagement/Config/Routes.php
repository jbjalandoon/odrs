<?php
$routes->group('notes', ['namespace' => 'Modules\DocumentManagement\Controllers'], function($routes){
  $routes->get('/', 'Notes::index');
  $routes->match(['get', 'post'], 'add', 'Notes::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Notes::edit/$1');
  $routes->get('delete/(:num)', 'Notes::delete/$1');
  $routes->get('restore/(:num)', 'Notes::restore/$1');
});

$routes->group('documents', ['namespace' => 'Modules\DocumentManagement\Controllers'], function($routes){
  $routes->get('/', 'Documents::index');
  $routes->get('notes', 'Documents::fetchNotes');
  $routes->get('requirements', 'Documents::fetchRequirements');
  $routes->match(['get', 'post'], 'add', 'Documents::add');
  $routes->match(['get', 'post'], 'edit/(:num)', 'Documents::edit/$1');
  $routes->get('delete/(:num)', 'Documents::delete/$1');
  $routes->get('restore/(:num)', 'Documents::restore/$1');
});
