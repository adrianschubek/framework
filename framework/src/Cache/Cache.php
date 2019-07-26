<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Cache;

use Closure;
use Phpfastcache\Config\ConfigurationOption;
use Phpfastcache\Helper\Psr16Adapter;

class Cache
{
    private static $cacheAdapter = null;

    /**
     * @param string $key
     * @param null $default
     * @param int|null $lifetime
     * @return bool|mixed|null
     */
    public static function push(string $key, $default = null, int $lifetime = null)
    {
        self::$cacheAdapter = self::$cacheAdapter ?? new Psr16Adapter("Files", new ConfigurationOption([
                "path" => "cache",
                "itemDetailedDate" => false
            ]));
        if (self::$cacheAdapter->has($key)) {
            return self::$cacheAdapter->get($key);
        }
        if ($default instanceof Closure) {
            $data = $default();
            self::set($key, $data, $lifetime);
            return $data;
        }
        self::set($key, $default, $lifetime);
        return $default ?? false;
    }

    /**
     * @param string $key
     * @param $value
     * @param int|null $lifetime
     */
    public static function set(string $key, $value, int $lifetime = null)
    {
        self::$cacheAdapter = self::$cacheAdapter ?? new Psr16Adapter("Files", new ConfigurationOption([
                "path" => "cache",
                "itemDetailedDate" => false
            ]));
        self::$cacheAdapter->set($key, $value, $lifetime);
    }

    public static function clear()
    {
        self::$cacheAdapter = self::$cacheAdapter ?? new Psr16Adapter("Files", new ConfigurationOption([
                "path" => "cache",
                "itemDetailedDate" => false
            ]));

        self::$cacheAdapter->clear();
    }
}