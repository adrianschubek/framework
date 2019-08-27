<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace App\Controllers;

use Framework\Controller\Controller;
use Framework\Http\RequestInterface as Request;
use Framework\Http\ResponseInterface as Response;

class TestController extends Controller
{
    public function test(Request $request, Response $response)
    {
        $response->body("Test");
        d($request === $this->request, $response === $this->response);
    }

    public function add(float $x, float $y)
    {
        d($this);
        \Framework\Facades\Response::body(
            $x + $y
        );
    }
}