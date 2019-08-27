<?php

namespace App\Controllers;

use App\Models\MQTT;
use DI\Annotation\Inject;
use Framework\Controller\Controller;

/**
 * Copyright (c) 2019. Adrian Schubek.
 */
class HomeController extends Controller
{
    /**
     * @Inject
     * @var MQTT
     */
    private $mqtt;


    public function page()
    {
//        d($this);

        $filepath = ROOT . "/app/Cache/test.txt";
        if (!file_exists($filepath)) {
            $this->error();
            return;
        }
        $arr = explode(":", file_get_contents($filepath));
        $arr = array_map(function ($x) {
            return str_replace(".", ",", $x);
        }, $arr);
        $this->response->body($this->render("home.html", [
            "tempx" => $arr[0],
            "wet" => $arr[1],
            "uv" => $arr[4],
            "pressure" => $arr[2],
            "height" => $arr[3],
            "last" => date("H:m:s")
        ]));
    }

    public function error()
    {
        $this->response->body($this->render("error.html"));
    }
}