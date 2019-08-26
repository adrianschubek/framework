<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace App\Migrations;

use Framework\Database\Blueprint;
use Framework\Database\Migrations\Migration;
use Framework\Database\Schema;

class Test extends Migration
{

    public function up()
    {
        $this->db;

        Schema::create("testTable", function (Blueprint $blueprint) {
            $blueprint->string("Lolz", 256);
            $blueprint->integer("id", 5);
        });
    }

    public function down()
    {

    }
}