<?php

/** @var \Phalcon\Mvc\Router $router */
$router = $di->getRouter();
$config = $di->getConfig();

$router->removeExtraSlashes(true);

$router->add('/', [
    'namespace' => 'App\Controllers',
    'controller' =>  'index',
    'action' =>  'index'
]);

$router->add('/:controller', [
    'namespace' => 'App\Controllers',
    'controller' =>  1,
    'action' =>  'index'
]);


$router->add('/:controller/:params', [
    'namespace' => 'App\Controllers',
    'controller' =>  1,
    'action' =>  'index',
    'params' => 2
]);

$router->add('/:controller/:action', [
    'namespace' => 'App\Controllers',
    'controller' =>  1,
    'action' =>  2,
]);

$router->add('/:controller/:action/:params', [
    'namespace' => 'App\Controllers',
    'controller' =>  1,
    'action' =>  2,
    'params' =>  3,
]);

$router->notFound([
    'namespace' => 'App\Controllers',
    'controller' => 'error',
    'action' => 'notFound',
]);

$router->handle($di->get('request_uri'));
