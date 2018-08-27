<?php

/**
 * Registering an autoloader
 */
$loader = new \Phalcon\Loader();

$loader->registerDirs(
    [
        $config->application->modelsDir
    ]
);

$loader->registerNamespaces(
    [
        'App' => __DIR__ . '/../../app'
    ]
);


/**
 * Register Files, composer autoloader
 */
$loader->registerFiles(
    [
        __DIR__ . '/../../vendor/autoload.php'
    ]
);


$loader->register();
