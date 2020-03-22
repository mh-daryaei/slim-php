<?php

//$app->get('/ali', function ($req,$res){
//    return $this->view->render($res, 'home.twig');
//});

//$app->get('/',"HomeController:index");

$app->get('/', App\Controllers\HomeController::class . ':index')->setName('Home');

$app->get('/auth/signup', App\Controllers\Auth\AuthController::class . ':getSignUp')->setName('auth.signup');
$app->post('/auth/signup', App\Controllers\Auth\AuthController::class . ':postSignUp');

$app->get('/auth/signin', App\Controllers\Auth\AuthController::class . ':getSignIn')->setName('auth.signin');
$app->post('/auth/signin', App\Controllers\Auth\AuthController::class . ':postSignIn');