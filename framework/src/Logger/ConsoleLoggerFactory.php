<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Logger;


class ConsoleLoggerFactory implements LoggerFactoryInterface
{
    public function createLogger(): Logger
    {
        return new ConsoleLogger();
    }
}