<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v;


class AuthController extends Controller
{

    public function getSignOut($req, $res)
    {
        $this->auth->logut();

        return $res->withRedirect($this->router->pathFor('Home'));
    }

    public function getSignIn($req, $res)
    {
        return $this->view->render($res, 'auth/signin.twig');
    }

    public function postSignIn($req, $res)
    {
        $auth = $this->auth->attempt(
            $req->getParam('email'),
            $req->getParam('password')
        );

        if (!$auth) {
            $this->flash->addMessage('error', 'You could not sigin with this email and password');
            return $res->withRedirect($this->router->pathFor('auth.signin'));
        }

        return $res->withRedirect($this->router->pathFor('Home'));
    }

    public function getSignUp($req, $res)
    {
        return $this->view->render($res, 'auth/signup.twig');
    }


    public function postSignUp($req, $res)
    {

        $validation = $this->validator->validate($req, [
            'email' => v::noWhitespace()->notEmpty()->email()->EmailAvailable(),
            'name' => v::notEmpty()->alpha(),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if ($validation->failed()) {
            return $res->withredirect($this->router->pathFor('auth.signup'));
        }


        $user = User::create([
            'email' => $req->getparam('email'),
            'name' => $req->getparam('name'),
            'password' => password_hash($req->getparam('password'), PASSWORD_DEFAULT)
        ]);

        $this->auth->attempt($user->email, $req->getparam('password'));
        $this->flash->addMessage('info', 'You have been signed up!');

        return $res->withredirect($this->router->pathFor('Home'));

    }

}