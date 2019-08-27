<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace App\Controllers;


use Framework\Controller\Controller;
use Framework\Facades\Logger;
use Framework\Facades\Response;

class ErrorController extends Controller
{
    public function notFound($args)
    {
        Response::statusCode(404);
        Response::body($this->render("error.html"));
        Logger::warn(sprintf("File not found: %s", $args));
    }

    public function notAllowed($args)
    {
        Response::statusCode(405);
        Response::body($this->render("error.html"));
        Logger::warn(sprintf("Method not allowed: %s", $args));
    }

//    public function notFound($args)
//    {
//        $this->response->statusCode(404);
//        $this->response->body($this->render("error.html"));
//        $this->logger->warn(sprintf("File not found: %s", $args));
//    }
//
//    public function notAllowed($args)
//    {
//        $this->response->statusCode(405);
//        $this->response->body($this->render("error.html"));
//        $this->logger->warn(sprintf("Method not allowed: %s", $args));
//    }
}