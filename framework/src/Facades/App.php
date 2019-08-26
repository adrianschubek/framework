<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Facades;


use Framework\Core\Application;
use Framework\Support\Facade;

class App extends Facade
{
    protected static $name = Application::class;
}