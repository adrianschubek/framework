<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
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
        return Application::container()->call([static::$name, $name], $arguments);
    }
}