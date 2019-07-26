<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Database\Migrations;

use DI\Annotation\Inject;
use Framework\Database\Database;

abstract class Migration
{
    /**
     * @Inject
     * @var Database
     */
    protected $db;

    abstract public function up();

    abstract public function down();
}