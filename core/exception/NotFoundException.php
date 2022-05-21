<?php

namespace app\core\exception;

use Exception;
use app\core\Application;

class NotFoundException extends \Exception
{
    protected $message = 'Page not found';
    protected $code = 404;
}
