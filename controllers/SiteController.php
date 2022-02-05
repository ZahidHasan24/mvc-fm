<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home()
    {
        return $this->render('home', [
            'title' => 'The Home Page'
        ]);
    }
    public function contact()
    {
        return $this->render('contact');
    }
}
