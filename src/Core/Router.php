<?php

declare(strict_types=1);

namespace App\Core;

use App\Controllers\AdminCategoryControllers;
use App\Controllers\AdminController;
use App\Controllers\AdminProductController;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\ProductController;

class Router
{

    private array $routes = array();

    public function __construct()
    {
        $this->routes = [
            "GET" => [
                "/" => [HomeController::class, "index"],

                "/auth/login" => [AuthController::class, "loginForm"],
                "/auth/logout" => [AuthController::class, "logout"],
                
                "/admin/dashboard" => [AdminController::class, "dashboard"],

                "/admin/products/index" => [AdminProductController::class, "index"],
                "/admin/products/create" => [AdminProductController::class, "create"],
                "/admin/products/show" => [AdminProductController::class, "show"],

                "/admin/category/menage" => [AdminCategoryControllers::class, "menage"],
                "/admin/category/create" => [AdminCategoryControllers::class, "create"],
                "/admin/category/update" => [AdminCategoryControllers::class, "update"],
                "/admin/category/delete" => [AdminCategoryControllers::class, "delete"],
            ],

            "POST" => [
                "/auth/login" => [AuthController::class, "login"],

                "/admin/products/store" => [AdminProductController::class, "store"],

                "/admin/category/store" => [AdminCategoryControllers::class, "store"],

            ]
        ];
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $method = strtoupper($method);

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

        if (!class_exists($controller)) {
            $this->defaultResponse(500, "Controller $controller not found !");
            return;
        }

        $instance = new $controller();

        if (!method_exists($instance, $action)) {
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
