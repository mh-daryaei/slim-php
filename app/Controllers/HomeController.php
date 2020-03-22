<?php

namespace App\Controllers;

use \Slim\Views\Twig as View;
use App\Models\User;

class HomeController extends Controller {

    public function index($req,$res)
    {
//        $user = $this->db->table('user')->find(1);

//        $user = User::create([
//           'name' => 'reza',
//           'email' => 'reza@gmail.com',
//           'password' => '321'
//        ]);
//
//        var_dump($user);
//        die();
        return $this->container->view->render($res,'home.twig');
    }
}