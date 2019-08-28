<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Facades;


use Framework\Core\Application;
use Framework\Support\Facade;

class App extends Facade
{
    protected static $name = Application::class;
}