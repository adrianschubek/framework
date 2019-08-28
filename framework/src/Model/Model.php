<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Model;

use DI\Annotation\Inject;
use Framework\Database\Database;
use Framework\Logger\Logger;

class Model implements ModelInterface
{
    /**
     * @Inject
     * @var Database
     */
    protected static $db;

    /**
     * @Inject
     * @var Logger
     */
    protected $logger;

    /**
     * @var string
     */
    protected $table;

    /**
     * @var string
     */
    protected $primaryKey = "id";

    /** @var array */
    private $data = [];

    public static function find()
    {
        self::$db->query("SELECT * FROM :table WHERE ");
    }

    public function __get($name)
    {

    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    function getPrimaryKey()
    {
        // TODO: Implement getPrimaryKey() method.
    }
}