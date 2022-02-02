<?php


namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller {
    public function home() {
        return $this->render('home', [
            'title' => 'The Home Page'
        ]);
    }
    public function contact() {
        return $this->render('contact');
    }
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