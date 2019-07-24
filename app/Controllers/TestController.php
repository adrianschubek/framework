<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace App\Controllers;

use App\Models\TestModel;
use DI\Annotation\Inject;
use Framework\Controller\Controller;

class TestController extends Controller
{
    /**
     * @Inject
     * @var TestModel
     */
    protected $testModel;

    public function test()
    {
        $this->response->setBody(
            $this->testModel->hello()
        );
        $this->sendResponse();
    }

    public function add(float $x, float $y)
    {
        d($this);
        $this->response->setBody(
            $x + $y
        );
        $this->sendResponse();
    }
}