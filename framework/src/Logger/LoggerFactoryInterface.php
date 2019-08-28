<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Logger;


interface LoggerFactoryInterface
{
    public function createLogger(): Logger;
}