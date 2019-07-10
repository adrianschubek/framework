<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Config;


class Config implements ConfigInterface
{
    /**
     * @var array
     */
    private static $config;

    public static function get(string $key)
    {
        return self::$config[$key];
    }

    public static function set($key, $val)
    {
        self::$config[$key] = $val;
    }

    public static function has($key): bool
    {
        return !!isset(self::$config[$key]);
    }

    public static function setArray(array $arr)
    {
        foreach ($arr as $key => $value) {
            self::$config[$key] = $value;
        }
    }
}
