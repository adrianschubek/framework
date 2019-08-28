<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Support;


interface FacadeInterface
{
    static function __callStatic($name, $arguments);
}