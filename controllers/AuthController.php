<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                Application::$app->response->redirect('/');
                return;
            }
        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
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

    public function logout(Request $request)
    {
        Application::$app->logout();
        Application::$app->response->redirect('/');
    }

    public function profile()
    {
        return $this->render('profile');
    }
}
