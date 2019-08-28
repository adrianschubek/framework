<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Logger;


class ConsoleLoggerFactory implements LoggerFactoryInterface
{
    public function createLogger(): Logger
    {
        return new ConsoleLogger();
    }
}