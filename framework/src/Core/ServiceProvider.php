<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Core;


abstract class ServiceProvider
{
    private static $services = [];

    public static function getServices()
    {
        return self::$services;
    }

    public function register(string $name, $obj)
    {
        if (is_callable($obj)) {
            self::$services[$name] = $obj();
        } else if (is_string($obj)) {
            self::$services[$name] = $obj;
        }
    }

    public function registerArray($arr)
    {
        if (is_array($arr)) {
            foreach ($arr as $key => $val) {
                self::$services[$key] = $val;
            }
        }
    }

    abstract function boot();
}