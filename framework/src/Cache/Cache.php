<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Cache;

use Closure;
use DI\Annotation\Inject;
use Phpfastcache\Helper\Psr16Adapter;

class Cache
{
    /**
     * @var Psr16Adapter
     * @Inject
     */
    private $cacheAdapter = null;

    /**
     * @param string $key
     * @param null $default
     * @param int|null $lifetime
     * @return bool|mixed|null
     */
    public function push(string $key, $default = null, int $lifetime = null)
    {
        if ($this->cacheAdapter->has($key)) {
            return $this->cacheAdapter->get($key);
        }
        if ($default instanceof Closure) {
            $data = $default();
            $this->set($key, $data, $lifetime);
            return $data;
        } else {
            $this->set($key, $default, $lifetime);
        }
        return $default ?? false;
    }

    /**
     * @param string $key
     * @param $value
     * @param int|null $lifetime
     */
    public function set(string $key, $value, int $lifetime = null)
    {
        $this->cacheAdapter->set($key, $value, $lifetime);
    }

    public function clear()
    {
        $this->cacheAdapter->clear();
    }
}