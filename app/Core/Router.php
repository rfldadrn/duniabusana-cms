<?php

class Router {

    private $routes = [];

    public function get($url, $handler) {
        $this->routes['GET'][$url] = $handler;
    }

    public function post($url, $handler) {
        $this->routes['POST'][$url] = $handler;
    }

    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $basePath = BASE_URL;
        $uri = str_replace($basePath, '', '/' . $uri);
        $uri = trim($uri, '/');

        if (!isset($this->routes[$method])) {
            http_response_code(404);
            echo "Method not allowed";
            return;
        }

        foreach ($this->routes[$method] as $route => $handler) {

            // ubah :id jadi regex
            $pattern = preg_replace('#:([\w]+)#', '([\w-]+)', $route);
            $pattern = "#^$pattern$#";

            if (preg_match($pattern, $uri, $matches)) {

                array_shift($matches); // hapus full match

                [$controller, $action] = explode('@', $handler);

                require_once "../app/Controllers/$controller.php";
                $obj = new $controller;

                call_user_func_array([$obj, $action], $matches);
                return;
            }
        }

        http_response_code(404);
        require_once __DIR__ . '/../../views/errors/404.php';
    }

}
?>