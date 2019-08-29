<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Router;

use Closure;
use Framework\Exception\ControllerNotFound;
use Framework\Facades\Core\App;
use Framework\Facades\Http\Response;
use Framework\Facades\Logger\Logger;

class Router
{
    protected $routes = [];
    protected $middlewareGroups = [];
    protected $errorRoute;

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

        /** @var Route $route */
        foreach ($this->routes as $route) {
            if ($route->getMethod() !== $method || ($route->getRoute() === "\/" && $uri !== "/")) {
                continue;
            }
            if (preg_match_all("/" . $route->getRoute() . "$/", $uri, $parameterMatches)) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            $this->call($this->errorRoute);
            return;
        }
        $this->call($route->getController());
//                dd($method, $uri, $this, $found, $parameterMatches);
    }

    /**
     * @param $var
     * @return mixed
     * @throws ControllerNotFound
     */
    private function call($var)
    {
        if ($var instanceof Closure) {
            Response::body($var());
            App::send();
            return;
        }
        if (!is_string($var) || !str_contains($var, "@")) {
            throw new ControllerNotFound();
        }
        $str = explode("@", $var);
        dd($str);
    }

    public function error($callback)
    {
        $this->errorRoute = $callback;
    }
}