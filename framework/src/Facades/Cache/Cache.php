<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Facades\Cache;

use Framework\Support\Facade;

/**
 * Class Cache
 * @package Framework\Facades
 * @method mixed push(string $key, $default = null, int $lifetime = null)
 * @method set(string $key, $value, int $lifetime = null)
 * @method clear()
 *
 */
class Cache extends Facade
{
    protected static $name = \Framework\Cache\Cache::class;
}