<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Model;


use Framework\Database\Database;
use Framework\Logger\Logger;

abstract class Model
{
    protected $db, $logger;

    public function __construct(Database $db, Logger $logger)
    {
        $this->db = $db;
        $this->logger = $logger;
    }
}