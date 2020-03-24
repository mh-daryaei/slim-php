<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v;


class PasswordConroller extends Controller
{
    public function getChangePassword($req, $res)
    {
        $this->view->render($res, 'auth/password/change.twig');
    }

    public function postChangePassword($req, $res)
    {
        $validation = $this->validator->validate($req, [
            'password_old' => v::noWhitespace()->notEmpty()->machesPassword($this->auth->user()->password),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if ($validation->failed()) {
            return $res->withRedirect($this->router->pathFor('auth.password.change'));
        }

        $this->auth->User()->setPassword($req->getparam('password'));

        $this->flash->addMessage('info', 'Your Password Was Changed');

        return $res->withRedirect($this->router->pathFor('Home'));
    }
}