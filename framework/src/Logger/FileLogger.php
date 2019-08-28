<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Logger;


class FileLogger extends Logger
{
    private $filepath = null;

    public function __construct($filepath = null)
    {
        $this->filepath = $filepath;
    }

    public function setFilepath(string $filepath)
    {
        $this->filepath = $filepath;
    }

    public function log(string $type, string $content, \DateTime $time = null)
    {
        $time = ($time === null) ? $time = new \DateTime() : $time;
        $text = "[{$time->format("H:m:s.u - d.m.y")}] [$type] $content";
        file_put_contents($this->filepath, $text . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    public function none(string $content, \DateTime $time = null)
    {
        $time = ($time === null) ? $time = new \DateTime() : $time;
        $text = sprintf("[%s] %s", $time->format("H:m:s.u - d.m.y"), $content);
        file_put_contents($this->filepath, $text . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    public function info(string $content, \DateTime $time = null)
    {
        $time = ($time === null) ? $time = new \DateTime() : $time;
        $text = sprintf("[%s] [%s] %s", $time->format("H:m:s.u - d.m.y"), LoggerType::INFO, $content);
        file_put_contents($this->filepath, $text . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    public function warn(string $content, \DateTime $time = null)
    {
        $time = ($time === null) ? $time = new \DateTime() : $time;
        $text = sprintf("[%s] [%s] %s", $time->format("H:m:s.u - d.m.y"), LoggerType::WARNING, $content);
        file_put_contents($this->filepath, $text . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    public function error(string $content, \DateTime $time = null)
    {
        $time = ($time === null) ? $time = new \DateTime() : $time;
        $text = sprintf("[%s] [%s] %s", $time->format("H:m:s.u - d.m.y"), LoggerType::ERROR, $content);
        file_put_contents($this->filepath, $text . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    public function event(string $content, \DateTime $time = null)
    {
        $time = ($time === null) ? $time = new \DateTime() : $time;
        $text = sprintf("[%s] [%s] %s", $time->format("H:m:s.u - d.m.y"), LoggerType::EVENT, $content);
        file_put_contents($this->filepath, $text . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    public function debug(string $content, \DateTime $time = null)
    {
        if (!$this->shouldLog(5)) return;
        $time = ($time === null) ? $time = new \DateTime() : $time;
        $text = sprintf("[%s] [%s] %s", $time->format("H:m:s.u - d.m.y"), LoggerType::DEBUG, $content);
        file_put_contents($this->filepath, $text . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}