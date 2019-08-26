<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Support;


use Framework\Core\Application;

class Facade implements FacadeInterface
{
    /**
     * Classname
     * @var string
     */
    protected static $name;

    final public static function __callStatic($name, $arguments)
    {
        Application::container()->call([static::$name, $name], $arguments);
    }
}