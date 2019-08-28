<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Router;


class Route
{
    /**
     * @var string
     */
    protected $method;
    /**
     * @var string
     */
    protected $route;
    protected $controller;
    protected $middleware = [];
    protected $middlewareGroup = [];

    public function __construct(string $method, string $route, $controller)
    {
        $this->method = $method;
        $this->route = $this->regex($route);
        $this->controller = $controller;
    }

    public function regex(string $route)
    {
        $str = preg_quote($route, '/');
        $str = str_replace("\]", "]", $str);
        $str = str_replace("/\\", "/", $str);
        return preg_replace("/\[([a-z]+)\]/", "([a-z0-9_-]+)", $str);
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return array
     */
    public function getMiddleware(): array
    {
        return $this->middleware;
    }

    /**
     * @return array
     */
    public function getMiddlewareGroup(): array
    {
        return $this->middlewareGroup;
    }

    public function middleware($middleware)
    {
        if (is_array($middleware)) {
            $this->middleware = $middleware;
        } else {
            $this->middleware[] = $middleware;
        }
    }

    public function group($middleware)
    {
        if (is_array($middleware)) {
            $this->middlewareGroup = $middleware;
        } else {
            $this->middlewareGroup[] = $middleware;
        }
    }

    public function name(string $name)
    {

    }
}