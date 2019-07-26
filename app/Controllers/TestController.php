<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace App\Controllers;

use App\Models\TestModel;
use DI\Annotation\Inject;
use Framework\Controller\Controller;
use Framework\Database\Blueprint;
use Framework\Database\Schema;

class TestController extends Controller
{
    /**
     * @Inject
     * @var TestModel
     */
    protected $testModel;

    public function test()
    {
        $body = Schema::create("testTable", function (Blueprint $blueprint) {
            $blueprint->string("Lolz", 256);
            $blueprint->integer("id", 5);
        });
        d(Schema::$db);
//        $body = Schema::exists("quiz");
        $this->response->body($body);
        $this->send();
    }

    public function add(float $x, float $y)
    {
        d($this);
        $this->response->body(
            $x + $y
        );
        $this->send();
    }
}