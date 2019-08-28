<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Database;

/**
 * Genaue Tabellen Struktur
 * @package Framework\Database
 */
class Blueprint
{
    /** @var array */
    private $data = [];

    public function string(string $name, int $maxlength, string $default = null)
    {
        $this->data[] = "{$name} varchar({$maxlength}) {$this->getDefault($default)}";
    }

    private function getDefault($value = null)
    {
        return ($value !== null) ? "DEFAULT '$value'" : null;
    }

    public function integer(string $name, int $default = null)
    {
        $this->data[] = "{$name} int {$this->getDefault($default)}";
    }

    public function bigInteger(string $name)
    {
        $this->data[] = "{$name} bigint";
    }

    public function timestamp(string $name)
    {
        $this->data[] = "{$name} timestamp";
    }

    public function get()
    {
        return implode(", ", $this->data);
    }
}