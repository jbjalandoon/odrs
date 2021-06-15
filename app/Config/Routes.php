<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('/verify', 'Home::verification');
$routes->get('logout', 'Home::logout');
$routes->post('register', 'Home::register');
$routes->get('signup', 'Home::signUp');

$routes->group('office', ['namespace' => 'App\Controllers\Office'], function($routes){
	$routes->get('/', 'Request::index');
});

$routes->group('student', ['namespace' => 'App\Controllers\Student'], function($routes)
{
	$routes->get('/', 'Request::index');
	$routes->get('history', 'Request::history');
	$routes->match(['get', 'post'], 'request', 'Request::send');
	$routes->get('request/delete/(:num)', 'Request::delete/$1');
	$routes->get('stub/(:num)', 'request::stub/$1');
});

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function($routes)
{
		//Online Request
    $routes->get('/', 'Request::index');
    $routes->get('pending-requests', 'Request::index');
    $routes->get('office-approval', 'Request::approval');
    $routes->post('approve-request', 'Request::approve');
    $routes->post('request-confirm', 'Request::confirm');
    $routes->get('on-process-requests', 'Request::process');
    $routes->post('process', 'Request::documentProcessed');
    $routes->get('processed-requests', 'Request::processed');
    $routes->post('scan', 'Request::scan');
    $routes->get('claimed-requests', 'Request::claimed');

		//Student Information
    $routes->get('undergraduate', 'Student::index');
		$routes->get('alumni', 'Student::alumni');

		//Settings

		$routes->get('roles', 'Roles::index');
		$routes->match(['get', 'post'], 'roles/add', 'Roles::add');
		$routes->match(['get', 'post'], 'roles/edit/(:num)', 'Roles::edit/$1');
		$routes->delete('roles/edit', 'Roles::edit');

		$routes->get('modules', 'Modules::index');
		$routes->match(['get', 'post'], 'modules/add', 'Modules::add');
		$routes->match(['get', 'post'], 'modules/edit/(:num)', 'Modules::edit/$1');
		$routes->delete('modules/edit', 'Modules::edit');


		$routes->get('users', 'User::index');
		$routes->post('users/delete', 'User::delete');
		$routes->post('users/activate', 'User::activate');
		$routes->match(['get', 'post'],'users/add', 'User::add');
		$routes->match(['get', 'post'],'users/edit/(:num)', 'User::edit/$1');


		$routes->get('documents', 'Document::index');
		$routes->match(['get', 'post'], 'documents/add', 'Documents::add');
		$routes->match(['get', 'post'], 'documents/edit/(:num)', 'Documents::edit/$1');
		$routes->delete('documents/edit', 'Documents::edit');

		$routes->get('courses', 'Course::index');
		$routes->get('offices', 'Office::index');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
