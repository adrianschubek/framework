<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Logger;


final class LoggerType
{
    public const NONE = "*";
    public const INFO = "INFO";
    public const SUCCESS = "OK";
    public const WARNING = "WARN";
    public const ERROR = "ERROR";
    public const EVENT = "EVENT";
    public const DEBUG = "DEBUG";

    private function __construct()
    {
    }
}