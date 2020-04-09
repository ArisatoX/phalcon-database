<?php

/** @var \Phalcon\Mvc\Router $router */
$router = $di->getRouter();
$config = $di->getConfig();

$router->add('/', [
    'controller' =>  'index',
    'action' =>  'index'
]);

$router->add('/:controller', [
    'controller' =>  1,
    'action' =>  'index'
]);


$router->add('/:controller/:param', [
    'controller' =>  1,
    'action' =>  'index',
    'params' => 2
]);

$router->add('/:controller/:action/:param', [
    'controller' =>  1,
    'action' =>  2,
    'params' =>  3,
]);

$router->notFound([
    'controller' => 'error',
    'action' => 'notfound',
]);

$request_uri = str_replace($config->application->baseUri, '', $_SERVER['REQUEST_URI']);

$router->handle($request_uri);
