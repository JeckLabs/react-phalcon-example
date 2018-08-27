<?php
use Phalcon\Mvc\View\Simple as View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use App\ReactEngine;

use Limenius\ReactRenderer\Renderer\ExternalServerReactRenderer;
use Limenius\ReactRenderer\Context\SymfonyContextProvider;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return include APP_PATH . "/config/config.php";
});

$config = $di->getConfig();

include APP_PATH . '/config/loader.php';


$di->setShared('context', function () {
    return new SymfonyContextProvider(new RequestStack());
});



$di->setShared('react', function () {
    return new ReactEngine;
});

/**
/**
 * Sets the view component
 */
$di->setShared('view', function () {
    $config = $this->getConfig();

    $view = new View();
    $view->setViewsDir($config->application->viewsDir);

    $view->registerEngines([
        '.php' => \Phalcon\Mvc\View\Engine\Php::class,
        '.phtml' => \Phalcon\Mvc\View\Engine\Php::class,
        '.volt' => function ($view, $di) use ($config) {
            $volt = new VoltEngine($view, $di);
            $volt->setOptions([
              'compiledPath' => '../app/compiled/',
              'compileAlways' => $config->env == ENV_DEV 
            ]);
            $compiler = $volt->getCompiler();
            $compiler->addFunction('react_component', '$this->react->react_component');
            return $volt;
        }
    ]);


    return $view;
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    $params = [
        'host'     => $config->database->host,
        'username' => $config->database->username,
        'password' => $config->database->password,
        'dbname'   => $config->database->dbname,
        'charset'  => $config->database->charset
    ];

    if ($config->database->adapter == 'Postgresql') {
        unset($params['charset']);
    }

    $connection = new $class($params);

    return $connection;
});

