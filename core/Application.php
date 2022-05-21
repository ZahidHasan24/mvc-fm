<?php

namespace app\core;

use app\models\User;

class Application
{
    public static Application $app;
    public static string $ROOT_DIR;
    public string $layout = 'main';
    public Router $router;
    public Request $request;
    public Response $response;
    public ?Controller $controller = null;
    public Session $session;
    public Database $db;
    public ?DbModel $user;
    public string $userClass;

    public function __construct($rootDir, array $config)
    {
        self::$ROOT_DIR = $rootDir;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
        $this->userClass = $config['userClass'];

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user =  $this->userClass::findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }

    public function run()
    {
        echo $this->router->resolve();
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }
}
