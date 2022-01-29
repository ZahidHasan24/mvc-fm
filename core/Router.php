<?php

namespace app\core;

class Router {
    private Request $request;
    private Response $response;
    private array $routerMap = [];

    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $url, $callback) {
        $this->routerMap['get'][$url] = $callback;
    }

    public function resolve() {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        $callback = $this->routerMap[$method][$url] ?? false;
        if(!$callback) {
            $this->response->statusCode(404);
            return 'Not Found';
        }
        if(is_string($callback)) {
            return $this->renderView($callback);
        }
        return call_user_func($callback);
    }

    public function renderView($view, $params = []) {
        return $this->renderViewOnly($view, $params);
    }

    public function renderViewOnly($view, $params = []) {
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }


}