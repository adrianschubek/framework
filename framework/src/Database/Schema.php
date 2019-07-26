<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Database;

use Closure;

/**
 * Datenbank Tabellenstruktur
 * @package Framework\Database
 */
class Schema
{
    /** @var Database */
    public static $db;

    public static function create(string $tableName, Closure $closure)
    {
        $blueprint = new Blueprint();
        $closure($blueprint);
        return sprintf("CREATE TABLE IF NOT EXISTS %s (%s) ENGINE=%s DEFAULT CHARSET=%s;", $tableName, $blueprint->get(), cfg("db.engine"), cfg("db.charset"));
    }

    public static function exists(string $tablename)
    {
        return self::$db->query("SELECT 1 FROM :name LIMIT 1;", [":name" => $tablename]) !== false;
    }

    public static function drop(string $tablename)
    {
        return self::$db->query("DROP TABLE :name;", [":name" => $tablename]) !== false;
    }
}