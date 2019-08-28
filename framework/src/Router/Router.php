<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Router;

use Framework\Facades\Logger;

class Router
{
    protected $routes = [];
    protected $middlewareGroups = [];

    public function get(string $routePath, $controller)
    {
        $route = new Route("GET", $routePath, $controller);
        $this->routes[] = $route;
        return $route;
    }

    public function post(string $routePath, $controller)
    {
        $route = new Route("POST", $routePath, $controller);
        $this->routes[] = $route;
        return $route;
    }

    public function put(string $routePath, $controller)
    {
        $route = new Route("PUT", $routePath, $controller);
        $this->routes[] = $route;
        return $route;
    }

    public function group(string $name, array $middleware)
    {
        $this->middlewareGroups[$name] = $middleware;
    }

    public function error($controller)
    {

    }

    public function enableCache()
    {
        if (!cfg("cache")) {
            Logger::error("Cache not enabled in config file.");
            return;
        }
    }

    public function delete(string $routePath, $controller)
    {
        $route = new Route("DELETE", $routePath, $controller);
        $this->routes[] = $route;
        return $route;
    }

    public function patch(string $routePath, $controller)
    {
        $route = new Route("PATCH", $routePath, $controller);
        $this->routes[] = $route;
        return $route;
    }

    public function options(string $routePath, $controller)
    {
        $route = new Route("OPTIONS", $routePath, $controller);
        $this->routes[] = $route;
        return $route;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function dispatch($method = null, $uri = null)
    {
        $method = $method ?? $_SERVER['REQUEST_METHOD'];
        $uri = $uri ?? $_SERVER['REQUEST_URI'];
        $found = false;
        $parameterMatches = [];

//        $new = array_filter($this->routes, function (Route $obj) use ($method, $uri, $parameterMatches) {
//            if ($obj->getMethod() !== $method) {
//                return false;
//            }
//            if ($obj->getRoute() === "\/" && $uri !== "/") { // Homepage
//                return false;
//            }
//            return !!preg_match_all("/" . $obj->getRoute() . "$/", $uri, $parameterMatches);
//        });

        /** @var Route $route */
        foreach ($this->routes as $route) {
            if ($route->getMethod() !== $method || ($route->getRoute() === "\/" && $uri !== "/")) {
                continue;
            }
        }

//        dd($method, $uri, $this, $new, $parameterMatches);
    }
}