<?php

$routes->group('requests', ['namespace' => 'Modules\DocumentRequest\Controllers'], function($routes)
{
    $routes->get('/', 'Requests::index');
    $routes->delete('delete/(:num)', 'Requests::delete/$1');
    $routes->get('stub/(:num)', 'Requests::stub/$1');
    $routes->get('history', 'Requests::history');
    $routes->match(['get', 'post'], 'new', 'Requests::add');
});

$routes->group('document-requests', ['namespace' => 'Modules\DocumentRequest\Controllers'], function($routes)
{
    $routes->get('/', 'DocumentRequests::index');
    $routes->post('request-confirm', 'DocumentRequests::confirmRequest');
    $routes->post('deny-request', 'DocumentRequests::denyRequest');
    $routes->get('goodmoral/(:num)', 'DocumentRequests::goodmoral/$1');
});

$routes->group('on-process-document', ['namespace' => 'Modules\DocumentRequest\Controllers'], function($routes)
{
    $routes->get('/', 'DocumentRequests::onProcess');
    $routes->get('filter', 'DocumentRequests::filterOnProcess');
    $routes->post('print-requests', 'DocumentRequests::printRequest');
});

$routes->group('approval', ['namespace' => 'Modules\DocumentRequest\Controllers'], function($routes)
{
    $routes->get('/', 'DocumentRequests::approval');
    $routes->post('approve', 'DocumentRequests::approveRequest');
    $routes->post('hold', 'DocumentRequests::holdRequest');
});

$routes->group('printed-requests', ['namespace' => 'Modules\DocumentRequest\Controllers'], function($routes)
{
    $routes->get('/', 'DocumentRequests::printed');
    $routes->get('filter', 'DocumentRequests::filterPrinted');
    $routes->get('get-printed', 'DocumentRequests::getPrinted');
    $routes->post('scan', 'DocumentRequests::claimRequest');
});

$routes->group('claimed-requests', ['namespace' => 'Modules\DocumentRequest\Controllers'], function($routes)
{
    $routes->get('/', 'DocumentRequests::claimed');
    $routes->get('filter', 'DocumentRequests::claimFilter');
    $routes->get('report', 'DocumentRequests::report');

});
