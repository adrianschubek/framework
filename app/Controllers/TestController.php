<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace App\Controllers;

use App\Models\TestModel;
use DI\Container;
use Framework\Controller\Controller;
use Framework\Http\RequestInterface;
use Framework\Http\ResponseInterface;
use Framework\Logger\Logger;
use Twig\Environment;

class TestController extends Controller
{
    protected $testModel;

    public function __construct(
        RequestInterface $request,
        ResponseInterface $response,
        Logger $logger,
        Environment $twig,
        Container $container,
        TestModel $model
    )
    {
        parent::__construct($request, $response, $logger, $twig, $container);
        $this->testModel = $model;
    }

    public function test($args = [])
    {
        $this->logger->debug(json($this->middleware));
        $this->testModel->hello();
    }
}