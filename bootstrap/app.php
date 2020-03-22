<?php

use Respect\Validation\Validator as v;

session_start();

require __DIR__.'/../vendor/autoload.php';

$app = new \Slim\App([
    'settings' =>  [
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'slim',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci'
        ]
    ]
]);


$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();


$container['db'] = function ($container) use ($capsule){
    return $capsule;
};


$container['validator'] = function ($container){
    return new App\Validation\Validator();
};


//$container['HomeController'] = function ($container){
//    return new App\Controllers\HomeController($container);
//};


$container['view'] = function ($container){

    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views',[
        'cache' => false,
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router ,
        $container->request->getUri()
    ));

    return $view;
};

$container['csrf'] = function ($container){
    return new \Slim\Csrf\Guard;
};

$container['auth'] = function ($container){
    return new App\Auth\Auth;
};

$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \App\Middleware\OldInputMiddleware($container));
$app->add(new \App\Middleware\CsrfViewMiddleware($container));

$app->add($container->csrf);

v::with('App\\Validation\\Rules\\');

require __DIR__.'/../app/routes.php';