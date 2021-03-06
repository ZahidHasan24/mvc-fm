<?php

namespace app\core;

use app\core\exception\NotFoundException;

class Router
{
    private Request $request;
    private Response $response;
    private array $routerMap = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $url, $callback)
    {
        $this->routerMap['get'][$url] = $callback;
    }

    public function post(string $url, $callback)
    {
        $this->routerMap['post'][$url] = $callback;
    }

    public function resolve()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        $callback = $this->routerMap[$method][$url] ?? false;
        if (!$callback) {
            throw new NotFoundException();
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            $controller = new $callback[0];
            $controller->action = $callback[1];
            Application::$app->controller = $controller;
            $middlewares = $controller->getMiddlewares();
            foreach ($middlewares as $middleware) {
                $middleware->execute();
            }
            $callback[0] = $controller;
        }
        return call_user_func($callback, $this->request);
    }

    public function renderView($view, $params = [])
    {
        $layout_name = Application::$app->layout;
        if (Application::$app->controller) {
            $layout_name = Application::$app->controller->layout;
        }
        $view_content = $this->renderViewOnly($view, $params);
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout_name.php";
        $layout_content = ob_get_clean();
        return str_replace('{{content}}', $view_content, $layout_content);
    }

    public function renderViewOnly($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}
