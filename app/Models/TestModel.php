<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace App\Models;

use Framework\Model\Model;

class TestModel extends Model
{
    public function hello()
    {
        return "Ja okay geht ";
    }

    function getPrimaryKey()
    {
        // TODO: Implement getPrimaryKey() method.
    }
}