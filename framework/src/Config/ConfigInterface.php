<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Config;


interface ConfigInterface
{
    static function get(string $key);

    static function set($key, $val);

    static function has($key): bool;

    static function setArray(array $array);
}