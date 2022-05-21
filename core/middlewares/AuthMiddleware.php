<?php

namespace app\core\middlewares;

use app\core\Application;
use Exception;

class AuthMiddleware extends BaseMiddleware
{
    public function execute()
    {
        if(Application::isGuest()) {
            throw new Exception();
        }
    }
}