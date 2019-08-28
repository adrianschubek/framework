<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Core;

/**
 * Class Autoloader
 * @package Framework\Core
 * @deprecated
 */
class Autoloader
{
    /**
     * @var string
     */
    private $basedir;

    /**
     * Autoloader constructor
     * @param string $basedir
     */
    public function __construct(string $basedir)
    {
        $this->basedir = $basedir;
    }

    /** Lädt zusätzliche PHP-Dateien
     * @param array $data
     * @param string $extension
     */
    public function load(array $data, string $extension = ".php")
    {
        foreach ($data as $file) {
            if (file_exists($this->basedir . $file . $extension)) {
                require_once $this->basedir . $file . $extension;
            }
        }
    }
}