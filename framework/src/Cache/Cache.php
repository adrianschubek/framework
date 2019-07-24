<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Cache;

use Phpfastcache\Helper\Psr16Adapter;

class Cache
{
    private static $cacheAdapter = null;

    public static function set($key, $value, $lifetime)
    {
        self::$cacheAdapter = self::$cacheAdapter ?? new Psr16Adapter("Files");
        $lifetime = $lifetime ?? 300;
        self::$cacheAdapter->set($key, $value, $lifetime);
    }
}