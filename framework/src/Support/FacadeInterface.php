<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Support;


interface FacadeInterface
{
    static function __callStatic($name, $arguments);
}