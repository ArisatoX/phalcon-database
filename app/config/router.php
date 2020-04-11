<?php

/** @var \Phalcon\Mvc\Router $router */
$router = $di->getRouter();
$config = $di->getConfig();

$router->removeExtraSlashes(true);

$router->add('/', [
    'namespace' => 'App\Controller',
    'controller' =>  'index',
    'action' =>  'index'
]);

$router->add('/:controller', [
    'namespace' => 'App\Controller',
    'controller' =>  1,
    'action' =>  'index'
]);


$router->add('/:controller/:params', [
    'namespace' => 'App\Controller',
    'controller' =>  1,
    'action' =>  'index',
    'params' => 2
]);

$router->add('/:controller/:action', [
    'namespace' => 'App\Controller',
    'controller' =>  1,
    'action' =>  2,
]);

$router->add('/:controller/:action/:params', [
    'namespace' => 'App\Controller',
    'controller' =>  1,
    'action' =>  2,
    'params' =>  3,
]);

$router->notFound([
    'namespace' => 'App\Controller',
    'controller' => 'error',
    'action' => 'notFound',
]);

$router->handle($di->get('request_uri'));
