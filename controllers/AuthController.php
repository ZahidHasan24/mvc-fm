<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AuthController extends Controller {
    public function login() {
        $this->setLayout('auth');
        return $this->render('login');
    }
    public function register(Request $request) {
        if ($request->getMethod() === 'post') {
            echo '<pre>';
            var_dump($request->getBody());
            echo '</pre>';
            exit;
        }
        $this->setLayout('auth');
        return $this->render('register');
    }
}