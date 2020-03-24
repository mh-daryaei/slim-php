<?php

namespace App\Middleware;

class AuthMiddleware extends Middleware
{

    public function __invoke($req, $res, $next)
    {
        if (!$this->container->auth->check()) {
            $this->container->flash->addMessage('error', 'please sign in before doing that');
            return $res->withRedirect($this->container->router->pathFor('auth.signin'));
        }

        $response = $next($req, $res);
        return $response;
    }
}