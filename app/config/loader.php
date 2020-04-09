<?php

$loader = new \Phalcon\Loader();

/** @var \Phalcon\Config $config */
/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir
    ]
);

$loader->registerNamespaces([
    'Phalcon\Db' => APP_PATH . '/lib/Phalcon/Db',
]);

$loader->register();
