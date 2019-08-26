<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace App\Controllers;

use Framework\Config\Config;
use Framework\Controller\Controller;
use Framework\Facades\Response;

class TestController extends Controller
{
    public function test()
    {
        $cfg = app(Config::class);
        $cfg->
        Response::body("Hallo");
        d($this);
//        $this->response->body("");
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