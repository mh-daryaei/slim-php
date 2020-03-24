<?php

namespace App\Middleware;

class GuestMiddleware extends Middleware
{

    public function __invoke($req, $res, $next)
    {
        if ($this->container->auth->check()) {
            return $res->withRedirect($this->container->router->pathFor('Home'));
        }

        $response = $next($req, $res);
        return $response;
    }
}