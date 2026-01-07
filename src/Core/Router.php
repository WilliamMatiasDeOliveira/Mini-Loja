<?php

declare(strict_types=1);

namespace App\Core;

class Router
{

    private array $routes = array();

    public function __construct()
    {
        $this->routes = [
            "GET" => [],
            "POST" => []
        ];
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $method = strtolower($method);

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = strtolower(str_replace("\\", "/", $uri));
        $uri = rtrim($uri, "/");
        $uri = $uri === '' ? '/' : $uri;

        if (!isset($this->routes[$method])) {
            $this->defaultResponse(405, "Method not allowed !");
            return;
        }

        if (!isset($this->routes[$method][$uri])) {
            $this->defaultResponse(404, "Page not found !");
            return;
        }

        [$controller, $action] = $this->routes[$method][$uri];
        
        if(!class_exists($controller)){
            $this->defaultResponse(500, "Controller $controller not found !");
            return;
        }

        $instance = new $controller();

        if(!method_exists($instance, $action)){
            $this->defaultResponse(500, "Action $action not found in controller $controller !");
            return;
        }

        $instance->$action();
    }


    private function defaultResponse($code, $message)
    {
        http_response_code($code);
        echo $message;
    }
}
