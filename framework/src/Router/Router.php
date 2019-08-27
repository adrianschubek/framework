<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Router;

class Router
{
    protected $routes = [];
    protected $middlewareGroups = [];

    public function get(string $routePath, $controller)
    {
        $route = new Route("get", $routePath, $controller);
        $this->routes[] = $route;
        return $route;
    }

    public function group(string $name, array $middleware)
    {
        $this->middlewareGroups[$name] = $middleware;
    }

    public function enableCache()
    {
        if (!cfg("cache")) {
            return;
        }
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}