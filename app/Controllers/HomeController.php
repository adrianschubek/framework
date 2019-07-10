<?php

namespace App\Controllers;

use App\Models\MQTT;
use DI\Container;
use Framework\Controller\Controller;
use Framework\Http\RequestInterface;
use Framework\Http\ResponseInterface;
use Framework\Logger\Logger;
use Twig\Environment;

/**
 * Copyright (c) 2019. Adrian Schubek.
 */
class HomeController extends Controller
{
    private $mqtt;

    public function __construct(
        RequestInterface $request,
        ResponseInterface $response,
        Logger $logger,
        Environment $twig,
        Container $container,
        MQTT $mqtt
    )
    {
        parent::__construct($request, $response, $logger, $twig, $container);
        $this->mqtt = $mqtt;
    }

    public function page()
    {
        $filepath = ROOT . "/app/Cache/test.txt";
        if (!file_exists($filepath)) {
            $this->error();
            return;
        }
        $arr = explode(":", file_get_contents($filepath));
        $this->response->setBody($this->render("home.html", [
            "tempx" => $arr[0],
            "wet" => $arr[1],
            "uv" => $arr[4],
            "pressure" => $arr[2],
            "height" => $arr[3],
            "last" => date("H:m:s")
        ]));
        $this->response->send();
    }

    public function error()
    {
        $this->response->setBody($this->render("error.html"));
        $this->response->send();
    }
}