<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace App\Controllers;


use DI\Container;
use Framework\Controller\Controller;
use Framework\Http\RequestInterface;
use Framework\Http\ResponseInterface;
use Framework\Logger\Logger;
use sskaje\mqtt\Debug;
use sskaje\mqtt\MQTT;
use Twig\Environment;

class ListenerController extends Controller
{
    private $homeController;

    public function __construct(
        RequestInterface $request,
        ResponseInterface $response,
        Logger $logger,
        Environment $twig,
        Container $container,
        HomeController $homeController
    )
    {
        parent::__construct($request, $response, $logger, $twig, $container);
        $this->homeController = $homeController;
    }

    public function show()
    {
        $mqtt = new MQTT(cfg("mqtt.ip"));
        $context = stream_context_create();
        $mqtt->setSocketContext($context);
        Debug::Enable();
//        $mqtt->setAuth('username', '12345678');
        $mqtt->setKeepalive(3600);
        $connected = $mqtt->connect();
        if (!$connected) {
            die("Not connected\n");
        }
        $topics['data/ws'] = 2;
        $mqtt->subscribe($topics);
        //$mqtt->unsubscribe(array_keys($topics));
        $callback = new \App\Models\MQTT($this->logger);
        $mqtt->setHandler($callback);
        $mqtt->loop();
    }
}