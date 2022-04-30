<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;

class AuthController extends Controller
{
    public function login()
    {
        $this->setLayout('auth');
        return $this->render('login');
    }
    public function register(Request $request)
    {
        $user = new User();
        if ($request->getMethod() === 'post') {
            $user->loadData($request->getBody());
            if ($user->validate() && $user->saveToDb()) {
                Application::$app->session->setFlash('success', 'Registration Successfully Done.');
                Application::$app->response->redirect('/');
                return 'Show success page';
            }
            // echo "<pre>";
            // var_dump($user->errors);
            // echo "</pre>";
            return $this->render('register', [
                'model' => $user
            ]);
        }
        $this->setLayout('auth');
        return $this->render('register', [
            'model' => $user
        ]);
    }
}
