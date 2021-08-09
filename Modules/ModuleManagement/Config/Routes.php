<?php

$routes->group('modules', ['namespace' => 'Modules\ModuleManagement\Controllers'], function($routes)
{
    $routes->get('/', 'Modules::index');
    $routes->match(['get', 'post'], 'add', 'Modules::add');
    $routes->match(['get', 'post'],'edit/(:num)', 'Modules::edit/$1');
    $routes->get('delete/(:num)', 'Modules::delete/$1');
    $routes->get('restore/(:num)', 'Modules::restore/$1');
});

$routes->group('permissions', ['namespace' => 'Modules\ModuleManagement\Controllers'], function($routes)
{
    $routes->get('/', 'Permissions::index');
    $routes->match(['get', 'post'], 'add', 'Permissions::add');
    $routes->match(['get', 'post'],'edit/(:num)', 'Permissions::edit/$1');
    $routes->get('delete/(:num)', 'Permissions::delete/$1');
    $routes->get('restore/(:num)', 'Permissions::restore/$1');
    $routes->get('filter', 'Permissions::filter');
});
$routes->group('permission-types', ['namespace' => 'Modules\ModuleManagement\Controllers'], function($routes)
{
    $routes->get('/', 'PermissionTypes::index');
    $routes->match(['get', 'post'], 'add', 'PermissionTypes::add');
    $routes->match(['get', 'post'],'edit/(:num)', 'PermissionTypes::edit/$1');
    $routes->get('delete/(:num)', 'PermissionTypes::delete/$1');
    $routes->get('restore/(:num)', 'PermissionTypes::restore/$1');
});
