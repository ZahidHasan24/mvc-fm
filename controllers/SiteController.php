<?php


namespace app\controllers;

use app\core\Controller;

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
}