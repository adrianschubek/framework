<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Model;


interface ModelInterface
{
    static function find();

    function getPrimaryKey();
}