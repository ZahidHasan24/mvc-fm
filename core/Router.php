<?php

namespace app\core;

class Router {
    private Request $request;
    private array $routerMap = [];

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function get(string $url, $callback) {
        $this->routerMap['get'][$url] = $callback;
    }

    public function resolve() {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        $callback = $this->routerMap[$method][$url] ?? false;
        if(!$callback) {    
            return 'Not Found';
        }
        if(is_string($callback)) {
            return $this->renderView($callback);
        }
        return call_user_func($callback);
    }

    public function renderView($view, $params = []) {
        return 'Rendering view '.$view;
    }


}