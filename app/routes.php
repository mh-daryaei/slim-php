<?php

$app->get('/', App\Controllers\HomeController::class . ':index')->setName('Home');

$app->group('', function () {
    $this->get('/auth/signup', App\Controllers\Auth\AuthController::class . ':getSignUp')->setName('auth.signup');
    $this->post('/auth/signup', App\Controllers\Auth\AuthController::class . ':postSignUp');

    $this->get('/auth/signin', App\Controllers\Auth\AuthController::class . ':getSignIn')->setName('auth.signin');
    $this->post('/auth/signin', App\Controllers\Auth\AuthController::class . ':postSignIn');

})->add(new \App\Middleware\GuestMiddleware($container));


$app->group('', function () {
    $this->get('/auth/signout', App\Controllers\Auth\AuthController::class . ':getSignOut')->setName('auth.signout');

    $this->get('/auth/password/change', App\Controllers\Auth\PasswordConroller::class . ':getChangePassword')->setName('auth.password.change');
    $this->post('/auth/password/change', App\Controllers\Auth\PasswordConroller::class . ':postChangePassword');

})->add(new \App\Middleware\AuthMiddleware($container));
