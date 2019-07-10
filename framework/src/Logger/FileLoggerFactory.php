<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Logger;


class FileLoggerFactory implements LoggerFactoryInterface
{
    private $filepath;

    public function __construct(string $filepath = null)
    {
        if (!$filepath) {
            $filepath = sprintf("%sapp.%s.log", cfg("dir.logs"), (new \DateTime())->format("d-m-y"));
        }
        $this->filepath = $filepath;
    }

    public function createLogger(): Logger
    {
        return new FileLogger($this->filepath);
    }
}